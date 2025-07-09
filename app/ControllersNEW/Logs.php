<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Logs extends BaseController
{

	private $logPath;

	public function __construct()
	{
		$this->logPath = WRITEPATH . 'logs/';
	}

	public function index()
	{
		helper('filesystem');

		// Obtendo todos os arquivos com caminho completo
		$files = get_filenames($this->logPath, TRUE);

		// Usar array para armazenar arquivos com suas respectivas datas de modificação
		$fileInfo = [];
		foreach ($files as $file) {
			// Obter a data de modificação do arquivo
			$filemtime = filemtime($file); // Retorna a data de modificação como timestamp
			// Adicionar ao array associativo
			$fileInfo[$file] = $filemtime;
		}

		// Ordenar o array pelo valor (data de modificação) em ordem decrescente
		arsort($fileInfo);

		// Agora $fileInfo contém os arquivos ordenados por data de modificação
		// Para simplificar o envio para a view, vamos reformatar isso para apenas uma lista de arquivos
		$sortedFiles = array_keys($fileInfo); // Obtém apenas as chaves do array, que são os caminhos dos arquivos

		// Preparar dados para a view
		$data = [
			'logs' => $sortedFiles
		];

		return view('logs/index', $data);
	}



	public function view($file)
	{
		if (!is_file($this->logPath . $file)) {
			return redirect()->to('/logs');
		}

		$content = file_get_contents($this->logPath . $file);
		$data = [
			'filename' => $file,
			'content' => $content
		];
		return view('logs/view', $data);
	}
}
