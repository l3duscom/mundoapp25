<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />
<style>
    /* Style the tab */
    .tab {
        overflow: hidden;
        padding: 0;
        border-radius: 5px;
        border: 1px solid #CCCCCC;
        background-color: #ffffff;
        font-size: 20px;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
        background-color: #ffffff;
        color: #333;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-weight: 500;

    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        color: #FFFFFF;
        background-color: purple;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        color: #FFFFFF;
        background-color: purple;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;


    }

    .tabcontent {
        animation: fadeEffect 1s;
        /* Fading effect takes 1 second */
    }

    /* Go from zero to full opacity */
    @keyframes fadeEffect {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }



    /* Estilos para dispositivos móveis */
    @media screen and (max-width: 768px) {
        .tab button {
            width: 50%;
        }
    }

    html {
        scroll-behavior: smooth;
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



<h5 class="mb-0 mt-3">Quais ingressos você deseja?</h5>


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
                                $produto = $items[$idProduto];
                                if (isset($_SESSION['carrinho'][$idProduto])) {
                                    if ($_SESSION['carrinho'][$idProduto]['quantidade'] > 0) {
                                        $_SESSION['carrinho'][$idProduto]['quantidade']--;
                                    } else {
                                        unset($_SESSION['carrinho'][$idProduto]);
                                    }
                                }
                            }
                        }


                        ?>
                        <?php $total_carrinho = 0; ?>


                        <!-- Tab links -->
                        <div class="tab">
                            <button class="tablinks" onclick="openCategoria(event, 'sabado')" id="defaultOpen">Sábado<p class="mb-0" style="font-size: 11px">6 de dezembro</p></button>
                            <button class="tablinks" onclick="openCategoria(event, 'domingo')">Domingo<p class="mb-0" style="font-size: 11px">7 de dezembro</p></button>
                            <button class="tablinks" onclick="openCategoria(event, 'passaporte')">2 Dias<p class="mb-0" style="font-size: 11px">6,7 de dezembro</p></button>
                            <button class="tablinks" onclick="openCategoria(event, 'epic')">EPIC PASS<p class="mb-0" style="font-size: 11px">Experiência Épica</p></button>
                            <button class="tablinks" onclick="openCategoria(event, 'vip')">VIP FULL<p class="mb-0" style="font-size: 11px">Experiência Máxima</p></button>
                            <button class="tablinks" onclick="openCategoria(event, 'cosplay')">Cosplayer<p class="mb-0" style="font-size: 11px">Promocional</p></button>
                        </div>
                        <div class="d-grid gap-2 mb-0" style="padding:10px">
                            <a class="btn btn-light" href="#pagar">
                                <!-- <i class="bi bi-arrow-down-circle-fill" style="font-size: 25px; color: purple;"></i>-->
                                <strong><i class='bx bx-down-arrow-circle'></i> Ver detalhes da compra</strong>
                            </a>
                        </div>
                        <!-- Tab content -->
                        <div id="sabado" class="tabcontent">

                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do Dreamfest 25 Parte 2 - Mega Convenção Geek <strong>somente no sábado </strong>, dia 6/12/2025 das 11h às 20h</p>
                            <p>Você receberá uma credencial exclusiva e colecionável que deverá ser apresentada na entrada e na saída do festival e sempre que for requisitada. Você terá direito à entrar e sair do evento sempre que quiser!</p>

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>

                            <?php foreach ($items as $key => $value) : ?>
                                <?php if (($value['categoria'] == 'comum' || $value['categoria'] == 'premium') && $value['tipo'] == 'individual' && $value['dia'] == 'sab') : ?>
                                    <div class="card border border-muted" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?> </strong><br>
                                                    <span class="text-muted" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20"><strong style="font-size: 20px;"><a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style=" padding-right: 4px;"></i></a> <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?> <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a></strong></div>

                                                        <div class="col-12 text-right ol-4 mt-2"><span style=" font-size: 12px;">R$ </span><strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal;font-size: 26px;"> <?= number_format($value['preco'], 2, ',', ''); ?> </strong>
                                                            <p class="text-muted" style="font-size: 10px">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' Taxa de ingresso' : ' Taxa de ingresso' ?> <a href="?adicionar=<?= $key ?>"> </a></p>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>

                        <div id="domingo" class="tabcontent">
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do Dreamfest 25 Parte 2 - Mega Convenção Geek <strong>somente no domingo </strong>, dia 7/12/2025 das 11h às 20h</p>
                            <p>Você receberá uma credencial exclusiva e colecionável que deverá ser apresentada na entrada e na saída do festival e sempre que for requisitada. Você terá direito à entrar e sair do evento sempre que quiser!</p>

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>

                            <?php foreach ($items as $key => $value) : ?>
                                <?php if (($value['categoria'] == 'comum' || $value['categoria'] == 'premium')  && $value['tipo'] == 'individual' && $value['dia'] == 'dom') : ?>
                                    <div class="card border border-muted" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?> </strong><br>
                                                    <span class="text-muted" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20"><strong style="font-size: 20px;"><a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style=" padding-right: 4px;"></i></a> <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?> <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a></strong></div>

                                                        <div class="col-12 text-right ol-4 mt-2"><span style=" font-size: 12px;">R$ </span><strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal;font-size: 26px;"> <?= number_format($value['preco'], 2, ',', ''); ?> </strong>
                                                            <p class="text-muted" style="font-size: 10px">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' Taxa de ingresso' : ' Taxa de ingresso' ?> <a href="?adicionar=<?= $key ?>"> </a></p>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>


                        <div id="passaporte" class="tabcontent">

                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do Dreamfest 25 - Mega Convenção Geek <strong>nos dois dias de evento</strong>, das 11 às 20h</p>
                            <p>Você receberá uma credencial exclusiva e colecionável que deverá ser apresentada na entrada e na saída do festival e sempre que for requisitada. Você terá direito à entrar e sair do evento sempre que quiser!</p>

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>

                            <?php foreach ($items as $key => $value) : ?>
                                <?php if (($value['categoria'] == 'comum' || $value['categoria'] == 'premium') && $value['tipo'] == 'combo') : ?>
                                    <div class="card border border-muted" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?> </strong><br>
                                                    <span class="text-muted" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20"><strong style="font-size: 20px;"><a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style=" padding-right: 4px;"></i></a> <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?> <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a></strong></div>

                                                        <div class="col-12 text-right ol-4 mt-2"><span style=" font-size: 12px;">R$ </span><strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal;font-size: 26px;"> <?= number_format($value['preco'], 2, ',', ''); ?> </strong>
                                                            <p class="text-muted" style="font-size: 10px">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' Taxa de ingresso' : ' Taxa de ingresso' ?> <a href="?adicionar=<?= $key ?>"> </a></p>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>


                        <div id="epic" class="tabcontent">
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do Dreamfest 25 - Mega Convenção Geek nos dias selecionados.</p>
                            <p>Você receberá uma kit colecionável com Credencial, Pulseira, Cordão, Pôster e Guia do evento! A Credencial e Pulseira deverão ser apresentados na entrada e na saída do festival e sempre que for requisitada. Você terá direito à entrar e sair do evento sempre que quiser!</p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#vip-fanModal" class="btn btn-outline-secondary w-100 mt-0" style="margin-right: 5px;">O que está incluso nesse ingresso? </a>

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>

                            <?php foreach ($items as $key => $value) : ?>
                                <?php if ($value['categoria'] == 'epic') : ?>
                                    <div class="card border border-muted" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?> </strong><br>
                                                    <span class="text-muted" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20"><strong style="font-size: 20px;"><a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style=" padding-right: 4px;"></i></a> <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?> <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a></strong></div>

                                                        <div class="col-lg-8 col-sm-6 text-muted"><?= $value['descricao'] ?></div>
                                                        <div class="col-lg-4 col-sm-6  text-right ol-4" style="padding-left: 60px; "><span style="font-size: 12px;">R$ </span><strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal;font-size: 26px;"> <?= number_format($value['preco'], 2, ',', ''); ?> </strong>
                                                            <p class="text-muted" style="font-size: 12px">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' Taxa de ingresso' : ' Taxa de ingresso' ?> <a href="?adicionar=<?= $key ?>"> </a></p>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>

                        <div id="vip" class="tabcontent">
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do Dreamfest 25 - Mega Convenção Geek nos dias selecionados.</p>
                            <p>Você receberá uma kit colecionável com Credencial, Pulseira, Cordão, Pôster, Copo, Ingresso holográfico e Guia do evento! A Credencial e Pulseira deverão ser apresentados na entrada e na saída do festival e sempre que for requisitada. Você terá direito à entrar e sair do evento sempre que quiser!</p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#vip-fullModal" class="btn btn-outline-secondary w-100 mt-0" style="margin-right: 5px;">O que está incluso nesse ingresso? </a>

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
                                <?php if ($value['categoria'] == 'vip') : ?>
                                    <div class="card border border-muted" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?> </strong><br>
                                                    <span class="text-muted" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20"><strong style="font-size: 20px;"><a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style=" padding-right: 4px;"></i></a> <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?> <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a></strong></div>
                                                        <div class="col-12 text-right ol-4 mt-2"><span style=" font-size: 12px;">R$ </span><strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal;font-size: 26px;"> <?= number_format($value['preco'], 2, ',', ''); ?> </strong>
                                                            <p class="text-muted" style="font-size: 10px">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' Taxa de ingresso' : ' Taxa de ingresso' ?> <a href="?adicionar=<?= $key ?>"> </a></p>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Quem pode comprar? </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>

                        <div id="cosplay" class="tabcontent">
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do Dreamfest 25 - Mega Festival Geek nos dias selecionados.</p>
                            <p>Você receberá uma pulseira colecionável COSPLAYER que deverá ser apresentada na entrada e na saída do festival e sempre que for requisitada. Vvocê terá direito à entrar e sair do evento sempre que quiser!</p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#cosplayerModal" class="btn btn-outline-secondary w-100 mt-0" style="margin-right: 5px;">O que está incluso nesse ingresso? </a>

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>

                            <?php foreach ($items as $key => $value) : ?>
                                <?php if ($value['categoria'] == 'cosplay') : ?>
                                    <div class="card border border-muted" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?> </strong><br>
                                                    <span class="text-muted" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20"><strong style="font-size: 20px;"><a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style=" padding-right: 4px;"></i></a> <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?> <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a></strong></div>

                                                        <div class="col-12 text-right ol-4 mt-2"><span style=" font-size: 12px;">R$ </span><strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal;font-size: 26px;"> <?= number_format($value['preco'], 2, ',', ''); ?> </strong>
                                                            <p class="text-muted" style="font-size: 10px">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' Taxa de ingresso' : ' Taxa de ingresso' ?> <a href="?adicionar=<?= $key ?>"> </a></p>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3">
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
                            <p style="padding-top: 20px;">Este ingresso dá direito a participar do Dreamfest 25 - Mega Festival Geek nos dias selecionados.</p>
                            <p>Você receberá uma credencial exclusiva e colecionável que deverá ser apresentada na entrada e na saída do festival e sempre que for requisitada. Você terá direito à entrar e sair do evento sempre que quiser!</p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#cosplayerModal" class="btn btn-outline-secondary w-100 mt-0" style="margin-right: 5px;">O que está incluso nesse ingresso? </a>

                            <hr>
                            <div class="mb-0 mt-3 font-24" style="color: #333;">Selecione seu ingresso </div>
                            <p>Apenas a promoção de maior desconto será aplicada ao final do carrinho.</p>

                            <?php foreach ($items as $key => $value) : ?>
                                <?php if ($value['categoria'] == 'mae') : ?>
                                    <div class="card border border-muted" data-item-id="<?= $key ?>">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong class="item-name" style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?> </strong><br>
                                                    <span class="text-muted" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                    <?php if ($value['estoque'] > 0) : ?>
                                                        <div class="col-12 mt-3 font-20"><strong style="font-size: 20px;"><a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style=" padding-right: 4px;"></i></a> <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?> <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a></strong></div>

                                                        <div class="col-12 text-right ol-4 mt-2"><span style=" font-size: 12px;">R$ </span><strong class="item-price" data-price="<?= $value['preco'] ?>" style="word-wrap: normal;font-size: 26px;"> <?= number_format($value['preco'], 2, ',', ''); ?> </strong>
                                                            <p class="text-muted" style="font-size: 10px">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' Taxa de ingresso' : ' Taxa de ingresso' ?> <a href="?adicionar=<?= $key ?>"> </a></p>
                                                        </div>
                                                    <?php else : ?>
                                                        <strong style="color: red;">ESGOTADO</strong>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-11 mt-3">
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





                    <!--
                        <div class=" mt-1"></div>
                        <div class="d-flex align-items-center">
                            <div class="card shadow-none w-100">
                                <div class="card-body shadow">
                                    <div class="">
                                        <h4 class="mb-0">Como você quer receber seus ingressos? </h4>
                                    </div>
                                    <div class="row" style="padding: 10px;">
                                        <div class="col-lg-6">
                                            s
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    -->





                    <div class="" style="padding: 5px;">

                        <?php if (isset($_SESSION['carrinho'])) : ?>


                            <?php foreach ($_SESSION['carrinho'] as $key => $value) : ?>

                                <?php

                                $total_carrinho += $value['quantidade'] * $value['preco'];

                                ?>

                            <?php endforeach; ?>

                        <?php endif; ?>

                        <?php $_SESSION['total'] = $total_carrinho ?>

                    </div>




                    <?php $total_carrinho = 0; ?>
                    <?php $total_taxa = 0; ?>


                    <div id="pagar" class="mt-2"></div>



                    <?php if ($_SESSION['total'] != 0) : ?>
                        <div class="card card-body">

                            <?php if (isset($_SESSION['carrinho'])) : ?>
                                <table class="table mb-0 table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="40%">Ingresso</th>
                                            <th scope="col" width="20%" style="align-items:center">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Quantidade
                                            </th>
                                            <th scope="col" width="40%">Valor </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($_SESSION['carrinho'] as $key => $value) : ?>
                                            <?php if ($value['quantidade'] != 0) : ?>
                                                <tr>
                                                    <td><u><?= $value['nome']; ?></u></td>
                                                    <td style="padding-left: 25px;"><a href="?excluir=<?= $key ?>"><i class="fadeIn animated bx bx-minus-circle" style="padding-right: 10px;"></i></a><?= $value['quantidade']; ?> <a href="?adicionar=<?= $key ?>"><i class="fadeIn animated bx bx-plus-circle" style="padding-left: 10px"></i></a></td>
                                                    <td>R$ <strong><?= number_format($value['quantidade'] * $value['unitario'], 2, ',', ''); ?></strong><span style="font-size: 12px;"><br> + R$ <?= number_format($value['quantidade'] * $value['taxa'], 2, ',', ''); ?> taxa de ingresso</span> </td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php

                                            $total_carrinho += $value['quantidade'] * $value['preco'];
                                            $total_taxa += $value['quantidade'] * $value['taxa'];

                                            ?>

                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <center>
                                            <i class="fadeIn animated bx bx-error-circle"></i><br>Oooops, seu carrinho está vazio, escolha um ingresso e venha viver a magia no Dreamfest!
                                            <hr>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Adicionar ingressos</button>
                                            <hr>
                                        </center>
                                        </hr>
                                    <?php endif; ?>

                                    <?php $_SESSION['total'] = $total_carrinho ?>
                                    </tbody>
                                </table>


                        </div>






                        <div class="fixed-bottom bg-white shadow-lg">
                            <div class="d-grid gap-2 mb-0" style="padding:10px">
                                <a class="btn btn-sm btn-light" href="#pagar">
                                    <!-- <i class="bi bi-arrow-down-circle-fill" style="font-size: 25px; color: purple;"></i>-->
                                    <strong><i class='bx bx-down-arrow-circle'></i> Ver detalhes da compra</strong>
                                </a>
                                <center><span style="padding-top: 5px; margin-bottom: -5px">Total a pagar: <strong>R$ <?= number_format($_SESSION['total'], 2, ',', '')  ?></strong></span> </center>

                                <a href="<?= site_url('/evento/entrega/'. $event_id) ?>" class="btn btn-lg mt-0" style="padding:10px; background-color: purple; border-color: purple; color: white;"> Ir para o pagamento <i class='bx bx-right-arrow-circle'></i></a>

                            </div>
                        </div>
                        <?php echo form_close(); ?>


                    <?php endif ?>

                    <center>
                        <span class="text-muted mb-1" style="font-size: 9px;">Processado por:</span><br>
                                                    <img class="mt-1 mb-4" src="<?php echo site_url('recursos/front/images/asaas.png'); ?>" width="100px" height="auto">
                    </center>
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
                                <h5 class="mb-0">Compra segura
                                    </h4>
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
                            <?php if ($value['categoria'] == 'epic') : ?>
                                <div class="card border border-muted">
                                    <div class="form-check mt-3 mb-3">
                                        <div class="row ">
                                            <div class="col-6 mb-2">
                                                <span style="color: #6C038F">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                <strong class="font-20" style="color: #6C038F"><?= $value['nome'] ?> </strong><br>
                                                <span class="text-muted"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>
                                            </div>
                                            <?php if ($value['estoque'] > 0) : ?>
                                                <div class="col-5 mt-4 font-20 d-flex flex-row-reverse"><strong style="font-size: 24px;"><a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style=" padding-right: 10px;"></i></a> <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?> <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 10px"></i></a></strong></div>

                                                <div class="col-lg-8 col-sm-6 text-muted"><?= $value['descricao'] ?></div>
                                                <div class="col-lg-4 col-sm-6  text-right ol-4" style="padding-left: 60px; "><span style="font-size: 12px;">R$ </span><strong style="word-wrap: normal;font-size: 26px;"> <?= number_format($value['preco'], 2, ',', ''); ?> </strong>
                                                    <p class="text-muted" style="font-size: 12px">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' Taxa de ingresso' : ' Taxa de ingresso' ?> <a href="?adicionar=<?= $key ?>"> </a></p>
                                                </div>
                                            <?php else : ?>
                                                <strong style="color: red;">ESGOTADO</strong>
                                            <?php endif; ?>
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
    function openCategoria(evt, categoria) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(categoria).style.display = "block";
        evt.currentTarget.className += " active";
    }

    document.getElementById("defaultOpen").click();
</script>




<?php echo $this->endSection() ?>