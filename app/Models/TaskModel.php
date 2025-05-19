<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
   protected $table      = 'tasks';
   protected $primaryKey = 'id';

   protected $useAutoIncrement = true;
   protected $returnType       = 'array';
   protected $useSoftDeletes   = false;

   protected $allowedFields = [
      'title',
      'description',
      'priority',
      'status',
      'due_date',
      'created_at',
      'updated_at'
   ];

   protected $useTimestamps = true;
   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';

   protected $validationRules    = [
      'title'    => 'required|min_length[3]|max_length[150]',
      'priority' => 'in_list[Low,Medium,High]',
      'status'   => 'in_list[Pending,In Progress,Completed]'
   ];

   protected $validationMessages = [];
   protected $skipValidation     = false;
}
