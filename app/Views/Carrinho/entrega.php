<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />

<style>
    .delivery-section {
        max-width: 540px;
        margin: 0 auto;
    }

    .delivery-option {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 18px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        color: inherit;
        background: #fff;
    }

    .delivery-option:hover {
        border-color: #c084fc;
        background: #faf5ff;
        color: inherit;
        text-decoration: none;
    }

    .delivery-option.active {
        border-color: #9333ea;
        background: #faf5ff;
    }

    .delivery-radio {
        width: 22px;
        height: 22px;
        min-width: 22px;
        border-radius: 50%;
        border: 2px solid #d1d5db;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 2px;
        transition: all 0.2s ease;
    }

    .delivery-option.active .delivery-radio {
        border-color: #9333ea;
        background: #9333ea;
    }

    .delivery-option.active .delivery-radio::after {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #fff;
    }

    .delivery-info {
        flex: 1;
    }

    .delivery-info-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 4px;
    }

    .delivery-name {
        font-size: 15px;
        font-weight: 600;
        color: #1f2937;
    }

    .delivery-price {
        font-size: 13px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
    }

    .delivery-price.free {
        color: #059669;
        background: #ecfdf5;
    }

    .delivery-price.paid {
        color: #d97706;
        background: #fffbeb;
    }

    .delivery-desc {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.4;
        margin: 0;
    }

    /* Botões de pagamento */
    .payment-section {
        margin-top: 24px;
    }

    .payment-section-title {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .payment-section-title i {
        color: #9333ea;
    }

    .payment-grid {
        display: flex;
        gap: 10px;
    }

    .btn-pay {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.2s;
        text-decoration: none;
        border: none;
        color: #fff !important;
    }

    .btn-pay:hover {
        transform: translateY(-1px);
        color: #fff !important;
        text-decoration: none;
    }

    .btn-pay-pix {
        background: #059669;
    }

    .btn-pay-pix:hover {
        background: #047857;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
    }

    .btn-pay-card {
        background: #7c3aed;
    }

    .btn-pay-card:hover {
        background: #6d28d9;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .pix-badge {
        background: rgba(255,255,255,0.25);
        font-size: 10px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 6px;
    }

    .total-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 16px;
        padding: 14px 18px;
        background: #f9fafb;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    .total-bar-label {
        font-size: 13px;
        color: #6b7280;
        font-weight: 500;
    }

    .total-bar-value {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
    }

    @media (max-width: 480px) {
        .payment-grid {
            flex-direction: column;
        }
    }
</style>

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>



<?php
if (!isset($_SESSION['frete'])) {
    $_SESSION['frete'] = 'impressao';
    $_SESSION['valor_frete'] = 0;
};
if (!isset($_SESSION['casa'])) {
    $_SESSION['casa'] = '';
    $_SESSION['btn_texto_casa'] = 'Selecionar';
    $_SESSION['btn_color_casa'] = 'muted';
};
if (!isset($_SESSION['impressao'])) {
    $_SESSION['impressao'] = 'disabled';
    $_SESSION['btn_texto_impressao'] = 'Selecionado';
    $_SESSION['btn_color_impressao'] = 'success';
};

?>


<?php
$entregas = [
    ['tipo' => 'impressao', 'valor' => 0, 'descricao' => 'Seu ingresso estará disponível na sua área de membros.', 'titulo' => 'Ingresso Digital', 'badge' => 'Grátis', 'badge_class' => 'free'],
    ['tipo' => 'casa', 'valor' => 25, 'descricao' => 'Receba seu kit com ingresso, credencial + cordão colecionável, pulseiras e guia no conforto da sua casa (máx. 4 ingressos por pacote).', 'titulo' => 'Receber em casa', 'badge' => '+ R$ 25,00', 'badge_class' => 'paid'],
];

if (isset($_GET['escolher'])) {
    $entrega = (int) $_GET['escolher'];
    $_SESSION['frete'] = $entregas[$entrega]['tipo'];
    $_SESSION['valor_frete'] = $entregas[$entrega]['valor'];

    if ($entregas[$entrega]['tipo'] == 'casa') {
        $_SESSION['casa'] = 'disabled';
        $_SESSION['impressao'] = '';
        $_SESSION['btn_texto_casa'] = 'Selecionado';
        $_SESSION['btn_color_casa'] = 'success';
        $_SESSION['btn_texto_impressao'] = 'Selecionar';
        $_SESSION['btn_color_impressao'] = 'muted';
    } else {
        $_SESSION['casa'] = '';
        $_SESSION['impressao'] = 'disabled';
        $_SESSION['btn_texto_casa'] = 'Selecionar';
        $_SESSION['btn_color_casa'] = 'muted';
        $_SESSION['btn_texto_impressao'] = 'Selecionado';
        $_SESSION['btn_color_impressao'] = 'success';
    }
}
?>

<div class="row mt-3 justify-content-center">
    <div class="col-12">

        <div class="delivery-section">
            <h5 class="mb-3" style="font-weight: 700; color: #111827;">Como quer receber seus ingressos?</h5>

            <?php foreach ($entregas as $key => $value) :
                $isSelected = $_SESSION['btn_color_' . $value['tipo']] === 'success';
            ?>
                <a href="?escolher=<?= $key ?>" class="delivery-option <?= $isSelected ? 'active' : '' ?>">
                    <div class="delivery-radio"></div>
                    <div class="delivery-info">
                        <div class="delivery-info-header">
                            <span class="delivery-name"><?= $value['titulo'] ?></span>
                            <span class="delivery-price <?= $value['badge_class'] ?>"><?= $value['badge'] ?></span>
                        </div>
                        <p class="delivery-desc"><?= $value['descricao'] ?></p>
                    </div>
                </a>
            <?php endforeach; ?>

            <?php if ($_SESSION['total'] != 0): ?>
            <div class="payment-section">
                <div class="payment-section-title">
                    <i class="bx bx-lock-alt"></i>
                    Escolha a forma de pagamento
                </div>

                <div class="payment-grid">
                    <a href="<?= site_url('/checkout/pix/' . ($event_id ?? '')) ?>" class="btn-pay btn-pay-pix">
                        <i class="fa-brands fa-pix"></i>
                        PIX
                        <span class="pix-badge">10% OFF</span>
                    </a>
                    <a href="<?= site_url('/checkout/cartao/' . ($event_id ?? '')) ?>" class="btn-pay btn-pay-card">
                        <i class="bx bx-credit-card"></i>
                        Cartão
                    </a>
                </div>

                <div class="total-bar">
                    <span class="total-bar-label">Total a pagar</span>
                    <span class="total-bar-value">R$ <?= number_format($_SESSION['total'] + $_SESSION['valor_frete'], 2, ',', '.') ?></span>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4 mb-2">
            <span class="text-muted" style="font-size: 11px;">Processado por</span><br>
            <img class="mt-1" src="<?= site_url('recursos/front/images/asaas.png') ?>" width="100" height="auto" alt="Asaas">
        </div>

        <div class="text-muted mt-3 mb-4" style="font-size: 11px; line-height: 1.6;">
            <p class="mb-1"><strong>Precisa de ajuda?</strong> <a href="#" target="_blank">Entre em contato</a></p>
            <p class="mb-1">* O valor parcelado possui acréscimo.</p>
            <p class="mb-1"><strong>Meia entrada solidária</strong> (40% de desconto) disponível para qualquer pessoa que levar 1kg de alimento não perecível no dia do evento.</p>
            <p class="mb-1">Ao clicar em "Comprar agora", eu concordo com os termos de uso e regras do evento Dreamfest 25 e estou ciente da Política de Privacidade.</p>
            <hr class="my-2">
            <p class="mb-0">MUNDO DREAM EVENTOS E PRODUCOES LTDA &copy; 2024 &mdash; 21.812.142/0001-23</p>
        </div>

    </div>
</div>





















<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>


<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>


<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>

<script>
    $(document).ready(function() {

        //$("#form").LoadingOverlay("show");

        <?php echo $this->include('Clientes/_checkmail'); ?>
        <?php echo $this->include('Clientes/_viacep'); ?>
    });
</script>




<?php echo $this->endSection() ?>