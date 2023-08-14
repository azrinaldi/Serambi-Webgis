<?php

namespace App\Controllers;

use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class PelangganPDAM extends BaseController
{
    public $title = 'Pelanggan PDAM';
    public $url = 'pelangganpdam';

    public function index()
    {
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        $data['page'] = 'Data ' . $this->title;
        $PelangganPDAMModel = new \App\Models\PelangganPDAMModel();
        $data['getData'] = $PelangganPDAMModel->findAll();

        return view('PelangganPDAM/index_view', $data);
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
            return redirect()->to('PelangganPDAM');
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

            $PelangganPDAMModel = new \App\Models\PelangganPDAMModel();
            // Read all the records
            while ($Geometry = $Shapefile->fetchRecord()) {
                // Skip the record if marked as "deleted"
                if ($Geometry->isDeleted()) {
                    continue;
                }
                $dataArray = $Geometry->getDataArray();
                $data = [

                    ############################################################################################
                    //Tambahkan penginputan data dari dataArray ke database
                    ############################################################################################
                    
                    'geojson' => $Geometry->getGeoJSON()

                ];
                $PelangganPDAMModel->save($data);
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

        return redirect()->to('PelangganPDAM');
    }

    public function ubah($jml_pel_id = '')
    {
        $PelangganPDAMModel = new \App\Models\PelangganPDAMModel();
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        if ($jml_pel_id != '') {
            $getData = $PelangganPDAMModel->asArray()->find($jml_pel_id);
        } else {
            $getData =  null;
        }
        $data['getData'] = $getData;
        $data['page'] = 'Ubah Data ' . $this->title;
        return view('PelangganPDAM/ubah_view', $data);
    }
    public function save()
    {
        $PelangganPDAMModel = new \App\Models\PelangganPDAMModel();
        $PelangganPDAMModel->save($this->request->getPost());
        session()->setFlashData(['info'=>'success', 'message'=>'Data berhasil disimpan']);
        return redirect()->to('PelangganPDAM');
    }
    public function delete($jml_pel_id = '')
    {
        $PelangganPDAMModel = new \App\Models\PelangganPDAMModel();
        $PelangganPDAMModel->delete($jml_pel_id);
        session()->setFlashData(['info'=>'success', 'message'=>'Data berhasil dihapus']);
        return redirect()->to('PelangganPDAM');
    }
}
