<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\KeahlianModel;
use App\Models\JawabanPegawaiModel;
use App\Models\DetailJawabanPegawaiModel;
use App\Models\AnswerModel;
use App\Models\QuestionModel;

// Tambahan namespace untuk Excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends BaseController
{
    protected $employeeModel;
    protected $departmentModel;
    protected $keahlianModel;
    protected $jawabanPegawaiModel;
    protected $detailJawabanPegawaiModel;
    protected $answerModel;
    protected $questionModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->departmentModel = new DepartmentModel();
        $this->keahlianModel = new KeahlianModel();
        $this->jawabanPegawaiModel = new JawabanPegawaiModel();
        $this->detailJawabanPegawaiModel = new DetailJawabanPegawaiModel();
        $this->answerModel = new AnswerModel();
        $this->questionModel = new QuestionModel();
    }

    // ==============================
    // 1. Laporan Pegawai per Departemen
    // ==============================
    public function perDepartemen()
    {
        $departemen = $this->departmentModel->findAll();
        $data = [];

        foreach ($departemen as $d) {
            $pegawai = $this->employeeModel->where('departemenid', $d['id'])->findAll();
            $data[] = [
                'departemen' => $d['name'],
                'pegawai' => $pegawai
            ];
        }

        return view('report/per_departemen', ['data' => $data]);
    }

    public function exportDepartemenExcel()
    {
        $departemen = $this->departmentModel->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Departemen');
        $sheet->setCellValue('B1', 'Pegawai');
        $sheet->setCellValue('C1', 'Gender');

        $row = 2;
        foreach ($departemen as $d) {
            $pegawai = $this->employeeModel->where('departemenid', $d['id'])->findAll();
            foreach ($pegawai as $p) {
                $sheet->setCellValue("A$row", $d['name']);
                $sheet->setCellValue("B$row", $p['name']);
                $sheet->setCellValue("C$row", $p['gender'] == 'P' ? 'Pria' : 'Wanita');
                $row++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Pegawai_Departemen.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // ==============================
    // 2. Laporan Pegawai per Keahlian
    // ==============================
    public function perKeahlian()
    {
        $keahlian = $this->keahlianModel->findAll();
        $data = [];

        foreach ($keahlian as $k) {
            $pegawai = $this->employeeModel
                ->like('keahlian', $k['id'])
                ->findAll();

            $data[] = [
                'keahlian' => $k['name'],
                'pegawai' => $pegawai
            ];
        }

        return view('report/per_keahlian', ['data' => $data]);
    }

    public function exportKeahlianExcel()
    {
        $keahlian = $this->keahlianModel->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Keahlian');
        $sheet->setCellValue('B1', 'Pegawai');
        $sheet->setCellValue('C1', 'Departemen');

        $row = 2;
        foreach ($keahlian as $k) {
            $pegawai = $this->employeeModel->like('keahlian', $k['id'])->findAll();
            foreach ($pegawai as $p) {
                $departemen = $this->departmentModel->find($p['departemenid']);
                $sheet->setCellValue("A$row", $k['name']);
                $sheet->setCellValue("B$row", $p['name']);
                $sheet->setCellValue("C$row", $departemen['name'] ?? '-');
                $row++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Pegawai_Keahlian.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // ==============================
    // 3. Laporan Hasil Kuis Pegawai
    // ==============================
    public function hasilKuis()
    {
        $jawabanPegawai = $this->jawabanPegawaiModel
            ->select('jawaban_pegawai.*, pegawai.name as pegawai')
            ->join('pegawai', 'pegawai.id = jawaban_pegawai.pegawaiid')
            ->findAll();

        $data = [];

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

            $data[] = [
                'pegawai' => $jp['pegawai'],
                'score'   => $score,
                'total'   => $total
            ];
        }

        return view('report/hasil_kuis', ['data' => $data]);
    }

    public function exportHasilKuisExcel()
    {
        $jawabanPegawai = $this->jawabanPegawaiModel
            ->select('jawaban_pegawai.*, pegawai.name as pegawai')
            ->join('pegawai', 'pegawai.id = jawaban_pegawai.pegawaiid')
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Pegawai');
        $sheet->setCellValue('B1', 'Score');
        $sheet->setCellValue('C1', 'Total Soal');

        $row = 2;

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

            $sheet->setCellValue("A$row", $jp['pegawai']);
            $sheet->setCellValue("B$row", $score);
            $sheet->setCellValue("C$row", $total);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Hasil_Kuis.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
