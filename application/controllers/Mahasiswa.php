<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";
class Mahasiswa extends Server {

	// buat function get, untuk mengambil data
	function service_get(){
		// panggil model Mmahasiswa, parameter kedua sebagai alias bersifat opsional
		$this->load->model("Mmahasiswa","mdl",TRUE);
		// panggil function get_data yang ada pada model yang sudah diinstance dengan perintah diatas
		$hasil = $this->mdl->get_data();
		// memanggil function response ketika data berhasil diambil
		$this->response(array("mahasiswa" => $hasil),200);
	}
	// buat function put, untuk mengupdate data
	function service_put()
	{

	}
	// buat function POST, untuk mengupdate data
	function service_post(){
		// panggil model "Mmahasiswa"
		$this->load->model("Mmahasiswa", "mdl", TRUE);
		// ambil parameter data yang akan diisi
		$data = array(						//cara 1
			"npm"=> $this->post("npm"),
			"nama"=> $this->post("nama"),
			"telepon"=> $this->post("telepon"),
			"jurusan"=> $this->post("jurusan"),
			"token"=> base64_encode($this->post("npm")),
		);

		//$data["npm"] = $this->post("npm");	//cara 2
		//$data["npm"] = $this->post("nama");

		//$npm = $this->post("npm");         	//cara 3
		//$npm = $this->post("nama");

		// panggil method "save_data"
		//$hasil = $this->mdl->save_data();
		//$hasil = $this->mdl->save_data($data["0"], $data["1"], $data["2"], $data["3"]);
		$hasil = $this->mdl->save_data($data["npm"], $data["nama"], $data["telepon"], $data["jurusan"], $data["token"]);
		// jika hasil = 0
		if($hasil == 0)
		{
			$this->response(array("status" => "Data Mahasiswa Berhasil Disimpan"),200);
		}
		// jika hasil != 0
		else
		{
			$this->response(array("status" => "Data Mahasiswa Gagal Disimpan !"),200);
		}
	}

	// buat function DELETE, untuk mengupdate data
	function service_delete(){
		// panggil model "Mmahasiswa"
		$this->load->model("Mmahasiswa", "mdl", TRUE);
		// ambil parameter token "npm"
		$token = $this->delete("npm");
		// panggil fungsi "delete_data"
		$hasil = $this->mdl->delete_data(base64_encode($token));
		// jika proses delete berhasil
		if($hasil == 1)
		{
			$this->response(array("status"=>"Data Mahasiswa berhasil dihapus"),200);
		}
		// jika proses delete gagal
		else
		{
			$this->response(array("status" => "Data mahasiswa gagal dihapus !"), 200);
		}
	}
    
}
