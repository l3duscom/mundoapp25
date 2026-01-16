<?php

namespace App\Models;

use CodeIgniter\Model;

class FooterSettingModel extends Model
{
    protected $table = 'footer_settings';
    protected $primaryKey = 'id';
    protected $returnType = \App\Entities\FooterSetting::class;
    protected $useTimestamps = true;
    protected $allowedFields = ['chave', 'valor', 'tipo', 'descricao'];

    /**
     * Busca configuração por chave
     */
    public function getByChave(string $chave)
    {
        return $this->where('chave', $chave)->first();
    }

    /**
     * Retorna valor de uma configuração por chave
     */
    public function getValor(string $chave, $default = null)
    {
        $setting = $this->getByChave($chave);
        return $setting ? $setting->valor : $default;
    }

    /**
     * Retorna todas as configurações como array associativo
     */
    public function getAllAsArray(): array
    {
        $settings = $this->findAll();
        $result = [];
        
        foreach ($settings as $setting) {
            $result[$setting->chave] = $setting->getValorProcessado();
        }
        
        return $result;
    }

    /**
     * Atualiza ou cria uma configuração
     */
    public function setValor(string $chave, $valor, string $tipo = 'text'): bool
    {
        $existing = $this->getByChave($chave);
        
        if ($existing) {
            return $this->update($existing->id, ['valor' => $valor]);
        }
        
        return $this->insert([
            'chave' => $chave,
            'valor' => $valor,
            'tipo' => $tipo
        ]);
    }
}
