<div class="d-flex align-items-center mt-0">
    <div class="card border shadow-none w-100">

        <div class="card-header py-3">
            <h6 class="mb-0">Seus dados</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="form-control-label">Nome completo</label>
                    <input type="text" name="local" placeholder="Digite seu nome completo" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px">
                </div>
                <div class="form-group col-md-12">
                    <label class="form-control-label">Seu email</label>
                    <input type="email" name="local" placeholder="Digite seu email para receber seu ingresso" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px">
                    <div id="email"></div>
                </div>
                <div class="form-group col-md-12">
                    <label class="form-control-label">Confirme seu email</label>
                    <input type="email" name="local" placeholder="Digite novamente seu email" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px">
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

            <ul class="nav nav-pills mb-3  " role="tablist">
                <li class="nav-item border shadow" role="presentation">
                    <a class="nav-link " data-bs-toggle="tab" href="#dangerhome" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bi bi-credit-card-fill me-2 font-24"></i>
                            </div>
                            <div class="tab-title">Cartão de crédito</div>
                        </div>
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link border shadow active" data-bs-toggle="tab" href="#dangercontact" role="tab" aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="fadeIn animated bx bx-barcode-reader me-2 font-24"></i>
                            </div>
                            <div class="tab-title">Boleto / PIX</div>
                        </div>
                    </a>
                </li>
            </ul>

            <div class="tab-content py-3">
                <div class="tab-pane fade " id="dangerhome" role="tabpanel">
                    <div class="d-flex align-items-center">
                        <div class="card border shadow-none w-100">
                            <div class="card-body mb-0 mt-0">
                                <p>Cartão de crédito</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="dangercontact" role="tabpanel">
                    <div class="form-group col-md-12">
                        <label class="form-control-label">CPF</label>
                        <input type="text" name="cpf" placeholder="Digite o número do  seu CPF" class="form-control form-control-lg mb-2 shadow cpf" style="font-size:medium; padding:13px">
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

                </div>
            </div>
            <div class="card-header py-3" style="margin-top: -35px !important">
                <h6 class="mb-0">Detalhes da compra</h6>
            </div>
            <div class="card-body">
                <table class="table mb-0 table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="60%">Ingresso</th>
                            <th scope="col" width="15%">Qtd</th>
                            <th scope="col" width="25%">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ingresso COMUM meia solidária</td>
                            <td>2</td>
                            <td>R$ 75,00</td>
                        </tr>
                        <tr>
                            <td>Ingresso COMUM PUC</td>
                            <td>1</td>
                            <td>R$ 35,00</td>
                        </tr>
                    </tbody>
                </table>

                <div class="row mt-3 shadow">
                    <div class="col-3">

                    </div>
                    <div class="col-3">
                        <span>Descontos:</span>
                        <h5>R$ 10,00</h5>
                    </div>
                    <div class="col-3">
                        <span>Frete:</span>
                        <h5>R$ 20,00</h5>
                    </div>
                    <div class="col-3">
                        <span>Total a pagar:</span>
                        <h4>R$ 120,00</h4>
                    </div>
                </div>

            </div>
        </div>






    </div>
</div>