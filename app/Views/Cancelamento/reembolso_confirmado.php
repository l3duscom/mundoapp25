<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>
<style>
    .reembolso-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 40px 20px;
        text-align: center;
    }
    
    .reembolso-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        font-size: 60px;
    }
    
    .reembolso-titulo {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 15px;
    }
    
    .reembolso-subtitulo {
        font-size: 16px;
        color: #6b7280;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    
    .reembolso-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        text-align: left;
    }
    
    .reembolso-card h3 {
        font-size: 16px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .reembolso-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 12px;
    }
    
    .reembolso-info-item {
        background: #f9fafb;
        padding: 12px;
        border-radius: 8px;
    }
    
    .reembolso-info-item label {
        display: block;
        font-size: 11px;
        color: #6b7280;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .reembolso-info-item span {
        font-size: 14px;
        font-weight: 600;
        color: #1f2937;
    }
    
    /* Aviso de demora - destaque */
    .aviso-demora {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        border: 2px solid #f59e0b;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        text-align: left;
    }
    
    .aviso-demora .aviso-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }
    
    .aviso-demora .aviso-icon {
        width: 50px;
        height: 50px;
        background: #f59e0b;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }
    
    .aviso-demora h4 {
        font-size: 18px;
        font-weight: 700;
        color: #92400e;
        margin: 0;
    }
    
    .aviso-demora p {
        font-size: 14px;
        color: #78350f;
        line-height: 1.7;
        margin: 0 0 15px 0;
    }
    
    .aviso-demora .motivo {
        background: rgba(255, 255, 255, 0.7);
        border-radius: 8px;
        padding: 15px;
        font-size: 13px;
        color: #92400e;
        line-height: 1.6;
    }
    
    .aviso-demora .motivo strong {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    /* Número do protocolo */
    .protocolo {
        background: #f3f4f6;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
    }
    
    .protocolo label {
        display: block;
        font-size: 12px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }
    
    .protocolo .numero {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        font-family: monospace;
    }
    
    .proximos-passos {
        background: #f0fdf4;
        border: 1px solid #86efac;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
        text-align: left;
    }
    
    .proximos-passos h4 {
        font-size: 15px;
        font-weight: 600;
        color: #166534;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .proximos-passos ol {
        margin: 0;
        padding-left: 20px;
        color: #15803d;
        font-size: 13px;
        line-height: 1.8;
    }
    
    .btn-voltar {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 30px;
        background: #6b7280;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .btn-voltar:hover {
        background: #4b5563;
    }
    
    .contato-suporte {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
        font-size: 13px;
        color: #6b7280;
    }
    
    .contato-suporte a {
        color: #6366f1;
        text-decoration: none;
    }
    
    .contato-suporte a:hover {
        text-decoration: underline;
    }
    
    @media (max-width: 768px) {
        .reembolso-titulo {
            font-size: 22px;
        }
        
        .reembolso-info {
            grid-template-columns: 1fr;
        }
        
        .protocolo .numero {
            font-size: 18px;
        }
    }
</style>
<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<div class="reembolso-container">
    <!-- Ícone -->
    <div class="reembolso-icon">
        📝
    </div>
    
    <!-- Título -->
    <h1 class="reembolso-titulo">Solicitação de Reembolso Registrada</h1>
    <p class="reembolso-subtitulo">
        Sua solicitação foi recebida e está sendo processada pela nossa equipe.
    </p>
    
    <!-- Número do protocolo -->
    <div class="protocolo">
        <label>Número do Protocolo</label>
        <div class="numero">#<?= esc($pedido->codigo) ?>-REF</div>
    </div>
    
    <!-- Card com detalhes do pedido -->
    <div class="reembolso-card">
        <h3>
            <span>📋</span>
            Detalhes da solicitação
        </h3>
        <div class="reembolso-info">
            <div class="reembolso-info-item">
                <label>Pedido Original</label>
                <span>#<?= esc($pedido->codigo) ?></span>
            </div>
            <div class="reembolso-info-item">
                <label>Valor do Pedido</label>
                <span>R$ <?= number_format($pedido->total, 2, ',', '.') ?></span>
            </div>
            <div class="reembolso-info-item">
                <label>Data da Compra</label>
                <span><?= date('d/m/Y', strtotime($pedido->created_at)) ?></span>
            </div>
            <div class="reembolso-info-item">
                <label>Forma de Pagamento</label>
                <?php
                $formaPagamentoMap = [
                    'CREDIT_CARD' => 'Cartão de Crédito',
                    'PIX' => 'PIX',
                    'RECEIVED' => 'PIX',
                    'RECEIVED_IN_CASH' => 'Dinheiro',
                ];
                $formaPagamento = $formaPagamentoMap[$pedido->forma_pagamento] ?? $pedido->forma_pagamento;
                ?>
                <span><?= esc($formaPagamento) ?></span>
            </div>
        </div>
    </div>
    
    <!-- Aviso importante sobre demora -->
    <div class="aviso-demora">
        <div class="aviso-header">
            <div class="aviso-icon">⏳</div>
            <h4>Aviso Importante sobre o Prazo</h4>
        </div>
        <p>
            O reembolso em dinheiro está <strong>demorando mais que o esperado</strong>. 
            Pedimos desculpas pelo inconveniente e agradecemos sua paciência.
        </p>
        <div class="motivo">
            <strong>Por que está demorando?</strong>
            Os valores investidos para trazer os artistas internacionais, assim como toda a logística do evento 
            (estrutura, equipamentos, hospedagem, passagens), já foram utilizados antes do cancelamento do evento 
            e não puderam ser recuperados integralmente. Por isso, estamos trabalhando para realizar os reembolsos 
            na medida do possível.
        </div>
    </div>
    
    <!-- Próximos passos -->
    <div class="proximos-passos">
        <h4>
            <span>✅</span>
            Próximos passos
        </h4>
        <ol>
            <li>Sua solicitação foi registrada em nosso sistema</li>
            <li>Você receberá um email de confirmação em breve</li>
            <li>Nossa equipe analisará o pedido e entrará em contato</li>
            <li>O reembolso será processado assim que possível</li>
        </ol>
    </div>
    
    <!-- Botão voltar -->
    <a href="<?= site_url('/') ?>" class="btn-voltar">
        <i class="bi bi-house"></i>
        Voltar para o início
    </a>
    
    <!-- Contato suporte -->
    <div class="contato-suporte">
        <p>
            Dúvidas? Entre em contato: 
            <a href="mailto:suporte@mundodream.com.br">suporte@mundodream.com.br</a>
        </p>
    </div>
</div>

<?php echo $this->endSection() ?>
