<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />


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
?>





<div class="row">
    <div class="col-lg-8">
        <div class="block">
            <div class="block-body">
                <div class="card shadow radius-10">
                    <div class="card-body">



                        <!-- Exibirá os retornos do backend -->
                        <div id="response">


                        </div>


                        <?php
                        $items = array(

                            ['tipo' => 'individual', 'modal' => 'comum', 'imagem' => 'recursos/front/images/ingressos/individual-35-sabado.png', 'nome' => 'Ingresso Comum SÁBADO - Meia e meia solidária | Lote 1', 'preco' => '37.49'],
                            ['tipo' => 'individual', 'modal' => 'comum', 'imagem' => 'recursos/front/images/ingressos/individual-35.png', 'nome' => 'Ingresso Comum DOMINGO - Meia e meia solidária | Lote 1', 'preco' => '37.49'],
                            ['tipo' => 'combo', 'modal' => 'comum', 'imagem' => 'recursos/front/images/ingressos/individual-35-combo.png', 'nome' => 'Ingresso Comum COMBO 2 DIAS - Meia e meia solidária | Lote 1', 'preco' => '63.73'],
                            ['tipo' => 'individual', 'modal' => 'vip-fan', 'imagem' => 'recursos/front/images/ingressos/vip-fan.png', 'nome' => 'Ingresso VIP FAN', 'preco' => '115.00'],
                            ['tipo' => 'individual', 'modal' => 'vip-full', 'imagem' => 'recursos/front/images/ingressos/vip-full.png', 'nome' => 'Ingresso VIP FULL', 'preco' => '195.00'],
                            ['tipo' => 'individual', 'modal' => 'clube', 'imagem' => 'recursos/front/images/ingressos/clube.png', 'nome' => 'DreamClub', 'preco' => '97.49'],
                            ['tipo' => 'individual', 'modal' => 'inteira', 'imagem' => 'recursos/front/images/ingressos/individual-70-sabado.png', 'nome' => 'Ingresso Comum SÁBADO', 'preco' => '74.98'],
                            ['tipo' => 'individual', 'modal' => 'inteira', 'imagem' => 'recursos/front/images/ingressos/individual-70.png', 'nome' => 'Ingresso Comum DOMINGO', 'preco' => '74.98'],
                            ['tipo' => 'combo', 'modal' => 'inteira', 'imagem' => 'recursos/front/images/ingressos/individual-70-combo.png', 'nome' => 'Ingresso Comum COMBO 2 DIAS', 'preco' => '127.46'],



                        );


                        ?>


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
                        <div class="d-flex align-items-center">
                            <div class="card shadow-none w-100">
                                <div class="card-body shadow">
                                    <div class="d-flex align-items-center ">
                                        <div class="">
                                            <h4 class="mb-0">Adicione mais experiências ao seu dia mágico! </h4>
                                            <p class="mb-0 text-muted" style="font-size: 14px">Monte seu passaporte para a diversão e ainda ajude <?php if ($_SESSION['convite'] !== 0) : ?>
                                                    <strong style="color:blueviolet"><?= $influencer ?></strong>
                                                <?php endif ?>
                                                comprando seu ingresso agora mesmo!
                                            </p>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>


                        <span></span>
                        <div class=" row" style="padding: 10px;">
                            <?php foreach ($items as $key => $value) : ?>
                                <div class="col-lg-4" style="padding: 5px;">
                                    <a href="?adicionar=<?= $key ?>"><img src="<?php echo site_url($value['imagem']); ?>" alt="" width="100%" height="auto"></a>
                                    <p style="text-align: right; margin-top: -5px;"><a href="#" data-bs-toggle="modal" data-bs-target="#<?= $value['modal'] ?>Modal"><u>+ detalhes</u></a> </p>
                                    <hr>
                                </div>


                                <!-- Modal -->


                            <?php endforeach; ?>
                        </div>


                        <?php
                        if (isset($_GET['adicionar'])) {
                            $idProduto = (int) $_GET['adicionar'];
                            if (isset($items[$idProduto])) {
                                if (isset($_SESSION['carrinho'][$idProduto])) {
                                    $_SESSION['carrinho'][$idProduto]['quantidade']++;
                                } else {
                                    $_SESSION['carrinho'][$idProduto] = array('quantidade' => 1, 'nome' => $items[$idProduto]['nome'], 'preco' => $items[$idProduto]['preco'], 'tipo' => $items[$idProduto]['tipo']);
                                }
                            }
                        }

                        if (isset($_GET['excluir'])) {
                            $idProduto = (int) $_GET['excluir'];
                            if (isset($items[$idProduto])) {
                                if (isset($_SESSION['carrinho'][$idProduto])) {
                                    if ($_SESSION['carrinho'][$idProduto]['quantidade'] > 0) {
                                        $_SESSION['carrinho'][$idProduto]['quantidade']--;
                                    } else {
                                        $_SESSION['carrinho'][$idProduto]['quantidade'] = 0;
                                    }
                                }
                            }
                        }


                        ?>
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

                        <?php $total_carrinho = 0; ?>
                        <div class="" style="padding: 5px;">
                            <?php if (isset($_SESSION['carrinho'])) : ?>
                                <table class="table mb-0 table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="45%">Ingresso</th>
                                            <th scope="col" width="30%">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Quantidade
                                            </th>
                                            <th scope="col" width="25%">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($_SESSION['carrinho'] as $key => $value) : ?>
                                            <?php if ($value['quantidade'] != 0) : ?>
                                                <tr>
                                                    <td><u><?= $value['nome']; ?></u></td>
                                                    <td> <a class="btn btn-sm" href="?adicionar=<?= $key ?>"><i class="bx bx-plus"></i> </a> <?= $value['quantidade']; ?> <a class="btn btn-sm" href="?excluir=<?= $key ?>"><i class="bx bx-minus"></i> </a></td>
                                                    <td>R$ <?= $value['quantidade'] * $value['preco']; ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php

                                            $total_carrinho += $value['quantidade'] * $value['preco'];

                                            ?>

                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <center>
                                            <i class="fadeIn animated bx bx-error-circle"></i><br>Oooops, seu carrinho está vazio, escolha um ingresso e venha viver a magia no Dreamfest!
                                        </center>
                                        </hr>
                                    <?php endif; ?>

                                    <?php $_SESSION['total'] = $total_carrinho ?>
                                    </tbody>
                                </table>
                        </div>









                        <div class="d-flex align-items-center">
                            <div class="card shadow-none w-100">
                                <div class="card-body  shadow">
                                    <div class="d-flex align-items-center ">
                                        <div class="">
                                            <h4 class="mb-0">Ingressos </h4>
                                            <p class="mb-0 text-muted" style="font-size: 11px">Dreamfest 23 - Mega Festival Geek</p>
                                            <p class="mb-0 text-muted" style="font-size: 11px">10 e 11 de Junho de 2023 - <strong>Lote 1</strong></p>
                                        </div>
                                        <div class="ms-auto fs-3 mb-0 text-muted">

                                        </div>

                                        <div class="ms-auto fs-3 mb-0">
                                            <p class="mb-0" style="font-size: 10px;">Total a pagar:</p>
                                            <strong>R$ <?= $_SESSION['total'] ?></strong>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($_SESSION['total'] != 0) : ?>
                            <div id="areaBotoes" class="row g-3">
                                <div class="col-lg-4">
                                    <a href="<?= site_url('/checkout/cartao') ?>" class="w-100 btn btn-primary btn-lg "><span class="text-white" style="font-size: 12px;">Pagar com:</span><i class="bi bi-credit-card-fill me-2 font-16"></i>Cartão</a>
                                </div>
                                <div class="col-lg-4">
                                    <a href="<?= site_url('/checkout/pix') ?>" class="w-100 btn btn-primary btn-lg "><span class="text-white" style="font-size: 12px;">Pagar com:</span><i class="fa-brands fa-pix"></i> PIX <span class="badge bg-warning text-dark font-13" style="margin-left: 7px;">5% OFF</span></a>
                                </div>
                                <div class="col-lg-4">
                                    <a href="<?= site_url('/checkout/boleto') ?>" class="w-100 btn btn-primary btn-lg disabled"><span class="text-white" style="font-size: 12px;">Pagar com:</span><i class="bx bx-barcode-reader me-2 font-24"></i>Boleto</a>
                                </div>

                            </div>
                            <hr>
                            <center>
                                <span class="text-muted mb-5" style="font-size: 12px;">Processado por:</span><br>
                                <img class="mt-1" src="https://asaas.com/assets/home3/header-logo-blue.svg">
                            </center>
                        <?php endif ?>
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
                                    <td style="color:#ffcc00; font-size: 22px" itle="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
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
                                    <th scope="row">Acesso ao evento dia de evento escolhido</th>
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
                                    <td style="color:#ffcc00; font-size: 22px" itle="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
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
<div class="modal fade" id="pucModal" tabindex="-1" aria-labelledby="pucModallLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pucModalLabel">Se liga nas vantagens!</h5>

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
                                </strong> Desconto exclusivo para alunos e funcionários da rede, incluindo PUCRS e MARISTA.
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
                                    <th scope="row">Acesso ao evento (domingo) das 10 às 20</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="color:grey">Acesso à Spoiler Night (sábado) das 20 às 22</th>
                                    <td style="color:grey; font-size: 22px"><i class="fadeIn animated bx bx-x"></i></td>
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
                                    <td style="color:#ffcc00; font-size: 22px" itle="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
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
                                    <th scope="row">Acesso ao evento no dia escolhido</th>
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
                                    <td style="color:#ffcc00; font-size: 22px" itle="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
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
                                </strong> O KIT VIP é composto por 1 ingresso já com desconto de meia entrada + KIT de benefícios VIP, conforme sua categoria.
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
                                    <th scope="row">Acesso ao evento (sábado) das 11 às 19</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Acesso ao evento (domingo) das 10 às 20</th>
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
                                    <th scope="row">Meet & Greet</th>
                                    <td style="color:#ffcc00; font-size: 22px" itle="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
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
                                </strong> O KIT VIP é composto por 1 ingresso já com desconto de meia entrada + KIT de benefícios VIP, conforme sua categoria.
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
                                    <th scope="row">Fila preferencial (Entrada e Food Park)</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Acesso ao evento (sábado) das 11 às 19</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Acesso ao evento (domingo) das 10 às 20</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">Descontos de até 30% de desconto em lojinhas durante o evento!</th>
                                    <td style="color:green; font-size: 22px"><i class="fadeIn animated bx bx-check-circle"></i></td>
                                </tr>
                                <tr>
                                    <th scope="row">HOTZONE - Espaço reservado nas primeiras fileiras do palco principal durante TODO o evento!</th>
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
                                    <th scope="row">Meet & Greet</th>
                                    <td style="color:#ffcc00; font-size: 22px" itle="Pago separadamente"><i class="fadeIn animated bx bx-dollar-circle"></i></td>
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

                <?php $total_carrinho = 0; ?>
                <div class="" style="padding: 5px;">
                    <?php if (isset($_SESSION['carrinho'])) : ?>
                        <table class="table mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="45%">Ingresso</th>
                                    <th scope="col" width="30%" style="align-items:center">
                                        &nbsp;&nbsp;&nbsp;&nbsp;Quantidade
                                    </th>
                                    <th scope="col" width="25%">Valor</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($_SESSION['carrinho'] as $key => $value) : ?>
                                    <?php if ($value['quantidade'] != 0) : ?>
                                        <tr>
                                            <td><u><?= $value['nome']; ?></u></td>
                                            <td> <a class="btn btn-sm" href="?adicionar=<?= $key ?>"><i class="bx bx-plus"></i> </a> <?= $value['quantidade']; ?> <a class="btn btn-sm" href="?excluir=<?= $key ?>"><i class="bx bx-minus"></i> </a></td>
                                            <td><strong>R$ <?= $value['quantidade'] * $value['preco']; ?></strong></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php

                                    $total_carrinho += $value['quantidade'] * $value['preco'];

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
                <div class="d-flex align-items-center">
                    <div class="card shadow-none w-100">
                        <div class="card-body  shadow">
                            <div class="d-flex align-items-center ">
                                <div class="">
                                    <h4 class="mb-0">Ingressos </h4>
                                    <p class="mb-0 text-muted" style="font-size: 11px">Dreamfest 23 - Mega Festival Geek</p>
                                    <p class="mb-0 text-muted" style="font-size: 11px">10 e 11 de Junho de 2023 - <strong>Lote 1</strong></p>
                                </div>
                                <div class="ms-auto fs-3 mb-0 text-muted">

                                </div>

                                <div class="ms-auto fs-3 mb-0">
                                    <p class="mb-0" style="font-size: 10px;">Total a pagar:</p>
                                    <strong>R$ <?= $_SESSION['total'] ?></strong>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($_SESSION['total'] != 0) : ?>
                    <div id="areaBotoes" class="row g-3">
                        <div class="col-lg-4">
                            <a href="<?= site_url('/checkout/cartao') ?>" class="w-100 btn btn-primary btn-lg "><span class="text-white" style="font-size: 12px;">Pagar com:</span><i class="bi bi-credit-card-fill me-2 font-16"></i>Cartão</a>
                        </div>
                        <div class="col-lg-4">
                            <a href="<?= site_url('/checkout/pix') ?>" class="w-100 btn btn-primary btn-lg "><span class="text-white" style="font-size: 12px;">Pagar com:</span><i class="fa-brands fa-pix"></i> PIX <span class="badge bg-warning text-dark font-13" style="margin-left: 7px;">5% OFF</span></a>
                        </div>
                        <div class="col-lg-4">
                            <a href="<?= site_url('/checkout/boleto') ?>" class="w-100 btn btn-primary btn-lg disabled"><span class="text-white" style="font-size: 12px;">Pagar com:</span><i class="bx bx-barcode-reader me-2 font-24"></i>Boleto</a>
                        </div>

                    </div>
                    <hr>
                    <center>
                        <span class="text-muted mb-5" style="font-size: 12px;">Processado por:</span><br>
                        <img class="mt-1" src="https://asaas.com/assets/home3/header-logo-blue.svg">
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

<script>
    $(document).ready(function() {

        //$("#form").LoadingOverlay("show");

        <?php echo $this->include('Clientes/_checkmail'); ?>

        <?php echo $this->include('Clientes/_viacep'); ?>


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

    $(document).ready(function() {
        $('#cartModal').modal('show');
    })
</script>




<?php echo $this->endSection() ?>