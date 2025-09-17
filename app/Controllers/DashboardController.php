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
        $this->employeeModel = new EmployeeModel();
        $this->departmentModel = new DepartmentModel();
        $this->keahlianModel = new KeahlianModel();
        $this->jawabanPegawaiModel = new JawabanPegawaiModel();
        $this->detailJawabanPegawaiModel = new DetailJawabanPegawaiModel();
        $this->answerModel = new AnswerModel();
    }

    public function index()
    {
        // total
        $totalPegawai = $this->employeeModel->countAllResults();
        $totalDepartemen = $this->departmentModel->countAllResults();
        $totalKeahlian = $this->keahlianModel->countAllResults();

        // rata-rata nilai kuis
        $jawabanPegawai = $this->jawabanPegawaiModel->findAll();
        $totalNilai = 0;
        $totalPeserta = 0;
        foreach ($jawabanPegawai as $jp) {
            $details = $this->detailJawabanPegawaiModel
                ->where('jawabanpegawaiid', $jp['id'])
                ->findAll();

            $score = 0;
            $total = count($details);

            foreach ($details as $d) {
                $correct = $this->answerModel
                    ->where('questionid', $d['questionid'])
                    ->where('isanswer', 1)
                    ->findAll();

                $correctIds = array_column($correct, 'id');
                $userIds = explode(',', $d['answer']);

                sort($correctIds);
                sort($userIds);

                if ($correctIds == $userIds) {
                    $score++;
                }
            }

            if ($total > 0) {
                $totalNilai += ($score / $total) * 100;
                $totalPeserta++;
            }
        }
        $rataNilai = $totalPeserta > 0 ? round($totalNilai / $totalPeserta, 2) : 0;

        // chart gender
        $genderData = $this->employeeModel
            ->select('gender, COUNT(*) as jml')
            ->groupBy('gender')
            ->findAll();

        $genderLabels = array_column($genderData, 'gender');
        $genderCounts = array_column($genderData, 'jml');

        // chart departemen
        $deptData = $this->employeeModel
            ->select('departemen.name as dept, COUNT(pegawai.id) as jml')
            ->join('departemen', 'departemen.id = pegawai.departemenid')
            ->groupBy('departemenid')
            ->findAll();

        $deptLabels = array_column($deptData, 'dept');
        $deptCounts = array_column($deptData, 'jml');

        return view('dashboard/index', [
            'totalPegawai' => $totalPegawai,
            'totalDepartemen' => $totalDepartemen,
            'totalKeahlian' => $totalKeahlian,
            'rataNilai' => $rataNilai,
            'genderLabels' => $genderLabels,
            'genderCounts' => $genderCounts,
            'deptLabels' => $deptLabels,
            'deptCounts' => $deptCounts
        ]);
    }
}
