<input type="hidden" name="user_id" value="<?php echo usuario_logado()->id; ?>">
<div class="col-lg-10 mx-auto mt-4">
    <div class="d-flex align-items-center justify-content-between">
        <div>

        </div>
        <div style="padding-right: 5px;">
            <a href="<?php echo site_url('eventos'); ?>">Voltar</a>
        </div>
    </div>
    <div class="card shadow radius-10">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase">onde o seu evento vai acontecer?</h6>
            <hr />
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="form-control-label">Local de realização do evento</label>
                    <input type="text" name="local" placeholder="Exemplo: Centro de eventos" class="form-control form-control-lg mb-2" style="font-size:medium; padding:13px" value="<?php echo esc($evento->local); ?>">
                </div>
                <div class="form-group col-md-4">
                    <label class="form-control-label">CEP</label>
                    <input type="text" name="cep" placeholder="Insira o CEP" class="form-control form-control-lg mb-2 " style="font-size:medium; padding:13px" value="<?php echo esc($evento->cep); ?>">
                    <div id="cep"></div>
                </div>

                <div class="form-group col-md-6">
                    <label class="form-control-label">Endereço</label>
                    <input type="text" name="endereco" placeholder="Insira o endereço" class="form-control form-control-lg mb-2" style="font-size:medium; padding:12px" value="<?php echo esc($evento->endereco); ?>">
                </div>

                <div class="form-group col-md-2">
                    <label class="form-control-label">Nº</label>
                    <input type="text" name="numero" placeholder="Insira o Nº" class="form-control form-control-lg mb-2" style="font-size:medium; padding:13px" value="<?php echo esc($evento->numero); ?>">
                </div>

                <div class="form-group col-md-4">
                    <label class="form-control-label">Bairro</label>
                    <input type="text" name="bairro" placeholder="Insira o Bairro" class="form-control form-control-lg mb-2" style="font-size:medium; padding:12px" value="<?php echo esc($evento->bairro); ?>">
                </div>

                <div class="form-group col-md-6">
                    <label class="form-control-label">Cidade</label>
                    <input type="text" name="cidade" placeholder="Insira a Cidade" class="form-control form-control-lg mb-2" style="font-size:medium; padding:12px" value="<?php echo esc($evento->cidade); ?>">
                </div>

                <div class="form-group col-md-2">
                    <label class="form-control-label">Estado</label>
                    <input type="text" name="estado" placeholder="U.F" class="form-control form-control-lg mb-2" style="font-size:medium; padding:12px" value="<?php echo esc($evento->estado); ?>">
                </div>
            </div>

        </div>
    </div>
    <div class="card shadow radius-10">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase">Informações Básicas</h6>
            <label class="form-control-label">Adicione as principais informações do evento.</label>
            <hr />
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="form-control-label">Nome do evento</label>
                    <input type="text" name="nome" placeholder="Nome do evento" class="form-control form-control-lg mb-2" style="font-size:medium; padding:13px" value="<?php echo esc($evento->nome); ?>">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-control-label">Assunto</label>
                    <select name="assunto" class="form-select form-select-lg text-muted mb-3" style="font-size:medium; padding:13px" aria-label=".form-select-lg example">
                        <option selected>Selecione um assunto</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-control-label">Categoria</label>
                    <select name="categoria" class="form-select form-select-lg text-muted mb-3" style="font-size:medium; padding:13px" aria-label=".form-select-lg example">
                        <option selected>Selecione uma categoria</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow radius-10">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase">Descrição do evento</h6>
            <label class="form-control-label">Conte todos os detalhes do seu evento, como a programação e os diferenciais da sua produção!</label>
            <hr />
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control form-control-lg mb-2" name="descricao" rows="5"><?= $evento->descricao; ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow radius-10">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase">Data e horário</h6>
            <label class="form-control-label">Informe aos participantes quando seu evento vai acontecer.</label>
            <hr />
            <div class="row">

                <div class="form-group col-md-4">
                    <label class="form-label">Data de início</label>
                    <input type="text" name="data_inicio" class="form-control datepicker" />
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label">Hora de início</label>
                    <input type="text" name="hora_inicio" class="form-control timepicker" />
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label">Data de fim</label>
                    <input type="text" name="data_fim" class="form-control datepicker" />
                </div>
                <div class="form-group col-md-2">
                    <label class="form-label">Hora de fim</label>
                    <input type="text" name="hora_fim" class="form-control timepicker" />
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow radius-10">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase">Configurações</h6>
            <hr />
            <div class="row">
                <div class="col-12">
                    <div class="form-group col-md-12">
                        <label class="form-control-label">Como devemos chamar seu ticket?</label>
                        <select name="nomenclatura" class="form-select form-select-lg text-muted mb-3" style="font-size:medium; padding:13px" aria-label=".form-select-lg example">
                            <option selected>Selecione a nomenclatura</option>
                            <option value="ingresso">Ingresso</option>
                            <option value="inscrição">Inscrição</option>
                            <option value="credencial">Credencial</option>
                            <option value="contribuição">Contribuição</option>
                        </select>
                    </div>
                    <div class="row" style="margin: 1px;">
                        <div class="form-check  form-switch col-lg-4 mb-3" style="font-size: medium; ">
                            <input type="hidden" name="taxa" value="0">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="taxa" value="1" id="taxa" <?php if ($evento->taxa == true) : ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Absorver taxa de serviço</label>
                        </div>
                        <div class="form-check  form-switch col-lg-4 mb-3" style="font-size: medium; ">
                            <input type="hidden" name="integracao" value="0">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="integracao" value="1" id="integracao" <?php if ($evento->integracao == true) : ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Integração com outra plataforma</label>
                        </div>

                        <div class="form-check  form-switch col-lg-4 mb-3" style="font-size: medium; ">
                            <input type="hidden" name="proprio" value="0">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="proprio" value="1" id="proprio" <?php if ($evento->proprio == true) : ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Evento próprio</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow radius-10">
        <div class="card-body">
            <h6 class="mb-0 text-uppercase">Responsabilidades</h6>
            <hr />
            <div class="row">
                <div class="row" style="margin: 1px;">
                    <div class="form-check  form-switch  mb-3" style="font-size: medium; ">
                        <input type="hidden" name="ativo" value="0">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="ativo" value="1" id="ativo" <?php if ($evento->ativo == true) : ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Ao publicar este evento, estou de acordo com os Termos de uso, com as Diretrizes de Comunidade e com o Acordo de Processamento de Dados, bem como declaro estar ciente da Política de Privacidade, da Política de Cookies e das Obrigatoriedades Legais.</label>
                    </div>
                </div>
            </div>
        </div>
    </div>