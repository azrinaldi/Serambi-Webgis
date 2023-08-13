<?php

namespace App\Models;

use CodeIgniter\Model;

class SAUModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mstr_sarana_minum';
    protected $primaryKey       = 'sau_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'sau_name'
    ];
    public function getSauIdByName($sau_name)
    {
        $query = $this->select('sau_id')
            ->where('sau_name', $sau_name)
            ->get();

        $result = $query->getRow();

        return ($result) ? $result->sau_id : null;
    }
    public function getSauNameById($sau_id)
    {
        $query = $this->select('sau_name')
            ->where('sau_id', $sau_id)
            ->get();

        $result = $query->getRow();

        return ($result) ? $result->sau_name : null;
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
