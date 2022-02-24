<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function exec($url, $header, $method='GET', $postBody='')
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);

		if ($method == 'POST') {
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postBody);
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

}

/* End of file Curl.php */
/* Location: ./application/libraries/Curl.php */
