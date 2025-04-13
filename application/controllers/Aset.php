<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property ModelAset $ma
 * @property ModelBarang $mb
 * @property ModelLokasi $ml
 * @property ModelKategori $mk
 * @property CI_Form_validation $form_validation
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Ciqrcode $ciqrcode
 * @property CI_Uuid $uuid
 * @property CI_URI $uri
 * @property CI_DB_query_builder $db
 * @property CI_Upload $upload
 */
class Aset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata("logged") <> 1) {
            redirect(site_url('login'));
        }

        //load model
        $this->load->model('ModelAset', 'ma');
        $this->load->model('ModelBarang', 'mb');
        $this->load->model('ModelLokasi', 'ml');
        $this->load->model('ModelKategori', 'mk');

        //load library
        $this->load->library('ciqrcode');
        $this->load->library('uuid');
    }

    public function index()
    {
        $kategori = $this->input->get('kategori');
        $tahun_pengadaan = $this->input->get('tahun_pengadaan');
        
        $data = array(
            'title' => 'Aset Berwujud',
            'active_menu_open' => 'menu-open',
            'active_menu_aset' => 'active',
            'active_menu_wujud' => 'active',
            'aset' => $this->ma->getAsetWujud($kategori, $tahun_pengadaan),
            'kategori' => $kategori,
            'tahun_pengadaan' => $tahun_pengadaan,
        );
        $this->load->view('layouts/header', $data);
        $this->load->view('aset/v_wujud', $data);
        $this->load->view('layouts/footer');
    }

    public function tambahAset()
    {
        $data = array(
            'title' => 'Aset Berwujud',
            'active_menu_open' => 'menu-open',
            'active_menu_aset' => 'active',
            'active_menu_wujud' => 'active',
            'aset' => $this->ma->getAsetWujud()
        );
        $this->load->view('layouts/header', $data);
        $this->load->view('aset/c_wujud', $data);
        $this->load->view('layouts/footer');
    }

    public function simpanAset()
    {
        $this->form_validation->set_rules(
            'kode_aset',
            'Kode Aset',
            'required|trim|is_unique[asets.kode_aset]',
            array(
                'required' => "<p>Kode Aset tidak boleh kosong</p>",
                'is_unique' => "<p>Kode Aset sudah digunakan</p>"
            )
        );

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('gagal', validation_errors());
            redirect(base_url('aset_wujud/tambah'));
        }
        
        // Buat UUID untuk ID Aset
        $id_aset = str_replace('-', '', $this->uuid->v4());
        $image_name = $id_aset . '.png';

        // generate QR Code
        $kode_aset = $this->input->post('kode_aset');
        $config['imagedir'] = './src/img/qrcode/';
        $this->ciqrcode->initialize($config);
        $url = base_url('aset/detail/' . $id_aset);

        // Konfigurasi QR Code
        $params['data'] = $url;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name;
        $this->ciqrcode->generate($params);

        // Data yang akan disimpan
        $data = array(
            'id_aset' => $id_aset,
            'kode_aset' => $kode_aset,
            'nama_aset' => $this->input->post('nama_aset'),
            'nup_aset' => $this->input->post('nama_aset'),
            'kategori_aset' => $this->input->post('kategori_aset'),
            'tahun_pengadaan' => $this->input->post('tahun_pengadaan'),
            'qr_code' => $image_name
        );

        $detail = array('id_aset' => $id_aset);
        switch ($data['kategori_aset']) {
            case ModelAset::KATEGORI_TANAH:
                $detail['luas'] = $this->input->post('luas');
                $detail['alamat'] = $this->input->post('alamat');
                $detail['kegunaan'] = $this->input->post('kegunaan');
                $detail['latitude'] = $this->input->post('latitude');
                $detail['longitude'] = $this->input->post('longitude');
                $detail['harga_satuan'] = $this->input->post('harga_satuan');
                $detail['harga_total'] = $this->input->post('harga_total');
                $detail['harga_sewa_satuan'] = $this->input->post('harga_sewa_satuan');
                $detail['harga_sewa_total'] = $this->input->post('harga_sewa_total');
                $detail['jarak_sumber_air'] = $this->input->post('jarak_sumber_air');
                $detail['jarak_jalan_utama'] = $this->input->post('jarak_jalan_utama');
                if (!empty($_FILES['foto'])) {
                    $config['upload_path'] = './src/img/aset/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = 2048; // 2MB
                    $config['file_name'] = 'foto_' . time();

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('foto')) {
                        $uploadData = $this->upload->data();
                        $detail['foto'] = '/src/img/aset/' . $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata('gagal', $this->upload->display_errors());
                        redirect(base_url('aset_wujud/tambah'));
                    }
                } else {
                    $detail['foto'] = null;
                }
                break;
            case ModelAset::KATEGORI_PERALATAN:
                $detail['merk'] = $this->input->post('merk');
                $detail['bahan'] = $this->input->post('bahan');
                $detail['perolehan'] = $this->input->post('perolehan');
                break;
            case ModelAset::KATEGORI_BANGUNAN:
                $detail['perolehan'] = $this->input->post('perolehan');
                break;
        }

        // Simpan ke database
        $result = $this->ma->storeAset($data, $detail);
        if ($result) {
            $this->session->set_flashdata('sukses', 'Aset berhasil disimpan');
            redirect(base_url('aset_wujud'));
        } else {
            $this->session->set_flashdata('gagal', 'Aset gagal disimpan');
            redirect(base_url('aset_wujud/tambah'));
        }

        // Jika validasi gagal, tampilkan form lagi
        $data = array(
            'title' => 'Aset Berwujud',
            'active_menu_open' => 'menu-open',
            'active_menu_aset' => 'active',
            'active_menu_wujud' => 'active',
            'aset' => $this->ma->getAsetWujud()
        );

        $this->load->view('layouts/header', $data);
        $this->load->view('aset/c_wujud', $data);
        $this->load->view('layouts/footer');
    }



    public function editAset($id_aset)

    {
        $id_aset = $this->uri->segment(3);

        $data = array(
            'title' => 'Aset Berwujud',
            'active_menu_open' => 'menu-open',
            'active_menu_aset' => 'active',
            'active_menu_wujud' => 'active',
            'aset' => $this->ma->getDetailAsetWujud($id_aset)
        );

        $this->load->view('layouts/header', $data);
        $this->load->view('aset/u_wujud', $data);
        $this->load->view('layouts/footer');
    }

    public function ubahAset()
    {
        $id_aset = $this->input->post('id_aset');
        $aset = $this->ma->getDetailAsetWujud($id_aset);

        if (!$aset) {
            $this->session->set_flashdata('gagal', 'Aset tidak ditemukan');
            redirect(base_url('aset_wujud'));
        }

        // Data yang akan disimpan
        $data = array(
            'nama_aset' => $this->input->post('nama_aset'),
            'nup_aset' => $this->input->post('nama_aset'),
            'tahun_pengadaan' => $this->input->post('tahun_pengadaan'),
        );

        $detail = array('id_aset' => $id_aset);
        switch ($aset['kategori_aset']) {
            case ModelAset::KATEGORI_TANAH:
                $detail['luas'] = $this->input->post('luas');
                $detail['alamat'] = $this->input->post('alamat');
                $detail['kegunaan'] = $this->input->post('kegunaan');
                $detail['latitude'] = $this->input->post('latitude');
                $detail['longitude'] = $this->input->post('longitude');
                $detail['harga_satuan'] = $this->input->post('harga_satuan');
                $detail['harga_total'] = $this->input->post('harga_total');
                $detail['harga_sewa_satuan'] = $this->input->post('harga_sewa_satuan');
                $detail['harga_sewa_total'] = $this->input->post('harga_sewa_total');
                $detail['jarak_sumber_air'] = $this->input->post('jarak_sumber_air');
                $detail['jarak_jalan_utama'] = $this->input->post('jarak_jalan_utama');
                if (!empty($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
                    $config['upload_path'] = './src/img/aset/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = 20480; // 20MB
                    $config['file_name'] = 'tanah_' . time();

                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('foto')) {
                        $uploadData = $this->upload->data();
                        $detail['foto'] = '/src/img/aset/' . $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata('gagal', $this->upload->display_errors());
                        redirect(base_url('aset_wujud'));
                    }
                }
                break;
            case ModelAset::KATEGORI_PERALATAN:
                $detail['merk'] = $this->input->post('merk');
                $detail['bahan'] = $this->input->post('bahan');
                $detail['perolehan'] = $this->input->post('perolehan');
                break;
            case ModelAset::KATEGORI_BANGUNAN:
                $detail['perolehan'] = $this->input->post('perolehan');
                break;
        }

        // Simpan ke database
        $result = $this->ma->updateAset($id_aset, $aset['kategori_aset'], $data, $detail);
        if ($result) {
            if (isset($detail['foto']) && $aset['detail']['foto'] && file_exists($aset['detail']['foto'])) {
                @unlink($aset['detail']['foto']);
            }

            $this->session->set_flashdata('sukses', 'Aset berhasil disimpan');
            redirect(base_url('aset_wujud'));
        }

        $this->session->set_flashdata('gagal', 'Aset gagal disimpan');
        redirect(base_url('aset_wujud/edit/' . $id_aset));
    }

    public function detailAset($id_aset)
    {
        $id_aset = $this->uri->segment(3);
        $data = array(
            'title' => 'Aset Berwujud',
            'active_menu_open' => 'menu-open',
            'active_menu_aset' => 'active',
            'active_menu_wujud' => 'active',
            'aset' => $this->ma->getDetailAsetWujud($id_aset)
        );

        $this->load->view('layouts/header', $data);
        $this->load->view('aset/d_wujud', $data);
        $this->load->view('layouts/footer');
    }

    public function hapusAset($id_aset)
    {
        $id_aset = $this->uri->segment(3);
        $this->db->where('id_aset', $id_aset);
        $this->db->update('asets', array('deleted_at' => date('Y-m-d H:i:s')));
        $this->session->set_flashdata('sukses', 'Dihapus');
        redirect('aset_wujud');
    }

    public function pruneAset($id){
      $this->db->where('id_aset', $id);
      $this->db->delete('asets');
      $this->session->set_flashdata('sukses', 'Dihapus');
      redirect('aset_dihapuskan');
    }

    public function restoreAset($id_aset)
    {
        $this->db->where('id_aset', $id_aset);
        $this->db->update('asets', array('deleted_at' => null));
        $this->session->set_flashdata('sukses', 'Dikembalikan');
        redirect('aset_dihapuskan');
    }

    public function filterAset()
    {
        $id_kategori = $this->input->post('id_kategori');
        $tahun_perolehan = $this->input->post('tahun_perolehan');
        $kondisi = $this->input->post('kondisi');

        $data = array(
            'title' => 'Aset Berwujud',
            'active_menu_open' => 'menu-open',
            'active_menu_aset' => 'active',
            'active_menu_wujud' => 'active',
            'aset' => $this->ma->getFilterAsetWujud($id_kategori, $tahun_perolehan, $kondisi),
            'kategori' => $this->mk->getKategoriBarang()
        );
        if (count($data['aset']) > 0) {
            $this->load->view('layouts/header', $data);
            $this->load->view('aset/v_wujud', $data);
            $this->load->view('layouts/footer');
        } else {
            $this->session->set_flashdata('gagal', 'Ditemukan');
            redirect('aset_wujud');
        }
    }

    public function dihapuskanAset()
    {
        $kategori = $this->input->get('kategori');
        $tgl_penghapusan = $this->input->get('tgl_penghapusan');
        
        $data = array(
            'title' => 'Aset Dihapuskan',
            'active_menu_open' => 'menu-open',
            'active_menu_aset' => 'active',
            'active_menu_hapuskan' => 'active',
            'aset' => $this->ma->getAsetDihapuskan($kategori, $tgl_penghapusan),
            'kategori' => $kategori,
            'tgl_penghapusan' => $tgl_penghapusan,
        );
        $this->load->view('layouts/header', $data);
        $this->load->view('aset/v_dihapuskan', $data);
        $this->load->view('layouts/footer');
    }

    public function detailDihapuskanAset($id_aset)
    {
        $id_aset = $this->uri->segment(3);
        $data = array(
            'title' => 'Aset Berwujud',
            'active_menu_open' => 'menu-open',
            'active_menu_aset' => 'active',
            'active_menu_hapuskan' => 'active',
            'aset' => $this->ma->getDetailAsetWujud($id_aset)
        );
        $this->load->view('layouts/header', $data);
        $this->load->view('aset/d_dihapuskan', $data);
        $this->load->view('layouts/footer');
    }

    public function filterAsetDihapuskan()
    {
        $id_kategori = $this->input->post('id_kategori');
        $tgl_penghapusan = $this->input->post('tgl_penghapusan');

        $data = array(
            'title' => 'Aset Dihapuskan',
            'active_menu_open' => 'menu-open',
            'active_menu_aset' => 'active',
            'active_menu_hapuskan' => 'active',
            'kategori' => $this->mk->getKategoriBarang(),
            'aset' => $this->ma->getFilterAsetDihapuskan($id_kategori, $tgl_penghapusan)
        );
        if (count($data['aset']) > 0) {
            $this->load->view('layouts/header', $data);
            $this->load->view('aset/v_dihapuskan', $data);
            $this->load->view('layouts/footer');
        } else {
            $this->session->set_flashdata('gagal', 'Ditemukan');
            redirect('aset_dihapuskan');
        }
    }

    public function cariAset()
    {
        $bar = $this->input->get('bar');
        $query = $this->ma->searchAset($bar, 'nama_barang');

        echo json_encode($query);
    }

    public function parse_tanah(Spreadsheet $spreadsheet)
    {
        $sheet = $spreadsheet->getSheetByName('INVENTARIS TANAH');
        if (!$sheet) {
            $this->session->set_flashdata('gagal', 'Sheet "INVENTARIS TANAH" tidak ditemukan.');
            redirect(base_url('aset_wujud'));
        }

        $config['imagedir'] = './src/img/qrcode/';
        $this->ciqrcode->initialize($config);

        $data = [];
        $row = 8;
        while (true) {
            $row++;
            if (!$sheet->getCell("A" . $row)->getValue()) {
                break;
            }

            $nama = $sheet->getCell("B" . $row)->getValue();
            $kode1 = $sheet->getCell("C" . $row)->getValue();
            $kode2 = $sheet->getCell("D" . $row)->getValue();
            $kode3 = $sheet->getCell("E" . $row)->getValue();
            $kode4 = $sheet->getCell("F" . $row)->getValue();
            $nup = $sheet->getCell("G" . $row)->getValue();

            $luas = $sheet->getCell("H" . $row)->getValue();
            $alamat = $sheet->getCell("I" . $row)->getValue();
            $tahun_pengadaan = $sheet->getCell("J" . $row)->getValue();
            $kegunaan = $sheet->getCell("K" . $row)->getValue();

            try {
                $koordinat = $sheet->getCell("L" . $row)->getValue();
                list($latitude, $longitude) = array_map('floatval', explode(', ', $koordinat));
            } catch (\Exception $e) {
                $latitude = $longitude = null;
            }

            $harga_satuan = $sheet->getCell("M" . $row)->getCalculatedValue();
            $harga_total = $sheet->getCell("N" . $row)->getCalculatedValue();
            $harga_sewa_satuan = $sheet->getCell("O" . $row)->getCalculatedValue();
            $harga_sewa_total = $sheet->getCell("P" . $row)->getCalculatedValue();
            $jarak_sumber_air = $sheet->getCell("Q" . $row)->getValue();
            $jarak_jalan_utama = $sheet->getCell("R" . $row)->getValue();

            // Buat UUID untuk ID Aset
            $id_aset = str_replace('-', '', $this->uuid->v4());
            $image_name = $id_aset . '.png';

            // generate QR Code
            $kode_aset = "$kode1$kode2$kode3$kode4/$nup/$tahun_pengadaan";


            $url = base_url('aset/detail/' . $id_aset);

            // Konfigurasi QR Code
            $params['data'] = $url;
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name;
            $this->ciqrcode->generate($params);

            $rowData = [
                'id_aset' => $id_aset,
                'nama_aset' => $nama,
                'kode_aset' => $kode_aset,
                'nup_aset' => $nup,
                'kategori_aset' => ModelAset::KATEGORI_TANAH,
                'tahun_pengadaan' => $tahun_pengadaan,
                'qr_code' => $image_name
            ];

            $detail = [
                'id_aset' => $id_aset,
                'luas' => $luas,
                'alamat' => $alamat,
                'kegunaan' => $kegunaan,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'harga_satuan' => $harga_satuan,
                'harga_total' => $harga_total,
                'harga_sewa_satuan' => $harga_sewa_satuan,
                'harga_sewa_total' => $harga_sewa_total,
                'jarak_sumber_air' => $jarak_sumber_air,
                'jarak_jalan_utama' => $jarak_jalan_utama
            ];

            $data[] = ['data' => $rowData, 'detail' => $detail];
        }

        return $data;
    }

    public function parse_peralatan(Spreadsheet $spreadsheet)
    {
        $sheet = $spreadsheet->getSheetByName('INVENTARIS PERALATAN DAN MESIN');
        if (!$sheet) {
            $this->session->set_flashdata('gagal', 'Sheet "INVENTARIS PERALATAN DAN MESIN" tidak ditemukan.');
            redirect(base_url('aset_wujud'));
        }

        $config['imagedir'] = './src/img/qrcode/';
        $this->ciqrcode->initialize($config);

        $data = [];
        $row = 8;
        while (true) {
            $row++;
            if (!$sheet->getCell("A" . $row)->getValue()) {
                break;
            }

            $nama = $sheet->getCell("B" . $row)->getValue();
            $kode1 = $sheet->getCell("C" . $row)->getValue();
            $kode2 = $sheet->getCell("D" . $row)->getValue();
            $kode3 = $sheet->getCell("E" . $row)->getValue();
            $kode4 = $sheet->getCell("F" . $row)->getValue();
            $nup = $sheet->getCell("G" . $row)->getValue();
            
            $merk = $sheet->getCell("H" . $row)->getValue();
            $bahan = $sheet->getCell("I" . $row)->getValue();
            $tahun_pengadaan = $sheet->getCell("J" . $row)->getValue();
            $perolehan = $sheet->getCell("K" . $row)->getValue();

            // Buat UUID untuk ID Aset
            $id_aset = str_replace('-', '', $this->uuid->v4());
            $image_name = $id_aset . '.png';

            // generate QR Code
            $kode_aset = "$kode1$kode2$kode3$kode4/$nup/$tahun_pengadaan";


            $url = base_url('aset/detail/' . $id_aset);

            // Konfigurasi QR Code
            $params['data'] = $url;
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name;
            $this->ciqrcode->generate($params);

            $rowData = [
                'id_aset' => $id_aset,
                'nama_aset' => $nama,
                'kode_aset' => $kode_aset,
                'nup_aset' => $nup,
                'kategori_aset' => ModelAset::KATEGORI_PERALATAN,
                'tahun_pengadaan' => $tahun_pengadaan,
                'qr_code' => $image_name
            ];

            $detail = [
                'id_aset' => $id_aset,
                'merk' => $merk,
                'bahan' => $bahan,
                'perolehan' => $perolehan
            ];

            $data[] = ['data' => $rowData, 'detail' => $detail];
        }

        return $data;
    }

    public function parse_bangunan(Spreadsheet $spreadsheet)
    {
        $sheet = $spreadsheet->getSheetByName('INVENTARIS GEDUNG DAN BANGUNAN');
        if (!$sheet) {
            $this->session->set_flashdata('gagal', 'Sheet "INVENTARIS GEDUNG DAN BANGUNAN" tidak ditemukan.');
            redirect(base_url('aset_wujud'));
        }

        $config['imagedir'] = './src/img/qrcode/';
        $this->ciqrcode->initialize($config);

        $data = [];
        $row = 8;
        while (true) {
            $row++;
            if (!$sheet->getCell("A" . $row)->getValue()) {
                break;
            }

            $nama = $sheet->getCell("B" . $row)->getValue();
            $kode1 = $sheet->getCell("C" . $row)->getValue();
            $kode2 = $sheet->getCell("D" . $row)->getValue();
            $kode3 = $sheet->getCell("E" . $row)->getValue();
            $kode4 = $sheet->getCell("F" . $row)->getValue();
            $nup = $sheet->getCell("G" . $row)->getValue();

            $tahun_pengadaan = $sheet->getCell("H" . $row)->getValue();
            $perolehan = $sheet->getCell("I" . $row)->getValue();

            // Buat UUID untuk ID Aset
            $id_aset = str_replace('-', '', $this->uuid->v4());
            $image_name = $id_aset . '.png';

            // generate QR Code
            $kode_aset = "$kode1$kode2$kode3$kode4/$nup/$tahun_pengadaan";


            $url = base_url('aset/detail/' . $id_aset);

            // Konfigurasi QR Code
            $params['data'] = $url;
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name;
            $this->ciqrcode->generate($params);

            $rowData = [
                'id_aset' => $id_aset,
                'nama_aset' => $nama,
                'kode_aset' => $kode_aset,
                'nup_aset' => $nup,
                'kategori_aset' => ModelAset::KATEGORI_BANGUNAN,
                'tahun_pengadaan' => $tahun_pengadaan,
                'qr_code' => $image_name
            ];

            $detail = [
                'id_aset' => $id_aset,
                'perolehan' => $perolehan
            ];

            $data[] = ['data' => $rowData, 'detail' => $detail];
        }

        return $data;
    }

    public function import_excel()
    {
        $this->load->library('upload');
        $file = $_FILES['fileExcel']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

        try {
            $data_tanah = $this->parse_tanah($spreadsheet);
            $data_peralatan = $this->parse_peralatan($spreadsheet);
            $data_bangunan = $this->parse_bangunan($spreadsheet);
            $data = array_merge($data_tanah, $data_peralatan, $data_bangunan);
            $this->ma->storeAsetMany($data);

            // Process the $data array as needed
            $this->session->set_flashdata('sukses', 'Data berhasil diimpor.');
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            $this->session->set_flashdata('gagal', 'Terjadi kesalahan saat membaca file: ' . $e->getMessage());
        } catch (\Exception $e) {
            $this->session->set_flashdata('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        redirect(base_url('aset_wujud'));
    }

    public function export_excel(){
      $asets = $this->ma->getAllAsetDetail();
      $spreadsheet = new Spreadsheet();

      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setTitle('Tanah');
      $sheet->setCellValue('A1', 'No.');
      $sheet->setCellValue('B1', 'Nama Aset');
      $sheet->setCellValue('C1', 'Kode Aset');
      $sheet->setCellValue('D1', 'Luas');
      $sheet->setCellValue('E1', 'Alamat');
      $sheet->setCellValue('F1', 'Tahun Pengadaan');
      $sheet->setCellValue('G1', 'Kegunaan');
      $sheet->setCellValue('H1', 'Koordinat');
      $sheet->setCellValue('I1', 'Harga Per Meter');
      $sheet->setCellValue('J1', 'Harga Total');
      $sheet->setCellValue('K1', 'Harga Sewa Per Meter');
      $sheet->setCellValue('L1', 'Harga Sewa Per Tahun');
      $sheet->setCellValue('M1', 'Jarak Sumber Air');
      $sheet->setCellValue('N1', 'Jarak Jalan Utama');

      $row = 2;
      foreach($asets[ModelAset::KATEGORI_TANAH] as $i=>$aset){
        $sheet->setCellValue('A'.$row, $i+1);
        $sheet->setCellValue('B'.$row, $aset['nama_aset']);
        $sheet->setCellValue('C'.$row, $aset['kode_aset']);
        $sheet->setCellValue('D'.$row, $aset['detail']['luas']);
        $sheet->setCellValue('E'.$row, $aset['detail']['alamat']);
        $sheet->setCellValue('F'.$row, $aset['tahun_pengadaan']);
        $sheet->setCellValue('G'.$row, $aset['detail']['kegunaan']);
        $sheet->setCellValue('H'.$row, $aset['detail']['latitude'].', '.$aset['detail']['longitude']);
        $sheet->setCellValue('I'.$row, $aset['detail']['harga_satuan']);
        $sheet->setCellValue('J'.$row, $aset['detail']['harga_total']);
        $sheet->setCellValue('K'.$row, $aset['detail']['harga_sewa_satuan']);
        $sheet->setCellValue('L'.$row, $aset['detail']['harga_sewa_total']);
        $sheet->setCellValue('M'.$row, $aset['detail']['jarak_sumber_air']);
        $sheet->setCellValue('N'.$row, $aset['detail']['jarak_jalan_utama']);
        $row++;
      }

      $sheet = $spreadsheet->createSheet();
      $sheet->setTitle('Peralatan dan Mesin');
      $sheet->setCellValue('A1', 'No.');
      $sheet->setCellValue('B1', 'Nama Aset');
      $sheet->setCellValue('C1', 'Kode Aset');
      $sheet->setCellValue('D1', 'Merk');
      $sheet->setCellValue('E1', 'Bahan');
      $sheet->setCellValue('F1', 'Tahun Pengadaan');
      $sheet->setCellValue('G1', 'Perolehan');

      $row = 2;
      foreach($asets[ModelAset::KATEGORI_PERALATAN] as $i=>$aset){
        $sheet->setCellValue('A'.$row, $i+1);
        $sheet->setCellValue('B'.$row, $aset['nama_aset']);
        $sheet->setCellValue('C'.$row, $aset['kode_aset']);
        $sheet->setCellValue('D'.$row, $aset['detail']['merk']);
        $sheet->setCellValue('E'.$row, $aset['detail']['bahan']);
        $sheet->setCellValue('F'.$row, $aset['tahun_pengadaan']);
        $sheet->setCellValue('G'.$row, $aset['detail']['perolehan']);
        $row++;
      }

      $sheet = $spreadsheet->createSheet();
      $sheet->setTitle('Gedung dan Bangunan');
      $sheet->setCellValue('A1', 'No.');
      $sheet->setCellValue('B1', 'Nama Aset');
      $sheet->setCellValue('C1', 'Kode Aset');
      $sheet->setCellValue('E1', 'Tahun Pengadaan');
      $sheet->setCellValue('F1', 'Perolehan');

      $row = 2;
      foreach($asets[ModelAset::KATEGORI_BANGUNAN] as $i=>$aset){
        $sheet->setCellValue('A'.$row, $i+1);
        $sheet->setCellValue('B'.$row, $aset['nama_aset']);
        $sheet->setCellValue('C'.$row, $aset['kode_aset']);
        $sheet->setCellValue('D'.$row, $aset['detail']['perolehan']);
        $sheet->setCellValue('E'.$row, $aset['tahun_pengadaan']);
        $row++;
      }

      foreach (range('A', 'N') as $columnID) {
          $spreadsheet->getSheetByName('Tanah')->getColumnDimension($columnID)->setAutoSize(true);
          $spreadsheet->getSheetByName('Peralatan dan Mesin')->getColumnDimension($columnID)->setAutoSize(true);
          $spreadsheet->getSheetByName('Gedung dan Bangunan')->getColumnDimension($columnID)->setAutoSize(true);
      }

      // save and download
      $temp_file = tempnam(sys_get_temp_dir(), 'aset_desa_') . '.xlsx';
      $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save($temp_file);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="aset_desa_' . date('Ymd_His') . '.xlsx"');
      header('Cache-Control: max-age=0');
      header('Expires: 0');
      header('Pragma: public');
      readfile($temp_file);
      unlink($temp_file);
      exit;
    }
}

/* End of file Aset.php */
/* Location: ./application/controllers/Aset.php */