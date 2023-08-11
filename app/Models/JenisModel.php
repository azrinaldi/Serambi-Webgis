<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mstr_jenis';
    protected $primaryKey       = 'jenis_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_id','jenis_name','jenis_fungsi', 'jenis_kode'
    ];
    public function getJenisIdByKode($jenis_kode)
    {
        $query = $this->select('jenis_id')
            ->where('jenis_kode', $jenis_kode)
            ->get();

        $result = $query->getRow();

        return ($result) ? $result->jenis_id : null;
    }
    public function getJenisNameById($jenis_id)
    {
        $query = $this->select('jenis_name')
            ->where('jenis_id', $jenis_id)
            ->get();

        $result = $query->getRow();

        return ($result) ? $result->jenis_name : null;
    }

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
