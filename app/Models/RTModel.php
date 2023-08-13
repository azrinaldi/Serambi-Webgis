<?php

namespace App\Models;

use CodeIgniter\Model;

class RTModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'rukun_tetangga';
    protected $primaryKey       = 'rukun_tetangga_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'warga_name','kelurahan_id'
    ];
    public function getRTNameById($rukun_tetangga_id)
    {
        $query = $this->select('warga_name')
            ->where('rukun_tetangga_id', $rukun_tetangga_id)
            ->get();

        $result = $query->getRow();

        return ($result) ? $result->warga_name : null;
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
