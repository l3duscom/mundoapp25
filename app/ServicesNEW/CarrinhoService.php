<?php

namespace App\Services;

class CarrinhoService
{
    public function obter(): array
    {
        return session('carrinho') ?? [];
    }

    public function adicionar(array $item): void
    {
        $carrinho = $this->obter();
        $carrinho[] = [
            'ticket_id' => $item['ticket_id'],
            'nome' => $item['nome'],
            'quantidade' => (int) $item['quantidade'],
            'preco' => (float) $item['preco'],
            'tipo' => $item['tipo']
        ];

        session()->set('carrinho', $carrinho);
    }

    public function remover(int $index): void
    {
        $carrinho = $this->obter();

        if (isset($carrinho[$index])) {
            unset($carrinho[$index]);
            session()->set('carrinho', array_values($carrinho));
        }
    }

    public function limpar(): void
    {
        session()->remove('carrinho');
    }

    public function totalItens(): int
    {
        $carrinho = $this->obter();
        return array_reduce($carrinho, fn($acc, $item) => $acc + $item['quantidade'], 0);
    }

    public function valorTotal(): float
    {
        $carrinho = $this->obter();
        return array_reduce($carrinho, fn($acc, $item) => $acc + ($item['preco'] * $item['quantidade']), 0.0);
    }
}
