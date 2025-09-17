<?php namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PositionModel;
use App\Models\DepartmentModel;

class Positions extends ResourceController
{
    protected $modelName = PositionModel::class;
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) return $this->failNotFound('Position not found');
        return $this->respond($data);
    }

    public function create()
    {
        $payload = $this->request->getJSON(true);
        $rules = ['department_id'=>'required|is_natural_no_zero', 'title'=>'required|min_length[2]'];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        // check department exists
        $dept = (new DepartmentModel())->find($payload['department_id']);
        if (!$dept) return $this->failValidationErrors(['department_id'=>'Referenced department does not exist']);

        $id = $this->model->insert($payload);
        return $this->respondCreated(['id'=>$id, 'message'=>'Position created']);
    }

    public function update($id = null)
    {
        if (!$this->model->find($id)) return $this->failNotFound('Position not found');
        $payload = $this->request->getJSON(true);
        $rules = ['department_id'=>'required|is_natural_no_zero', 'title'=>'required|min_length[2]'];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $dept = (new DepartmentModel())->find($payload['department_id']);
        if (!$dept) return $this->failValidationErrors(['department_id'=>'Referenced department does not exist']);
        $this->model->update($id, $payload);
        return $this->respond(['message'=>'Position updated']);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) return $this->failNotFound('Position not found');
        $this->model->delete($id);
        return $this->respondDeleted(['message'=>'Position deleted']);
    }
}
