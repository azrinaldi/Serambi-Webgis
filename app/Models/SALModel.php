<?php

namespace App\Models;

use CodeIgniter\Model;

class SALModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mstr_sarana_limbah';
    protected $primaryKey       = 'sal_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'sal_name'
    ];
    public function getSalIdByName($sal_name)
    {
        $query = $this->select('sal_id')
            ->where('sal_name', $sal_name)
            ->get();

        $result = $query->getRow();

        return ($result) ? $result->sal_id : null;
    }
    public function getSalNameById($sal_id)
    {
        $query = $this->select('sal_name')
            ->where('sal_id', $sal_id)
            ->get();

        $result = $query->getRow();

        return ($result) ? $result->sal_name : null;
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
