<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>



<!-- Bootstrap core CSS -->
<link href="<?php echo site_url('recursos/'); ?>/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

<!-- CDN JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>


<!-- Cole aqui o script -->
<script type='text/javascript'>
    var s = document.createElement('script');
    s.type = 'text/javascript';
    var v = parseInt(Math.random() * 1000000);
    s.src = 'https://sandbox.gerencianet.com.br/v1/cdn/f4a23657edfeb8bd4d2613b0a9aa759b/' + v;
    s.async = false;
    s.id = 'f4a23657edfeb8bd4d2613b0a9aa759b';
    if (!document.getElementById('f4a23657edfeb8bd4d2613b0a9aa759b')) {
        document.getElementsByTagName('head')[0].appendChild(s);
    };
    $gn = {
        validForm: true,
        processed: false,
        done: {},
        ready: function(fn) {
            $gn.done = fn;
        }
    };
</script>


<script src="<?php echo site_url('recursos/'); ?>/js/script-cartao.js"></script>


<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>



<div class="container">

    <header class="d-flex flex-wrap justify-content-center py-3 mb-4">
        <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <img style="height: 30px;" src="https://login.gerencianet.com.br/img/svg/logo-gerencianet-topo.svg" alt="Logo Gerencianet">
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="" class="nav-link active" aria-current="page">Início</a></li>
            <li class="nav-item"><a href="https://dev.gerencianet.com.br/docs/pagamento-com-cartao" target="_blank" class="nav-link">Documentação</a></li>
            <li class="nav-item"><a href="https://login.gerencianet.com.br/" target="_blank" class="nav-link">Login</a></li>
        </ul>

        <div class="py-5 text-center">
            <h2>Checkout - Cobrança cartão de crédito</h2>
            <p class="lead">No caso de transações com cartão de crédito, será realizada a transmissão (via
                JavaScript, no browser), de forma segura, dos dados do cartão e
                retornando um payment_token, e na segunda etapa seu backend envia o restante das informações da
                transação junto com o payment_token.</p>
        </div>
    </header>

    <main>

        <form target="_blank" class="needs-validation" id="formulario_pagamento" method="POST" action="./confirmar_pagamento.php" novalidate>
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Produtos</span>
                        <span class="badge bg-primary rounded-pill">2</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Caneca</h6>
                                <small class="text-muted">Caneca de porcelana da Gerencianet</small>

                                <!-- Nome item 1 -->
                                <input type="hidden" name="nome_item_1" id="nome_item_1" value="Caneca de porcelana da Gerencianet" required>
                            </div>
                            <span class="text-muted">1 X R$ 25,00</span>

                            <!-- Valor e quantidade item 1 -->
                            <input type="hidden" name="quantidade_item_1" id="quantidade_item_1" value="1" required>
                            <input type="hidden" name="valor_item_1" id="valor_item_1" value="2500" required>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Chaveiro</h6>
                                <small class="text-muted">Chaveiro Gerencianet</small>

                                <!-- Nome item 2 -->
                                <input type="hidden" name="nome_item_2" id="nome_item_2" value="Chaveiro Gerencianet" required>
                            </div>
                            <span class="text-muted">1 X R$ 10,00</span>

                            <!-- Valor e quantidade item 2 -->
                            <input type="hidden" name="quantidade_item_2" id="quantidade_item_2" value="1" required>
                            <input type="hidden" name="valor_item_2" id="valor_item_2" value="1000" required>
                        </li>

                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <h5>Total</h5>
                            <h5>R$ 35,00</h5>

                            <!-- Valor item 2 -->
                            <input type="hidden" name="valor_total" id="valor_total" value="3500" required>
                        </li>
                    </ul>
                </div>

                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Dados pessoais do pagador.</h4>

                    <div class="row g-3">
                        <div class="col-sm-8">
                            <label for="nome_cliente" class="form-label">Nome completo</label>
                            <input type="text" class="form-control" name="nome_cliente" id="nome_cliente" value="Gorbadoc Oldbuck" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" value="94271564656" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" value="email_do_cliente@servidor.com.br" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" value="5144916523" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-3">
                            <label for="nascimento" class="form-label">Data de nascimento</label>
                            <input type="text" class="form-control" name="nascimento" id="nascimento" value="29081990" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <hr class="my-4">
                        <h4 class="mb-3">Endereço de cobrança</h4>

                        <div class="col-5">
                            <label for="rua" class="form-label">Rua</label>
                            <input type="text" class="form-control" name="rua" id="rua" value="Avenida Juscelino Kubitschek" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-2">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control" name="numero" id="numero" value="909" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control" name="bairro" id="bairro" value="Bauxita" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" name="cep" id="cep" value="35400000" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control" name="cidade" id="cidade" value="Ouro Preto" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" name="estado" id="estado" required>
                                <option value=""></option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG" selected>Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Informação do cartão</h4>

                    <div class="row gy-3">

                        <div class="col-md-7">
                            <label for="numero_cartao" class="form-label">Número do cartão</label>
                            <input type="text" class="form-control" name="numero_cartao" id="numero_cartao" value="4012001038443335" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="bandeira" class="form-label">Bandeira</label>
                            <select class="form-select" id="bandeira" required>
                                <option value=""></option>
                                <option value="visa" selected>Visa</option>
                                <option value="mastercard">MasterCard</option>
                                <option value="amex">Amex</option>
                                <option value="elo">Elo</option>
                                <option value="hipercard">Hipercard</option>
                            </select>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="mes_vencimento" class="form-label">Mês de vencimento</label>
                            <select class="form-select" name="mes_vencimento" id="mes_vencimento" required>
                                <option></option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option selected>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                            </select>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="ano_vencimento" class="form-label">Ano de vencimento</label>
                            <select class="form-select" name="ano_vencimento" id="ano_vencimento" required>
                                <option></option>
                                <option>2020</option>
                                <option>2022</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option selected>2025</option>
                                <option>2026</option>
                                <option>2027</option>
                                <option>2028</option>
                                <option>2029</option>
                                <option>2030</option>
                                <option>2031</option>
                                <option>2032</option>
                                <option>2033</option>
                                <option>2034</option>
                                <option>2035</option>
                            </select>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="codigo_seguranca" class="form-label">Código de segurança (cvv)</label>
                            <input type="text" class="form-control" name="codigo_seguranca" id="codigo_seguranca" value="123" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>

                        <!-- Input do Payment Token que será gerado a partir dos dados do cartão inseridos -->
                        <div class="col-12">
                            <label for="payment_token" class="form-label">Payment Token a ser gerado</label>
                            <input type="text" class="form-control" name="payment_token" id="payment_token" readonly>
                        </div>

                        <!-- Input da máscara do cartão de crédito inserido -->
                        <div class="col-12">
                            <label for="mascara_cartao" class="form-label">Máscara do cartão de crédito</label>
                            <input type="text" class="form-control" name="mascara_cartao" id="mascara_cartao" readonly>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div id="areaBotoes" class="row g-3">
                        <div class="col-6">
                            <button class="w-100 btn btn-primary btn-lg" id="ver_parcelas" type="button"><i class="bi bi-arrow-right-short"></i> Definir
                                parcelas</button>

                            <!-- número de parcelas escolhido -->
                            <input type="text" class="form-control" name="parcelas" id="parcelas">
                        </div>
                        <div class="col-6">
                            <button class="w-100 btn btn-secondary btn-lg disabled" id="confirmar_pagamento" type="button">Confirmar pagamento</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <a href="https://gerencianet.com.br/" target="_blank">
            <img style="height: 30px;" src="https://login.gerencianet.com.br/img/svg/logo-gerencianet-topo.svg" alt="Gerencianet - Conceito em Pagamentos">
        </a>
    </footer>
</div>


<!-- MODAL PARA DEFINIÇÃO DAS PARCELAS -->
<div class="modal fade" id="modal_parcelas" tabindex="-1" aria-labelledby="modal_parcelas_Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_parcelas_Label">Número de parcelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="opcoes_parcelas" class="form-label">Escolha como deseja pagar</label>
                <select class="form-select" id="opcoes_parcelas" required>
                </select>
                <div class="invalid-feedback">
                    O número de parcelas é obrigatório
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="definir_parcelas" class="btn btn-primary">Definir parcelas</button>
            </div>
        </div>
    </div>
</div>



<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>


<script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>




<?php echo $this->endSection() ?>