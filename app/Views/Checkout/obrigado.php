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

?>

<?php
$event_id = session()->get('event_id');
?>

<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <div class="block-body">
                <div class="card shadow radius-10">
                    <div class="card-body">




                      <!-- Exibirá os retornos do backend -->
                      <div id="response">


</div>


                        <div style="padding-left: 30px; padding-right: 30px;padding-top: 5px">
                            <center>
                                <i class="bx bx-check-circle" style="font-size: 80px; color:green"></i>
                                <p>Parabéns! Sua compra foi realizada com sucesso!, <strong>mas não feche essa página, você vai amar as novidades!</strong> <span style="font-size: 14px; color: red">Os emails de dado de acesso são enviados automaticamente, porém, notamos uma demora no envio para caixas do GMAIL. </span></p>
                                <hr>
                                <h3>Compre o FAST PASS e faça algo muito feio: <strong style="color: orangered">FURE A FILA</strong></h3>
                                <p>Chega de filas e de perder o tempo! Com o Fast Pass, você fura a fila das ativações próprias do Dream25 e garante acesso prioritário ao <strong> PALCO MUNDO, que tem lugares LIMITADOS,</strong> pra não perder a apresentação de nenhum dos seus ídolos!</p>
                               
                            </center>
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
                                        'preco' => $produto['preco'],
                                        'tipo' => $produto['tipo'],
                                        'taxa' => 0,
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
                     

                        <?php foreach ($items as $key => $value) : ?>
                                <?php if ($value['tipo'] == 'produto') : ?>
                                    <div class="card border border-muted">
                                        <div class="form-check mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-7">
                                                    <span style="color: purple; font-size: 10px">Finaliza em: <?= date('d/m/Y', strtotime($value['data_lote'])) ?> </span><br>
                                                    <strong style="color: #6C038F; font-size: 16px"><?= $value['nome'] ?> </strong><br>
                                                    <span class="text-muted" style="font-size: 10px"><strong><?= $value['tipo'] ?> - <?= $value['lote'] ?> lote</strong></span>


                                                </div>
                                                <div class="col-5 text-right">
                                                        <div class="col-12 mt-3 font-20"><strong style="font-size: 20px;"><a href="?excluir=<?= $key ?>"><i class="bi bi-dash-circle-fill" style=" padding-right: 4px;"></i></a> <?= (isset($_SESSION['carrinho'][$key]['quantidade'])) ? $_SESSION['carrinho'][$key]['quantidade'] : '0' ?> <a href="?adicionar=<?= $key ?>"><i class="bi bi-plus-circle-fill" style="padding-left: 4px"></i></a></strong></div>

                                                        <div class="col-12 text-right ol-4 mt-2"><span style=" font-size: 12px;">R$ </span><strong style="word-wrap: normal;font-size: 26px;"> <?= number_format($value['preco'], 2, ',', ''); ?> </strong>
                                                            <p class="text-muted" style="font-size: 10px">+ <?= (isset($_SESSION['carrinho'][$key]['taxa'])) ? 'R$ ' . number_format($_SESSION['carrinho'][$key]['taxa'], 2, ',', '') . ' Taxa' : ' Taxa' ?> <a href="?adicionar=<?= $key ?>"> </a></p>
                                                        </div>
                                                  
                                                </div>
                                                <div class="col-11 mt-3">
                                                    <strong style="font-size: 13px;" class="mt-5"><i class='bx bx-info-circle'></i> Descrição </strong>
                                                    <div class="text-muted mt-1" style="font-size: 11px;"><?= $value['descricao'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>


                            <div style="padding-left: 30px; padding-right: 30px; padding-bottom: 30px; padding-top: 5px">
                            <center>

                                <p>O Universo mágico do Dreamfest está te esperando! <strong>Sua compra foi realizada com sucesso e seus ingressos já estão disponíveis no link abaixo!</strong> O comprovante foi enviado para seu email e você deve favoritar esse email para não perder nenhum detalhe!</p>
                                <a href="<?= site_url('/console/dashboard/') ?>" class="btn btn-lg btn-primary mt-0 shadow">Ver meus ingressos</a>
                                <p style="padding-top: 15px"><a href="https://indigoneo.com.br/pt/booking/999901058" target="_blank" style="color: black; text-decoration-line: underline">Comprar <strong>estacionamento</strong> com desconto | CUPOM: 06CEPUC25</a></p>
                                <hr>
                                <p style="padding-top: 5px"><strong>Essa é sua primeira compra de ingressos para o Dream?</strong> Fique ligado! Você receberá <strong>automaticamente uma senha de acesso em seu email!</strong> Ao receber o email (confira no spam), favorite o mesmo para não perder nenhum detalhe da sua participação!</p>

                                <p>Use seu e-mail para acessar seu ingresso! </p>
                                <hr class="mt-5">
                                
                            </center>


                        </div>

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

                                <a href="<?= site_url('/evento/entrega') ?>" class="btn btn-lg mt-0" style="padding:10px; background-color: purple; border-color: purple; color: white;"> Ir para o pagamento <i class='bx bx-right-arrow-circle'></i></a>

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
    </div>


</div>

<div class="row" style="padding-left: 20px; padding-right: 20px">
    <div class="col-8">
        <div class="text-muted" style="font-size: 11px; ">
            <p class="mb-0"><strong>Precisa de ajuda? </strong><a href="#" target="_blank">Entre em contato</a></p>
            <p class="mt-0 mb-0">* O valor parcelado (acima de 3 parcelas) possui acréscimo.</p>
            <p class="mt-0 mb-0"><strong>Meia entrada solidária </strong> (50% de desconto) disponível para qualquer pessoa que levar 1kg de alimento não perecível no dia do evento.</p>
            <p class="mt-0 mb-0">Ao clicar em 'Comprar agora', eu concordo (i) com os termos de uso e regras do evento denominado Dreamfest 23 - Mega Festivalk Geek e estou ciente da Política de Privacidade e que sou maior de idade ou autorizado e acompanhado por um tutor legal.</p>

            <hr>
            <p class="mt-0 mb-0">L & M SOLUCOES EM EVENTOS E CONVENCOES DE CULTURA POP LTDA © 2023 - Todos os direitos reservados</p>
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




        $("#form").on('submit', function(e) {


            e.preventDefault();


            $.ajax({

                type: 'POST',
                url: '<?php echo site_url('checkout/finalizar'); ?>',
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
                                "<?php echo site_url("checkout/qrcode/"); ?>" + response.id;

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
</script>


<?php echo $this->endSection() ?>