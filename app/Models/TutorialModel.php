<?php

namespace App\Models;

use CodeIgniter\Model;

class TutorialModel extends Model
{
    protected $table      = 'tutorials';
    protected $primaryKey = 'tutorialId';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ["tutorialTitle", "tutorialPath", "seriesId"];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    // encryptpassword

    // function getTutorialDetail($id)
    // {
    //     $builder = $this->db->table('tutorials');
       
    // }
    
}