<?php
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
        $data = array(
            'title' => 'Aset Berwujud',
            'active_menu_open' => 'menu-open',
            'active_menu_aset' => 'active',
            'active_menu_wujud' => 'active',
            'aset' => $this->ma->getAsetWujud(),
            'kategori' => $this->mk->getKategoriBarang()
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

        if ($this->form_validation->run() == TRUE) {
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
        $get_image_file = $this->db->get('asets')->row();
        @unlink('src/img/qrcode/' . $get_image_file->qr_code);

        $this->db->where('id_aset', $id_aset);
        $this->db->delete('asets');
        $this->session->set_flashdata('sukses', 'Dihapus');
        redirect('aset_wujud');
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
        $data = array(
            'title' => 'Aset Dihapuskan',
            'active_menu_open' => 'menu-open',
            'active_menu_aset' => 'active',
            'active_menu_hapuskan' => 'active',
            'kategori' => $this->mk->getKategoriBarang(),
            'aset' => $this->ma->getAsetDihapuskan()
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
}

/* End of file Aset.php */
/* Location: ./application/controllers/Aset.php */