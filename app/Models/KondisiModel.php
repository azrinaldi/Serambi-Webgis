<?php

namespace App\Models;

use CodeIgniter\Model;

class KondisiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mstr_kondisi';
    protected $primaryKey       = 'kondisi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kondisi_name','kondisi_fungsi'
    ];
    public function getKondisiIdByName($kondisi_name)
    {
        $query = $this->select('kondisi_id')
            ->where('kondisi_name', $kondisi_name)
            ->get();

        $result = $query->getRow();

        return ($result) ? $result->kondisi_id : null;
    }
    public function getKondisiNameById($kondisi_id)
    {
        $query = $this->select('kondisi_name')
            ->where('kondisi_id', $kondisi_id)
            ->get();

        $result = $query->getRow();

        return ($result) ? $result->kondisi_name : null;
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
