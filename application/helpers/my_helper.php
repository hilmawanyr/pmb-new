<?php 

	function PopulateForm()
	{
		$CI = &get_instance();
		$post = array();

		foreach(array_keys($_POST) as $key){
			$post[$key] = $CI->input->post($key);
		}
		
		if ($post == '' or is_null($post)) {
			return 'NULL';
		} else {
			return $post;
		}

	}

	function get_prodi($kd_prodi)
	{
		$CI = &get_instance();
		$CI->load->library('curl');
		$callAPI = $CI->curl->exec(APIHOST.'/getProdi', [
			'x-pmb-key: Nzg3NTY2S2V5Rm9yUE1C'
		], 'POST', json_encode(['kodeprodi' => $kd_prodi]));
		$prodi = json_decode($callAPI)->data->nama;
		return $prodi;
	}

	function getName($u)
	{
		$CI = &get_instance();
		$usr = $CI->db->where('userid', $u)->get('tbl_regist')->row();
		if ($usr->nm_belakang == '' || is_null($usr->nm_belakang)) {
            $nav_name = $usr->nm_depan;
        } else {
            $nav_name = $usr->nm_depan.' '.$usr->nm_belakang;
        }
        return $nav_name;
	}

	function dateIdn($date)
	{
		$BulanIndo = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 	$split = explode('-', $date);
		return $split[2] . ' ' . $BulanIndo[ (int)$split[1] ] . ' ' . $split[0];
	}

	function getEmail($u)
	{
		$CI = &get_instance();
		$cek = $CI->db->where('userid',$u)->get('tbl_regist')->row()->email;
		return $cek;
	}

	function complete($tbl,$fld,$key,$fldcom,$keycom,$fldkey,$iskey)
	{
		$CI = &get_instance();
		$cek = $CI->db->where($fld, $key)->where($fldcom, $keycom)->where($fldkey,$iskey)->get($tbl)->num_rows();
		if ($cek > 0) {
			$res = 'Lengkap';
		} else {
			$res = 'Belum Lengkap';
		}
		return $res;
	}

	function getCamp($c)
	{
		if ($c == 'bks') {
			$camp = 'BEKASI';
		} else {
			$camp = 'JAKARTA';
		}
		return $camp;
	}

	function regType($r)
	{
		if ($r == 'MB') {
			$reg = 'Mahasiswa Baru';
		} elseif ($r == 'RM') {
			$reg = 'Readmisi';
		} else {
			$reg = 'Konversi';
		}
		return $reg;
	}

	function programType($p)
	{
		if ($p == '1') {
			$pro = 'Strata satu';
		} else {
			$pro = 'Strata dua';
		}
		return $pro;
	}

	function myUrlEncode($string)
	{
	    $entities = array('%21','%20', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
	    $replacements = array('!',' ', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
	    return str_replace($entities, $replacements, urlencode($string));
	}

	function myEncode($e,$type)
	{
		$en = array('0','1','2','3','4','5','6','7','8','9');
		$re = array('N','o','P','L','B','l','m','X','y','z');
		if ($type) {
			return str_replace($en, $re, $e);
		} elseif (!$type) {
			return str_replace($re, $en, $e);
		}
	}

	function validHumas($u,$t,$k)
	{
		$CI = &get_instance();
		$val = $CI->db->select('valid')->from('tbl_file')->where('userid',$u)->where('tipe',$t)->where('key_booking',$k)->get();

		if ($val->result() == TRUE) {
			if ($val->row()->valid == 1) {
				$prt = 'Sesuai';
			} elseif ($val->row()->valid == 0) {
				$prt = 'Tidak Sesuai';
			} elseif ($val->row()->valid == 2) {
				$prt = 'Belum Divalidasi';
			}
			return $prt;
		} else {
			$prt = '-';
			return $prt;
		}
	}

	function randomString()
	{
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charsLen = strlen($chars);
	    $randString = '';
	    for ($i = 0; $i < 11; $i++) {
	        $randString .= $chars[rand(0, $charsLen - 1)];
	    }
	    return $randString;
	}

	function dd($data, $terminate = 1)
	{
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		$terminate == 1 ? exit : '';
	}

	function encryptDecrypt($string, $action='e')
	{
		$secret_key = md5('OvIdUcojJzrh13IFI3WHhTOVQuRuGcIM');
		$secret_iv = 'OvIdUcojJzrh13IFI3WHhTOVQuRuGcIM';
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$key = hash( 'sha256', $secret_key );
		$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
		if ( $action == 'e' ) {
			$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
		}
		elseif ( $action == 'd' ){
			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
		}
		return $output;
	}

	function get_app_setting($key)
	{
		$CI =& get_instance();
		$app_name = $CI->crud_model->getDetail('app_setting', 'key_name', $key)->row();
		return $app_name->key_value;
	}