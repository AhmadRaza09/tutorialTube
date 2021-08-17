<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table      = 'comments';
    protected $primaryKey = 'commentId';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ["tutorialId", "userId", "comment"];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    // encryptpassword

    //get all the comment of the particular tutorial
    function getAllComment($id)
    {
        
        $builder = $this->db->table('comments');
        $builder->orderBy('commentId', 'DESC');
        $builder->select('comments.comment, users.email'); 
        $builder->join('users', 'comments.userId = users.id');
        $builder->where('comments.tutorialId', $id);
        $result = $builder->get();
        $result = $result->getResult('array');
        return $result;
        // echo "<pre>";
        // print_r($result);d
    }
    
}