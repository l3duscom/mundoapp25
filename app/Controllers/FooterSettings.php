<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FooterSettings extends BaseController
{
    private $footerModel;

    public function __construct()
    {
        $this->footerModel = new \App\Models\FooterSettingModel();
    }

    public function index()
    {
        // Verificar permissão
        if (!$this->usuarioLogado() || !$this->usuarioLogado()->is_admin) {
            return redirect()->back()->with('atencao', 'Você não tem permissão para acessar esse menu.');
        }

        // Buscar configurações atuais
        $config = $this->footerModel->getAllAsArray();

        $data = [
            'titulo' => 'Configurações do Footer',
            'config' => $config,
        ];

        return view('FooterSettings/index', $data);
    }

    public function salvar()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->back();
        }

        // Verificar permissão
        if (!$this->usuarioLogado() || !$this->usuarioLogado()->is_admin) {
            return redirect()->back()->with('atencao', 'Você não tem permissão para acessar esse menu.');
        }

        $post = $this->request->getPost();

        // Salvar campos de texto
        $camposTexto = [
            'pagamento_titulo',
            'pagamento_parcelamento',
            'seguranca_titulo',
            'seguranca_texto',
            'ajuda_titulo',
            'ajuda_texto',
            'ajuda_link',
            'ajuda_link_texto',
            'footer_copyright',
            'social_facebook',
            'social_instagram',
            'social_twitter',
            'social_linkedin',
        ];

        foreach ($camposTexto as $campo) {
            if (isset($post[$campo])) {
                $this->footerModel->setValor($campo, $post[$campo], 'text');
            }
        }

        // Processar upload de imagens de bandeiras
        $this->processarUploadMultiplo('bandeiras', 'pagamento_imagens');

        // Processar upload de imagens de segurança
        $this->processarUploadMultiplo('selos', 'seguranca_selos');

        return redirect()->to(site_url('footer-settings'))->with('sucesso', 'Configurações salvas com sucesso!');
    }

    /**
     * Processa upload múltiplo de imagens
     */
    private function processarUploadMultiplo(string $inputName, string $chave)
    {
        $files = $this->request->getFileMultiple($inputName);
        
        if (empty($files) || !$files[0]->isValid()) {
            return;
        }

        $uploadPath = FCPATH . 'uploads/footer/';
        
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Buscar imagens existentes
        $existente = $this->footerModel->getByChave($chave);
        $imagensAtuais = [];
        
        if ($existente && $existente->tipo === 'json') {
            $imagensAtuais = json_decode($existente->valor, true) ?? [];
        }

        // Processar novos uploads
        foreach ($files as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);
                $imagensAtuais[] = $newName;
            }
        }

        // Salvar lista atualizada
        $this->footerModel->setValor($chave, json_encode($imagensAtuais), 'json');
    }

    /**
     * Remove uma imagem específica
     */
    public function removerImagem()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false]);
        }

        $chave = $this->request->getPost('chave');
        $imagem = $this->request->getPost('imagem');

        $existente = $this->footerModel->getByChave($chave);
        
        if (!$existente || $existente->tipo !== 'json') {
            return $this->response->setJSON(['success' => false]);
        }

        $imagens = json_decode($existente->valor, true) ?? [];
        $imagens = array_filter($imagens, fn($img) => $img !== $imagem);

        // Remover arquivo físico
        $filePath = FCPATH . 'uploads/footer/' . $imagem;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $this->footerModel->setValor($chave, json_encode(array_values($imagens)), 'json');

        return $this->response->setJSON(['success' => true]);
    }
}
