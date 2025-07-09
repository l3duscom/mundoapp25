<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class Whatsapp extends BaseController
{




	public function index()
	{

		$url = 'https://chat.whatsapp.com/DcpFnhWj3MTHlEvaJ4h4jd';

		$data = [
			'titulo' => 'Lançamento oficial',
			'url' => $url,
		];

		//header('Location: ' . $url);

		return view('Redirect/whatsapp', $data);
	}
}
