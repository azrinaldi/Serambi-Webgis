<?php

namespace App\Controllers;

use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class Kecamatan extends BaseController
{
    public $title = 'Kecamatan';
    public $url = 'kecamatan';

    public function index()
    {
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        $data['page'] = 'Data ' . $this->title;
        $KecamatanModel = new \App\Models\KecamatanModel();
        $data['getDataKecamatan'] = $KecamatanModel->findAll();

        return view('Kecamatan/index_view', $data);
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
            return redirect()->to('Kecamatan');
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

            $KecamatanModel = new \App\Models\KecamatanModel();
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
                $KecamatanModel->save($data);
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

        return redirect()->to('Kecamatan');
    }

    public function ubah($kecamatan_id = '')
    {
        $KecamatanModel = new \App\Models\KecamatanModel();
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        if ($kecamatan_id != '') {
            $getDataKecamatan = $KecamatanModel->asArray()->find($kecamatan_id);
        } else {
            $getDataKecamatan =  null;
        }
        $data['getDataKecamatan'] = $getDataKecamatan;
        $data['page'] = 'Ubah Data ' . $this->title;
        return view('Kecamatan/ubah_view', $data);
    }
    public function save()
    {
        $KecamatanModel = new \App\Models\KecamatanModel();
        $KecamatanModel->save($this->request->getPost());
        session()->setFlashData(['info'=>'success', 'message'=>'Data berhasil disimpan']);
        return redirect()->to('Kecamatan');
    }
    public function delete($kecamatan_id = '')
    {
        $KecamatanModel = new \App\Models\KecamatanModel();
        $KecamatanModel->delete($kecamatan_id);
        session()->setFlashData(['info'=>'success', 'message'=>'Data berhasil dihapus']);
        return redirect()->to('Kecamatan');
    }
}
