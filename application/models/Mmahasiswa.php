<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mmahasiswa extends CI_Model {

	// buat method untuk tampil data
    function get_data(){
        // jika ingin mengambil salah satu field saja, jika tidak ditulis maka dianggap mengambil seluruh data
        // $this->db->select('npm');
        // Untuk mengambil seluruh data dari table mahasiswa
        $this->db->select("id AS id_mhs,
        npm AS npm_mhs,
        nama AS nama_mhs,
        telepon AS telepon_mhs,
        jurusan AS jurusan_mhs");
        $this->db->from('tb_mahasiswa');
        // untuk melakukan pengurutan data berdasarkan npm dengan aturan ascending,parameter dua bersifat opsional
        $this->db->order_by('npm','asc');

        // untuk melakukan query sql untuk mengambil data dan mengembalikan hasil
        $query = $this->db->get()->result();
        // mengembalikan data
        return $query;
    }

    // buat fungsi untuk hapus data
    function delete_data($token)
    {
        // cek apakah npm ada/tidak
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'"); // TO_BASE64(npm) =
        // eksekusi query
        $query = $this->db->get()->result();
        //jika npm ditemukan
        if(count($query) == 1)  // bisa  > 0  bisa juga ! 0 ---> tapi untuk mengecek data nama yang sama
        {
            // hapus data mahasiswa
            $this->db->where("TO_BASE64(npm) = '$token'");
            $this->db->delete("tb_mahasiswa");
            // kirim nilai hasil = 1
            $hasil = 1;
        }
        // jika npm tidak ditemukan
        else
        {
            // kirim nilai hasil = 0
            $hasil = 0;
        }
        // kirim variabel hasil ke "controller" Mahasiswa
        return $hasil;
    }

    // buat fungsi untuk simpan data
    function save_data($npm,$nama,$telepon,$jurusan,$token)
    {
        // cek apakah npm ada/tidak
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");
        // eksekusi query
        $query = $this->db->get()->result();
        //jika npm tidak ditemukan
        if(count($query) == 0)
        {
            // isi nilai untuk masing2 field
            $data = array(
                "npm" => $npm,
                "nama" => $nama,
                "telepon" => $telepon,
                "jurusan" => $jurusan,
            );
            // simpan data
            $this->db->insert("tb_mahasiswa",$data);
            $hasil = 0;
        }
        //jika npm ditemukan
        else
        {
            $hasil = 1;
        }
        return $hasil;
    }
}