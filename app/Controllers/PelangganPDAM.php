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

        $shpExtension = $shpFile->getExtension();
        $shxExtension = $shxFile->getExtension();
        $dbfExtension = $dbfFile->getExtension();

        if ($shpExtension != '.shp' or $shxExtension != '.shx' or $dbfExtension != '.dbf'
        ) {
            echo "File yang ditambahkan tidak sesuai";
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
                    'pemilik' => $dataArray['PEMILIK'],
                    'PelangganPDAM_no' => $dataArray['NO_RUMAH'],
                    'kk_jml' => $dataArray['JUMLAH_KK'],
                    'kk_name' => $dataArray['NAMA_KK'],
                    'imb' => $dataArray['IMB'],
                    'keterangan' => $dataArray['KETERANGAN'],
                    'rukun_tetangga' => $dataArray['RT_ID'],
                    'jenis_id' => $dataArray['JENIS_BGN'],
                    'status_id' => $dataArray['STAT_RUMAH'],
                    'kondisi_id' => $dataArray['KOND_RUMAH'],
                    'sau_id' => $dataArray['SAU'],
                    'sal_id' => $dataArray['SAL'],
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
        return redirect()->to('PelangganPDAM');
    }
    public function delete($jml_pel_id = '')
    {
        $PelangganPDAMModel = new \App\Models\PelangganPDAMModel();
        $PelangganPDAMModel->delete($jml_pel_id);
        return redirect()->to('PelangganPDAM');
    }
}
