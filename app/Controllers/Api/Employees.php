<?php namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\PositionModel;

class Employees extends ResourceController
{
    protected $modelName = EmployeeModel::class;
    protected $format = 'json';

    public function index()
    {
        // join to show department and position labels
        $builder = $this->model->builder();
        $builder->select('employees.*, departments.name as department_name, positions.title as position_title');
        $builder->join('departments','departments.id = employees.department_id','left');
        $builder->join('positions','positions.id = employees.position_id','left');
        $data = $builder->get()->getResultArray();
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) return $this->failNotFound('Employee not found');
        return $this->respond($data);
    }

    public function create()
    {
        $payload = $this->request->getJSON(true);
        $rules = [
            'nik' => 'required|min_length[3]|max_length[50]|is_unique[employees.nik]',
            'name'=> 'required|min_length[2]',
            'email'=> 'permit_empty|valid_email',
            'department_id' => 'permit_empty|is_natural_no_zero',
            'position_id'   => 'permit_empty|is_natural_no_zero',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        // FK checks
        if (!empty($payload['department_id']) && !(new DepartmentModel())->find($payload['department_id'])) {
            return $this->failValidationErrors(['department_id'=>'Department not found']);
        }
        if (!empty($payload['position_id']) && !(new PositionModel())->find($payload['position_id'])) {
            return $this->failValidationErrors(['position_id'=>'Position not found']);
        }

        $id = $this->model->insert($payload);
        return $this->respondCreated(['id'=>$id,'message'=>'Employee created']);
    }

    public function update($id = null)
    {
        $existing = $this->model->find($id);
        if (!$existing) return $this->failNotFound('Employee not found');

        $payload = $this->request->getJSON(true);
        // If nik changed, ensure uniqueness
        if (!empty($payload['nik']) && $payload['nik'] !== $existing['nik']) {
            $exists = $this->model->where('nik', $payload['nik'])->first();
            if ($exists) return $this->failValidationErrors(['nik'=>'NIK already used']);
        }

        $rules = [
            'nik' => 'required|min_length[3]|max_length[50]',
            'name'=> 'required|min_length[2]',
            'email'=> 'permit_empty|valid_email',
            'department_id' => 'permit_empty|is_natural_no_zero',
            'position_id'   => 'permit_empty|is_natural_no_zero',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        // FK checks
        if (!empty($payload['department_id']) && !(new DepartmentModel())->find($payload['department_id'])) {
            return $this->failValidationErrors(['department_id'=>'Department not found']);
        }
        if (!empty($payload['position_id']) && !(new PositionModel())->find($payload['position_id'])) {
            return $this->failValidationErrors(['position_id'=>'Position not found']);
        }

        $this->model->update($id, $payload);
        return $this->respond(['message'=>'Employee updated']);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) return $this->failNotFound('Employee not found');
        $this->model->delete($id);
        return $this->respondDeleted(['message'=>'Employee deleted']);
    }
}
