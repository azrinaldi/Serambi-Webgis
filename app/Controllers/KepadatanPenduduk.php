<?php

namespace App\Controllers;

use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class KepadatanPenduduk extends BaseController
{
    public $title = 'Kepadatan Penduduk';
    public $url = 'kepadatanpenduduk';

    public function index()
    {
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        $data['page'] = 'Data ' . $this->title;
        $KepadatanPendudukModel = new \App\Models\KepadatanPendudukModel();
        $data['getData'] = $KepadatanPendudukModel->findAll();

        return view('KepadatanPenduduk/index_view', $data);
    }

    public function upload()
    {
        $shpFile = $this->request->getFile('shapefile-shp');
        $shxFile = $this->request->getFile('shapefile-shx');
        $dbfFile = $this->request->getFile('shapefile-dbf');

        $shpExtension = $shpFile->getClientExtension();
        $shxExtension = $shxFile->getClientExtension();
        $dbfExtension = $dbfFile->getClientExtension();

        if ($shpExtension != 'shp' or $shxExtension != 'shx' or $dbfExtension != 'dbf'
        ) {
            session()->setFlashData(['info'=>'error', 'message'=>'Gagal mengimpor file']);
            return redirect()->to('KepadatanPenduduk');
        }

        $shpFilename = $shpFile->getName();
        $shxFilename = $shxFile->getName();
        $dbfFilename = $dbfFile->getName();

        $shpFile->move('./uploads', $shpFilename);
        $shxFile->move('./uploads', $shxFilename);
        $dbfFile->move('./uploads', $dbfFilename);
        try {
            // Open Shapefile
            $Shapefile = new ShapefileReader([
                Shapefile::FILE_SHP => ('./uploads/' . $shpFilename),
                Shapefile::FILE_SHX => ('./uploads/' . $shxFilename),
                Shapefile::FILE_DBF => ('./uploads/' . $dbfFilename),
            ]);

            $KepadatanPendudukModel = new \App\Models\KepadatanPendudukModel();
            // Read all the records
            while ($Geometry = $Shapefile->fetchRecord()) {
                // Skip the record if marked as "deleted"
                if ($Geometry->isDeleted()) {
                    continue;
                }
                $dataArray = $Geometry->getDataArray();
                $data = [
                    
                    'geojson' => $Geometry->getGeoJSON()

                ];
                $KepadatanPendudukModel->save($data);
            }
        } catch (ShapefileException $e) {
            // Print detailed error information
            echo "Error Type: " . $e->getErrorType()
                . "\nMessage: " . $e->getMessage()
                . "\nDetails: " . $e->getDetails();
        }
        unlink('./uploads/' . $shpFilename);
        unlink('./uploads/' . $shxFilename);
        unlink('./uploads/' . $dbfFilename);
        session()->setFlashData(['info'=>'success', 'message'=>'Gagal mengimpor file']);

        return redirect()->to('KepadatanPenduduk');
    }

    public function ubah($jumlah_id = '')
    {
        $KepadatanPendudukModel = new \App\Models\KepadatanPendudukModel();
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        if ($jumlah_id != '') {
            $getData = $KepadatanPendudukModel->asArray()->find($jumlah_id);
        } else {
            $getData =  null;
        }
        $data['getData'] = $getData;
        $data['page'] = 'Ubah Data ' . $this->title;
        return view('KepadatanPenduduk/ubah_view', $data);
    }
    public function save()
    {
        $KepadatanPendudukModel = new \App\Models\KepadatanPendudukModel();
        $KepadatanPendudukModel->save($this->request->getPost());
        session()->setFlashData(['info'=>'success', 'message'=>'Data berhasil disimpan']);
        return redirect()->to('KepadatanPenduduk');
    }
    public function delete($jumlah_id = '')
    {
        $KepadatanPendudukModel = new \App\Models\KepadatanPendudukModel();
        $KepadatanPendudukModel->delete($jumlah_id);
        session()->setFlashData(['info'=>'success', 'message'=>'Data berhasil dihapus']);
        return redirect()->to('KepadatanPenduduk');
    }
}
