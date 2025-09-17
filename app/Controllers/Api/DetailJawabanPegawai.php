<?php namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\DetailJawabanPegawaiModel;
use App\Models\EmployeeModel;

class DetailJawabanPegawai extends ResourceController
{
    protected $modelName = DetailJawabanPegawaiModel::class;
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) return $this->failNotFound('Not found');
        return $this->respond($data);
    }

    public function create()
    {
        $payload = $this->request->getJSON(true);
        $rules = ['employee_id'=>'required|is_natural_no_zero','question'=>'required'];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        if (!(new EmployeeModel())->find($payload['employee_id'])) {
            return $this->failValidationErrors(['employee_id'=>'Employee not found']);
        }

        $id = $this->model->insert($payload);
        return $this->respondCreated(['id'=>$id,'message'=>'Created']);
    }

    public function update($id = null)
    {
        if (!$this->model->find($id)) return $this->failNotFound('Not found');
        $payload = $this->request->getJSON(true);
        $rules = ['employee_id'=>'required|is_natural_no_zero','question'=>'required'];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        if (!(new EmployeeModel())->find($payload['employee_id'])) {
            return $this->failValidationErrors(['employee_id'=>'Employee not found']);
        }
        $this->model->update($id, $payload);
        return $this->respond(['message'=>'Updated']);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) return $this->failNotFound('Not found');
        $this->model->delete($id);
        return $this->respondDeleted(['message'=>'Deleted']);
    }
}
