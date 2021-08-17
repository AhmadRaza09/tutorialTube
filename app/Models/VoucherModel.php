<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table      = 'voucher';
    protected $primaryKey = 'voucherId';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['userId','seriesId', 'voucherPath', 'createdDate', 'dueDate', 'status'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    //get the voucher request
    function getSubmitVoucherDetail($status, int $limit = 0, int $offset = 0)
    {
        $builder = $this->db->table('voucher');
        $builder->select('voucher.voucherId, voucher.createdDate, voucher.voucherPath,
        voucher.dueDate, voucher.status, series.seriesName, series.seriesType, series_price.seriesPrice, users.email' );
        $builder->join('series', 'voucher.seriesId = series.seriesId', 'left');
        $builder->join('users', 'voucher.userId = users.id', 'left');
        $builder->join('series_price', 'series.seriesId = series_price.seriesId', 'left');
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
        
        // var_dump($eventData['data'][0]['voucherPath']);
        // print_r($eventData['data']);die;

        return $eventData['data'];
    }   

    public function paginateVouchers($status,int $perPage = null, string $group = 'default', int $page = null, int $segment = 0)
	{
		$pager = \Config\Services::pager(null, null, false);

		if ($segment)
		{
			$pager->setSegment($segment);
		}

		$page = $page >= 1 ? $page : $pager->getCurrentPage($group);

        $builder = $this->db->table('voucher');
        $builder->select('voucher.voucherId, voucher.createdDate, voucher.voucherPath,
        voucher.dueDate, voucher.status, series.seriesName, series.seriesType, series_price.seriesPrice, users.email' );
        $builder->join('series', 'voucher.seriesId = series.seriesId', 'left');
        $builder->join('users', 'voucher.userId = users.id', 'left');
        $builder->join('series_price', 'series.seriesId = series_price.seriesId', 'left');
        $builder->where($status);
		$total = $total = $builder->countAllResults();;

		// Store it in the Pager library so it can be
		// paginated in the views.
		$this->pager = $pager->store($group, $page, $perPage, $total, $segment);
		$perPage     = $this->pager->getPerPage($group);
		$offset      = ($page - 1) * $perPage;

		return $this->getSubmitVoucherDetail
        ($status,$perPage, $offset);
	}
}