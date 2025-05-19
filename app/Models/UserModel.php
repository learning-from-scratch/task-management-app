<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
   protected $table      = 'users';
   protected $primaryKey = 'id';

   protected $useAutoIncrement = true;
   protected $returnType       = 'array';
   protected $useSoftDeletes   = false;

   protected $allowedFields = [
      'username',
      'email',
      'password_hash',
      'created_at',
      'updated_at'
   ];

   protected $useTimestamps = true;
   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';

   protected $validationRules    = [
      'username' => 'required|min_length[3]|max_length[100]',
      'email'    => 'required|valid_email|is_unique[users.email]',
      'password_hash' => 'required|min_length[6]'
   ];

   protected $validationMessages = [];
   protected $skipValidation     = false;
}
