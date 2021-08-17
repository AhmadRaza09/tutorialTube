<?php

namespace App\Models;

use CodeIgniter\Model;

class SeriesPriceModel extends Model
{
    protected $table      = 'series_price';
    // protected $primaryKey = 'seriesId';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ["seriesId", "seriesPrice"];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    // encryptpassword
    
}