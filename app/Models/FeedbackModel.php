<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table      = 'feedback';
    protected $primaryKey = 'feedbackId';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ["tutorialId", "tutorialLike", "userId", "tutorialWatchCount"];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    // get feeback if feebacktype is 1 then get like otherwise get dislike
    function getFeedback($id, $feedbackType)
    {
        $builder = $this->db->table('feedback');
        $builder->select('Count(tutorialLike) as feedback'); 
        $builder->where(['tutorialId'=>$id, "tutorialLike"=>$feedbackType]);
        $result = $builder->get();
        $result = $result->getRowArray();
    //    echo  $query = $this->db->getLastQuery();
        return $result;
        // echo "<pre>";
        // print_r($result);
    }

    //get all the views of the partiular tutorial
    function views($id)
    {
        $builder = $this->db->table('feedback');
        $builder->select('Count(tutorialWatchCount) as views'); 
        $builder->where(['tutorialId'=>$id, "tutorialWatchCount"=>1]);
        $result = $builder->get();
        $result = $result->getRowArray();
    //    echo  $query = $this->db->getLastQuery();
        return $result;
        // echo "<pre>";
        // print_r($result);
    }
    
}