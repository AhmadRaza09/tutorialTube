<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['firstName','lastName', 'email', 'role','password', 'status'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    // encryptpassword
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    
    function beforeInsert($data)
    {
        return $this->hashpassword($data);
        
    }

    function beforeUpdate($data)
    {
        if(isset($data['data']['password']) && $data['data']['password'] != "")
        {
            return $this->hashpassword($data);
        }
        else
        {
            return $data;
        }
    }
    protected function hashpassword($data)
    {
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }
}