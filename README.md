# Auto_number

Library untuk membuat ID Otomatis di Framework CodeIgniter

 NOTE: Saat ini prefix yang didukung Library Auto_number adalah:

 - Prefix huruf (contoh: P0001)
 - Prefix tanggal (contoh: 1810140001)

## Installasi

Silahkan download library ini, kemudian letakan file Auto_number.php pada folder:

    application/libraries

Selanjutnya load library melalui file autoload.php pada folder:

    application/config/autoload.php

Tambahkan menjadi seperti ini:

    $autoload['libraries'] = array('database', 'auto_number');
    $autoload['model'] = array('contoh_model');

## Persiapan

 - Buat database
 - Atur koneksi database pada folder application/config/database.php
 - Sebelum menggunakan Library Auto_number pastikan koneksi database berhasil dan tidak ada error
 
 Buat model Contoh_model.php di folder application/models/Contoh_model.php

    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Contoh_model extends CI_Model {

        public function id_terakhir()
        {
            $this->db->select('id');
            $this->db->from('nama_table');
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get();
            return $query->row();
        }
    }

Selanjutnya tambahkan kode berikut ini di Controller Welcome di folder application/controllers/Welcome.php:

    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Welcome extends CI_Controller {

        public function index()
        {
            $this->load->view('welcome_message');
        }

        public function tes_auto_number()
        {        
            $row = $this->contoh_model->id_terakhir();
            $config['id'] = $row->id;
            $config['awalan'] = 'P';
            $config['digit'] = 4;
            $this->auto_number->config($config);
            echo $this->auto_number->generate_id();
        }
    }

Silahkan tes di Browser, seharusnya id yang muncul adalah P0001

## Menggunakan Prefix Tanggal

Untuk menggunakan prefix tanggal cukup merubah config seperti ini:

    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Welcome extends CI_Controller {

        public function index()
        {
            $this->load->view('welcome_message');
        }

        public function tes_auto_number()
        {
            $row = $this->contoh_model->id_terakhir();
            $config['id'] = $row->id;
            $config['digit'] = 4;
            $config['tanggal'] = TRUE;
            $this->auto_number->config($config);
            echo $this->auto_number->generate_id();
        }
    }

Silahkan tes di Browser, seharusnya id yang muncul adalah 1810140001

## Catatan Tambahan

Pastikan table di database dalam keadaan kosong untuk menghindari error.
