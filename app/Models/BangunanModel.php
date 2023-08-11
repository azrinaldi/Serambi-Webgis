<?php

namespace App\Models;

use CodeIgniter\Model;

class BangunanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'infra_bangunan';
    protected $primaryKey       = 'bangunan_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'bangunan_name', 'pemilik','bangunan_no','kk_jml','kk_name','imb','keterangan','warna','rukun_tetangga_id','jenis_id','status_id','kondisi_id','sau_id','sal_id','geojson','foto','created_at','updated_at',
    ];

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
