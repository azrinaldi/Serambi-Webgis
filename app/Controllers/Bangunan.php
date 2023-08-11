<?php

namespace App\Controllers;

use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class Bangunan extends BaseController
{
    public $title = 'Bangunan';
    public $url = 'bangunan';

    public function index()
    {
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        $data['page'] = 'Data ' . $this->title;
        $BangunanModel = new \App\Models\BangunanModel();
        $data['getData'] = $BangunanModel->findAll();

        return view('Bangunan/index_view', $data);
    }

    public function upload()
    {
        $shpFile = $this->request->getFile('shapefile-shp');
        $shxFile = $this->request->getFile('shapefile-shx');
        $dbfFile = $this->request->getFile('shapefile-dbf');

        $shpExtension = $shpFile->getClientExtension();
        $shxExtension = $shxFile->getClientExtension();
        $dbfExtension = $dbfFile->getClientExtension();

        if (
            $shpExtension != 'shp' or $shxExtension != 'shx' or $dbfExtension != 'dbf'
        ) {
            session()->setFlashData(['info' => 'error', 'message' => 'Gagal mengimpor file']);
            return redirect()->to('Bangunan');
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

            $BangunanModel = new \App\Models\BangunanModel();
            // Read all the records
            while ($Geometry = $Shapefile->fetchRecord()) {
                // Skip the record if marked as "deleted"
                if ($Geometry->isDeleted()) {
                    continue;
                }
                $dataArray = $Geometry->getDataArray();
                $jenis_name = $dataArray['JENIS_BGN'];
                $jenisModel = new \App\Models\JenisModel();
                $jenis_id = $jenisModel->getJenisIdByName($jenis_name);
                if ($jenis_id === null) {
                    $jenis_id = 0;
                }
                //print_r($dataArray);
                $data = [
                    'pemilik' => $dataArray['PEMILIK'],
                    'bangunan_no' => $dataArray['NO_RUMAH'],
                    'kk_jml' => $dataArray['JUMLAH_KK'],
                    'kk_name' => $dataArray['NAMA_KK'],
                    'imb' => $dataArray['IMB'],
                    'keterangan' => $dataArray['KETERANGAN'],
                    'rukun_tetangga' => $dataArray['RT_ID'],
                    'jenis_id' => $jenis_id,
                    'status_id' => $dataArray['STAT_RUMAH'],
                    'kondisi_id' => $dataArray['KOND_RUMAH'],
                    'sau_id' => $dataArray['SAU'],
                    'sal_id' => $dataArray['SAL'],
                    'geojson' => $Geometry->getGeoJSON()

                ];
                $BangunanModel->save($data);
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
        session()->setFlashData(['info' => 'success', 'message' => 'Berhasil mengimpor file']);
        return redirect()->to('Bangunan');
    }

    public function ubah($bangunan_id = '')
    {
        $BangunanModel = new \App\Models\BangunanModel();
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        if ($bangunan_id != '') {
            $getData = $BangunanModel->asArray()->find($bangunan_id);
        } else {
            $getData =  null;
        }
        $data['getData'] = $getData;
        $data['page'] = 'Ubah Data ' . $this->title;
        return view('Bangunan/ubah_view', $data);
    }
    public function save()
    {
        $BangunanModel = new \App\Models\BangunanModel();
        $BangunanModel->save($this->request->getPost());
        session()->setFlashData(['info' => 'success', 'message' => 'Data berhasil disimpan']);
        return redirect()->to('Bangunan');
    }
    public function delete($bangunan_id = '')
    {
        $BangunanModel = new \App\Models\BangunanModel();
        $BangunanModel->delete($bangunan_id);
        session()->setFlashData(['info' => 'success', 'message' => 'Data berhasil dihapus']);
        return redirect()->to('Bangunan');
    }
}
