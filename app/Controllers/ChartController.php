<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\DepartmentModel;

class ChartController extends BaseController
{
    protected $employeeModel;
    protected $departmentModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->departmentModel = new DepartmentModel();
    }

    public function index()
    {
        // Pie Chart (Gender)
        $genderData = $this->employeeModel
            ->select('gender, COUNT(*) as jml')
            ->groupBy('gender')
            ->findAll();

        $genderLabels = array_column($genderData, 'gender');
        $genderCounts = array_column($genderData, 'jml');

        // Bar Chart (Pegawai per Departemen)
        $deptData = $this->employeeModel
            ->select('departemen.name as dept, COUNT(pegawai.id) as jml')
            ->join('departemen', 'departemen.id = pegawai.departemenid')
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
