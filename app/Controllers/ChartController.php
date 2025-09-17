<?php

namespace App\Controllers;

use App\Models\EmployeeModel;

class ChartController extends BaseController
{
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function index()
    {
        $genderData = $this->employeeModel
            ->select('gender, COUNT(*) as jml')
            ->where('active', 1)
            ->groupBy('gender')
            ->findAll();

        $genderLabels = array_column($genderData, 'gender');
        $genderCounts = array_column($genderData, 'jml');

        $deptData = $this->employeeModel
            ->select('departemen.name as dept, COUNT(pegawai.id) as jml')
            ->join('departemen', 'departemen.id = pegawai.departemenid')
            ->where('pegawai.active', 1)
            ->groupBy('departemenid')
            ->findAll();

        $deptLabels = array_column($deptData, 'dept');
        $deptCounts = array_column($deptData, 'jml');

        return view('chart/index', [
            'genderLabels' => $genderLabels,
            'genderCounts' => $genderCounts,
            'deptLabels'   => $deptLabels,
            'deptCounts'   => $deptCounts,
        ]);
    }
}
