<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />
<style>
    /* ===== Layout base ===== */
    .checkout-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 0 16px;
    }

    /* ===== Grid de categorias ===== */
    .cat-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }

    .cat-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 10px 16px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        color: #6b7280;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        outline: none;
    }

    .cat-btn i {
        font-size: 15px;
    }

    .cat-btn:hover:not(.active) {
        border-color: #c7d2fe;
        color: #4338ca;
        background: #f5f3ff;
    }

    .cat-btn.active {
        background: #4338ca;
        color: #fff;
        border-color: #4338ca;
        box-shadow: 0 2px 8px rgba(67, 56, 202, 0.3);
    }

    /* ===== Tab content ===== */
    .tabcontent {
        display: none;
        padding: 0;
        animation: fadeEffect 0.3s;
    }

    @keyframes fadeEffect {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* ===== Sub-filtros (Todas, Inteira, Meia) ===== */
    .sub-filter-bar {
        display: flex;
        gap: 0;
        background: #f3f4f6;
        border-radius: 10px;
        padding: 3px;
        margin-bottom: 16px;
    }

    .sub-filter-btn {
        flex: 1;
        background: transparent;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s;
    }

    .sub-filter-btn:hover:not(.active) {
        color: #374151;
    }

    .sub-filter-btn.active {
        background: #fff;
        color: #111827;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    /* ===== Ticket card ===== */
    .ticket-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 12px;
        transition: all 0.2s;
    }

    .ticket-card.has-qty {
        border-color: #22c55e;
        background: #fafffe;
    }

    .ticket-card-lote-info {
        font-size: 11px;
        color: #7c3aed;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .ticket-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 2px;
    }

    .ticket-card-name {
        font-size: 16px;
        font-weight: 700;
        color: #1a2332;
        line-height: 1.3;
        flex: 1;
    }

    .ticket-card-right {
        flex-shrink: 0;
    }

    .ticket-card-meta {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .ticket-card-price-row {
        display: flex;
        align-items: baseline;
        gap: 8px;
        margin-bottom: 10px;
    }

    .ticket-card-price {
        font-size: 24px;
        font-weight: 700;
        color: #1a2332;
        white-space: nowrap;
    }

    .ticket-card-price .currency {
        font-size: 14px;
        font-weight: 600;
    }

    .ticket-card-taxa {
        font-size: 11px;
        color: #94a3b8;
    }

    .ticket-card-controls {
        display: inline-flex;
        align-items: center;
        gap: 0;
        background: #f1f5f9;
        border-radius: 50px;
        padding: 2px;
    }

    .ticket-card-controls a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        color: #e07020;
        text-decoration: none;
        transition: all 0.15s;
        font-size: 18px;
    }

    .ticket-card-controls a:hover {
        background: #e2e8f0;
        color: #c05010;
    }

    .ticket-card-controls .qty-value {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        min-width: 28px;
        text-align: center;
        padding: 0 2px;
    }

    .ticket-card.has-qty .ticket-card-controls .qty-value {
        color: #16a34a;
    }

    .ticket-card-esgotado {
        display: inline-block;
        background: #fef2f2;
        color: #dc2626;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 8px;
    }

    .ticket-card-elegibilidade {
        border-top: 1px solid #f1f5f9;
        padding-top: 10px;
        margin-top: 4px;
    }

    .ticket-card-elegibilidade strong {
        font-size: 12px;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 4px;
    }

    .ticket-card-elegibilidade-text {
        font-size: 11px;
        color: #94a3b8;
        line-height: 1.5;
    }

    /* ===== Barra fixa inferior ===== */
    .cart-bottom-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #fff;
        border-top: 1px solid #e5e7eb;
        padding: 16px 20px;
        z-index: 1000;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
    }

    .cart-bottom-inner {
        max-width: 600px;
        margin: 0 auto;
    }

    .cart-bottom-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .cart-bottom-info {
        flex: 1;
    }

    .cart-bottom-fee {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 2px;
    }

    .cart-bottom-fee span {
        float: right;
        color: #374151;
        font-weight: 500;
    }

    .cart-bottom-total-label {
        font-size: 11px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .cart-bottom-total-value {
        font-size: 22px;
        font-weight: 700;
        color: #16a34a;
        line-height: 1.2;
    }

    .cart-bottom-note {
        font-size: 10px;
        color: #9ca3af;
        margin-top: 2px;
    }

    .btn-continuar {
        background: #22c55e;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 16px 32px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        text-decoration: none;
    }

    .btn-continuar:hover {
        background: #16a34a;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
        color: #fff;
        text-decoration: none;
    }

    /* ===== Ver Resumo toggle ===== */
    .ver-resumo-toggle {
        text-align: center;
        padding: 12px 0;
        cursor: pointer;
        user-select: none;
    }

    .ver-resumo-toggle a {
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .ver-resumo-toggle a:hover {
        color: #374151;
    }

    /* Resumo expandido */
    .cart-summary-section {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
    }

    .cart-summary-section.hidden {
        display: none;
    }

    .summary-item-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #f3f4f6;
        font-size: 14px;
    }

    .summary-item-row:last-of-type {
        border-bottom: none;
    }

    .summary-item-name {
        flex: 1;
        color: #374151;
        font-weight: 500;
    }

    .summary-item-qty {
        color: #9ca3af;
        font-size: 13px;
        margin: 0 12px;
    }

    .summary-item-price {
        font-weight: 600;
        color: #1f2937;
    }

    .summary-total-row {
        display: flex;
        justify-content: space-between;
        padding-top: 12px;
        margin-top: 8px;
        border-top: 2px solid #e5e7eb;
    }

    .summary-total-row .label {
        font-weight: 600;
        color: #374151;
    }

    .summary-total-row .value {
        font-size: 18px;
        font-weight: 700;
        color: #16a34a;
    }

    /* ===== Seletor de dia ===== */
    .day-selector-overlay {
        max-width: 540px;
        margin: 0 auto;
    }

    .day-selector-title {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .day-selector-subtitle {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 24px;
    }

    .day-option {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px;
        border: 2px solid #e5e7eb;
        border-radius: 14px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #fff;
        text-decoration: none;
        color: inherit;
    }

    .day-option:hover {
        border-color: #2563eb;
        background: #f0f6ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        color: inherit;
        text-decoration: none;
    }

    .day-option-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .day-option-icon.sab { background: #eff6ff; color: #3b82f6; }
    .day-option-icon.dom { background: #fef3c7; color: #d97706; }
    .day-option-icon.combo { background: #ecfdf5; color: #059669; }

    .day-option-info { flex: 1; }

    .day-option-name {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 2px;
    }

    .day-option-date {
        font-size: 13px;
        color: #6b7280;
    }

    .day-option-arrow {
        font-size: 20px;
        color: #9ca3af;
        transition: transform 0.2s;
    }

    .day-option:hover .day-option-arrow {
        transform: translateX(4px);
        color: #2563eb;
    }

    .day-option-badge {
        font-size: 11px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        background: #ecfdf5;
        color: #059669;
    }

    #carrinho-content {
        display: none;
    }

    html {
        scroll-behavior: smooth;
    }

    /* Spacer para barra fixa */
    .bottom-spacer {
        height: 140px;
    }

    /* ===== Responsivo ===== */
    @media screen and (max-width: 768px) {
        .checkout-container {
            padding: 0 12px;
        }

        .ticket-card {
            padding: 16px;
        }

        .ticket-card-name {
            font-size: 15px;
        }

        .ticket-card-price {
            font-size: 16px;
        }

        .btn-continuar {
            padding: 14px 24px;
            font-size: 15px;
        }

        .cart-bottom-total-value {
            font-size: 20px;
        }

        .tab button {
            padding: 8px 14px;
            font-size: 13px;
        }

        .tab button .day-name {
            font-size: 13px;
        }
    }

    @media screen and (max-width: 480px) {
        .cart-bottom-row {
            flex-direction: column;
            gap: 12px;
        }

        .btn-continuar {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<?php

$a = 0;
$influencer = '';
if (!isset($_SESSION['total'])) {
    $_SESSION['total'] = 0;
};
if (isset($_SESSION['cupom'])) {
    $_SESSION['cupom'] = 0;
};
if (isset($_GET['cosplyer'])) {
    $cosplayer = 1;
} else {
    $cosplayer = 0;
}
if (isset($_GET['convite'])) {
    $_SESSION['convite'] = $_GET['convite'];
} else if (!empty($_SESSION['convite'])) {
    $_SESSION['convite'];
} else {
    $_SESSION['convite'] = 0;
};

if ($_SESSION['convite'] == 'x') {
    $influencer = 'o mago supremo';
} else if ($_SESSION['convite'] == 'ALKUQ4J') {
    $influencer = 'a Annya';
} else if ($_SESSION['convite'] == 'BSJFMRJ') {
    $influencer = 'a Dumadril';
} else if ($_SESSION['convite'] == '7DWYFOG') {
    $influencer = 'Yuri';
} else if ($_SESSION['convite'] == '6OKB9NC') {
    $influencer = 'a Val';
} else if ($_SESSION['convite'] == 'YN93AUN') {
    $influencer = 'a Duda';
} else if ($_SESSION['convite'] == 'WSDRKMI') {
    $influencer = 'a Viv Lee Cosplay';
} else if ($_SESSION['convite'] == '40WEBRK') {
    $influencer = 'a Vanessa';
} else if ($_SESSION['convite'] == '0ZOF49A') {
    $influencer = 'a Vithória Millan';
} else if ($_SESSION['convite'] == 'ELSWNKP') {
    $influencer = 'a Juniper Universe';
} else if ($_SESSION['convite'] == 'FJ3XYWZ') {
    $influencer = 'o Rafael Nunes';
} else {
    $influencer = 'o mago supremo';
}

// Salva o event_id na sessão ao carregar a página
if (isset($event_id)) {
    session()->set('event_id', $event_id);
} else {
    $event_id = session()->get('event_id');
}

?>



<!-- ETAPA 1: Seletor de Dia -->
<div id="day-selector" class="day-selector-overlay mt-3">
    <div class="day-selector-title">Qual dia voce quer participar?</div>
    <div class="day-selector-subtitle">Escolha o dia para ver os ingressos disponiveis</div>

    <div class="day-option" onclick="selecionarDia('sabado')">
        <div class="day-option-icon sab">
            <i class="bx bx-calendar"></i>
        </div>
        <div class="day-option-info">
            <div class="day-option-name">Sabado</div>
            <div class="day-option-date"><?php
                if (isset($evento)) {
                    $data_inicio = date_create($evento->data_inicio);
                    $meses_sel = ['01'=>'janeiro','02'=>'fevereiro','03'=>'marco','04'=>'abril','05'=>'maio','06'=>'junho','07'=>'julho','08'=>'agosto','09'=>'setembro','10'=>'outubro','11'=>'novembro','12'=>'dezembro'];
                    echo date_format($data_inicio, 'd') . ' de ' . $meses_sel[date_format($data_inicio, 'm')] . ' de ' . date_format($data_inicio, 'Y');
                }
            ?></div>
        </div>
        <div class="day-option-arrow"><i class="bx bx-chevron-right"></i></div>
    </div>

    <div class="day-option" onclick="selecionarDia('domingo')">
        <div class="day-option-icon dom">
            <i class="bx bx-calendar"></i>
        </div>
        <div class="day-option-info">
            <div class="day-option-name">Domingo</div>
            <div class="day-option-date"><?php
                if (isset($evento)) {
                    $data_fim = date_create($evento->data_fim);
                    echo date_format($data_fim, 'd') . ' de ' . $meses_sel[date_format($data_fim, 'm')] . ' de ' . date_format($data_fim, 'Y');
                }
            ?></div>
        </div>
        <div class="day-option-arrow"><i class="bx bx-chevron-right"></i></div>
    </div>

    <div class="day-option" onclick="selecionarDia('passaporte')">
        <div class="day-option-icon combo">
            <i class="bx bx-calendar-star"></i>
        </div>
        <div class="day-option-info">
            <div class="day-option-name">2 Dias <span class="day-option-badge"><i class="bx bxs-crown" style="font-size: 10px;"></i> Recomendado</span></div>
            <div class="day-option-date"><?php
                if (isset($evento)) {
                    echo date_format($data_inicio, 'd') . ' e ' . date_format($data_fim, 'd') . ' de ' . $meses_sel[date_format($data_fim, 'm')] . ' de ' . date_format($data_fim, 'Y');
                }
            ?></div>
        </div>
        <div class="day-option-arrow"><i class="bx bx-chevron-right"></i></div>
    </div>

    <div class="text-center mt-3 mb-2">
        <span style="font-size: 11px; color: #9ca3af;">Pagamento processado com seguranca por</span><br>
        <img class="mt-1" src="<?php echo site_url('recursos/front/images/asaas.png'); ?>" width="80" height="auto" style="opacity: 0.6;">
    </div>
</div>

<!-- ETAPA 2: Carrinho (escondido ate selecionar o dia) -->
<div id="carrinho-content">

<div class="checkout-container mt-3">

    <!-- Retornos do backend -->
    <div id="response"></div>




                        <?php
                        if (isset($_GET['adicionar']) || isset($_GET['excluir'])) {
                            if (isset($_GET['adicionar'])) {
                                $idProduto = (int)$_GET['adicionar'];
                                if (isset($items[$idProduto])) {
                                    $produto = $items[$idProduto];
                                    if (isset($_SESSION['carrinho'][$idProduto])) {
                                        $_SESSION['carrinho'][$idProduto]['quantidade']++;
                                    } else {
                                        $_SESSION['carrinho'][$idProduto] = array(
                                            'quantidade' => 1,
                                            'nome' => $produto['nome'],
                                            'preco' => $produto['preco'] + ($produto['preco'] * 0.07),
                                            'tipo' => $produto['tipo'],
                                            'taxa' => $produto['preco'] * 0.07,
                                            'unitario' => $produto['preco'],
                                            'ticket_id' => $produto['id']
                                        );
                                    }
                                }
                            }

                            if (isset($_GET['excluir'])) {
                                $idProduto = (int)$_GET['excluir'];
                                if (isset($items[$idProduto])) {
                                    if (isset($_SESSION['carrinho'][$idProduto])) {
                                        if ($_SESSION['carrinho'][$idProduto]['quantidade'] > 0) {
                                            $_SESSION['carrinho'][$idProduto]['quantidade']--;
                                        } else {
                                            unset($_SESSION['carrinho'][$idProduto]);
                                        }
                                    }
                                }
                            }

                            // Redirect para limpar o GET param e evitar reprocessamento
                            $url = strtok($_SERVER['REQUEST_URI'], '?');
                            header('Location: ' . $url);
                            exit;
                        }
                        ?>
                        <?php $total_carrinho = 0; ?>


                        <!-- Tab links -->
                        <?php
                        $tem_camping = false;
                        $tem_epic = false;
                        $tem_vip = false;
                        $tem_super_pack = false;
                        foreach ($items as $item) {
                            if (isset($item['categoria'])) {
                                if (strtolower($item['categoria']) === 'epic') $tem_epic = true;
                                if (strtolower($item['categoria']) === 'vip') $tem_vip = true;
                                if (strtolower($item['categoria']) === 'camping') $tem_camping = true;
                            }
                            if (!empty($item['parent_ticket_id'])) {
                                $tem_super_pack = true;
                            }
                        }
                        ?>
                        <!-- Botao trocar dia -->
                        <div class="mb-3">
                            <a href="javascript:void(0)" onclick="voltarSeletor()" style="font-size: 13px; color: #7c3aed; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                <i class="bx bx-chevron-left"></i> Trocar dia
                            </a>
                        </div>

                        <?php
                        // Monta array de categorias disponiveis com labels e icones
                        $categoriasConfig = [
                            'comum'   => ['label' => 'Comum',       'icon' => 'bx bx-ticket'],
                            'premium' => ['label' => 'Premium',     'icon' => 'bx bx-star'],
                            'epic'    => ['label' => 'EPIC PASS',   'icon' => 'bx bx-crown'],
                            'vip'     => ['label' => 'VIP FULL',    'icon' => 'bx bx-diamond'],
                            'camping' => ['label' => 'Camping',     'icon' => 'bx bx-tent'],
                            'cosplay' => ['label' => 'Cosplayer',   'icon' => 'bx bx-mask'],
                            'after'   => ['label' => 'After Dream', 'icon' => 'bx bx-moon'],
                            'mae'     => ['label' => 'Especial',    'icon' => 'bx bx-heart'],
                            'army'    => ['label' => 'Army',        'icon' => 'bx bx-group'],
                        ];

                        // Descobre categorias que existem nos tickets (sem parent_ticket_id)
                        $categoriasDisponiveis = [];
                        foreach ($items as $item) {
                            $cat = strtolower($item['categoria'] ?? '');
                            if (!empty($cat) && empty($item['parent_ticket_id']) && !in_array($cat, $categoriasDisponiveis)) {
                                $categoriasDisponiveis[] = $cat;
                            }
                        }
                        // Super Pack (tickets com parent_ticket_id)
                        $tem_super_pack = false;
                        foreach ($items as $item) {
                            if (!empty($item['parent_ticket_id'])) { $tem_super_pack = true; break; }
                        }

                        // Ordena tickets por preco (menor para maior)
                        $itemsOrdenados = $items;
                        uasort($itemsOrdenados, function($a, $b) {
                            return $a['preco'] <=> $b['preco'];
                        });
                        ?>

                        <!-- Categorias em grid -->
                        <div class="cat-grid" id="tabMenu">
                            <?php $primeiraTab = true; ?>
                            <?php foreach ($categoriasConfig as $catKey => $catInfo): ?>
                                <?php if (in_array($catKey, $categoriasDisponiveis)): ?>
                                    <button class="cat-btn tablinks" onclick="openCategoria(event, '<?= $catKey ?>')" <?= $primeiraTab ? 'id="defaultOpen"' : '' ?>>
                                        <i class="<?= $catInfo['icon'] ?>"></i>
                                        <span><?= $catInfo['label'] ?></span>
                                    </button>
                                    <?php $primeiraTab = false; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if ($tem_super_pack): ?>
                                <button class="cat-btn tablinks" onclick="openCategoria(event, 'super_pack')">
                                    <i class="bx bx-package"></i>
                                    <span>Super Pack</span>
                                </button>
                            <?php endif; ?>
                        </div>


                        <!-- Tab contents por categoria -->
                        <?php foreach ($categoriasConfig as $catKey => $catInfo): ?>
                            <?php if (in_array($catKey, $categoriasDisponiveis)): ?>
                                <div id="<?= $catKey ?>" class="tabcontent">

                                    <?php
                                    $temTicketNaCategoria = false;
                                    foreach ($itemsOrdenados as $key => $value):
                                        if (strtolower($value['categoria']) == $catKey && empty($value['parent_ticket_id'])):
                                            $temTicketNaCategoria = true;
                                            $ticketDia = '';
                                            if ($value['tipo'] == 'individual' && $value['dia'] == 'sab') $ticketDia = 'sabado';
                                            elseif ($value['tipo'] == 'individual' && $value['dia'] == 'dom') $ticketDia = 'domingo';
                                            elseif ($value['tipo'] == 'combo') $ticketDia = 'passaporte';
                                            else $ticketDia = 'todos';
                                            $qty = isset($_SESSION['carrinho'][$key]['quantidade']) ? $_SESSION['carrinho'][$key]['quantidade'] : 0;
                                            $isMeia = (stripos($value['nome'], 'meia') !== false);
                                    ?>
                                    <div class="ticket-card <?= $qty > 0 ? 'has-qty' : '' ?>" data-item-id="<?= $key ?>" data-dia="<?= $ticketDia ?>" data-categoria="<?= $catKey ?>" data-ticket-tipo="<?= $isMeia ? 'meia' : 'inteira' ?>">
                                        <div class="ticket-card-lote-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?></div>
                                        <div class="ticket-card-header">
                                            <div class="ticket-card-name"><?= $value['nome'] ?></div>
                                            <div class="ticket-card-right">
                                                <?php if ($value['estoque'] > 0) : ?>
                                                <div class="ticket-card-controls">
                                                    <span onclick="window.location.href='?excluir=<?= $key ?>'" style="cursor:pointer"><i class="bx bx-minus"></i></span>
                                                    <span class="qty-value"><?= $qty ?></span>
                                                    <span onclick="window.location.href='?adicionar=<?= $key ?>'" style="cursor:pointer"><i class="bx bx-plus"></i></span>
                                                </div>
                                                <?php else : ?>
                                                <div class="ticket-card-esgotado">ESGOTADO</div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="ticket-card-meta"><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</div>
                                        <div class="ticket-card-price-row">
                                            <div class="ticket-card-price"><span class="currency">R$</span> <?= number_format($value['preco'], 2, ',', '') ?></div>
                                            <div class="ticket-card-taxa">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de servico' : 'taxa de servico' ?></div>
                                        </div>
                                        <?php if (!empty($value['descricao'])): ?>
                                        <div class="ticket-card-elegibilidade">
                                            <strong><i class='bx bx-info-circle'></i> Quem pode comprar?</strong>
                                            <div class="ticket-card-elegibilidade-text"><?= $value['descricao'] ?></div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php if (!$temTicketNaCategoria): ?>
                                        <div style="text-align: center; padding: 24px; color: #9ca3af; font-size: 14px;">Nenhum ingresso disponivel nesta categoria</div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if ($tem_super_pack): ?>
                        <div id="super_pack" class="tabcontent">
                            <?php foreach ($itemsOrdenados as $key => $value): ?>
                                <?php if (!empty($value['parent_ticket_id'])):
                                    $ticketDia = '';
                                    if ($value['tipo'] == 'individual' && $value['dia'] == 'sab') $ticketDia = 'sabado';
                                    elseif ($value['tipo'] == 'individual' && $value['dia'] == 'dom') $ticketDia = 'domingo';
                                    elseif ($value['tipo'] == 'combo') $ticketDia = 'passaporte';
                                    else $ticketDia = 'todos';
                                    $qty = isset($_SESSION['carrinho'][$key]['quantidade']) ? $_SESSION['carrinho'][$key]['quantidade'] : 0;
                                ?>
                                <div class="ticket-card <?= $qty > 0 ? 'has-qty' : '' ?>" data-item-id="<?= $key ?>" data-dia="<?= $ticketDia ?>" data-categoria="super_pack" data-ticket-tipo="inteira">
                                    <div class="ticket-card-lote-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?></div>
                                    <div class="ticket-card-header">
                                        <div class="ticket-card-name"><?= $value['nome'] ?></div>
                                        <div class="ticket-card-right">
                                            <?php if ($value['estoque'] > 0) : ?>
                                            <div class="ticket-card-controls">
                                                <a href="?excluir=<?= $key ?>"><i class="bx bx-minus"></i></a>
                                                <span class="qty-value"><?= $qty ?></span>
                                                <a href="?adicionar=<?= $key ?>"><i class="bx bx-plus"></i></a>
                                            </div>
                                            <?php else : ?>
                                            <div class="ticket-card-esgotado">ESGOTADO</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="ticket-card-meta"><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</div>
                                    <div class="ticket-card-price-row">
                                        <div class="ticket-card-price"><span class="currency">R$</span> <?= number_format($value['preco'], 2, ',', '') ?></div>
                                        <div class="ticket-card-taxa">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de servico' : 'taxa de servico' ?></div>
                                    </div>
                                    <?php if (!empty($value['descricao'])): ?>
                                    <div class="ticket-card-elegibilidade">
                                        <strong><i class='bx bx-info-circle'></i> Quem pode comprar?</strong>
                                        <div class="ticket-card-elegibilidade-text"><?= $value['descricao'] ?></div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <?php /* Inicio bloco antigo removido */
                        if (false): ?>
                        <?php
                        // DOMINGO
                        $tem_domingo = false;
                        foreach ($items as $key => $value) {
                            if ((($value['categoria'] == 'comum' || $value['categoria'] == 'premium') && $value['tipo'] == 'individual' && $value['dia'] == 'dom' && empty($value['parent_ticket_id']))) {
                                $tem_domingo = true;
                                break;
                            }
                        }
                        ?>
                        <div id="domingo" class="tabcontent">
                            <?php if (!$tem_domingo): ?>
                                <div class="alert alert-warning text-center mt-3 mb-3">LOTE ESGOTADO, aguarde novo lote</div>
                            <?php endif; ?>
                            <!-- instruções e conteúdo já existentes da aba Domingo -->
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do <?= isset($evento) ? esc($evento->nome) : 'evento' ?> <strong>somente no domingo</strong><?php
                                if (isset($evento)) {
                                    $data_fim = date_create($evento->data_fim);
                                    $meses = [
                                        '01' => 'janeiro', '02' => 'fevereiro', '03' => 'março', '04' => 'abril',
                                        '05' => 'maio', '06' => 'junho', '07' => 'julho', '08' => 'agosto',
                                        '09' => 'setembro', '10' => 'outubro', '11' => 'novembro', '12' => 'dezembro'
                                    ];
                                    $dia_fim = date_format($data_fim, 'd');
                                    $mes = $meses[date_format($data_fim, 'm')];
                                    $ano = date_format($data_fim, 'Y');
                                    $hora_inicio = isset($evento->hora_inicio) ? $evento->hora_inicio : '11:00';
                                    $hora_fim = isset($evento->hora_fim) ? $evento->hora_fim : '20:00';
                                    echo ", dia $dia_fim de $mes de $ano das $hora_inicio às $hora_fim";
                                }
                            ?></p>
                            <p>Você receberá uma credencial exclusiva e colecionável que deverá ser apresentada na entrada e na saída do festival e sempre que for requisitada. Você terá direito à entrar e sair do evento sempre que quiser!</p>
                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>
                            
                            
                            <?php foreach ($items as $key => $value) : ?>
                                <?php if ((($value['categoria'] == 'comum' || $value['categoria'] == 'premium') && $value['tipo'] == 'individual' && $value['dia'] == 'dom' && empty($value['parent_ticket_id']))) : ?>
                                    <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px" class="ticket-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?></strong><br>
                                                    <?php if (!empty($value['parent_ticket_id'])) : ?>
                                                        <div class="mt-1 mb-1 badge-container">
                                                            <span class="badge bg-success text-white me-2" style="font-size: 11px; padding: 4px 8px;">
                                                                <i class="bi bi-check-circle-fill me-1"></i>Válido para 2 eventos: Dream25 + Anime Dream 25
                                                            </span>
                                                            <span class="badge bg-warning text-dark" style="font-size: 11px; padding: 4px 8px;">
                                                                + Econômico
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <span class="text-muted ticket-info" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20 d-flex flex-column align-items-end justify-content-center quantity-section" style="gap:0;">
                                                            <strong class="quantity-controls" style="font-size: 20px;">
                                                                <a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style="padding-right: 4px;"></i></a>
                                                                <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?>
                                                                <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a>
                                                            </strong>
                                                            <div class="d-flex flex-column align-items-end price-section" style="margin-top: 2px;">
                                                                <strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal; font-size: 26px; line-height: 1; margin-bottom: 0;">
                                                                    <span style="font-size: 0.6em; vertical-align: middle;">R$</span> <?= number_format($value['preco'], 2, ',', ''); ?>
                                                                </strong>
                                                                <span class="text-muted service-fee" style="font-size: 11px; line-height: 1.1; margin-top: 0; margin-bottom: 0; padding-top: 0;">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de serviço' : 'taxa de serviço' ?></span>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3 eligibility-section">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            
                        </div>


                        <?php
                        // 2 DIAS
                        $tem_passaporte = false;
                        foreach ($items as $key => $value) {
                            if ((($value['categoria'] == 'comum' || $value['categoria'] == 'premium') && $value['tipo'] == 'combo' && empty($value['parent_ticket_id']))) {
                                $tem_passaporte = true;
                                break;
                            }
                        }
                        ?>
                        <div id="passaporte" class="tabcontent">
                            <?php if (!$tem_passaporte): ?>
                                <div class="alert alert-warning text-center mt-3 mb-3">LOTE ESGOTADO, aguarde novo lote</div>
                            <?php endif; ?>
                            <!-- instruções e conteúdo já existentes da aba 2 Dias -->
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do <?= isset($evento) ? esc($evento->nome) : 'evento' ?> <strong>nos dois dias de evento</strong><?php
                                if (isset($evento)) {
                                    $data_inicio = date_create($evento->data_inicio);
                                    $data_fim = date_create($evento->data_fim);
                                    $meses = [
                                        '01' => 'janeiro', '02' => 'fevereiro', '03' => 'março', '04' => 'abril',
                                        '05' => 'maio', '06' => 'junho', '07' => 'julho', '08' => 'agosto',
                                        '09' => 'setembro', '10' => 'outubro', '11' => 'novembro', '12' => 'dezembro'
                                    ];
                                    $dia_inicio = date_format($data_inicio, 'd');
                                    $dia_fim = date_format($data_fim, 'd');
                                    $mes = $meses[date_format($data_inicio, 'm')];
                                    $ano = date_format($data_inicio, 'Y');
                                    $hora_inicio = isset($evento->hora_inicio) ? $evento->hora_inicio : '11:00';
                                    $hora_fim = isset($evento->hora_fim) ? $evento->hora_fim : '20:00';
                                    echo ", dias $dia_inicio e $dia_fim de $mes de $ano das $hora_inicio às $hora_fim";
                                }
                            ?></p>
                            <p>Você receberá uma credencial exclusiva e colecionável que deverá ser apresentada na entrada e na saída do festival e sempre que for requisitada. Você terá direito à entrar e sair do evento sempre que quiser!</p>
                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>
                            
                            
                            <?php foreach ($items as $key => $value) : ?>
                                <?php if ((($value['categoria'] == 'comum' || $value['categoria'] == 'premium') && $value['tipo'] == 'combo' && empty($value['parent_ticket_id']))) : ?>
                                    <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px" class="ticket-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?></strong><br>
                                                    <?php if (!empty($value['parent_ticket_id'])) : ?>
                                                        <div class="mt-1 mb-1 badge-container">
                                                            <span class="badge bg-success text-white me-2" style="font-size: 11px; padding: 4px 8px;">
                                                                <i class="bi bi-check-circle-fill me-1"></i>Válido para 2 eventos: Dream25 + Anime Dream 25
                                                            </span>
                                                            <span class="badge bg-warning text-dark" style="font-size: 11px; padding: 4px 8px;">
                                                                + Econômico
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <span class="text-muted ticket-info" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20 d-flex flex-column align-items-end justify-content-center quantity-section" style="gap:0;">
                                                            <strong class="quantity-controls" style="font-size: 20px;">
                                                                <a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style="padding-right: 4px;"></i></a>
                                                                <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?>
                                                                <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a>
                                                            </strong>
                                                            <div class="d-flex flex-column align-items-end price-section" style="margin-top: 2px;">
                                                                <strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal; font-size: 26px; line-height: 1; margin-bottom: 0;">
                                                                    <span style="font-size: 0.6em; vertical-align: middle;">R$</span> <?= number_format($value['preco'], 2, ',', ''); ?>
                                                                </strong>
                                                                <span class="text-muted service-fee" style="font-size: 11px; line-height: 1.1; margin-top: 0; margin-bottom: 0; padding-top: 0;">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de serviço' : 'taxa de serviço' ?></span>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3 eligibility-section">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                <strong class="item-name" style="color: #6C038F; font-size: 16px">Passaporte Basic - Solidário | Lote 3</strong><br>
                                                <span class="text-muted ticket-info" style="font-size: 10px"> individual - 3º lote</strong></span>
                                                <br><span style="color: red; font-size: 14px" class="item-name">ESGOTADO </span>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>

                        <?php
                        // DREAM PASS
                        $tem_camping_ingresso = false;
                        foreach ($items as $key => $value) {
                            if (($value['categoria'] == 'camping' && empty($value['parent_ticket_id']))) {
                                $tem_camping_ingresso = true;
                                break;
                            }
                        }
                        ?>
                        <div id="camping" class="tabcontent">
                            <?php if (!$tem_camping_ingresso): ?>
                                <div class="alert alert-warning text-center mt-3 mb-3">LOTE ESGOTADO, aguarde novo lote</div>
                            <?php endif; ?>
                            <!-- instruções e conteúdo já existentes da aba EPIC PASS -->
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do <?= isset($evento) ? esc($evento->nome) : 'evento' ?> no dia 7 de dezembro de 2025 + Apresentação da Atriz Florinda Meza
                            <!--<a href="#" data-bs-toggle="modal" data-bs-target="#vip-fanModal" class="btn btn-outline-secondary w-100 mt-0" style="margin-right: 5px;">O que está incluso nesse ingresso? </a> -->

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>
                            
                            <?php foreach ($items as $key => $value) : ?>
                                <?php if (($value['categoria'] == 'camping' && empty($value['parent_ticket_id']))) : ?>
                                    <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px" class="ticket-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?></strong><br>
                                                    <?php if (!empty($value['parent_ticket_id'])) : ?>
                                                        <div class="mt-1 mb-1 badge-container">
                                                            <span class="badge bg-success text-white me-2" style="font-size: 11px; padding: 4px 8px;">
                                                                <i class="bi bi-check-circle-fill me-1"></i>EXCLUSIVO, INÉDITO
                                                            </span>
                                                            
                                                        </div>
                                                    <?php endif; ?>
                                                    <span class="text-muted ticket-info" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>
                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20 d-flex flex-column align-items-end justify-content-center quantity-section" style="gap:0;">
                                                            <strong class="quantity-controls" style="font-size: 20px;">
                                                                <a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style="padding-right: 4px;"></i></a>
                                                                <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?>
                                                                <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a>
                                                            </strong>
                                                            <div class="d-flex flex-column align-items-end price-section" style="margin-top: 2px;">
                                                                <strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal; font-size: 26px; line-height: 1; margin-bottom: 0;">
                                                                    <span style="font-size: 0.6em; vertical-align: middle;">R$</span> <?= number_format($value['preco'], 2, ',', ''); ?>
                                                            </strong>
                                                                <span class="text-muted service-fee" style="font-size: 11px; line-height: 1.1; margin-top: 0; margin-bottom: 0; padding-top: 0;">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de serviço' : 'taxa de serviço' ?></span>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3 eligibility-section">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                <strong class="item-name" style="color: #6C038F; font-size: 16px">Platéia - Solidário | FLORINDA MEZA 2025 - DOMINGO</strong><br>
                                                <span class="text-muted ticket-info" style="font-size: 10px"> individual - 3º lote</strong></span>
                                                <br><span style="color: red; font-size: 14px" class="item-name">ESGOTADO </span>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>


                        <?php
                        // EPIC
                        $tem_epic_ingresso = false;
                        foreach ($items as $key => $value) {
                            if (($value['categoria'] == 'epic' && empty($value['parent_ticket_id']))) {
                                $tem_epic_ingresso = true;
                                break;
                            }
                        }
                        ?>
                        <div id="epic" class="tabcontent">
                            <?php if (!$tem_epic_ingresso): ?>
                                <div class="alert alert-warning text-center mt-3 mb-3">LOTE ESGOTADO, aguarde novo lote</div>
                            <?php endif; ?>
                            <!-- instruções e conteúdo já existentes da aba EPIC PASS -->
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do <?= isset($evento) ? esc($evento->nome) : 'evento' ?> nos dias selecionados.</p>
                            <p>Você receberá uma kit colecionável com Credencial, Pulseira, Cordão, Pôster e Guia do evento! A Credencial e Pulseira deverão ser apresentados na entrada e na saída do festival e sempre que for requisitada. Você terá direito à entrar e sair do evento sempre que quiser!</p>
                            <!--<a href="#" data-bs-toggle="modal" data-bs-target="#vip-fanModal" class="btn btn-outline-secondary w-100 mt-0" style="margin-right: 5px;">O que está incluso nesse ingresso? </a> -->

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>                        


                            <?php foreach ($items as $key => $value) : ?>
                                <?php if (($value['categoria'] == 'epic' && empty($value['parent_ticket_id']))) : ?>
                                    <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px" class="ticket-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?></strong><br>
                                                    <?php if (!empty($value['parent_ticket_id'])) : ?>
                                                        <div class="mt-1 mb-1 badge-container">
                                                            <span class="badge bg-success text-white me-2" style="font-size: 11px; padding: 4px 8px;">
                                                                <i class="bi bi-check-circle-fill me-1"></i>Válido para 2 eventos: Dream25 + Anime Dream 25
                                                            </span>
                                                            <span class="badge bg-warning text-dark" style="font-size: 11px; padding: 4px 8px;">
                                                                + Econômico
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <span class="text-muted ticket-info" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>
                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20 d-flex flex-column align-items-end justify-content-center quantity-section" style="gap:0;">
                                                            <strong class="quantity-controls" style="font-size: 20px;">
                                                                <a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style="padding-right: 4px;"></i></a>
                                                                <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?>
                                                                <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a>
                                                            </strong>
                                                            <div class="d-flex flex-column align-items-end price-section" style="margin-top: 2px;">
                                                                <strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal; font-size: 26px; line-height: 1; margin-bottom: 0;">
                                                                    <span style="font-size: 0.6em; vertical-align: middle;">R$</span> <?= number_format($value['preco'], 2, ',', ''); ?>
                                                            </strong>
                                                                <span class="text-muted service-fee" style="font-size: 11px; line-height: 1.1; margin-top: 0; margin-bottom: 0; padding-top: 0;">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de serviço' : 'taxa de serviço' ?></span>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3 eligibility-section">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>

                        <?php
                        // VIP
                        $tem_vip_ingresso = false;
                        foreach ($items as $key => $value) {
                            if (($value['categoria'] == 'vip' && empty($value['parent_ticket_id']))) {
                                $tem_vip_ingresso = true;
                                break;
                            }
                        }
                        ?>
                        <div id="vip" class="tabcontent">
                            <?php if (!$tem_vip_ingresso): ?>
                                <div class="alert alert-warning text-center mt-3 mb-3">LOTE ESGOTADO, aguarde novo lote</div>
                            <?php endif; ?>
                            <!-- instruções e conteúdo já existentes da aba VIP FULL -->
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do <?= isset($evento) ? esc($evento->nome) : 'evento' ?> nos dias selecionados.</p>
                            <p>Você receberá uma kit colecionável com Credencial, Pulseira, Cordão, Pôster, Copo, Ingresso holográfico e Guia do evento! A Credencial e Pulseira deverão ser apresentados na entrada e na saída do festival e sempre que for requisitada. Você terá direito à entrar e sair do evento sempre que quiser!</p>
                            <!--<a href="#" data-bs-toggle="modal" data-bs-target="#vip-fullModal" class="btn btn-outline-secondary w-100 mt-0" style="margin-right: 5px;">O que está incluso nesse ingresso? </a> -->

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>
                            <!-- <div class="card border border-muted">
                                <div class="form-check mt-3 mb-3">
                                    <div class="row">
                                        <strong style="color: red; font-size: 14px">VIP FULL Sábado e VIP FULL Combo 2 dias ESGOTADOS</strong>
                                    </div>
                                </div>
                            </div> -->
                            <?php foreach ($items as $key => $value) : ?>
                                <?php if (($value['categoria'] == 'vip' && empty($value['parent_ticket_id']))) : ?>
                                    <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px" class="ticket-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?></strong><br>
                                                    <?php if (!empty($value['parent_ticket_id'])) : ?>
                                                        <div class="mt-1 mb-1 badge-container">
                                                            <span class="badge bg-success text-white me-2" style="font-size: 11px; padding: 4px 8px;">
                                                                <i class="bi bi-check-circle-fill me-1"></i>Válido para 2 eventos: Dream25 + Anime Dream 25
                                                            </span>
                                                            <span class="badge bg-warning text-dark" style="font-size: 11px; padding: 4px 8px;">
                                                                + Econômico
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <span class="text-muted ticket-info" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20 d-flex flex-column align-items-end justify-content-center quantity-section" style="gap:0;">
                                                            <strong class="quantity-controls" style="font-size: 20px;">
                                                                <a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style="padding-right: 4px;"></i></a>
                                                                <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?>
                                                                <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a>
                                                            </strong>
                                                            <div class="d-flex flex-column align-items-end price-section" style="margin-top: 2px;">
                                                                <strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal; font-size: 26px; line-height: 1; margin-bottom: 0;">
                                                                    <span style="font-size: 0.6em; vertical-align: middle;">R$</span> <?= number_format($value['preco'], 2, ',', ''); ?>
                                                                </strong>
                                                                <span class="text-muted service-fee" style="font-size: 11px; line-height: 1.1; margin-top: 0; margin-bottom: 0; padding-top: 0;">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de serviço' : 'taxa de serviço' ?></span>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3 eligibility-section">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>

                        <?php
                        // SUPER PACK
                        $tem_super_pack_ingresso = false;
                        foreach ($items as $key => $value) {
                            if (!empty($value['parent_ticket_id'])) {
                                $tem_super_pack_ingresso = true;
                                break;
                            }
                        }
                        ?>
                        <div id="super_pack" class="tabcontent">
                            <?php if (!$tem_super_pack_ingresso): ?>
                                <div class="alert alert-warning text-center mt-3 mb-3">LOTE ESGOTADO, aguarde novo lote</div>
                            <?php endif; ?>
                            <!-- instruções e conteúdo já existentes da aba Super Pack -->
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar de <strong>2 eventos incríveis</strong>: <?= isset($evento) ? esc($evento->nome) : 'evento principal' ?> + Anime Dream 25!</p>
                            <p>Você receberá uma credencial exclusiva e colecionável que será válida para ambos os eventos. A credencial deverá ser apresentada na entrada e na saída dos festivais e sempre que for requisitada. Você terá direito à entrar e sair dos eventos sempre que quiser!</p>
                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>

                            <?php foreach ($items as $key => $value) : ?>
                                <?php if (!empty($value['parent_ticket_id'])) : ?>
                                    <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px" class="ticket-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?></strong><br>
                                                    <div class="mt-1 mb-1 badge-container">
                                                        <span class="badge bg-success text-white me-2" style="font-size: 11px; padding: 4px 8px;">
                                                            <i class="bi bi-check-circle-fill me-1"></i>Válido para 2 eventos: Dream25 + Anime Dream 25
                                                        </span>
                                                        <span class="badge bg-warning text-dark" style="font-size: 11px; padding: 4px 8px;">
                                                            + Econômico
                                                        </span>
                                                    </div>
                                                    <span class="text-muted ticket-info" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>
                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20 d-flex flex-column align-items-end justify-content-center quantity-section" style="gap:0;">
                                                            <strong class="quantity-controls" style="font-size: 20px;">
                                                                <a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style="padding-right: 4px;"></i></a>
                                                                <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?>
                                                                <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a>
                                                            </strong>
                                                            <div class="d-flex flex-column align-items-end price-section" style="margin-top: 2px;">
                                                                <strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal; font-size: 26px; line-height: 1; margin-bottom: 0;">
                                                                    <span style="font-size: 0.6em; vertical-align: middle;">R$</span> <?= number_format($value['preco'], 2, ',', ''); ?>
                                                                </strong>
                                                                <span class="text-muted service-fee" style="font-size: 11px; line-height: 1.1; margin-top: 0; margin-bottom: 0; padding-top: 0;">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de serviço' : 'taxa de serviço' ?></span>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3 eligibility-section">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>

                        <?php
                        // COSPLAY
                        $tem_cosplay = false;
                        foreach ($items as $key => $value) {
                            if (($value['categoria'] == 'cosplay' && empty($value['parent_ticket_id']))) {
                                $tem_cosplay = true;
                                break;
                            }
                        }
                        ?>
                        <div id="cosplay" class="tabcontent">
                            <?php if (!$tem_cosplay): ?>
                                <div class="alert alert-warning text-center mt-3 mb-3">LOTE ESGOTADO, aguarde novo lote</div>
                            <?php endif; ?>
                            <!-- instruções e conteúdo já existentes da aba Cosplayer -->
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do <?= isset($evento) ? esc($evento->nome) : 'evento' ?> nos dias selecionados.</p>
                            <p>Você receberá uma pulseira colecionável COSPLAYER que deverá ser apresentada na entrada e na saída do festival e sempre que for requisitada. Vvocê terá direito à entrar e sair do evento sempre que quiser!</p>
                            <!--<a href="#" data-bs-toggle="modal" data-bs-target="#cosplayerModal" class="btn btn-outline-secondary w-100 mt-0" style="margin-right: 5px;">O que está incluso nesse ingresso? </a> -->

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>

                            <?php foreach ($items as $key => $value) : ?>
                                <?php if (($value['categoria'] == 'cosplay' && empty($value['parent_ticket_id']))) : ?>
                                    <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px" class="ticket-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?></strong><br>
                                                    <?php if (!empty($value['parent_ticket_id'])) : ?>
                                                        <div class="mt-1 mb-1 badge-container">
                                                            <span class="badge bg-success text-white me-2" style="font-size: 11px; padding: 4px 8px;">
                                                                <i class="bi bi-check-circle-fill me-1"></i>Válido para 2 eventos: Dream25 + Anime Dream 25
                                                            </span>
                                                            <span class="badge bg-warning text-dark" style="font-size: 11px; padding: 4px 8px;">
                                                                + Econômico
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <span class="text-muted ticket-info" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20 d-flex flex-column align-items-end justify-content-center quantity-section" style="gap:0;">
                                                            <strong class="quantity-controls" style="font-size: 20px;">
                                                                <a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style="padding-right: 4px;"></i></a>
                                                                <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?>
                                                                <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a>
                                                            </strong>
                                                            <div class="d-flex flex-column align-items-end price-section" style="margin-top: 2px;">
                                                                <strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal; font-size: 26px; line-height: 1; margin-bottom: 0;">
                                                                    <span style="font-size: 0.6em; vertical-align: middle;">R$</span> <?= number_format($value['preco'], 2, ',', ''); ?>
                                                                </strong>
                                                                <span class="text-muted service-fee" style="font-size: 11px; line-height: 1.1; margin-top: 0; margin-bottom: 0; padding-top: 0;">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de serviço' : 'taxa de serviço' ?></span>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3 eligibility-section">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>


                         <?php
                        // COSPLAY
                        $tem_after = false;
                        foreach ($items as $key => $value) {
                            if (($value['categoria'] == 'after' && empty($value['parent_ticket_id']))) {
                                $tem_after = true;
                                break;
                            }
                        }
                        ?>
                        <div id="after" class="tabcontent">
                            <?php if (!$tem_after): ?>
                                <div class="alert alert-warning text-center mt-3 mb-3">LOTE ESGOTADO, aguarde novo lote</div>
                            <?php endif; ?>
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do After do <?= isset($evento) ? esc($evento->nome) : 'evento' ?> nos dias selecionados.</p>
                            <p>Classificação: 18 Anos <br>Você receberá uma pulseira colecionável que deverá ser apresentada na entrada e na saída da festa e sempre que for requisitada. <br>Funcionamento: 20h às 5h <br> Game Party Inclusa + Camping se selecionado</p>

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>

                            <?php foreach ($items as $key => $value) : ?>
                                <?php if (($value['categoria'] == 'after' && empty($value['parent_ticket_id']))) : ?>
                                    <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px" class="ticket-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?></strong><br>
                                                    <?php if (!empty($value['parent_ticket_id'])) : ?>
                                                        <div class="mt-1 mb-1 badge-container">
                                                            <span class="badge bg-success text-white me-2" style="font-size: 11px; padding: 4px 8px;">
                                                                <i class="bi bi-check-circle-fill me-1"></i>Válido para 2 eventos: Dream25 + Anime Dream 25
                                                            </span>
                                                            <span class="badge bg-warning text-dark" style="font-size: 11px; padding: 4px 8px;">
                                                                + Econômico
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <span class="text-muted ticket-info" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20 d-flex flex-column align-items-end justify-content-center quantity-section" style="gap:0;">
                                                            <strong class="quantity-controls" style="font-size: 20px;">
                                                                <a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style="padding-right: 4px;"></i></a>
                                                                <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?>
                                                                <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a>
                                                            </strong>
                                                            <div class="d-flex flex-column align-items-end price-section" style="margin-top: 2px;">
                                                                <strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal; font-size: 26px; line-height: 1; margin-bottom: 0;">
                                                                    <span style="font-size: 0.6em; vertical-align: middle;">R$</span> <?= number_format($value['preco'], 2, ',', ''); ?>
                                                                </strong>
                                                                <span class="text-muted service-fee" style="font-size: 11px; line-height: 1.1; margin-top: 0; margin-bottom: 0; padding-top: 0;">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de serviço' : 'taxa de serviço' ?></span>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3 eligibility-section">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>
                        <div id="mae" class="tabcontent">
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do <?= isset($evento) ? esc($evento->nome) : 'evento' ?> nos dias selecionados.</p>
                            <p>Você receberá uma credencial exclusiva e colecionável que deverá ser apresentada na entrada e na saída do festival e sempre que for requisitada. Você terá direito à entrar e sair do evento sempre que quiser!</p>
                            <!--<a href="#" data-bs-toggle="modal" data-bs-target="#cosplayerModal" class="btn btn-outline-secondary w-100 mt-0" style="margin-right: 5px;">O que está incluso nesse ingresso? </a> -->

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>

                            <?php foreach ($items as $key => $value) : ?>
                                <?php if (($value['categoria'] == 'mae' && empty($value['parent_ticket_id']))) : ?>
                                    <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px" class="ticket-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?></strong><br>
                                                    <?php if (!empty($value['parent_ticket_id'])) : ?>
                                                        <div class="mt-1 mb-1 badge-container">
                                                            <span class="badge bg-success text-white me-2" style="font-size: 11px; padding: 4px 8px;">
                                                                <i class="bi bi-check-circle-fill me-1"></i>Válido para 2 eventos: Dream25 + Anime Dream 25
                                                            </span>
                                                            <span class="badge bg-warning text-dark" style="font-size: 11px; padding: 4px 8px;">
                                                                + Econômico
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <span class="text-muted ticket-info" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20 d-flex flex-column align-items-end justify-content-center quantity-section" style="gap:0;">
                                                            <strong class="quantity-controls" style="font-size: 20px;">
                                                                <a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style="padding-right: 4px;"></i></a>
                                                                <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?>
                                                                <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a>
                                                            </strong>
                                                            <div class="d-flex flex-column align-items-end price-section" style="margin-top: 2px;">
                                                                <strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal; font-size: 26px; line-height: 1; margin-bottom: 0;">
                                                                    <span style="font-size: 0.6em; vertical-align: middle;">R$</span> <?= number_format($value['preco'], 2, ',', ''); ?>
                                                                </strong>
                                                                <span class="text-muted service-fee" style="font-size: 11px; line-height: 1.1; margin-top: 0; margin-bottom: 0; padding-top: 0;">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de serviço' : 'taxa de serviço' ?></span>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3 eligibility-section">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>


                    </div>
                    <?php endif; /* Fim bloco antigo removido */ ?>





                    <?php
                    // Calcula total do carrinho
                    $total_carrinho = 0;
                    $total_taxa = 0;
                    if (isset($_SESSION['carrinho'])) {
                        foreach ($_SESSION['carrinho'] as $key => $value) {
                            $total_carrinho += $value['quantidade'] * $value['preco'];
                            $total_taxa += $value['quantidade'] * $value['taxa'];
                        }
                    }
                    $_SESSION['total'] = $total_carrinho;
                    ?>

                    <?php if ($_SESSION['total'] != 0) : ?>
                    <!-- Ver Resumo toggle -->
                    <div class="ver-resumo-toggle" onclick="toggleResumo()">
                        <a href="javascript:void(0)" id="resumoToggleLink">OCULTAR RESUMO <i class="bx bx-chevron-down"></i></a>
                    </div>

                    <!-- Resumo expandivel -->
                    <div class="cart-summary-section" id="cartSummary">
                        <?php if (isset($_SESSION['carrinho'])) : ?>
                            <?php foreach ($_SESSION['carrinho'] as $key => $value) : ?>
                                <?php if ($value['quantidade'] != 0) : ?>
                                    <div class="summary-item-row">
                                        <span class="summary-item-name"><?= $value['nome']; ?></span>
                                        <span class="summary-item-qty"><?= $value['quantidade']; ?>x</span>
                                        <span class="summary-item-price">R$ <?= number_format($value['quantidade'] * $value['unitario'], 2, ',', ''); ?></span>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <div class="summary-total-row">
                            <span class="label">Total</span>
                            <span class="value">R$ <?= number_format($_SESSION['total'], 2, ',', '.') ?></span>
                        </div>
                    </div>
                    <?php endif ?>

                    <div class="bottom-spacer"></div>

                    <?php if ($_SESSION['total'] != 0) : ?>
                    <!-- Barra fixa inferior -->
                    <div class="cart-bottom-bar">
                        <div class="cart-bottom-inner">
                            <?php if ($total_taxa > 0): ?>
                            <div class="cart-bottom-fee">
                                Taxa de servico (plataforma) <span>R$ <?= number_format($total_taxa, 2, ',', '.') ?></span>
                            </div>
                            <?php endif; ?>
                            <div class="cart-bottom-row">
                                <div class="cart-bottom-info">
                                    <div class="cart-bottom-total-label">TOTAL</div>
                                    <div class="cart-bottom-total-value">R$ <?= number_format($_SESSION['total'], 2, ',', '.') ?></div>
                                    <div class="cart-bottom-note">Cupom, PIX, ofertas extras e tipo de entrega podem alterar o total final.</div>
                                </div>
                                <a href="<?= site_url('/evento/entrega/' . $event_id) ?>" class="btn-continuar">
                                    CONTINUAR <i class="bx bx-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>

</div><!-- /checkout-container -->

<div style="max-width: 600px; margin: 0 auto; padding: 0 16px 20px;">
    <div style="font-size: 11px; color: #9ca3af; line-height: 1.6;">
        <p class="mb-1"><strong>Precisa de ajuda?</strong> <a href="#" target="_blank">Entre em contato</a></p>
        <p class="mb-1">* O valor parcelado possui acrescimo.</p>
        <p class="mb-1"><strong>Meia entrada solidaria</strong> (40% de desconto) disponivel para qualquer pessoa que levar 1kg de alimento no dia do evento.</p>
        <p class="mb-1">Ao clicar em "Continuar", eu concordo com os termos de uso e regras do evento e estou ciente da Politica de Privacidade.</p>
        <hr style="border-color: #e5e7eb;">
        <p class="mb-0">MUNDO DREAM EVENTOS E PRODUCOES LTDA &copy; 2024</p>
        <p class="mb-0">21.812.142/0001-23</p>
    </div>
</div>

<!--MODAL-->
<div class="modal fade" id="comumModal" tabindex="-1" aria-labelledby="comumModallLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="comumModalLabel">Se liga nas vantagens!</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <div class="alert border-0 bg-light-dark alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="fs-3 text-dark"><i class="bi bi-bell-fill"></i>
                        </div>
                        <div class="ms-3">
                            <div class="text-dark mt-2"><strong>Quem tem direito à meia solidária?
                                    <br>
                                </strong> Qualquer pessoa que leve 1kg de alimento não perecível no dia do evento, sendo 1kg por ingresso adquirido.
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>


                <hr>
                <div class="card">
                    <div class="card-body">
                        <table class="table mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="80%"></th>
                                    <th scope="col" width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Acesso a um dos dias mágicos do Dreamfest</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Credencial Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Cordão Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="color:grey">Descontos de até 30% em lojinhas durante o evento!</th>
                                    <td style="color:grey; font-size: 22px"><i class="fadeIn animated bx bx-x"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Fliperama Liberado</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena de Games</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena KPOP</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Food Park</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Palcos e painéis</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Espaços temáticos</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Camarins</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Guarda Volumes</th>
                                    <td style="color:#ffcc00; font-size: 22px" title="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Meet & Greet</th>
                                    <td style="color:#ffcc00; font-size: 22px" title="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">1 foto grátis no estúdio fotográfico</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Entendi!</button>

            </div>
        </div>
    </div>
</div>



<!--MODAL-->
<div class="modal fade" id="clubeModal" tabindex="-1" aria-labelledby="clubeModallLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clubeModal">Se liga nas vantagens!</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <div class="alert border-0 bg-light-dark alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="fs-3 text-dark"><i class="bi bi-bell-fill"></i>
                        </div>
                        <div class="ms-3">
                            <div class="text-dark mt-2">Garanta agora mesmo a sua vaga e faça parte do clube de vantagens geek exclusivo do Dreamfest!
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <img src="<?php echo site_url('recursos/front/images/ingressos/clube-card.png'); ?>" alt="" width="100%" height="auto">



                <hr>
                <div class="card">
                    <div class="card-body">
                        <table class="table mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="80%"></th>
                                    <th scope="col" width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Acesso ao evento (sábado) das 12 às 19</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Acesso ao evento (domingo) das 11 às 20</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Entrar e sair do evento quando quiser!</th>
                                    <td style="color:#ffcc00; font-size: 22px" title="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Pulseira RFID Colecionável</th>
                                    <td style="color:#ffcc00; font-size: 22px" title="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Credencial Colecionável</th>
                                    <td style="color:#ffcc00; font-size: 22px" title="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Acesso GRÁTIS em todos os eventos da produtora, dentre eles o Dreamfest, Dreamfest Go, AnimeDream, Kdream e outros!</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Acesso GRÁTIS e/ou com desconto em eventos parceiros</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Você poderá dar dicas e participar da escolha dos artistas e temáticas dos eventos!</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Descontos em lojas parceiras, dentro e fora dos eventos, que variam de 10 a 50%.</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Descontos em cursos online de diversos tipos, tais como desenho, línguas, música…</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Acesso exclusivo em fila separada nos eventos da produtora!</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Espaço exclusivo com acesso privilegiado nos palcos do evento, utilizando a Hotzone</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Filas preferenciais nas praças de alimentação dos eventos</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Descontos, Cashback e isenções em produtos da linha Dreamfest</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Cartão exclusivo de sócio</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Sorteios exclusivos</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Fliperama Liberado</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena de Games</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena KPOP</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Food Park</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Palcos e painéis</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Espaços temáticos</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Camarins</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Guarda Volumes</th>
                                    <td style="color:#ffcc00; font-size: 22px" title="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Meet & Greet</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">1 foto grátis no estúdio fotográfico</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Entendi!</button>

            </div>
        </div>
    </div>
</div>





<!--MODAL-->
<div class="modal fade" id="cosplayerModal" tabindex="-1" aria-labelledby="cosplayerModallLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cosplayerModalLabel">Se liga nas vantagens!</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <div class="alert border-0 bg-light-dark alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="fs-3 text-dark"><i class="bi bi-bell-fill"></i>
                        </div>
                        <div class="ms-3">
                            <div class="text-dark mt-2"><strong>EXCLUSIVO!
                                    <br>
                                </strong> Promoção válida para cosplayers devidamente caracterizados no dia do evento!</a>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>


                <hr>
                <div class="card">
                    <div class="card-body">
                        <table class="table mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="80%"></th>
                                    <th scope="col" width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Acesso ao evento dia de evento escolhido</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Credencial Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Cordão Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Fila preferencial</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Prioridade no Camarim (competidores)</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Pulseira personalizada</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row" style="color:grey">Descontos de até 30% em lojinhas durante o evento!</th>
                                    <td style="color:grey; font-size: 22px"><i class="fadeIn animated bx bx-x"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Fliperama Liberado</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena de Games</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena KPOP</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Food Park</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Palcos e painéis</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Espaços temáticos</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Camarins</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Guarda Volumes</th>
                                    <td style="color:#ffcc00; font-size: 22px" title="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Meet & Greet</th>
                                    <td style="color:#ffcc00; font-size: 22px" title="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">1 foto grátis no estúdio fotográfico</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Entendi!</button>

            </div>
        </div>
    </div>
</div>


<!--MODAL-->
<div class="modal fade" id="inteiraModal" tabindex="-1" aria-labelledby="inteiraModallLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inteiraModalLabel">Se liga nas vantagens!</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">
                <div class="alert border-0 bg-light-danger alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="fs-3 text-dark"><i class="bi bi-bell-fill"></i>
                        </div>
                        <div class="ms-3">
                            <div class="text-dark mt-2"><strong>Sabia que <sctrong>VOCÊ</sctrong> Pode pagar meia-entrada?
                                    <br>
                                </strong> SIM! Criamos a meia-entrada solidária, um projeto social onde qualquer pessoa que leve 1kg de alimento não perecível no dia do evento recebe o mesmo desconto da meia-entrada!.
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>



                <hr>
                <div class="card">
                    <div class="card-body">
                        <table class="table mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="80%"></th>
                                    <th scope="col" width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Acesso ao evento dia de evento escolhido</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Credencial Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Cordão Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row" style="color:grey">Descontos de até 30% em lojinhas durante o evento!</th>
                                    <td style="color:grey; font-size: 22px"><i class="fadeIn animated bx bx-x"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Fliperama Liberado</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena de Games</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena KPOP</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Food Park</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Palcos e painéis</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Espaços temáticos</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Camarins</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Guarda Volumes</th>
                                    <td style="color:#ffcc00; font-size: 22px" title="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Meet & Greet</th>
                                    <td style="color:#ffcc00; font-size: 22px" title="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">1 foto grátis no estúdio fotográfico</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Entendi!</button>

            </div>
        </div>
    </div>
</div>

<!--MODAL INGRESSO INDIVIDUAL-->
<div class="modal fade" id="ingIndividualSabModal" tabindex="-1" aria-labelledby="ingIndividualSabModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ingIndividualSabModal">Escolha uma opção:</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">



            </div>
        </div>
    </div>
</div>

<!--MODAL INGRESSO INDIVIDUAL-->
<div class="modal fade" id="ingIndividualDomModal" tabindex="-1" aria-labelledby="ingIndividualDomModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ingIndividualDomModal">Escolha uma opção:</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">

                xxxx

            </div>
        </div>
    </div>
</div>

<!--MODAL INGRESSO PASSAPORTE-->
<div class="modal fade" id="ingComboModal" tabindex="-1" aria-labelledby="ingComboModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ingComboModal">Escolha uma opção:</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">


                xxxx
            </div>
        </div>
    </div>
</div>

<!--MODAL-->

<!--MODAL INGRESSO PASSAPORTE-->
<div class="modal fade" id="ingEpicModal" tabindex="-1" aria-labelledby="ingEpicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ingEpicModal">Escolha uma opção:</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">


                <div class="card">
                    <div class="card-body">
                        <?php foreach ($items as $key => $value) : ?>
                            <?php if ($value['categoria'] == 'epic' && empty($value['parent_ticket_id'])) : ?>
                                <div class="card border border-muted px-3" data-item-id="<?= $key ?>">
                                    <div class="form-check mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-7">
                                                <span style="color: purple; font-size: 10px" class="ticket-info">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?></strong><br>
                                                <?php if (!empty($value['parent_ticket_id'])) : ?>
                                                    <div class="mt-1 mb-1 badge-container">
                                                        <span class="badge bg-success text-white me-2" style="font-size: 11px; padding: 4px 8px;">
                                                            <i class="bi bi-check-circle-fill me-1"></i>Válido para 2 eventos: Dream25 + Anime Dream 25
                                                        </span>
                                                        <span class="badge bg-warning text-dark" style="font-size: 11px; padding: 4px 8px;">
                                                            + Econômico
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                                <span class="text-muted ticket-info" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>
                                            </div>
                                            <div class="col-5 text-right">
                                                <?php if ($value['estoque'] > 0) : ?>
                                                    <div class="col-12 mt-3 font-20 d-flex flex-column align-items-end justify-content-center quantity-section" style="gap:0;">
                                                        <strong class="quantity-controls" style="font-size: 20px;">
                                                            <a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style="padding-right: 4px;"></i></a>
                                                            <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?>
                                                            <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a>
                                                        </strong>
                                                        <div class="d-flex flex-column align-items-end price-section" style="margin-top: 2px;">
                                                            <strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal; font-size: 26px; line-height: 1; margin-bottom: 0;">
                                                                <span style="font-size: 0.6em; vertical-align: middle;">R$</span> <?= number_format($value['preco'], 2, ',', ''); ?>
                                                        </strong>
                                                            <span class="text-muted service-fee" style="font-size: 11px; line-height: 1.1; margin-top: 0; margin-bottom: 0; padding-top: 0;">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' taxa de serviço' : 'taxa de serviço' ?></span>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <strong style="color: red;">ESGOTADO</strong>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-11 mt-3 eligibility-section">
                                                <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--MODAL-->


<!--MODAL INGRESSO COSPLAY-->
<div class="modal fade" id="ingCosplayModal" tabindex="-1" aria-labelledby="ingCosplayModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ingCosplayModal">Escolha uma opção:</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">


                ccc
            </div>
        </div>
    </div>
</div>

<!--MODAL-->

<!--MODAL INGRESSO COSPLAY-->
<div class="modal fade" id="ingVipModal" tabindex="-1" aria-labelledby="ingVipModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ingVipModal">Escolha uma opção:</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">


                xxxx
            </div>
        </div>
    </div>
</div>

<!--MODAL-->



<div class="modal fade" id="vip-fullModal" tabindex="-1" aria-labelledby="vip-fullModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vip-fullModalLabel">Se liga nas vantagens de ser VIP!</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <div class="alert border-0 bg-light-dark alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="fs-3 text-dark"><i class="bi bi-bell-fill"></i>
                        </div>
                        <div class="ms-3">
                            <div class="text-dark mt-2">
                                </strong> O KIT VIP FULL é composto por ingresso já com desconto de meia entrada (50% de desconto) + Ingresso Cinemark + Estacionamento Grátis + KIT de benefícios VIP FULL, conforme sua categoria
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>


                <hr>
                <div class="card">
                    <div class="card-body">
                        <table class="table mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="80%"></th>
                                    <th scope="col" width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <small class="text-muted">**** Mediante disponibilidade do convidado. Não inclui convidado internacional.</small>
                                <tr>
                                    <th scope="row">Fila preferencial (Entrada e Food Park)</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">1 INGRESSO CINEMARK CORTESIA</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">ESTACIONAMENTO GRÁTIS</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Entrar e sair do evento quando quiser!</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Pulseira Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Credencial Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Cordão Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Pôster oficial EXCLUSIVO</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Copo Colecionável EXCLUSIVO</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Ingresso Holográfico EXCLUSIVO</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Meet & Greet com todos os convidados*</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Acesso ao evento nos dias escolhidos das 10 às 19</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Descontos de até 30% de desconto em lojinhas durante o evento!</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">****Sala VIP - Acesso à sala climatizada, reservada e com a presença de convidados*</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">**Espaço diversão - Fliperamas e animes/séries liberados na sala VIP</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">HOTZONE - Espaço reservado nas primeiras fileiras do palco principal durante TODO o evento!</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">**Alimentação - Snacks, Salgados, Bebidas quentes e geladas e Guloseimas sendo servidas durante o dia na sala VIP</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Rodízio de Pizza servido exclusivamente na sala VIP das 13h às 16h​</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Área de descanso - Espaço com puffs e sofás na sala VIP</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Fliperama Liberado</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena de Games</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena KPOP</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Food Park</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Palcos e painéis</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Espaços temáticos</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Camarins</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Guarda Volumes</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">1 foto grátis no estúdio fotográfico</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Entendi!</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="vip-fanModal" tabindex="-1" aria-labelledby="vip-fanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vip-fanModalLabel">Se liga nas vantagens de ser VIP!</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <div class="alert border-0 bg-light-dark alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="fs-3 text-dark"><i class="bi bi-bell-fill"></i>
                        </div>
                        <div class="ms-3">
                            <div class="text-dark mt-2">
                                </strong> O KIT EPIC é composto por 1 passaporte 2 dias já com desconto de meia entrada (50% de desconto) + KIT de benefícios EPIC, conforme sua categoria
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>


                <hr>
                <div class="card">
                    <div class="card-body">
                        <table class="table mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="80%"></th>
                                    <th scope="col" width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <small class="text-muted">**** Mediante disponibilidade do convidado. Não inclui convidado internacional.</small>
                                <tr>
                                    <th scope="row">Fila preferencial (Entrada e Food Park)</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>


                                <tr>
                                    <th scope="row">Entrar e sair do evento quando quiser!</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Pulseira RFID Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Credencial Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Cordão Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Pôster oficial EXCLUSIVO</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Meet & Greet com 1 convidado de sua escolha</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Acesso ao evento nos dias escolhidos das 10 às 19</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Descontos de até 30% de desconto em lojinhas durante o evento!</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>


                                <tr>
                                    <th scope="row">HOTZONE - Espaço nas primeiras fileiras do palco principal! </th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>


                                <tr>
                                    <th scope="row">Fliperama Liberado</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena de Games</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena KPOP</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Food Park</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Palcos e painéis</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Espaços temáticos</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Camarins</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Guarda Volumes</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">1 foto grátis no estúdio fotográfico</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Entendi!</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="premiumModal" tabindex="-1" aria-labelledby="premiumlLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="premiumLabel">Se liga nas vantagens de ser Premium!</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">


                <div class="card">
                    <div class="card-body">
                        <table class="table mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="80%"></th>
                                    <th scope="col" width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Fila preferencial (Entrada e Food Park)</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Entrar e sair do evento quando quiser!</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Pulseira Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Credencial Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Cordão Colecionável</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Pôster oficial EXCLUSIVO</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Brindes exclusivos</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Acesso ao evento nos dias escolhidos das 10 às 19</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Descontos de até 30% de desconto em lojinhas durante o evento!</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">Fliperama Liberado</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena de Games</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Arena KPOP</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Food Park</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Palcos e painéis</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Espaços temáticos</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Camarins</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Guarda Volumes</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>

                                <tr>
                                    <th scope="row">1 foto grátis no estúdio fotográfico</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Entendi!</button>

            </div>
        </div>
    </div>
</div>


<!--MODAL-->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-body">


                <div class=" mt-1"></div>
                <div class="d-flex align-items-center">
                    <div class="card shadow-none w-100">
                        <div class="card-body shadow">
                            <div class="d-flex align-items-center ">
                                <div class="">
                                    <h4 class="mb-0">Sacola mágica! </h4>
                                    <p class="mb-0 text-muted" style="font-size: 14px">Aqui você encontra o resumo dos ingressos que <strong style="color:blueviolet"><?= $influencer ?></strong> te ajudou a escolher!</p>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex align-items-center">
                    <div class="card shadow-none w-100">
                        <div class="card-body  shadow">
                            <div class="d-flex align-items-center ">
                                <div class="">
                                    <h4 class="mb-0">Ingressos </h4>
                                    <p class="mb-0 text-muted" style="font-size: 11px">O Universo Geek ao Extremo</p>
                                </div>
                                <div class="ms-auto fs-3 mb-0 text-muted">

                                </div>

                                <div class="ms-auto fs-3 mb-0">
                                    <p class="mb-0" style="font-size: 10px;">Total a pagar:</p>
                                    <strong>R$ <?= number_format($_SESSION['total'], 2, ',', '') ?></strong>
                                    <strong>R$ <?= number_format($total_taxa, 2, ',', '') ?></strong>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($_SESSION['total'] != 0) : ?>
                    <div id="areaBotoes" class="row g-3">
                        <div class="col-lg-12">
                            <a href="<?= site_url('/evento/entrega'. $event_id) ?>" class="w-100 btn btn-primary btn-lg ">Ir para entrega</a>
                        </div>

                    </div>
                    <hr>
                    <center>
                        <span class="text-muted mb-5" style="font-size: 12px;">Processado por:</span><br>
                                                    <img class="mt-1" src="<?php echo site_url('recursos/front/images/asaas.png'); ?>" width="150px" height="auto">
                    </center>
                <?php endif ?>



            </div>
            <div class="modal-footer">

                <a href="" class="w-100 btn btn-outline-dark btn-block" data-bs-dismiss="modal"><i class="fa-solid fa-rotate-left"></i>Continuar comprando</a>

            </div>
        </div>
    </div>
</div>



</div><!-- /carrinho-content -->

<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>


<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>


<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>

<!-- Meta Pixel Events -->
<?php if (isset($evento) && !empty($evento->meta_pixel_id)): ?>
<script>
// ViewContent Event - quando a página do carrinho é carregada
fbq('track', 'ViewContent', {
    content_name: '<?= $evento->nome ?>',
    content_category: '<?= $evento->categoria ?? 'Evento' ?>',
    content_type: 'product',
    content_ids: [<?= $evento->id ?>]
});

// AddToCart Event - quando um item é adicionado ao carrinho
function trackAddToCart(itemId, itemName, itemPrice, itemQuantity = 1) {
    fbq('track', 'AddToCart', {
        content_name: '<?= $evento->nome ?> - ' + itemName,
        content_category: '<?= $evento->categoria ?? 'Evento' ?>',
        content_type: 'product',
        value: itemPrice,
        currency: 'BRL',
        content_ids: [itemId],
        num_items: itemQuantity
    });
}

// InitiateCheckout Event - quando o usuário clica para ir para o pagamento
function trackInitiateCheckout() {
    let totalValue = <?= $_SESSION['total'] ?? 0 ?>;
    let cartItems = [];
    let totalItems = 0;
    
    <?php if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])): ?>
        <?php foreach ($_SESSION['carrinho'] as $key => $value): ?>
            <?php if ($value['quantidade'] > 0): ?>
                cartItems.push(<?= $key ?>);
                totalItems += <?= $value['quantidade'] ?>;
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    
    fbq('track', 'InitiateCheckout', {
        content_name: '<?= $evento->nome ?>',
        content_category: '<?= $evento->categoria ?? 'Evento' ?>',
        content_type: 'product',
        value: totalValue,
        currency: 'BRL',
        content_ids: cartItems,
        num_items: totalItems
    });
}

// Track AddToCart when items are added via URL parameters
<?php if (isset($_GET['adicionar'])): ?>
    <?php 
    $idProduto = (int)$_GET['adicionar'];
    if (isset($items[$idProduto])): 
        $produto = $items[$idProduto];
    ?>
    trackAddToCart(<?= $idProduto ?>, '<?= $produto['nome'] ?>', <?= $produto['preco'] ?>);
    <?php endif; ?>
<?php endif; ?>
</script>
<?php endif; ?>

<script>
    $(document).ready(function() {

        //$("#form").LoadingOverlay("show");

        <?php echo $this->include('Clientes/_checkmail'); ?>

        <?php echo $this->include('Clientes/_viacep'); ?>

        // Track AddToCart when items are added via AJAX
        $(document).on('click', 'a[href*="adicionar="]', function(e) {
            <?php if (isset($evento) && !empty($evento->meta_pixel_id)): ?>
            let href = $(this).attr('href');
            let itemId = href.match(/adicionar=(\d+)/);
            if (itemId && itemId[1]) {
                // Get item details from the page
                let itemElement = $('[data-item-id="' + itemId[1] + '"]');
                let itemName = itemElement.find('.item-name').text() || 'Ingresso';
                let itemPrice = parseFloat(itemElement.find('.item-price').data('price')) || 0;
                
                // Track after a short delay to ensure the item is added to cart
                setTimeout(function() {
                    trackAddToCart(itemId[1], itemName, itemPrice);
                }, 500);
            }
            <?php endif; ?>
        });

        // Track InitiateCheckout when user clicks to go to payment
        $(document).on('click', 'a[href*="evento/entrega"]', function(e) {
            <?php if (isset($evento) && !empty($evento->meta_pixel_id)): ?>
            trackInitiateCheckout();
            <?php endif; ?>
        });

        $("#form").on('submit', function(e) {


            e.preventDefault();


            $.ajax({

                type: 'POST',
                url: '<?php echo site_url('carrinho/cupom'); ?>',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {

                    $("#response").html('');
                    $("#btn-salvar").val('Por favor aguarde...');

                },
                success: function(response) {

                    $("#btn-salvar").val('Salvar');
                    $("#btn-salvar").removeAttr("disabled");

                    $('[name=csrf_ordem]').val(response.token);


                    if (!response.erro) {


                        if (response.info) {

                            $("#response").html('<div class="alert alert-info">' + response
                                .info + '</div>');

                        } else {

                            // Tudo certo com a atualização do usuário
                            // Podemos agora redirecioná-lo tranquilamente

                            window.location.href =
                                "<?php echo site_url("carrinho"); ?>";

                        }

                    }

                    if (response.erro) {

                        // Exitem erros de validação


                        $("#response").html('<div class="alert alert-danger">' + response.erro +
                            '</div>');


                        if (response.erros_model) {


                            $.each(response.erros_model, function(key, value) {

                                $("#response").append(
                                    '<ul class="list-unstyled"><li class="text-danger">' +
                                    value + '</li></ul>');

                            });

                        }

                    }

                },
                error: function() {

                    alert(
                        'Não foi possível procesar a solicitação. Por favor entre em contato com o suporte técnico.'
                    );
                    $("#btn-salvar").val('Salvar');
                    $("#btn-salvar").removeAttr("disabled");

                }



            });


        });


        $("#form").submit(function() {

            $(this).find(":submit").attr('disabled', 'disabled');

        });


    });

    //$(document).ready(function() {
    //  $('#cartModal').modal('show');
    //})
</script>
<script>
    // Dia selecionado globalmente
    var diaSelecionado = localStorage.getItem('diaSelecionado') || 'sabado';

    // Volta para o seletor de dia
    function voltarSeletor() {
        document.getElementById('carrinho-content').style.display = 'none';
        document.getElementById('day-selector').style.display = 'block';
        localStorage.removeItem('diaSelecionado');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Filtra tickets visiveis com base no dia selecionado
    function filtrarTicketsPorDia() {
        // Reseta sub-filtro ao trocar de dia
        subFiltroAtual = 'todas';
        var subBtns = document.querySelectorAll('.sub-filter-btn');
        subBtns.forEach(function(b) { b.classList.remove('active'); });
        if (subBtns.length > 0) subBtns[0].classList.add('active');
        aplicarFiltros();
    }

    // Seletor de dia - mostra carrinho e abre a aba correspondente
    function selecionarDia(dia) {
        diaSelecionado = dia;

        // Esconde o seletor
        document.getElementById('day-selector').style.display = 'none';
        // Mostra o carrinho
        document.getElementById('carrinho-content').style.display = 'block';

        // Salva escolha
        localStorage.setItem('diaSelecionado', dia);

        // Filtra tickets pelo dia
        filtrarTicketsPorDia();

        // Abre primeira tab
        var defaultBtn = document.getElementById('defaultOpen');
        if (defaultBtn) defaultBtn.click();

        // Scroll para o topo
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Ao carregar, verifica se ja tem itens no carrinho ou dia selecionado
    document.addEventListener('DOMContentLoaded', function() {
        var temCarrinho = <?= (isset($_SESSION['carrinho']) && !empty(array_filter($_SESSION['carrinho'] ?? [], function($item) { return $item['quantidade'] > 0; }))) ? 'true' : 'false' ?>;
        var temAdicionar = <?= isset($_GET['adicionar']) ? 'true' : 'false' ?>;
        var temExcluir = <?= isset($_GET['excluir']) ? 'true' : 'false' ?>;

        if (temCarrinho || temAdicionar || temExcluir) {
            document.getElementById('day-selector').style.display = 'none';
            document.getElementById('carrinho-content').style.display = 'block';

            // Restaura dia salvo
            var diaSalvo = localStorage.getItem('diaSelecionado');
            if (diaSalvo) diaSelecionado = diaSalvo;

            // Filtra tickets pelo dia
            filtrarTicketsPorDia();

            // Restaura aba salva
            var abaSalva = localStorage.getItem('abaCarrinhoSelecionada');
            if (abaSalva) {
                var tabButtons = document.querySelectorAll('.tablinks');
                tabButtons.forEach(function(btn) {
                    var onclick = btn.getAttribute('onclick');
                    if (onclick && onclick.indexOf("'" + abaSalva + "'") !== -1) {
                        btn.click();
                    }
                });
            } else {
                document.getElementById("defaultOpen").click();
            }
        }
    });

    function openCategoria(evt, categoria) {
        // Esconde todas as tabcontent
        var tabcontent = document.getElementsByClassName("tabcontent");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        // Remove a classe 'active' de todos os botões
        var tablinks = document.getElementsByClassName("tablinks");
        for (var i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        // Mostra a aba selecionada
        document.getElementById(categoria).style.display = "block";
        evt.currentTarget.className += " active";
        // Salva a aba selecionada no localStorage
        localStorage.setItem('abaCarrinhoSelecionada', categoria);
        // Reseta sub-filtro para "Todas" ao trocar de aba
        var subBtns = document.querySelectorAll('.sub-filter-btn');
        subBtns.forEach(function(b) { b.classList.remove('active'); });
        if (subBtns.length > 0) subBtns[0].classList.add('active');
        filtrarTipo(null, 'todas');
    }

    // Sub-filtro: Todas / Inteira / Meia
    var subFiltroAtual = 'todas';

    function filtrarTipo(btn, tipo) {
        if (btn) {
            document.querySelectorAll('.sub-filter-btn').forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');
        }
        subFiltroAtual = tipo;
        aplicarFiltros();
    }

    // Aplica ambos os filtros (dia + tipo) simultaneamente
    function aplicarFiltros() {
        document.querySelectorAll('.ticket-card').forEach(function(card) {
            var ticketDia = card.getAttribute('data-dia');
            var ticketTipo = card.getAttribute('data-ticket-tipo');

            // Filtro de dia
            var passaDia = (!diaSelecionado || ticketDia === diaSelecionado || ticketDia === 'todos');

            // Filtro de tipo (inteira/meia)
            var passaTipo = (subFiltroAtual === 'todas' || ticketTipo === subFiltroAtual);

            card.style.display = (passaDia && passaTipo) ? '' : 'none';
        });

        // Verifica se alguma tab tem tickets visiveis
        document.querySelectorAll('.tabcontent').forEach(function(tab) {
            var cards = tab.querySelectorAll('.ticket-card');
            var temVisivel = false;
            cards.forEach(function(card) {
                if (card.style.display !== 'none') temVisivel = true;
            });
            var aviso = tab.querySelector('.alert-no-tickets');
            if (aviso) aviso.remove();
            if (!temVisivel && cards.length > 0) {
                var div = document.createElement('div');
                div.className = 'alert-no-tickets';
                div.style.cssText = 'text-align: center; padding: 24px; color: #9ca3af; font-size: 14px;';
                div.textContent = 'Nenhum ingresso disponivel para o dia selecionado nesta categoria';
                tab.appendChild(div);
            }
        });
    }

    // Toggle resumo do pedido
    function toggleResumo() {
        var summary = document.getElementById('cartSummary');
        var link = document.getElementById('resumoToggleLink');
        if (summary.classList.contains('hidden')) {
            summary.classList.remove('hidden');
            link.innerHTML = 'OCULTAR RESUMO <i class="bx bx-chevron-down"></i>';
        } else {
            summary.classList.add('hidden');
            link.innerHTML = 'VER RESUMO <i class="bx bx-chevron-up"></i>';
        }
    }

    // Função para controlar o scroll horizontal das tabs
    function scrollTabs(direction) {
        const container = document.querySelector('.tab-container');
        const scrollAmount = 200; // Quantidade de pixels para rolar
        
        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
        
        // Atualiza o estado das setas após um pequeno delay
        setTimeout(updateArrowState, 100);
    }

    // Função para atualizar o estado (visibilidade) das setas
    function updateArrowState() {
        const container = document.querySelector('.tab-container');
        const scrollLeft = container.scrollLeft;
        const scrollWidth = container.scrollWidth;
        const clientWidth = container.clientWidth;
        
        const leftArrow = document.getElementById('scrollLeft');
        const rightArrow = document.getElementById('scrollRight');
        
        // Desabilita seta esquerda se estiver no início
        if (scrollLeft <= 0) {
            leftArrow.classList.add('disabled');
        } else {
            leftArrow.classList.remove('disabled');
        }
        
        // Desabilita seta direita se estiver no fim
        if (scrollLeft + clientWidth >= scrollWidth - 5) { // -5 para margem de erro
            rightArrow.classList.add('disabled');
        } else {
            rightArrow.classList.remove('disabled');
        }
    }

    // Função para atualizar a barra de scroll customizada
    function updateScrollBar() {
        const container = document.getElementById('tabContainer');
        const scrollThumb = document.getElementById('scrollThumb');
        const instruction = document.getElementById('scrollInstruction');
        
        if (!container || !scrollThumb) return;
        
        const scrollLeft = container.scrollLeft;
        const scrollWidth = container.scrollWidth;
        const clientWidth = container.clientWidth;
        
        // Calcula a porcentagem de scroll
        const scrollPercentage = scrollLeft / (scrollWidth - clientWidth);
        
        // Calcula o tamanho do thumb baseado na proporção visível
        const thumbWidth = (clientWidth / scrollWidth) * 100;
        
        // Calcula a posição do thumb
        const thumbPosition = scrollPercentage * (100 - thumbWidth);
        
        // Aplica os valores
        scrollThumb.style.width = thumbWidth + '%';
        scrollThumb.style.left = thumbPosition + '%';
        
        // Controla visibilidade da barra e instrução
        const indicator = document.querySelector('.tab-scroll-indicator');
        if (scrollWidth <= clientWidth) {
            indicator.style.opacity = '0.3';
            if (instruction) instruction.style.display = 'none';
        } else {
            indicator.style.opacity = '1';
            if (instruction && scrollLeft === 0) {
                instruction.style.display = 'flex';
            } else if (instruction && scrollLeft > 0) {
                instruction.style.display = 'none';
            }
        }
    }

    window.addEventListener('DOMContentLoaded', function() {
        // Inicializa o estado das setas e da barra
        updateArrowState();
        updateScrollBar();
        
        // Atualiza as setas e a barra quando o container for rolado
        const container = document.querySelector('.tab-container');
        if (container) {
            container.addEventListener('scroll', function() {
                updateArrowState();
                updateScrollBar();
            });
        }
        
        // Atualiza as setas e a barra quando a janela for redimensionada
        window.addEventListener('resize', function() {
            updateArrowState();
            updateScrollBar();
        });

        // Permite clicar na barra de scroll para navegar
        const scrollIndicator = document.querySelector('.tab-scroll-indicator');
        if (scrollIndicator) {
            scrollIndicator.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const clickX = e.clientX - rect.left;
                const percentage = clickX / rect.width;
                
                const container = document.getElementById('tabContainer');
                const scrollWidth = container.scrollWidth;
                const clientWidth = container.clientWidth;
                
                container.scrollLeft = percentage * (scrollWidth - clientWidth);
            });
        }

        // Permite arrastar o thumb da barra
        const scrollThumb = document.getElementById('scrollThumb');
        let isDragging = false;
        let startX = 0;
        let startScrollLeft = 0;

        if (scrollThumb) {
            scrollThumb.addEventListener('mousedown', function(e) {
                isDragging = true;
                startX = e.clientX;
                startScrollLeft = container.scrollLeft;
                scrollThumb.style.cursor = 'grabbing';
                e.preventDefault();
            });

            document.addEventListener('mousemove', function(e) {
                if (!isDragging) return;
                
                const indicator = document.querySelector('.tab-scroll-indicator');
                const rect = indicator.getBoundingClientRect();
                const deltaX = e.clientX - startX;
                const deltaPercentage = deltaX / rect.width;
                
                const scrollWidth = container.scrollWidth;
                const clientWidth = container.clientWidth;
                
                container.scrollLeft = startScrollLeft + (deltaPercentage * (scrollWidth - clientWidth));
            });

            document.addEventListener('mouseup', function() {
                if (isDragging) {
                    isDragging = false;
                    scrollThumb.style.cursor = 'grab';
                }
            });

            // Touch support para mobile
            scrollThumb.addEventListener('touchstart', function(e) {
                isDragging = true;
                startX = e.touches[0].clientX;
                startScrollLeft = container.scrollLeft;
                e.preventDefault();
            });

            document.addEventListener('touchmove', function(e) {
                if (!isDragging) return;
                
                const indicator = document.querySelector('.tab-scroll-indicator');
                const rect = indicator.getBoundingClientRect();
                const deltaX = e.touches[0].clientX - startX;
                const deltaPercentage = deltaX / rect.width;
                
                const scrollWidth = container.scrollWidth;
                const clientWidth = container.clientWidth;
                
                container.scrollLeft = startScrollLeft + (deltaPercentage * (scrollWidth - clientWidth));
            });

            document.addEventListener('touchend', function() {
                isDragging = false;
            });
        }

        // Esconde a instrução ao clicar nela ou após alguns segundos de inatividade
        const instruction = document.getElementById('scrollInstruction');
        if (instruction) {
            instruction.addEventListener('click', function() {
                this.style.display = 'none';
            });

            // Auto-esconde após 15 segundos se o usuário não interagir
            let instructionTimer = setTimeout(function() {
                if (instruction && container.scrollLeft === 0) {
                    instruction.style.transition = 'opacity 0.5s ease';
                    instruction.style.opacity = '0';
                    setTimeout(function() {
                        instruction.style.display = 'none';
                    }, 500);
                }
            }, 15000);

            // Reseta o timer se o usuário interagir
            container.addEventListener('scroll', function() {
                clearTimeout(instructionTimer);
            }, { once: true });
        }
        // So abre aba automaticamente se o carrinho ja estiver visivel
        var carrinhoContent = document.getElementById('carrinho-content');
        if (carrinhoContent && carrinhoContent.style.display !== 'none') {
            // Restaura dia e filtra
            var diaSalvo = localStorage.getItem('diaSelecionado');
            if (diaSalvo) diaSelecionado = diaSalvo;
            if (typeof filtrarTicketsPorDia === 'function') filtrarTicketsPorDia();

            var abaSalva = localStorage.getItem('abaCarrinhoSelecionada');
            if (abaSalva) {
                var btn = document.querySelector('.tab button[onclick*="' + abaSalva + '"]');
                if (btn) {
                    btn.click();
                }
            } else {
                var defaultBtn = document.getElementById('defaultOpen');
                if (defaultBtn) defaultBtn.click();
            }
        }
    });
</script>

<?php echo $this->endSection() ?>