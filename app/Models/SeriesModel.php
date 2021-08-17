<?php

namespace App\Models;

use CodeIgniter\Model;

class SeriesModel extends Model
{
    protected $table      = 'series';
    protected $primaryKey = 'seriesId';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['seriesName','seriesType', 'seriesCategory', 'seriesDescription', 'seriesImage','seriesUploadedBy', 'status'];

    //get count of the request for the dashboard
    function getCount($tbl, $status)
    {
        $builder  = $this->db->table($tbl);
		$builder->where('status', $status);
        $result = $builder->countAllResults();
		// echo $builder->countAllResults();die;
        return $result;
    }

    //get email of the particular user
    function getEMail($id)
    {
        $builder = $this->db->table('series');
        $builder->select('users.email' );
        $builder->join('users', 'series.seriesUploadedBy = users.id ','left');
        $builder->where('seriesId',$id);
        $result  = $builder->get();
        $result = $result->getRowArray();
        // print_r($result);die;
        return $result;
    }


    //get the voucher detail
    function getVoucherDetail($id)
    {
        
        $builder = $this->db->table('series');
        $builder->select('series.seriesName, series_price.seriesPrice' );
        $builder->join('series_price', 'series.seriesId = series_price.seriesId ','right');
        $builder->where('series.seriesId',$id);
        $result  = $builder->get();
        $result = $result->getRowArray();
        // print_r($result);die;
        return $result;
    }

    //show all the series request
    function showAllSeriesRequest($status, int $limit = 0, int $offset = 0)
    {
    //    $builder =$this->builder;
        $builder = $this->db->table('series');
        $builder->select('series.seriesId, series.seriesName, series.seriesType, series.seriesCategory, series.seriesUploadedBy,  series_price.seriesPrice, users.email' );
        $builder->join('series_price', 'series_price.seriesId = series.seriesId ','left');
        $builder->join('users', 'users.id = series.seriesUploadedBy', 'left');
        $builder->where($status);
        
        if ($this->tempUseSoftDeletes === true)
		{
			$builder->where($this->table . '.' . $this->deletedField, null);
		}
       
        $row = $builder->limit($limit, $offset)
        ->get();
        $row = $row->getResult($this->tempReturnType);

		$eventData = $this->trigger('afterFind', ['data' => $row, 'limit' => $limit, 'offset' => $offset]);
        $this->tempReturnType     = $this->returnType;
		$this->tempUseSoftDeletes = $this->useSoftDeletes;
        
        return $eventData['data'];

    }

    //for pagination
    public function paginateSeries($status,int $perPage = null, string $group = 'default', int $page = null, int $segment = 0)
	{
		$pager = \Config\Services::pager(null, null, false);

		if ($segment)
		{
			$pager->setSegment($segment);
		}

		$page = $page >= 1 ? $page : $pager->getCurrentPage($group);

		$builder = $this->db->table('series');
        $builder->select('series.seriesId, series.seriesName, series.seriesType, series.seriesCategory, series.seriesUploadedBy,  series_price.seriesPrice, users.email' );
        $builder->join('series_price', 'series_price.seriesId = series.seriesId ','left');
        $builder->join('users', 'users.id = series.seriesUploadedBy', 'left');
        $builder->where($status);
        $total = $builder->countAllResults();

		// Store it in the Pager library so it can be
		// paginated in the views.
		$this->pager = $pager->store($group, $page, $perPage, $total, $segment);
		$perPage     = $this->pager->getPerPage($group);
		$offset      = ($page - 1) * $perPage;

		return $this->showAllSeriesRequest
        ($status,$perPage, $offset);
	}
    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    // encryptpassword
    
}