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
        $data['getDataBangunan'] = $BangunanModel->findAll();
        $JenisModel = new \App\Models\JenisModel();
        $RTModel = new \App\Models\RTModel();
        $data['RTModel'] = $RTModel;
        $data['JenisModel'] = $JenisModel;
        $KondisiModel = new \App\Models\KondisiModel();
        $data['KondisiModel'] = $KondisiModel;
        $StatusModel = new \App\Models\StatusModel();
        $data['StatusModel'] = $StatusModel;
        $SAUModel = new \App\Models\SAUModel();
        $data['SAUModel'] = $SAUModel;
        $SALModel = new \App\Models\SALModel();
        $data['SALModel'] = $SALModel;

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

                $jenis_kode = $dataArray['JENIS_BGN'];
                $jenisModel = new \App\Models\JenisModel();
                $jenis_id = $jenisModel->getJenisIdByKode($jenis_kode);
                if ($jenis_id === null) {
                    $jenis_id = 17;
                }
                $kondisi_name = $dataArray['KOND_RUMAH'];
                $kondisiModel = new \App\Models\KondisiModel();
                $kondisi_id = $kondisiModel->getKondisiIdByName($kondisi_name);
                if ($kondisi_id === null) {
                    $kondisi_id = 0;
                }
                $sal_name = $dataArray['SAL'];
                $salModel = new \App\Models\SalModel();
                $sal_id = $salModel->getSalIdByName($sal_name);
                if ($sal_id === '-') {
                    $sal_id = 6;
                }
                if ($sal_id === null) {
                    $sal_id = 7;
                }
                $sau_name = $dataArray['SAU'];
                $sauModel = new \App\Models\SauModel();
                $sau_id = $sauModel->getSauIdByName($sau_name);
                if ($sau_id === '-') {
                    $sau_id = 4;
                }
                if ($sau_id === null) {
                    $sau_id = 5;
                }
                $status_kode = $dataArray['STAT_RUMAH'];
                $statusModel = new \App\Models\StatusModel();
                $status_id = $statusModel->getStatusIdByKode($status_kode);
                if ($status_id === null) {
                    $status_id = 9;
                }


                $data = [
                    'pemilik' => $dataArray['PEMILIK'],
                    'bangunan_no' => $dataArray['NO_RUMAH'],
                    'kk_jml' => $dataArray['JUMLAH_KK'],
                    'kk_name' => $dataArray['NAMA_KK'],
                    'imb' => $dataArray['IMB'],
                    'keterangan' => $dataArray['KETERANGAN'],
                    'rukun_tetangga_id' => $dataArray['RT_ID'],
                    'jenis_id' => $jenis_id,
                    'status_id' => $status_id,
                    'kondisi_id' => $kondisi_id,
                    'sau_id' => $sau_id,
                    'sal_id' => $sal_id,
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
            $getDataBangunan = $BangunanModel->asArray()->find($bangunan_id);
        } else {
            $getDataBangunan =  null;
        }
        $data['getDataBangunan'] = $getDataBangunan;
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
    public function delete_selected()
    {
        $selectedItems = $this->request->getPost('selected_items');
        $selectAll = $this->request->getPost('select_all');

        if ($selectAll) {
            // Fetch all bangunan_ids from your database and assign them to $selectedItems
            $BangunanModel = new \App\Models\BangunanModel();
            $allBangunanIds = $BangunanModel->findAll();
            $selectedItems = array_column($allBangunanIds, 'bangunan_id');
        }

        if (empty($selectedItems)) {
            session()->setFlashData(['info' => 'error', 'message' => 'Tidak ada item yang dipilih untuk dihapus']);
        } else {
            $BangunanModel = new \App\Models\BangunanModel();
            foreach ($selectedItems as $bangunan_id) {
                $BangunanModel->delete($bangunan_id);
            }
            session()->setFlashData(['info' => 'success', 'message' => 'Data Berhasil Dihapus']);
        }

        return redirect()->to('Bangunan');
    }
}
