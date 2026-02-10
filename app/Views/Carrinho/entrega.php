<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />

<style>
    /* === MOBILE FIRST - Estilos base para mobile === */
    
    /* Reduzir padding dos containers */
    .delivery-container .card-body {
        padding: 10px !important;
    }
    
    .delivery-container .row.mt-2 {
        margin-top: 0 !important;
    }
    
    /* Cards de entrega */
    .delivery-card {
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        border-radius: 16px !important;
        margin-bottom: 16px;
        padding: 20px 16px !important;
    }
    
    /* Card não selecionado */
    .delivery-card.not-selected {
        border: 2px solid #e0e0e0 !important;
        background: #fafafa;
    }
    
    /* Card selecionado - DESTAQUE */
    .delivery-card.selected {
        border: 3px solid #9c27b0 !important;
        background: linear-gradient(135deg, #f3e5f5 0%, #ffffff 100%);
        box-shadow: 0 4px 20px rgba(156, 39, 176, 0.25);
    }
    
    .delivery-card.selected::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #9c27b0, #e91e63);
    }
    
    /* Ícone de check - oculto */
    .selection-indicator {
        display: none;
    }
    
    /* Conteúdo do card - layout em coluna no mobile */
    .delivery-content {
        padding-right: 0;
    }
    
    /* Header com título e badge - empilhados no mobile */
    .delivery-header {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 12px;
    }
    
    /* Título */
    .delivery-title {
        font-size: 18px;
        font-weight: 700;
        line-height: 1.2;
        margin: 0;
    }
    
    .selected .delivery-title {
        color: #7b1fa2;
    }
    
    .not-selected .delivery-title {
        color: #444;
    }
    
    /* Badge de preço */
    .delivery-badge {
        font-size: 12px !important;
        padding: 5px 10px !important;
        border-radius: 16px !important;
        font-weight: 600;
    }
    
    /* Descrição */
    .delivery-description {
        font-size: 13px;
        color: #666;
        line-height: 1.5;
        margin-bottom: 16px;
    }
    
    /* Botão de seleção */
    .btn-select {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 25px;
        transition: all 0.3s;
        width: 100%;
        text-align: center;
    }
    
    .btn-select.selected-btn {
        background: linear-gradient(135deg, #ff9800, #f57c00) !important;
        border: none !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(255, 152, 0, 0.4);
        margin-bottom: 0;
        border-radius: 12px 12px 0 0;
    }
    
    .btn-select.unselected-btn {
        background: white !important;
        border: 2px solid #9c27b0 !important;
        color: #9c27b0 !important;
    }
    
    /* Etiqueta "Recomendado" */
    .recommended-tag {
        position: absolute;
        top: 0;
        left: 16px;
        background: linear-gradient(135deg, #ff9800, #f57c00);
        color: white;
        padding: 4px 10px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 2px 6px rgba(255, 152, 0, 0.4);
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .recommended-tag i {
        font-size: 12px;
    }
    
    /* Ajuste para card com tag recomendado */
    .delivery-card.has-tag .delivery-content {
        padding-top: 10px;
    }
    
    /* === TABLET e DESKTOP === */
    @media (min-width: 576px) {
        .delivery-card {
            padding: 24px !important;
        }
        
        .delivery-card.selected {
            box-shadow: 0 6px 25px rgba(156, 39, 176, 0.3);
        }
        
        .selection-indicator {
            width: 32px;
            height: 32px;
            font-size: 18px;
            top: 12px;
            right: 12px;
        }
        
        .delivery-content {
            padding-right: 45px;
        }
        
        /* Header em linha no tablet+ */
        .delivery-header {
            flex-direction: row;
            align-items: center;
            gap: 12px;
        }
        
        .delivery-title {
            font-size: 20px;
        }
        
        .delivery-badge {
            font-size: 13px !important;
            padding: 6px 12px !important;
        }
        
        .delivery-description {
            font-size: 14px;
        }
        
        .btn-select {
            width: auto;
            padding: 12px 30px;
        }
        
        .recommended-tag {
            font-size: 11px;
            padding: 5px 12px;
        }
    }
    
    /* === DESKTOP LARGE === */
    @media (min-width: 992px) {
        .delivery-card:hover {
            transform: translateY(-2px);
        }
        
        .delivery-card.not-selected:hover {
            border-color: #9c27b0 !important;
            box-shadow: 0 4px 15px rgba(156, 39, 176, 0.15);
        }
        
        .btn-select.unselected-btn:hover {
            background: #9c27b0 !important;
            color: white !important;
        }
    }
    
    /* === BOTÕES DE PAGAMENTO DENTRO DO CARD === */
    .payment-buttons {
        margin-top: 0;
        padding: 16px;
        background: linear-gradient(180deg, #fff3e0 0%, #ffffff 100%);
        border-radius: 0 0 16px 16px;
    }
    
    .payment-title {
        font-size: 12px;
        color: #e65100;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
    }
    
    .payment-title i {
        color: #ff9800;
        font-size: 14px;
    }
    
    .payment-grid {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .btn-payment {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s;
        text-decoration: none;
        width: 100%;
    }
    
    .btn-payment-pix {
        background: linear-gradient(135deg, #00b894, #00a381) !important;
        color: white !important;
        border: none;
    }
    
    .btn-payment-pix:hover {
        background: linear-gradient(135deg, #00a381, #009673) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 184, 148, 0.4);
    }
    
    .btn-payment-card {
        background: linear-gradient(135deg, #9c27b0, #7b1fa2) !important;
        color: white !important;
        border: none;
    }
    
    .btn-payment-card:hover {
        background: linear-gradient(135deg, #7b1fa2, #6a1b9a) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(156, 39, 176, 0.4);
    }
    
    .btn-payment .payment-label {
        font-size: 11px;
        opacity: 0.9;
    }
    
    .btn-payment .payment-icon {
        font-size: 20px;
    }
    
    .pix-discount {
        background: #ffd700;
        color: #333;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 10px;
        margin-left: 5px;
    }
    
    .total-payment {
        text-align: center;
        margin-top: 12px;
        padding: 12px;
        background: linear-gradient(135deg, #fff8e1, #ffecb3);
        border-radius: 10px;
        border: 1px solid #ffcc80;
    }
    
    .total-payment-label {
        font-size: 11px;
        color: #e65100;
        font-weight: 500;
    }
    
    .total-payment-value {
        font-size: 22px;
        font-weight: 700;
        color: #e65100;
    }
    
    @media (min-width: 576px) {
        .payment-grid {
            flex-direction: row;
        }
        
        .btn-payment {
            flex: 1;
        }
    }
</style>

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>



<?php
if (!isset($_SESSION['frete'])) {
    $_SESSION['frete'] = 'casa';
    $_SESSION['valor_frete'] = 25;
};
if (!isset($_SESSION['casa'])) {
    $_SESSION['casa'] = 'disabled';
    $_SESSION['btn_texto_casa'] = 'Selecionado';
    $_SESSION['btn_color_casa'] = 'success';
};
if (!isset($_SESSION['impressao'])) {
    $_SESSION['impressao'] = '';
    $_SESSION['btn_texto_impressao'] = 'Selecionar';
    $_SESSION['btn_color_impressao'] = 'muted';
};

?>


<h5 class="mb-0 mt-3">Como você quer receber os seus ingressos?</h5>

<div class="row mt-4">
    <div class="col-lg-8">
        <div class="block">
            <div class="block-body">
                <div class="card shadow radius-10">
                    <div class="card-body">



                        <!-- Exibirá os retornos do backend -->
                        <div id="response">


                        </div>



                        <?php
                        $entregas = array(

                            ['tipo' => 'casa', 'valor' => 25, 'descricao' => 'Receba seu kit com ingresso, credencial + cordão colecionável, pulseiras e guia no conforto da sua casa (máximo de 4 ingressos por pacote)', 'titulo' => 'Receber em casa', 'badge' => '+ R$ 25,00', 'icone' => '<i class="fa-solid fa-truck-fast"></i>', 'classe' => 'badge bg-warning text-dark font-13'],
                            ['tipo' => 'impressao', 'valor' => 0, 'descricao' => 'Seu ingresso vai estar disponível na sua área de membros.', 'titulo' => 'Ingresso Digital', 'badge' => 'GRÁTIS', 'classe' => 'badge bg-success  font-13']

                        );


                        ?>


                        <?php
                        if (isset($_GET['escolher'])) {
                            $entrega = (int) $_GET['escolher'];

                            $_SESSION['frete'] =  $entregas[$entrega]['tipo'];
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


                        <div class="delivery-container">
                            <div class="card shadow-none w-100">
                                <div class="card-body p-2">

                                                <?php foreach ($entregas as $key => $value) : 
                                                    $isSelected = $_SESSION['btn_color_' . $value['tipo']] === 'success';
                                                    $cardClass = $isSelected ? 'selected' : 'not-selected';
                                                    $btnClass = $isSelected ? 'selected-btn' : 'unselected-btn';
                                                    $hasTag = $value['tipo'] === 'casa';
                                                ?>

                                                    <div class="card delivery-card <?= $cardClass ?> <?= $hasTag ? 'has-tag' : '' ?>">
                                                        <?php if ($hasTag): ?>
                                                            <div class="recommended-tag"><i class="bx bx-star"></i> Recomendado</div>
                                                        <?php endif; ?>
                                                        
                                                        <div class="selection-indicator">
                                                            <i class="bx <?= $isSelected ? 'bx-check' : 'bx-circle' ?>"></i>
                                                        </div>
                                                        
                                                        <div class="delivery-content">
                                                            <div class="delivery-header">
                                                                <h3 class="delivery-title"><?= $value['titulo'] ?></h3>
                                                                <span class="<?= $value['classe'] ?> delivery-badge"><?= $value['badge'] ?></span>
                                                            </div>
                                                            
                                                            <p class="delivery-description"><?= $value['descricao'] ?></p>
                                                            
                                                            <?php if (!$isSelected): ?>
                                                                <a href="?escolher=<?= $key ?>" class="btn btn-select <?= $btnClass ?>">
                                                                    <i class="bx bx-check-circle me-1"></i> Selecionar
                                                                </a>
                                                            <?php else: ?>
                                                                <span class="btn btn-select <?= $btnClass ?>">
                                                                    <i class="bx bx-check-circle me-1"></i> Selecionado
                                                                </span>
                                                                
                                                                <?php if ($_SESSION['total'] != 0): ?>
                                                                <!-- Botões de Pagamento -->
                                                                <div class="payment-buttons">
                                                                    <div class="payment-title">
                                                                        <i class="bx bx-lock-alt"></i>
                                                                        <span>Escolha a forma de pagamento:</span>
                                                                    </div>
                                                                    
                                                                    <div class="payment-grid">
                                                                        <a href="<?= site_url('/checkout/pix/' . ($event_id ?? '')) ?>" class="btn-payment btn-payment-pix">
                                                                            <i class="fa-brands fa-pix payment-icon"></i>
                                                                            <span>PIX</span>
                                                                            <span class="pix-discount">10% OFF</span>
                                                                        </a>
                                                                        
                                                                        <a href="<?= site_url('/checkout/cartao/' . ($event_id ?? '')) ?>" class="btn-payment btn-payment-card">
                                                                            <i class="bx bx-credit-card payment-icon"></i>
                                                                            <span>Cartão</span>
                                                                        </a>
                                                                    </div>
                                                                    
                                                                    <div class="total-payment">
                                                                        <div class="total-payment-label">Total a pagar:</div>
                                                                        <div class="total-payment-value">R$ <?= number_format($_SESSION['total'] + $_SESSION['valor_frete'], 2, ',', '.') ?></div>
                                                                    </div>
                                                                </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>

                                </div>
                            </div>
                        </div>

                                    <hr>
                                    <center>
                                        <span class="text-muted mb-5" style="font-size: 12px;">Processado por:</span><br>
                                        <img class="mt-1" src="<?php echo site_url('recursos/front/images/asaas.png'); ?>" width="150px" height="auto">
                                    </center>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">


                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <h5 class="mb-0">Compra segura</h4>
                                    <p class="mb-0">Ambiente seguro e autenticado</p>
                                    <span class="text-muted" style="font-size: 10px;">Este site utiliza certificado SSL</span>
                            </div>
                            <div class="ms-auto fs-3 ">
                                <i class="fadeIn animated bx bx-check-shield" style="font-size: 45px;"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 5px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 42%"></div>
                        </div>
                    </div>


                </div>
            </div>

        </div>

    </div>

</div>

<div class="row" style="padding-left: 20px; padding-right: 20px">
    <div class="col-8">
        <div class="text-muted" style="font-size: 11px; ">
            <p class="mb-0"><strong>Precisa de ajuda? </strong><a href="#" target="_blank">Entre em contato</a></p>
            <p class="mt-0 mb-0">* O valor parcelado possui acréscimo.</p>
            <p class="mt-0 mb-0"><strong>Meia entrada solidária </strong> (40% de desconto) disponível para qualquer pessoa que levar 1kg de alimento não perecível no dia do evento.</p>
            <p class="mt-0 mb-0">Ao clicar em 'Comprar agora', eu concordo (i) com os termos de uso e regras do evento denominado Dreamfest 25 - Mega Festivalk Geek e estou ciente da Política de Privacidade e que sou maior de idade ou autorizado e acompanhado por um tutor legal.</p>

            <hr>
            <p class="mt-0 mb-0">MUNDO DREAM EVENTOS E PRODUCOES LTDA © 2024 - Todos os direitos reservados</p>
            <p class="mt-0 mb-0">21.812.142/0001-23</p>
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