<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\KeahlianModel;

class EmployeeController extends BaseController
{
    protected $employeeModel;
    protected $departmentModel;
    protected $keahlianModel;

    public function __construct()
    {
        $this->employeeModel   = new EmployeeModel();
        $this->departmentModel = new DepartmentModel();
        $this->keahlianModel   = new KeahlianModel();
    }

    // ==========================
    // List Pegawai
    // ==========================
    public function index()
    {
        $data['pegawai'] = $this->employeeModel
            ->select('pegawai.*, departemen.name as departemen')
            ->join('departemen', 'departemen.id = pegawai.departemenid')
            ->orderBy('pegawai.id', 'ASC') 
            ->findAll();

        $keahlian = $this->keahlianModel->findAll();
        $data['keahlianMap'] = array_column($keahlian, 'name', 'id');

        return view('pegawai/index', $data);
    }

    // ==========================
    // Form Create
    // ==========================
    public function create()
    {
        $data['departemen'] = $this->departmentModel->findAll();
        $data['keahlian']   = $this->keahlianModel->findAll();

        return view('pegawai/create', $data);
    }

    // ==========================
    // Store (AJAX)
    // ==========================
    public function storeAjax()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'name'         => 'required|min_length[3]',
                'gender'       => 'required|in_list[P,W]',
                'departemenid' => 'required|integer',
            ];

            if (! $this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $keahlian = $this->request->getPost('keahlian') ?? [];
            $keahlianStr = implode(',', $keahlian);

            $this->employeeModel->insert([
                'name'         => $this->request->getPost('name'),
                'gender'       => $this->request->getPost('gender'),
                'departemenid' => $this->request->getPost('departemenid'),
                'address'      => $this->request->getPost('address'),
                'keahlian'     => $keahlianStr,
                'active'       => 1, // default aktif
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Pegawai berhasil ditambahkan',
            ]);
        }

        return redirect()->to('/pegawai');
    }

    // ==========================
    // Form Edit
    // ==========================
    public function edit($id)
    {
        $data['pegawai']    = $this->employeeModel->find($id);
        $data['departemen'] = $this->departmentModel->findAll();
        $data['keahlian']   = $this->keahlianModel->findAll();

        return view('pegawai/edit', $data);
    }

    // ==========================
    // Update (AJAX)
    // ==========================
    public function updateAjax($id)
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'name'         => 'required|min_length[3]',
                'gender'       => 'required|in_list[P,W]',
                'departemenid' => 'required|integer',
            ];

            if (! $this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $keahlian = $this->request->getPost('keahlian') ?? [];
            $keahlianStr = implode(',', $keahlian);

            $this->employeeModel->update($id, [
                'name'         => $this->request->getPost('name'),
                'gender'       => $this->request->getPost('gender'),
                'departemenid' => $this->request->getPost('departemenid'),
                'address'      => $this->request->getPost('address'),
                'keahlian'     => $keahlianStr,
                'active'       => $this->request->getPost('active') ?? 1,
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Pegawai berhasil diupdate',
            ]);
        }

        return redirect()->to('/pegawai');
    }

    // ==========================
    // Toggle Active (AJAX)
    // ==========================
    public function toggleActive($id)
    {
        if ($this->request->isAJAX()) {
            $pegawai = $this->employeeModel->find($id);
            if (! $pegawai) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Pegawai tidak ditemukan',
                ]);
            }

            $newStatus = $pegawai['active'] ? 0 : 1;

            $this->employeeModel->update($id, [
                'active' => $newStatus,
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => $newStatus 
                    ? 'Pegawai berhasil diaktifkan'
                    : 'Pegawai berhasil dinonaktifkan',
            ]);
        }

        return redirect()->to('/pegawai');
    }
}
