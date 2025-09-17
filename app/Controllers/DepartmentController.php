<?php

namespace App\Controllers;

use App\Models\DepartmentModel;

class DepartmentController extends BaseController
{
    protected $departmentModel;

    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
    }

    // ==========================
    // List Departemen
    // ==========================
    public function index()
    {
        $data['departemen'] = $this->departmentModel->findAll();
        return view('departemen/index', $data);
    }

    // ==========================
    // Form Create
    // ==========================
    public function create()
    {
        return view('departemen/create');
    }

    // ==========================
    // Store (AJAX)
    // ==========================
    public function storeAjax()
    {
        if ($this->request->isAJAX()) {
            $rules = ['name' => 'required|min_length[3]'];

            if (! $this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $this->validator->getErrors()
                ]);
            }

            $this->departmentModel->insert([
                'name'   => $this->request->getPost('name'),
                'active' => 1
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Departemen berhasil ditambahkan'
            ]);
        }

        return redirect()->to('/departemen');
    }

    // ==========================
    // Form Edit
    // ==========================
    public function edit($id)
    {
        $data['departemen'] = $this->departmentModel->find($id);
        return view('departemen/edit', $data);
    }

    // ==========================
    // Update (AJAX)
    // ==========================
    public function updateAjax($id)
    {
        if ($this->request->isAJAX()) {
            $rules = ['name' => 'required|min_length[3]'];

            if (! $this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $this->validator->getErrors()
                ]);
            }

            $this->departmentModel->update($id, [
                'name'   => $this->request->getPost('name'),
                'active' => $this->request->getPost('active') ?? 1
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Departemen berhasil diupdate'
            ]);
        }

        return redirect()->to('/departemen');
    }

    // ==========================
    // Delete (AJAX)
    // ==========================
    public function deleteAjax($id)
    {
        if ($this->request->isAJAX()) {
            $data = $this->departmentModel->find($id);
            if (! $data) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Departemen tidak ditemukan'
                ]);
            }

            $this->departmentModel->delete($id);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Departemen berhasil dihapus'
            ]);
        }

        return redirect()->to('/departemen');
    }
}
