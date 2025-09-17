<?php

namespace App\Controllers;

use App\Models\KeahlianModel;

class KeahlianController extends BaseController
{
    protected $keahlianModel;

    public function __construct()
    {
        $this->keahlianModel = new KeahlianModel();
    }

    // List
    public function index()
    {
        $data['keahlian'] = $this->keahlianModel->findAll();
        return view('keahlian/index', $data);
    }

    // Form Create
    public function create()
    {
        return view('keahlian/create');
    }

    // Store AJAX
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

            $this->keahlianModel->insert([
                'name'   => $this->request->getPost('name'),
                'active' => 1,
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Keahlian berhasil ditambahkan'
            ]);
        }
        return redirect()->to('/keahlian');
    }

    // Form Edit
    public function edit($id)
    {
        $data['keahlian'] = $this->keahlianModel->find($id);
        return view('keahlian/edit', $data);
    }

    // Update AJAX
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

            $this->keahlianModel->update($id, [
                'name'   => $this->request->getPost('name'),
                'active' => $this->request->getPost('active') ?? 1,
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Keahlian berhasil diupdate'
            ]);
        }
        return redirect()->to('/keahlian');
    }

    // Delete AJAX
    public function deleteAjax($id)
    {
        if ($this->request->isAJAX()) {
            $keahlian = $this->keahlianModel->find($id);
            if (! $keahlian) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Keahlian tidak ditemukan'
                ]);
            }

            $this->keahlianModel->delete($id);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Keahlian berhasil dihapus'
            ]);
        }
        return redirect()->to('/keahlian');
    }
}
