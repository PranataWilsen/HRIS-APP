<?php

namespace App\Models;

use CodeIgniter\Model;

class AnswerModel extends Model
{
    protected $table = 'answers';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'questionid',
        'text',
        'isanswer',
        'active',
    ];
}
