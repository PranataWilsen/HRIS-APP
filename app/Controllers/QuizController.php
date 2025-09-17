<?php

namespace App\Controllers;

use App\Models\QuestionModel;
use App\Models\AnswerModel;
use App\Models\JawabanPegawaiModel;
use App\Models\DetailJawabanPegawaiModel;
use App\Models\EmployeeModel;

class QuizController extends BaseController
{
    protected $questionModel;
    protected $answerModel;
    protected $jawabanPegawaiModel;
    protected $detailJawabanPegawaiModel;
    protected $employeeModel;

    public function __construct()
    {
        $this->questionModel           = new QuestionModel();
        $this->answerModel             = new AnswerModel();
        $this->jawabanPegawaiModel     = new JawabanPegawaiModel();
        $this->detailJawabanPegawaiModel = new DetailJawabanPegawaiModel();
        $this->employeeModel           = new EmployeeModel();
    }

    // ==========================
    // Halaman Kuis
    // ==========================
    public function index()
    {
        $data['questions'] = $this->questionModel->where('active', 1)->findAll();
        foreach ($data['questions'] as &$q) {
            $q['answers'] = $this->answerModel->where('questionid', $q['id'])->findAll();
        }

        // ✅ Dropdown pegawai
        $data['pegawai'] = $this->employeeModel
            ->select('id, name')
            ->where('active', 1)
            ->findAll();

        return view('quiz/index', $data);
    }

    // ==========================
    // Submit jawaban
    // ==========================
    public function submit()
    {
        $pegawaiId = $this->request->getPost('pegawaiid');
        $answers   = $this->request->getPost('answers'); // array questionid => [answerid]

        if (!$pegawaiId || empty($answers)) {
            return redirect()->to('/quiz')->with('error', 'Silakan pilih pegawai dan jawab pertanyaan.');
        }

        // insert jawaban_pegawai
        $jawabanPegawaiId = $this->jawabanPegawaiModel->insert([
            'pegawaiid' => $pegawaiId,
            'active'    => 1
        ]);

        // simpan detail jawaban
        foreach ($answers as $questionId => $answerIds) {
            if (is_array($answerIds)) {
                $answerIds = implode(',', $answerIds);
            }
            $this->detailJawabanPegawaiModel->insert([
                'jawabanpegawaiid' => $jawabanPegawaiId,
                'questionid'       => $questionId,
                'answer'           => $answerIds
            ]);
        }

        return redirect()->to('/quiz/result/' . $jawabanPegawaiId);
    }

    // ==========================
    // Hasil kuis
    // ==========================
    public function result($id)
    {
        $details = $this->detailJawabanPegawaiModel
            ->where('jawabanpegawaiid', $id)
            ->findAll();

        $score = 0;
        $total = count($details);

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

        $data['score'] = $score;
        $data['total'] = $total;

        return view('quiz/result', $data);
    }
}
