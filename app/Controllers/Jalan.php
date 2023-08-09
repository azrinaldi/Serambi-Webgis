<?php

namespace App\Controllers;

use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class Jalan extends BaseController
{
    public $title = 'Jalan';
    public $url = 'jalan';

    public function index()
    {
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        $data['page'] = 'Data ' . $this->title;
        $JalanModel = new \App\Models\JalanModel();
        $data['getData'] = $JalanModel->findAll();

        return view('Jalan/index_view', $data);
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
            return redirect()->to('Jalan');
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

            $JalanModel = new \App\Models\JalanModel();
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
                $JalanModel->save($data);
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

        return redirect()->to('Jalan');
    }

    public function ubah($jalan_id = '')
    {
        $JalanModel = new \App\Models\JalanModel();
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        if ($jalan_id != '') {
            $getData = $JalanModel->asArray()->find($jalan_id);
        } else {
            $getData =  null;
        }
        $data['getData'] = $getData;
        $data['page'] = 'Ubah Data ' . $this->title;
        return view('Jalan/ubah_view', $data);
    }
    public function save()
    {
        $JalanModel = new \App\Models\JalanModel();
        $JalanModel->save($this->request->getPost());
        session()->setFlashData(['info'=>'success', 'message'=>'Data berhasil disimpan']);
        return redirect()->to('Jalan');
    }
    public function delete($jalan_id = '')
    {
        $JalanModel = new \App\Models\JalanModel();
        $JalanModel->delete($jalan_id);
        session()->setFlashData(['info'=>'success', 'message'=>'Data berhasil dihapus']);
        return redirect()->to('Jalan');
    }
}
