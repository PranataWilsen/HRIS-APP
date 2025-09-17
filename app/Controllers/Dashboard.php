<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\KeahlianModel;
use App\Models\JawabanPegawaiModel;
use App\Models\DetailJawabanPegawaiModel;
use App\Models\AnswerModel;

class Dashboard extends BaseController
{
    protected $employeeModel;
    protected $departmentModel;
    protected $keahlianModel;
    protected $jawabanPegawaiModel;
    protected $detailJawabanPegawaiModel;
    protected $answerModel;

    public function __construct()
    {
        $this->employeeModel          = new EmployeeModel();
        $this->departmentModel        = new DepartmentModel();
        $this->keahlianModel          = new KeahlianModel();
        $this->jawabanPegawaiModel    = new JawabanPegawaiModel();
        $this->detailJawabanPegawaiModel = new DetailJawabanPegawaiModel();
        $this->answerModel            = new AnswerModel();
    }

    public function index()
    {
        // ==========================
        // Total data (hanya pegawai aktif)
        // ==========================
        $totalPegawai    = $this->employeeModel->where('active', 1)->countAllResults();
        $totalDepartemen = $this->departmentModel->countAllResults();
        $totalKeahlian   = $this->keahlianModel->countAllResults();

        // ==========================
        // Hitung rata-rata nilai kuis
        // ==========================
        $jawabanPegawai = $this->jawabanPegawaiModel
            ->select('jawaban_pegawai.*, pegawai.name as pegawai, pegawai.active')
            ->join('pegawai', 'pegawai.id = jawaban_pegawai.pegawaiid')
            ->where('pegawai.active', 1) 
            ->findAll();

        $totalNilai   = 0;
        $totalPeserta = 0;
        $benar100     = [];

        foreach ($jawabanPegawai as $jp) {
            $details   = $this->detailJawabanPegawaiModel
                ->where('jawabanpegawaiid', $jp['id'])
                ->findAll();

            $score     = 0;
            $totalSoal = count($details);

            foreach ($details as $d) {
                $correct = $this->answerModel
                    ->where('questionid', $d['questionid'])
                    ->where('isanswer', 1)
                    ->findAll();

                $correctIds = array_column($correct, 'id');
                $userIds    = explode(',', $d['answer']);

                sort($correctIds);
                sort($userIds);

                if ($correctIds == $userIds) {
                    $score++;
                }
            }

            if ($totalSoal > 0) {
                $nilai = ($score / $totalSoal) * 100;
                $totalNilai += $nilai;
                $totalPeserta++;
            }

            if ($totalSoal > 0 && $score == $totalSoal) {
                $benar100[] = [
                    'pegawai'       => $jp['pegawai'],
                    'total_soal'    => $totalSoal,
                    'jawaban_benar' => $score
                ];
            }
        }

        $rataNilai = $totalPeserta > 0 ? round($totalNilai / $totalPeserta, 2) : 0;

        // ==========================
        // Chart Gender (hanya pegawai aktif)
        // ==========================
        $genderData = $this->employeeModel
            ->select('gender, COUNT(*) as jml')
            ->where('active', 1)
            ->groupBy('gender')
            ->findAll();

        $genderLabels = array_column($genderData, 'gender');
        $genderCounts = array_column($genderData, 'jml');

        // ==========================
        // Chart Departemen (hanya pegawai aktif)
        // ==========================
        $deptData = $this->employeeModel
            ->select('departemen.name as dept, COUNT(pegawai.id) as jml')
            ->join('departemen', 'departemen.id = pegawai.departemenid')
            ->where('pegawai.active', 1)
            ->groupBy('departemenid')
            ->findAll();

        $deptLabels = array_column($deptData, 'dept');
        $deptCounts = array_column($deptData, 'jml');

        // ==========================
        // Return ke view
        // ==========================
        return view('dashboard/index', [
            'totalPegawai'    => $totalPegawai,
            'totalDepartemen' => $totalDepartemen,
            'totalKeahlian'   => $totalKeahlian,
            'rataNilai'       => $rataNilai,
            'genderLabels'    => $genderLabels,
            'genderCounts'    => $genderCounts,
            'deptLabels'      => $deptLabels,
            'deptCounts'      => $deptCounts,
            'benar100'        => $benar100
        ]);
    }
}
