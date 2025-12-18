<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>
<style>
    .cancelamento-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 30px 20px;
    }
    
    .cancelamento-header {
        margin-bottom: 40px;
    }
    
    .cancelamento-header h1 {
        font-size: 28px;
        font-weight: 400;
        color: #333;
        margin-bottom: 10px;
    }
    
    .cancelamento-header p {
        color: #666;
        font-size: 14px;
    }
    
    .cancelamento-content {
        display: flex;
        gap: 60px;
    }
    
    /* Stepper Lateral */
    .stepper-sidebar {
        min-width: 200px;
    }
    
    .stepper-item {
        display: flex;
        align-items: flex-start;
        position: relative;
        padding-bottom: 30px;
    }
    
    .stepper-item:last-child {
        padding-bottom: 0;
    }
    
    .stepper-item::before {
        content: '';
        position: absolute;
        left: 7px;
        top: 20px;
        width: 2px;
        height: calc(100% - 10px);
        background-color: #e0e0e0;
    }
    
    .stepper-item:last-child::before {
        display: none;
    }
    
    .stepper-indicator {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 2px solid #e0e0e0;
        background: #fff;
        margin-right: 15px;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }
    
    .stepper-item.active .stepper-indicator {
        border-color: #6366f1;
        background: #6366f1;
    }
    
    .stepper-item.completed .stepper-indicator {
        border-color: #10b981;
        background: #10b981;
    }
    
    .stepper-item.completed .stepper-indicator::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 10px;
        font-weight: bold;
    }
    
    .stepper-item.active .stepper-indicator::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 6px;
        height: 6px;
        background: #fff;
        border-radius: 50%;
    }
    
    .stepper-label {
        font-size: 14px;
        color: #999;
    }
    
    .stepper-item.active .stepper-label,
    .stepper-item.completed .stepper-label {
        color: #333;
        font-weight: 500;
    }
    
    /* Formulário */
    .form-section {
        flex: 1;
    }
    
    .form-section h2 {
        font-size: 20px;
        font-weight: 500;
        color: #333;
        margin-bottom: 30px;
    }
    
    /* Card de Pedido */
    .pedido-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .pedido-card h3 {
        font-size: 16px;
        color: #333;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .pedido-card .badge {
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 4px;
    }
    
    .pedido-card .badge-success {
        background: #10b981;
        color: #fff;
    }
    
    .pedido-card .badge-warning {
        background: #f59e0b;
        color: #fff;
    }
    
    .pedido-card .badge-danger {
        background: #ef4444;
        color: #fff;
    }
    
    .pedido-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .pedido-info-item {
        display: flex;
        flex-direction: column;
    }
    
    .pedido-info-item label {
        font-size: 12px;
        color: #666;
        margin-bottom: 4px;
    }
    
    .pedido-info-item span {
        font-size: 14px;
        color: #333;
        font-weight: 500;
    }
    
    /* Tabela de Ingressos */
    .ingressos-table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }
    
    .ingressos-table th,
    .ingressos-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .ingressos-table th {
        font-size: 12px;
        color: #666;
        font-weight: 500;
    }
    
    .ingressos-table td {
        font-size: 14px;
        color: #333;
    }
    
    /* Alerta */
    .alert-info {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
    }
    
    .alert-warning {
        background: #fffbeb;
        border: 1px solid #fcd34d;
        color: #92400e;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
    }
    
    .alert-danger {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
    }
    
    .btn-link {
        display: inline-block;
        padding: 10px 20px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background: #fff;
        color: #666;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }
    
    .btn-link:hover {
        border-color: #6366f1;
        color: #6366f1;
    }
    
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: #6366f1;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .btn-primary:hover {
        background: #4f46e5;
    }
    
    .btn-primary:disabled,
    .btn-primary.disabled {
        background: #9ca3af;
        cursor: not-allowed;
        opacity: 0.7;
    }
    
    .btn-primary:disabled:hover,
    .btn-primary.disabled:hover {
        background: #9ca3af;
    }
    
    .form-actions {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    @media (max-width: 768px) {
        .cancelamento-content {
            flex-direction: column;
            gap: 30px;
        }
        
        .stepper-sidebar {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 20px;
        }
        
        .stepper-item {
            flex-direction: column;
            align-items: center;
            padding-bottom: 0;
            min-width: fit-content;
        }
        
        .stepper-item::before {
            display: none;
        }
        
        .stepper-indicator {
            margin-right: 0;
            margin-bottom: 8px;
        }
        
        .stepper-label {
            font-size: 12px;
            text-align: center;
        }
        
        .pedido-info {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column-reverse;
            gap: 15px;
        }
        
        .form-actions .btn-primary {
            width: 100%;
            justify-content: center;
        }
    }
</style>
<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<?php 
// Verificar se o pedido é elegível para cancelamento

// =================================================================
// EXCEÇÃO: Lista de ticket_ids que IGNORAM as regras de tempo
// (7 dias desde a compra e 48h antes do evento)
// Apenas a regra de STATUS continua valendo para estes tickets
// =================================================================
$ticketIdsExcecao = [1113, 1114, 1115, 1116, 1117, 1118, 1119, 1123, 1124];

// Verificar se algum ingresso do pedido possui um ticket_id de exceção
$temTicketExcecao = false;
if (!empty($ingressos)) {
    foreach ($ingressos as $ingresso) {
        if (isset($ingresso->ticket_id) && in_array((int)$ingresso->ticket_id, $ticketIdsExcecao)) {
            $temTicketExcecao = true;
            break;
        }
    }
}

// 1. Verificar status (SEMPRE se aplica, mesmo para exceções)
$statusElegiveis = ['CONFIRMED', 'RECEIVED', 'RECEIVED_IN_CASH'];
$statusElegivel = in_array($pedido->status, $statusElegiveis);

// 2. Verificar prazo de 7 dias desde a compra
$dataCompra = new DateTime($pedido->created_at);
$dataAtual = new DateTime();
$diasDesdeCompra = $dataAtual->diff($dataCompra)->days;
$dentroPrazo7Dias = $diasDesdeCompra <= 7;

// 3. Verificar se faltam mais de 48h para o evento
$mais48hAntesEvento = true;
$horasParaEvento = null;
if ($evento && !empty($evento->data_inicio)) {
    $dataEvento = new DateTime($evento->data_inicio . ' ' . ($evento->hora_inicio ?? '00:00:00'));
    $diferencaHoras = ($dataEvento->getTimestamp() - $dataAtual->getTimestamp()) / 3600;
    $horasParaEvento = $diferencaHoras;
    $mais48hAntesEvento = $diferencaHoras > 48;
}

// Determinar elegibilidade:
// - Se tem ticket de exceção: apenas status precisa ser válido
// - Caso contrário: todas as regras se aplicam
if ($temTicketExcecao) {
    // EXCEÇÃO: Ignora regras de tempo, apenas status é verificado
    $elegivel = $statusElegivel;
} else {
    // Regra normal: TODAS as condições devem ser atendidas
    $elegivel = $statusElegivel && $dentroPrazo7Dias && $mais48hAntesEvento;
}

// Determinar o motivo da não elegibilidade (prioridade)
$motivoNaoElegivel = '';
if (!$statusElegivel) {
    // Regra de status sempre se aplica
    if ($pedido->status === 'REFUNDED') {
        $motivoNaoElegivel = 'Este pedido já foi reembolsado anteriormente.';
    } elseif ($pedido->status === 'PENDING' || $pedido->status === 'OVERDUE') {
        $motivoNaoElegivel = 'Este pedido está com pagamento pendente. Pedidos não pagos não podem ser cancelados por esta via.';
    } elseif (strpos($pedido->status, 'CHARGEBACK') !== false) {
        $motivoNaoElegivel = 'Este pedido possui um chargeback registrado.';
    } else {
        $motivoNaoElegivel = 'O status atual do pedido não permite solicitar reembolso. Entre em contato com o suporte.';
    }
} elseif (!$temTicketExcecao) {
    // Regras de tempo só se aplicam se NÃO for ticket de exceção
    if (!$dentroPrazo7Dias) {
        $motivoNaoElegivel = 'O prazo para solicitar reembolso expirou. O cancelamento só pode ser solicitado em até 7 dias após a compra. Esta compra foi realizada há ' . $diasDesdeCompra . ' dias.';
    } elseif (!$mais48hAntesEvento) {
        if ($horasParaEvento !== null && $horasParaEvento <= 0) {
            $motivoNaoElegivel = 'O evento já ocorreu ou está em andamento. Não é possível solicitar reembolso após o início do evento.';
        } else {
            $motivoNaoElegivel = 'O cancelamento só pode ser solicitado com mais de 48 horas de antecedência do evento. Faltam aproximadamente ' . round($horasParaEvento) . ' horas para o início do evento.';
        }
    }
}
?>

<div class="cancelamento-container">
    <!-- Header -->
    <div class="cancelamento-header">
        <h1>Solicitar reembolso</h1>
        <p>Ao fazer isso, sua compra será cancelada e não será mais possível acessar o produto.</p>
    </div>
    
    <div class="cancelamento-content">
        <!-- Stepper Lateral -->
        <div class="stepper-sidebar">
            <div class="stepper-item completed">
                <div class="stepper-indicator"></div>
                <span class="stepper-label">Localizar compra</span>
            </div>
            <div class="stepper-item active">
                <div class="stepper-indicator"></div>
                <span class="stepper-label">Verificação de segurança</span>
            </div>
            <div class="stepper-item">
                <div class="stepper-indicator"></div>
                <span class="stepper-label">Motivo do reembolso</span>
            </div>
            <div class="stepper-item">
                <div class="stepper-indicator"></div>
                <span class="stepper-label">Conferir informações</span>
            </div>
            <div class="stepper-item">
                <div class="stepper-indicator"></div>
                <span class="stepper-label">Feedback</span>
            </div>
        </div>
        
        <!-- Conteúdo -->
        <div class="form-section">
            <h2>Confirme os dados do pedido</h2>
            
            <?php if ($elegivel): ?>
            <div class="alert-info">
                <i class="bi bi-info-circle"></i>
                Encontramos o pedido abaixo. Por favor, verifique se os dados estão corretos antes de continuar.
            </div>
            <?php else: ?>
            <div class="alert-danger">
                <i class="bi bi-exclamation-triangle"></i>
                <strong>Esta compra não está elegível para cancelamento.</strong><br>
                <?= $motivoNaoElegivel ?>
            </div>
            <?php endif; ?>
            
            <!-- Card do Pedido -->
            <div class="pedido-card">
                <h3>
                    Pedido #<?= esc($pedido->codigo) ?>
                    <?php 
                    $statusClass = 'badge-warning';
                    $statusText = $pedido->status;
                    
                    if (in_array($pedido->status, ['CONFIRMED', 'RECEIVED', 'PAID', 'RECEIVED_IN_CASH'])) {
                        $statusClass = 'badge-success';
                        $statusText = 'Pago';
                    } elseif (in_array($pedido->status, ['REFUNDED'])) {
                        $statusClass = 'badge-danger';
                        $statusText = 'Reembolsado';
                    } elseif (in_array($pedido->status, ['PENDING', 'OVERDUE'])) {
                        $statusClass = 'badge-warning';
                        $statusText = 'Pendente';
                    }
                    ?>
                    <span class="badge <?= $statusClass ?>"><?= $statusText ?></span>
                </h3>
                
                <div class="pedido-info">
                    <div class="pedido-info-item">
                        <label>Nome</label>
                        <span><?= esc($cliente->nome) ?></span>
                    </div>
                    <div class="pedido-info-item">
                        <label>Email</label>
                        <span><?= esc($cliente->email) ?></span>
                    </div>
                    <div class="pedido-info-item">
                        <label>Evento</label>
                        <span><?= esc($evento->nome ?? 'N/A') ?></span>
                    </div>
                    <div class="pedido-info-item">
                        <label>Valor Total</label>
                        <span>R$ <?= number_format($pedido->total, 2, ',', '.') ?></span>
                    </div>
                    <div class="pedido-info-item">
                        <label>Data da Compra</label>
                        <span><?= date('d/m/Y H:i', strtotime($pedido->created_at)) ?></span>
                    </div>
                    <div class="pedido-info-item">
                        <label>Forma de Pagamento</label>
                        <?php
                        $formaPagamentoMap = [
                            'CREDIT_CARD' => 'Cartão de Crédito',
                            'PIX' => 'PIX',
                            'RECEIVED' => 'PIX',
                            'RECEIVED_IN_CASH' => 'Dinheiro',
                        ];
                        $formaPagamentoExibir = $formaPagamentoMap[$pedido->forma_pagamento] ?? ($pedido->forma_pagamento ?? 'N/A');
                        ?>
                        <span><?= esc($formaPagamentoExibir) ?></span>
                    </div>
                </div>
                
                <?php if (!empty($ingressos)): ?>
                <table class="ingressos-table">
                    <thead>
                        <tr>
                            <th>Ingresso</th>
                            <th>Código</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ingressos as $ingresso): ?>
                        <tr>
                            <td><?= esc($ingresso->nome) ?></td>
                            <td><?= esc($ingresso->codigo) ?></td>
                            <td>R$ <?= number_format($ingresso->valor ?? $ingresso->valor_unitario ?? 0, 2, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
            
            <div class="form-actions">
                <a href="<?= site_url('cancelamento') ?>" class="btn-link">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
                <?php if ($elegivel): ?>
                    <?php if ($temTicketExcecao): ?>
                    <!-- Ticket de exceção: vai para tela de upgrade -->
                    <?= form_open('cancelamento/upgrade', ['style' => 'display: inline;']) ?>
                        <input type="hidden" name="pedido_id" value="<?= esc($pedido->id) ?>">
                        <button type="submit" class="btn-primary">
                            Confirmar e continuar
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    <?= form_close() ?>
                    <?php else: ?>
                    <!-- Ticket normal: vai direto para reembolso -->
                    <?= form_open('cancelamento/solicitar-reembolso', ['style' => 'display: inline;']) ?>
                        <input type="hidden" name="pedido_id" value="<?= esc($pedido->id) ?>">
                        <button type="submit" class="btn-primary">
                            Solicitar Reembolso
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    <?= form_close() ?>
                    <?php endif; ?>
                <?php else: ?>
                <button type="button" class="btn-primary disabled" disabled>
                    Confirmar e continuar
                    <i class="bi bi-arrow-right"></i>
                </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<?php echo $this->endSection() ?>

