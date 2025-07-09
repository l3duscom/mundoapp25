<div class="d-flex align-items-center mt-0">
    <div class="card border shadow-none w-100">

        <div class="card-header py-3">
            <h6 class="mb-0">Seus dados </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <input type="hidden" name="total" value="<?= $_SESSION['total'] ?>">
                <input type="hidden" name="convite" value="<?= $_SESSION['convite'] ?>">
                <input type="hidden" id="forma_pagamento" name="forma_pagamento" value="">


                <div class="form-group col-md-12">
                    <label class="form-control-label">Nome completo</label>
                    <input type="text" name="nome" placeholder="Digite seu nome completo" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" required>
                </div>
                <div class="form-group col-md-12">
                    <label class="form-control-label">Seu email</label>
                    <input type="email" name="email" placeholder="Digite seu email para receber seu ingresso" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" required>
                    <div id="email"></div>
                </div>
                <div class="form-group col-md-12">
                    <label class="form-control-label">Celular</label>
                    <input type="text" name="telefone" placeholder="Insira o telefone" class="form-control sp_celphones mb-2 shadow" style="font-size:medium; padding:13px">
                </div>
            </div>


        </div>
    </div>
</div>

<div class="d-flex align-items-center mt-0">
    <div class="card border shadow-none w-100">

        <div class="card-header py-3">
            <h6 class="mb-0">Pagamento</h6>
        </div>
        <div class="card-body">

            <div class="form-group col-md-12">
                <label class="form-control-label">CPF</label>
                <input type="text" name="cpf" placeholder="Digite o número do  seu CPF" class="form-control form-control-lg mb-2 shadow cpf" style="font-size:medium; padding:13px" required>
                <span class="text-muted" style="font-size: 11px; padding-left: 5px">Por exigência do Banco Central, o boleto precisa ter seu CPF.</span>
            </div>
            <hr>
            <div class="d-flex align-items-center">
                <div class="card border shadow-none">
                    <div class="card-body mb-0 mt-0">

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="d-flex align-items-center mt-0">
                                    <div class="card border shadow-none w-100">
                                        <div class="card-body mb-4 mt-0">
                                            <i class="bx bx-calendar-event me-2 font-24"></i>
                                            <h5>Pague até a data de vencimento</h5>
                                            <span>Faça o pagamento até a data de vencimento e garanta seu ingresso.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="d-flex align-items-center mt-0">
                                    <div class="card border shadow-none w-100">
                                        <div class="card-body mb-4 mt-0">
                                            <i class="bx bx-time me-2 font-24"></i>
                                            <h5>Aguarde a aprovação do pagamento</h5>
                                            <span>Pagamentos com boleto levam até 3 dias úteis para serem compensados.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="d-flex align-items-center mt-0 mb-0">
                                    <div class="card border shadow-none w-100 bg-gradient-purple">
                                        <div class="card-body mb-4 mt-0 text-light">
                                            <img class="mb-2" src="<?php echo site_url('recursos/front/images/pix.svg'); ?>" width="24px" style="color:white">
                                            <h5>Pague com Pix e tenha acesso imediato ao produto</h5>
                                            <span>Pague o boleto via QRCODE e receba seu ingresso em segundos.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="card-header py-3" style="margin-top: -35px !important">
                <h6 class="mb-0">Detalhes da compra</h6>
            </div>
            <div class="" style="padding: 5px;">
                <?php if (isset($_SESSION['carrinho'])) : ?>
                    <table class="table mb-0 table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="70%">Ingresso</th>
                                <th scope="col" width="10%" style="align-items:center">
                                    Qtd
                                </th>
                                <th scope="col" width="20%">Valor</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($_SESSION['carrinho'] as $key => $value) : ?>
                                <?php if ($value['quantidade'] != 0) : ?>
                                    <tr>
                                        <td><u><?= $value['nome']; ?></u></td>
                                        <td><?= $value['quantidade']; ?> </a></td>
                                        <td>R$ <?= $value['quantidade'] * $value['preco']; ?></td>
                                    </tr>
                                <?php endif; ?>


                            <?php endforeach; ?>
                        <?php else : ?>
                            <center>
                                <i class="fadeIn animated bx bx-error-circle"></i><br>Oooops, seu carrinho está vazio, escolha um ingresso e venha viver a magia no Dreamfest!
                            </center>
                            </hr>
                        <?php endif; ?>


                        </tbody>
                    </table>
            </div>


        </div>

    </div>


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
                <select class="form-select" id="opcoes_parcelas">
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


<script>
    function setaPagamento(forma) {
        var elemento = document.getElementById("forma_pagamento");
        elemento.value = forma;

    }
</script>