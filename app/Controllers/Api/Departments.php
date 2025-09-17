<?php namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\DepartmentModel;

class Departments extends ResourceController
{
    protected $modelName = DepartmentModel::class;
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) return $this->failNotFound('Department not found');
        return $this->respond($data);
    }

    public function create()
    {
        $payload = $this->request->getJSON(true);
        $rules = ['name'=>'required|min_length[2]|max_length[150]'];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $id = $this->model->insert($payload);
        return $this->respondCreated(['id'=>$id, 'message'=>'Department created']);
    }

    public function update($id = null)
    {
        if (!$this->model->find($id)) return $this->failNotFound('Department not found');
        $payload = $this->request->getJSON(true);
        $rules = ['name'=>'required|min_length[2]|max_length[150]'];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $this->model->update($id, $payload);
        return $this->respond(['message'=>'Department updated']);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) return $this->failNotFound('Department not found');
        $this->model->delete($id);
        return $this->respondDeleted(['message'=>'Department deleted']);
    }
}
