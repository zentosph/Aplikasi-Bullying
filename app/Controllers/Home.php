<?php

namespace App\Controllers;
date_default_timezone_set('Asia/Jakarta');
use App\Models\M_s;
use App\Models\M_m;
class Home extends BaseController
{
    private function updatelog($update,$table)
    {
		$model = new M_s();
        $data = [
            'id_user'    => session()->get('id'),
            'updated'   => $update,
			'timestamp' => date('Y-m-d H:i:s'),
			'table' => $table
        ];

        $model->tambah('updatelog', $data);
    }
	public function index()
	{
		$model = new M_s();
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
		if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
			return redirect()->to('Home/login');
		}
		if (session()->get('level') == 1 || $data['menu']->dashboard == 1) {
        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
		echo view('header', $data);
		echo view('menu', $data);
		echo view('dashboard',$data);
		echo view('footer');
        // print_r($data['user']);
	} else {
		return redirect()->to('home/login');
	}
}

public function login(){
    $model = new M_s();
	$where = array('setting.id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where);
	echo view('login',$data);
}
public function generateCaptcha()
{
    // Create a string of possible characters
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captcha_code = '';
    
    // Generate a random CAPTCHA code with letters and numbers
    for ($i = 0; $i < 6; $i++) {
        $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    // Store CAPTCHA code in session
    session()->set('captcha_code', $captcha_code);
    
    // Create an image for CAPTCHA
    $image = imagecreate(120, 40); // Increased size for better readability
    $background = imagecolorallocate($image, 200, 200, 200);
    $text_color = imagecolorallocate($image, 0, 0, 0);
    $line_color = imagecolorallocate($image, 64, 64, 64);
    
    imagefilledrectangle($image, 0, 0, 120, 40, $background);
    
    // Add some random lines to the CAPTCHA image for added complexity
    for ($i = 0; $i < 5; $i++) {
        imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
    }
    
    // Add the CAPTCHA code to the image
    imagestring($image, 5, 20, 10, $captcha_code, $text_color);
    
    // Output the CAPTCHA image
    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
}

public function checkInternetConnection()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    } else {
        return false;
    }
}
public function aksi_login()
{
    // Periksa koneksi internet
    if (!$this->checkInternetConnection()) {
        // Jika tidak ada koneksi, cek CAPTCHA gambar
        $captcha_code = $this->request->getPost('captcha_code');
        if (session()->get('captcha_code') !== $captcha_code) {
            session()->setFlashdata('toast_message', 'Invalid CAPTCHA');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    } else {
        // Jika ada koneksi, cek Google reCAPTCHA
        $recaptchaResponse = trim($this->request->getPost('g-recaptcha-response'));
        $secret = '6LeKfiAqAAAAAFkFzd_B9MmWjX76dhdJmJFb6_Vi'; // Ganti dengan Secret Key Anda
        $credential = array(
            'secret' => $secret,
            'response' => $recaptchaResponse
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        curl_close($verify);

        $status = json_decode($response, true);

        if (!$status['success']) {
            session()->setFlashdata('toast_message', 'Captcha validation failed');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    }

    // Proses login seperti biasa
    $u = $this->request->getPost('username');
    $p = $this->request->getPost('password');

    $where = array(
        'username' => $u,
        'password' => md5($p),
        // 'status' => 'verified'
    );
    $model = new M_s;
    $cek = $model->getWhere('user', $where);
    
    if ($cek) {
        // $this->log_activitys('User Melakukan Login', $cek->id_user);
        session()->set('nama', $cek->nama);
        session()->set('id', $cek->id_user);
        session()->set('level', $cek->id_level);
        session()->set('kelas', $cek->id_kelas);
        return redirect()->to('home/');
    } else {
        session()->setFlashdata('toast_message', 'Invalid login credentials');
        session()->setFlashdata('toast_type', 'danger');
        return redirect()->to('home/login');
    }
}

public function logout()
{
    // $this->log_activity('User Logout');
    session()->destroy();
    return redirect()->to('home/login');
}

public function t_kasus(){
    $model = new M_s();
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
		if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
			return redirect()->to('Home/login');
		}
		if (session()->get('level') == 1 || $data['menu']->dashboard == 1) {
        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('t_kasus');
        echo view('footer');
    } else {
		return redirect()->to('home/login');
	}
}

public function aksi_tkasus(){
    $model = new M_s();
	
	$kronologi = $this->request->getPost('kronologi');
	$data = array(
        'id_user' => session()->get('id'),  
        'kasus' => $kronologi,
        'status' => 'Pending',
		'create_at' => date('Y-m-d H:i:s'),
		'create_by' => session()->get('id'),
    );

	$model->tambah('kasus', $data);
    return redirect()->to('home/t_kasus');
}

public function kasus(){
    $model = new M_s();
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
		if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
			return redirect()->to('Home/login');
		}
	if (session()->get('level') == 1 || $data['menu']->kasus == 1) {
    if (session()->get('level') == 4){
        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where = array('kasus.delete' => Null);
        $where1 = array('user.id_user' => session()->get('id'));
        $data['satu'] = $model->joinresult23('kasus','user','kasus.id_user = user.id_user','kelas','user.id_kelas = kelas.id_kelas',$where,$where1);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('kasus',$data);
        echo view('footer');
    } elseif(session()->get('level') == 3) {
        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where = array('kasus.delete' => Null);
        $where1 = array('kelas.id_walikelas' => session()->get('id'));
        $data['satu'] = $model->joinresult23('kasus','user','kasus.id_user = user.id_user','kelas','user.id_kelas = kelas.id_kelas',$where,$where1);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('kasus',$data);
        echo view('footer');
    } elseif(session()->get('level') == 1) {
        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where = array('kasus.delete' => Null);
        $data['satu'] = $model->joinresult2('kasus','user','kasus.id_user = user.id_user','kelas','user.id_kelas = kelas.id_kelas',$where);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('kasus',$data);
        echo view('footer');
	}elseif(session()->get('level') == 2){
        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where = array('kasus.delete' => Null);
        $where1 = array('kasus.status' => 'Proses ke Kepala Sekolah');
        $data['satu'] = $model->joinresult23('kasus','user','kasus.id_user = user.id_user','kelas','user.id_kelas = kelas.id_kelas',$where,$where1);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('kasus',$data);
        echo view('footer');
    }else{
        return redirect()->to('home/login');
    }
}
}

public function detailkasus($id){

    $model = new M_s();
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
		if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
			return redirect()->to('Home/login');
		}
	if (session()->get('level') == 1 || $data['menu']->kasus == 1) {
        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where = array('kasus.delete' => Null);
        $where1 = array('id_kasus' => $id);
        $data['satu'] = $model->joinrow2('kasus','user','kasus.id_user = user.id_user','kelas','user.id_kelas = kelas.id_kelas',$where,$where1);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('detailkasus',$data);
        echo view('footer');
        // print_r($data['satu']);
    } else {
		return redirect()->to('home/login');
	}
}

public function statusproses($id){
    $model = new M_S;
			$where = array('id_kasus' => $id);
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$model->statuschange('kasus', 'status', 'Proses', $where);
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/kasus');
}

public function statuspending($id){
    $model = new M_S;
			$where = array('id_kasus' => $id);
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$model->statuschange('kasus', 'status', 'Pending', $where);
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/kasus');
}
public function statuspks($id){
    $model = new M_S;
			$where = array('id_kasus' => $id);
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$model->statuschange('kasus', 'status', 'Proses ke Kepala Sekolah', $where);
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/kasus');
}

public function statusselesai($id){
    $model = new M_S;
			$where = array('id_kasus' => $id);
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$model->statuschange('kasus', 'status', 'Selesai', $where);
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/kasus');
}



public function profile(){
    
    if (session()->get('level') == 4){
        $model = new M_s();
        $where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where1 = array('view' => 1);
        $data['kelas'] = $model->tampilwhere('kelas',$where1);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('profile',$data);
        echo view('footer');
    }elseif (session()->get('level') == 1 | session()->get('level') == 2 | session()->get('level') == 3 ){
            $model = new M_s();
            $where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
            $where = array('user.id_kelas' => session()->get('kelas'));
            $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
            $where = array('setting.id_setting' => 1);
            $data['setting'] = $model->getwhere('setting', $where);
            $where1 = array('view' => '2');
            $data['kelas'] = $model->tampilwhere('kelas',$where1);
            echo view('header', $data);
            echo view('menu', $data);
            echo view('profile',$data);
            echo view('footer');
    } else {
		return redirect()->to('home/login');
	}
}

public function aksi_eprofile(){
	$model = new M_s();
	$uploadedFile = $this->request->getfile('image');
	$username = $this->request->getPost('username');
	$nama = $this->request->getPost('nama');
	$kelas = $this->request->getPost('kelas');
	$id = $this->request->getPost('id');
	$where = array('id_user' => $id);
	if ($uploadedFile->getName()) {
		$foto = $uploadedFile->getName();
		$model->upload1($uploadedFile);

		
	$data = array(
        'username' => $username,
        'nama' => $nama,
		'foto' => $foto,
		'id_kelas' => $kelas,
		'update_by' => session()->get('id'),
		'update_at' => date('Y-m-d H:i:s')
    );

	}else{
		$data = array(
			'username' => $username,
			'nama' => $nama,
			'id_kelas' => $kelas,
			'update_by' => session()->get('id'),
			'update_at' => date('Y-m-d H:i:s')
		);
	}
	

		

    $model->edit('user', $data, $where);
    return redirect()->to('home/profile');
    // print_r($id);
}

public function aksi_euser(){
	$model = new M_s();
	$uploadedFile = $this->request->getfile('image');
	$username = $this->request->getPost('username');
	$nama = $this->request->getPost('nama');
	$kelas = $this->request->getPost('kelas');
	$id = $this->request->getPost('id');
	$where = array('id_user' => $id);
	if ($uploadedFile->getName()) {
		$foto = $uploadedFile->getName();
		$model->upload1($uploadedFile);

		
	$data = array(
        'username' => $username,
        'nama' => $nama,
		'foto' => $foto,
		'id_kelas' => $kelas,
		'update_by' => session()->get('id'),
		'update_at' => date('Y-m-d H:i:s')
    );

	}else{
		$data = array(
			'username' => $username,
			'nama' => $nama,
			'id_kelas' => $kelas,
			'update_by' => session()->get('id'),
			'update_at' => date('Y-m-d H:i:s')
		);
	}
	

		

    $model->edit('user', $data, $where);
    return redirect()->to('home/detailuser/'.$id);
    // print_r($id);
}

public function dkasus(){
    $model = new M_s();
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
		if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
			return redirect()->to('Home/login');
		}
	if (session()->get('level') == 1 || $data['menu']->data == 1) {
        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where = array('kasus.delete' => Null);
        $data['satu'] = $model->joinresult2('kasus','user','kasus.id_user = user.id_user','kelas','user.id_kelas = kelas.id_kelas',$where);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('kasus',$data);
        echo view('footer');
    }else{
        return redirect()->to('home/login');
    }
}

public function editkasus($id){
    $model = new M_s();
    $where1 = array('level' =>session()->get('level'));
    $data['menu'] = $model->getwhere('menu', $where1);
    if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
        return redirect()->to('Home/login');
    }
if (session()->get('level') == 1 || $data['menu']->data == 1) {
        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where1 = array('user.id_level' => 4);
        $data['murid'] = $model->tampil('user');
        $where = array('kasus.delete' => Null);
        $where1 = array('id_kasus' => $id);
        $data['satu'] = $model->joinrow2('kasus','user','kasus.id_user = user.id_user','kelas','user.id_kelas = kelas.id_kelas',$where,$where1);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('editkasus',$data);
        echo view('footer');
        // print_r($data['satu']);
    } else {
		return redirect()->to('home/login');
	}
}

public function aksi_ekasus(){
    $model = new M_s();
	$murid = $this->request->getPost('murid');
	$kronologi = $this->request->getPost('kronologi');
    $id = $this->request->getPost('id');
    $where = array('id_kasus' => $id);
	$data = array(
        'id_user' => $murid,  
        'kasus' => $kronologi,
		'update_at' => date('Y-m-d H:i:s'),
		'update_by' => session()->get('id'),
    );

	$model->edit('kasus', $data, $where);
    return redirect()->to('home/dkasus');
}

public function softdeletekasus($id){
    $model = new M_S;
			$where = array('id_kasus' => $id);
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$model->statuschange('kasus', 'delete', date('Y-m-d H:i:s'), $where);
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/kasus');
}

public function restorekasus($id){
    $model = new M_S;
			$where = array('id_kasus' => $id);
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$model->statuschange('kasus', 'delete', NULL, $where);
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/skasus');
}

public function skasus(){
    $model = new M_s();
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
		if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
			return redirect()->to('Home/login');
		}
	if (session()->get('level') == 1 || $data['menu']->data == 1) {

        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where1 = "kasus.delete IS NOT NULL";
        $data['satu'] = $model->joinresult2('kasus','user','kasus.id_user = user.id_user','kelas','user.id_kelas = kelas.id_kelas',$where1);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('kasus',$data);
        echo view('footer'); 
    }else{
        return redirect()->to('home/login');
    }

}

public function user(){
    $model = new M_s();
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
		if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
			return redirect()->to('Home/login');
		}
	if (session()->get('level') == 1 || $data['menu']->data == 1) {

        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where1 = array('user.delete' => Null);
        $data['satu'] = $model->joinresult('kelas','user','kelas.id_kelas = user.id_kelas',$where1);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('user',$data);
        echo view('footer'); 
    }else{
        return redirect()->to('home/login');
    }

}

public function resetpassword($id) {
    $model = new M_s();
    
    // Define where clause and table details
    $where = array('id_user' => $id);
    
    // Prepare the data array with the new password
    $data = array(
        'password' => md5('sph'),
    );
    
    // $this->log_activity('User Reset Password for user with ID ' . $id);

    // $this->updatelog('User Update Password to Default for user with ID ' . $id, 'user');
    
    // Reset the password in the database
    $model->edit('user', $data, $where);
    
    // Redirect to the user management page
    return redirect()->to('Home/user');
}

public function detailuser($id){
    $model = new M_s();
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
		if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
			return redirect()->to('Home/login');
		}
	if (session()->get('level') == 1 || $data['menu']->data == 1) {
            $model = new M_s();
            $where = array('user.id_kelas' => session()->get('kelas'));
            $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
            $where = array('user.id_user' => $id);
            $data['users'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
            $where1 = array('view' => '2');
            $data['kelas'] = $model->tampilwhere('kelas',$where1);
            $where = array('setting.id_setting' => 1);
            $data['setting'] = $model->getwhere('setting', $where);
            echo view('header', $data);
            echo view('menu', $data);
            echo view('detailuser',$data);
            echo view('footer');
    } else {
		return redirect()->to('home/login');
	}
}

public function softdeleteuser($id){
    $model = new M_S;
			$where = array('id_user' => $id);
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$model->statuschange('user', 'delete', date('Y-m-d H:i:s'), $where);
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/user');
}

public function suser(){
    $model = new M_s();
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
		if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
			return redirect()->to('Home/login');
		}
	if (session()->get('level') == 1 || $data['menu']->data == 1) {
        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where1 = "user.delete IS NOT NULL";
        $data['satu'] = $model->joinresult('kelas','user','kelas.id_kelas = user.id_kelas',$where1);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('user',$data);
        echo view('footer'); 
    }else{
        return redirect()->to('home/login');
    }
}

public function restoreuser($id){
    $model = new M_S;
			$where = array('id_user' => $id);
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$model->statuschange('user', 'delete', Null, $where);
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/suser');
}

public function deleteuser($id)
	{
		$model = new M_s();
		$where = array('id_user' => $id);
		$model->hapus('user', $where);

		return redirect()->to('Home/suser');
	}

public function setting(){
    $model = new M_s();
    $where1 = array('level' =>session()->get('level'));
    $data['menu'] = $model->getwhere('menu', $where1);
    if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
        return redirect()->to('Home/login');
    }
if (session()->get('level') == 1 || $data['menu']->data == 1) {
    $model = new M_s();
    $where = array('user.id_kelas' => session()->get('kelas'));
    $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
    $where = array('setting.id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where);
    echo view('header', $data);
    echo view('menu', $data);
    echo view('setting',$data);
    echo view('footer'); 
}else{
    return redirect()->to('home/login');
}
}

public function aksi_esetting() {
    $model = new M_s();
    $jwebsite = $this->request->getPost('judul_website');
    $t_icon = $this->request->getFile('t_icon');
    $m_icon = $this->request->getFile('m_icon');
    $l_icon = $this->request->getFile('l_icon');
    $l_image = $this->request->getFile('l_image');
    $id = $this->request->getPost('id');
    $data = array('nama_website' => $jwebsite);

    if ($t_icon->isValid() && !$t_icon->hasMoved()) {
        $foto_t_icon = $t_icon->getName();
        $t_icon->move(ROOTPATH . 'public/assets/images/website', $foto_t_icon);
        $data['icon_website'] = $foto_t_icon;
    }
    
    if ($m_icon->isValid() && !$m_icon->hasMoved()) {
        $foto_m_icon = $m_icon->getName();
        $m_icon->move(ROOTPATH . 'public/assets/images/website', $foto_m_icon);
        $data['icon_menu'] = $foto_m_icon;
    }
    
    if ($l_icon->isValid() && !$l_icon->hasMoved()) {
        $foto_l_icon = $l_icon->getName();
        $l_icon->move(ROOTPATH . 'public/assets/images/website', $foto_l_icon);
        $data['login_icon'] = $foto_l_icon;
    }

    if ($l_icon->isValid() && !$l_icon->hasMoved()) {
        $foto_l_image = $l_image->getName();
        $l_icon->move(ROOTPATH . 'public/assets/images/website', $foto_l_image);
        $data['login_image'] = $foto_l_icon;
    }
    
    $where = array('id_setting' => $id);
    $model->edit('setting', $data, $where);
    
    return redirect()->to('home/setting');
}

public function menu(){
    $model = new M_s();
    $where1 = array('level' =>session()->get('level'));
    $data['menu'] = $model->getwhere('menu', $where1);
    if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
        return redirect()->to('Home/login');
    }
if (session()->get('level') == 1 || $data['menu']->data == 1) {
    $model = new M_s();
			
			// Fetch user details
			$where = ['id_user' => session()->get('id')];
			$data['user'] = $model->getwhere('user', $where);
			$where2 = ['level' => '2'];
			$data['menue'] = $model->getwhere('menu', $where2);
            $where3 = ['level' => '3'];
			$data['menuee'] = $model->getwhere('menu', $where3);
            $where4 = ['level' => '4'];
			$data['menueee'] = $model->getwhere('menu', $where4);
			$where = ['id_setting' => 1];
			$data['setting'] = $model->getwhere('setting', $where);
			
			
			echo view('header', $data);
			echo view('menu', $data);
			echo view('managemenu', $data);
			echo view('footer');
}else{
    return redirect()->to('home/login');
}
}

public function updatemenuws()
{
    $level = 2; // Level 2 untuk Wali Kelas

    // Ambil data dari form
    $data = $this->request->getPost();

    // Panggil fungsi untuk update menu visibility
    $menuModel = new M_m(); // Pastikan model ini sudah dibuat
    $success = $menuModel->updateMenuVisibility($data, $level);

    if ($success) {
        return redirect()->back()->with('message', 'Menu updated successfully for Wali Kelas');
    } else {
        return redirect()->back()->with('message', 'Failed to update menu');
    }
}

public function updateMenuks()
{
    $level = 3; // Level 3 untuk Kepala Sekolah

    $data = $this->request->getPost();
    $menuModel = new M_m();
    $success = $menuModel->updateMenuVisibility($data, $level);

    if ($success) {
        return redirect()->back()->with('message', 'Menu updated successfully for Kepala Sekolah');
    } else {
        return redirect()->back()->with('message', 'Failed to update menu');
    }
}

public function updateMenumd()
{
    $level = 4; // Level 4 untuk Murid

    $data = $this->request->getPost();
    $menuModel = new M_m();
    $success = $menuModel->updateMenuVisibility($data, $level);

    if ($success) {
        return redirect()->back()->with('message', 'Menu updated successfully for Murid');
    } else {
        return redirect()->back()->with('message', 'Failed to update menu');
    }
}

public function restoreupkasus($id)
{
    $model = new M_s();

    // Get the current data from the barang table
    $currentData = $model->getWherearray('kasus', ['id_kasus' => $id]);

    // Get the backup data from the barang_backup table
    $backupData = $model->getWherearray('kasus_backup', ['id_kasus' => $id]);
    unset($backupData['update_by']);
    unset($backupData['update_at']);
    // Restore product data from backup
    $model->restoreProduct('kasus_backup', 'id_kasus', $id);

    // Log the restored data with specific details
    foreach ($backupData as $key => $value) {
        if (isset($currentData[$key]) && $currentData[$key] !== $value) {
            $this->updatelog("User Merestore $key dari {$currentData[$key]} ke $value",'barang');
        }
    }

    // General log entry for restoring the product


    return redirect()->to('home/dkasus');
}

public function restoreupuser($id)
{
    $model = new M_s();

    // Get the current data from the barang table
    $currentData = $model->getWherearray('user', ['id_user' => $id]);

    // Get the backup data from the barang_backup table
    $backupData = $model->getWherearray('user_backup', ['id_user' => $id]);
    unset($backupData['update_by']);
    unset($backupData['update_at']);
    // Restore product data from backup
    $model->restoreProduct('user_backup', 'id_user', $id);

    // Log the restored data with specific details
    foreach ($backupData as $key => $value) {
        if (isset($currentData[$key]) && $currentData[$key] !== $value) {
            $this->updatelog("User Merestore $key dari {$currentData[$key]} ke $value",'barang');
        }
    }

    // General log entry for restoring the product


    return redirect()->to('home/user');
}

public function t_user(){
    $model = new M_s();
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
		if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
			return redirect()->to('Home/login');
		}
		if (session()->get('level') == 1 || $data['menu']->dashboard == 1) {
        $model = new M_s();
        $where = array('user.id_kelas' => session()->get('kelas'));
        $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
        $where = array('setting.id_setting' => 1);
        $data['setting'] = $model->getwhere('setting', $where);
        $where1 = "view IS NOT NULL";
        $data['kelas'] = $model->tampilwhere('kelas',$where1);
        echo view('header', $data);
        echo view('menu', $data);
        echo view('t_user',$data);
        echo view('footer');
    } else {
		return redirect()->to('home/login');
	}
}

public function aksi_tuser() {
    $model = new M_s();
    $uploadedFile = $this->request->getFile('image');
    $idkelas = $this->request->getPost('kelas');
    $username = $this->request->getPost('username');
    $nama = $this->request->getPost('nama');

    // Tentukan nilai id_level berdasarkan id_kelas
    $id_level = null;
    if ($idkelas >= 1 && $idkelas <= 36) {
        $id_level = 4;
    } elseif ($idkelas == 38) {
        $id_level = 3;
    } elseif ($idkelas == 39) {
        $id_level = 1;
    } elseif ($idkelas == 40) {
        $id_level = 2;
    }

    // Atur nama foto
    if ($uploadedFile->getName()) {
        $foto = $uploadedFile->getName();
        $model->upload($uploadedFile);
    } else {
        $foto = '1.jpg';
    }

    // Siapkan data untuk ditambahkan
    $data = array(
        'id_kelas' => $idkelas,
        'id_level' => $id_level,
        'username' => $username,
        'nama' => $nama,
        'password' => md5('sph'),
        'foto' => $foto,
        'delete' => null
    );

    // Tambahkan data ke dalam tabel 'user'
    $model->tambah('user', $data);
    return redirect()->to('home/user');
}

public function laporan(){
    $model = new M_s();
    $where1 = array('level' =>session()->get('level'));
    $data['menu'] = $model->getwhere('menu', $where1);
    if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
        return redirect()->to('Home/login');
    }
    if (session()->get('level') == 1 || $data['menu']->dashboard == 1) {
    $model = new M_s();
    $where = array('user.id_kelas' => session()->get('kelas'));
    $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
    $where = array('setting.id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where);
    $where1 = "view IS NOT NULL";
    $data['kelas'] = $model->joinresult2r('user','kasus','user.id_user = kasus.id_user','kelas','user.id_kelas = kelas.id_kelas');
    echo view('header', $data);
    echo view('menu', $data);
    echo view('laporan',$data);
    echo view('footer');
} else {
    return redirect()->to('home/login');
}
}

public function filterTanggal()
    {
		$model = new M_s();
    $where1 = array('level' =>session()->get('level'));
    $data['menu'] = $model->getwhere('menu', $where1);
    if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
        return redirect()->to('Home/login');
    }
    if (session()->get('level') == 1 || $data['menu']->dashboard == 1) {
    $model = new M_s();
    $where = array('user.id_kelas' => session()->get('kelas'));
    $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
    $where = array('setting.id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where);
    $where1 = "view IS NOT NULL";
        // Ambil parameter tanggal dari query string
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Set tanggal default jika tidak ada filter
        if (!$startDate) {
            $startDate = '0000-00-00'; // Atau tanggal default yang sesuai
        }
        if (!$endDate) {
            $endDate = '9999-12-31'; // Atau tanggal default yang sesuai
        }

        // Panggil model untuk mendapatkan data yang difilter
        $model = new M_s(); // Ganti dengan nama model Anda
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
        $data['kelas'] = $model->joinresult2tanggal(
            'user','kasus','user.id_user = kasus.id_user','kelas','user.id_kelas = kelas.id_kelas',
            $startDate,
            $endDate
        );
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
        // Load view dengan data yang difilter
        echo view('header',$data);
		echo view('menu',$data);
		echo view('laporan',$data);
		echo view('footer');
	}else{
		return redirect()->to('home/login');
	}
    }

    public function kasus_pdf()
    {
		$model = new M_s();
    $where1 = array('level' =>session()->get('level'));
    $data['menu'] = $model->getwhere('menu', $where1);
    if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
        return redirect()->to('Home/login');
    }
    if (session()->get('level') == 1 || $data['menu']->dashboard == 1) {
    $model = new M_s();
    $where = array('user.id_kelas' => session()->get('kelas'));
    $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
    $where = array('setting.id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where);
    $where1 = "view IS NOT NULL";
        // Ambil parameter tanggal dari query string
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Set tanggal default jika tidak ada filter
        if (!$startDate) {
            $startDate = '0000-00-00'; // Atau tanggal default yang sesuai
        }
        if (!$endDate) {
            $endDate = '9999-12-31'; // Atau tanggal default yang sesuai
        }

        // Panggil model untuk mendapatkan data yang difilter
        $model = new M_s(); // Ganti dengan nama model Anda
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
        $data['kelas'] = $model->joinresult2tanggal(
            'user','kasus','user.id_user = kasus.id_user','kelas','user.id_kelas = kelas.id_kelas',
            $startDate,
            $endDate
        );
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        // Load view dengan data yang difilter
        return view('laporanpdf', $data);
	}else{
		return redirect()->to('home/login');
	}
    }

    public function kasus_excel()
    {
		$model = new M_s();
    $where1 = array('level' =>session()->get('level'));
    $data['menu'] = $model->getwhere('menu', $where1);
    if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
        return redirect()->to('Home/login');
    }
    if (session()->get('level') == 1 || $data['menu']->dashboard == 1) {
    $model = new M_s();
    $where = array('user.id_kelas' => session()->get('kelas'));
    $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
    $where = array('setting.id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where);
    $where1 = "view IS NOT NULL";
        // Ambil parameter tanggal dari query string
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Set tanggal default jika tidak ada filter
        if (!$startDate) {
            $startDate = '0000-00-00'; // Atau tanggal default yang sesuai
        }
        if (!$endDate) {
            $endDate = '9999-12-31'; // Atau tanggal default yang sesuai
        }

        // Panggil model untuk mendapatkan data yang difilter
        $model = new M_s(); // Ganti dengan nama model Anda
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
        $data['kelas'] = $model->joinresult2tanggal(
            'user','kasus','user.id_user = kasus.id_user','kelas','user.id_kelas = kelas.id_kelas',
            $startDate,
            $endDate
        );
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        // Load view dengan data yang difilter
        return view('laporanexcel', $data);
	}else{
		return redirect()->to('home/login');
	}
    }

    public function kasus_windows()
    {
		$model = new M_s();
    $where1 = array('level' =>session()->get('level'));
    $data['menu'] = $model->getwhere('menu', $where1);
    if ($data['menu'] === null || !isset($data['menu']->dashboard)) {
        return redirect()->to('Home/login');
    }
    if (session()->get('level') == 1 || $data['menu']->dashboard == 1) {
    $model = new M_s();
    $where = array('user.id_kelas' => session()->get('kelas'));
    $data['user'] = $model->joinrow('kelas','user','kelas.id_kelas = user.id_kelas', $where);
    $where = array('setting.id_setting' => 1);
    $data['setting'] = $model->getwhere('setting', $where);
    $where1 = "view IS NOT NULL";
        // Ambil parameter tanggal dari query string
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Set tanggal default jika tidak ada filter
        if (!$startDate) {
            $startDate = '0000-00-00'; // Atau tanggal default yang sesuai
        }
        if (!$endDate) {
            $endDate = '9999-12-31'; // Atau tanggal default yang sesuai
        }

        // Panggil model untuk mendapatkan data yang difilter
        $model = new M_s(); // Ganti dengan nama model Anda
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
        $data['kelas'] = $model->joinresult2tanggal(
            'user','kasus','user.id_user = kasus.id_user','kelas','user.id_kelas = kelas.id_kelas',
            $startDate,
            $endDate
        );
		$where1 = array('level' =>session()->get('level'));
		$data['menu'] = $model->getwhere('menu', $where1);
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        // Load view dengan data yang difilter
        return view('laporanwindows', $data);
	}else{
		return redirect()->to('home/login');
	}
    }
}
