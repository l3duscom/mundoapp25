<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />

<style>
/* Card de ingresso com cortes laterais */
.ticket-card {
    position: relative;
    max-width: 500px;
    border: none;
    border-radius: 16px;
    overflow: visible;
    background: transparent;
}
.ticket-card-header {
    position: relative;
    background: linear-gradient(135deg, #ffffff 0%, #ffffff 20%, #16213e 80%, #0f3460 100%);
    height: 150px;
    border-radius: 16px 16px 0 0;
}
.ticket-card-header.header-dream {
    background: linear-gradient(135deg, #ffffff 0%, #ffffff 20%, #672eba 80%, #8b4ecf 100%);
}
.ticket-card-header.header-anime {
    background: linear-gradient(135deg, #ffffff 0%, #ffffff 20%, #ff0063 80%, #ff3385 100%);
}
.ticket-card-body {
    background: #212529;
    border-radius: 0 0 16px 16px;
    position: relative;
}
/* Cortes laterais */
.ticket-notch {
    position: relative;
    height: 0;
    z-index: 30;
}
.ticket-notch::before,
.ticket-notch::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    background: #1a2232;
    border-radius: 50%;
    top: -8px;
}
.ticket-notch::before {
    left: -8px;
}
.ticket-notch::after {
    right: -8px;
}
.ticket-card-buttons {
    position: absolute;
    bottom: 15px;
    right: 15px;
    z-index: 10;
    display: flex;
    gap: 8px;
}
.ticket-card-buttons a {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 50%;
    border: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    color: #333;
    text-decoration: none;
}
.ticket-card-buttons a:hover {
    background: #f0f0f0;
}
</style>
<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row g-4 align-items-start">
    <!-- Coluna lateral esquerda -->
    <div class="col-lg-4 col-xl-3">

        <?php if (isset($perfil_incompleto) && $perfil_incompleto): ?>
        <!-- Card de Perfil Incompleto (Compacto) -->
        <a href="<?= site_url('usuarios/perfil') ?>" class="card w-100 shadow-lg mb-2 text-decoration-none" style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 50%, #ffc107 100%); border-radius: 12px; overflow: hidden;">
            <div class="card-body py-2 px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-triangle-fill text-white" style="font-size: 1.1rem;"></i>
                        <div>
                            <span class="text-white fw-bold" style="font-size: 0.9rem;">Complete seu Perfil</span>
                            <span class="badge bg-dark ms-2" style="font-size: 0.7rem;"><?= count($campos_faltando) ?> pendente(s)</span>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-white-50"></i>
                </div>
            </div>
        </a>
        <?php endif; ?>

        <?php if (isset($refoundsTotal) && $refoundsTotal > 0): ?>
        <!-- Card de Solicitações (Compacto) -->
        <a href="<?= site_url('pedidos/meus-refounds') ?>" class="card w-100 shadow-lg mb-2 text-decoration-none" style="background: linear-gradient(135deg, #6f42c1 0%, #8b5cf6 50%, #a855f7 100%); border-radius: 12px; overflow: hidden;">
            <div class="card-body py-2 px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-arrow-repeat text-white" style="font-size: 1.1rem;"></i>
                        <div>
                            <span class="text-white fw-bold" style="font-size: 0.9rem;">Minhas Solicitações</span>
                            <?php if ($refoundsPendentes > 0): ?>
                                <span class="badge bg-warning text-dark ms-2" style="font-size: 0.7rem;"><?= $refoundsPendentes ?> pendente(s)</span>
                            <?php else: ?>
                                <span class="text-white-50 ms-2" style="font-size: 0.75rem;"><?= $refoundsTotal ?> total</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-white-50"></i>
                </div>
            </div>
        </a>
        <?php endif; ?>

        <div class="card w-100 shadow bg-dark radius-10 mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h5> <img src="<?php echo site_url('recursos/img/dreamcoin.png'); ?>" alt="" class="rounded-circle" width="34" height="34">
                            Saldo da conta </h5>
                    </div>
                    <div class="row ">
                        <div class="col col-5">
                            <p class="mb-0 text-muted" style="font-size: 10px;">DREAMCOIN</p>
                            <h4 class="mb-0"><?php echo usuario_logado()->pontos; ?></h4>
                        </div>
                        <div class="col col-2">
                            <i class="bi bi-plus-lg text-muted" style="margin-left: -10px"></i>
                        </div>
                        <div class="col col-5">
                            <p class="mb-0 text-muted" style="font-size: 10px;">CASHBACK</p>
                            <h4 class="mb-0"><span style="font-size: 10px; margin-left: -20px"> R$ </span> <?php echo usuario_logado()->saldo; ?></h4>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>

        <!-- Card Conquistas Compacto -->
        <div class="card w-100 shadow bg-dark radius-10 mb-2">
            <div class="card-body py-2 px-3">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted small">Conquistas</span>
                    <div class="d-flex gap-2">
                        <?php if (usuario_logado()->is_membro) : ?>
                            <i class="bx bx-mouse-alt" style="color: #ffd700; font-size: 1.3rem;" title="Cadastro realizado"></i>
                            <i class="bx bx-face" style="color: #ffd700; font-size: 1.3rem;" title="Pioneiro"></i>
                            <i class="bx bx-crown" style="color: #ffd700; font-size: 1.3rem;" title="Premium"></i>
                        <?php else : ?>
                            <i class="bx bx-mouse-alt" style="color: #ffd700; font-size: 1.3rem;" title="Cadastro realizado"></i>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>




    </div>
    
    <!-- Conteúdo principal à direita -->
    <div class="col-lg-8 col-xl-9">
        <!-- Todo o restante da dashboard (ingressos, check-in, etc.) -->
        
        <!-- Coloque a ancora aqui, antes das abas -->
        



   
            
                <div class="row">
                    <?php if(usuario_logado()->temPermissaoPara('access-controll')): ?>
                        <div class="col-lg-6">
                            <div class="card shadow radius-10">
                                <div class="card-body">
                                    <a href="<?= site_url('/acessos/bilheteria') ?>" class="btn btn-success mt-2 shadow w-100"> Bilheteria</a>
                                </div>
                            </div>
                        </div>    
                    <?php endif ?>  
                    <?php if(usuario_logado()->temPermissaoPara('juri')): ?>
                        <div class="col-lg-6">
                            <div class="card shadow radius-10">
                                <div class="card-body">
                                    <a href="<?= site_url('/concursos') ?>" class="btn btn-success mt-2 shadow w-100"> Gerenciar concursos</a>
                                </div>
                            </div>
                        </div>    
                    <?php endif ?>           
                </div>
            
        
        
        <!-- Nav tabs -->
        <ul class="nav nav-tabs mb-3" id="ingressosTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="atuais-tab" data-bs-toggle="tab" data-bs-target="#atuais" type="button" role="tab" aria-controls="atuais" aria-selected="true">Ingressos Atuais</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="anteriores-tab" data-bs-toggle="tab" data-bs-target="#anteriores" type="button" role="tab" aria-controls="anteriores" aria-selected="false">Ingressos Anteriores</button>
            </li>
        </ul>
        <div class="tab-content" id="ingressosTabsContent">
            <div class="tab-pane fade show active" id="atuais" role="tabpanel" aria-labelledby="atuais-tab">
                <?php if (!empty($ingressos_atuais)) : ?>
                    <?php foreach ($ingressos_atuais as $i) : ?>
                    <!-- Card de Ingresso - Novo Design -->
                    <div class="ticket-card card mb-4">
                        <!-- Header com imagem/capa do evento -->
                        <?php 
                        $header_class = 'ticket-card-header';
                        if (stripos($i->nome_evento, 'Dream') !== false) {
                            $header_class .= ' header-dream';
                        } elseif (stripos($i->nome_evento, 'Anime') !== false) {
                            $header_class .= ' header-anime';
                        }
                        ?>
                        <div class="<?= $header_class ?>">
                            <?php if (!empty($i->evento_avatar)): ?>
                                <?php 
                                // Composição da URL do avatar (mesma lógica do externo.php)
                                if (strpos($i->evento_avatar, 'http') === 0) {
                                    $avatarUrl = $i->evento_avatar;
                                } elseif (strpos($i->evento_avatar, 'eventos/imagem/') === 0) {
                                    $avatarUrl = 'https://backoffice.mundodream.com.br/' . $i->evento_avatar;
                                } else {
                                    $avatarUrl = 'https://backoffice.mundodream.com.br/eventos/imagem/' . $i->evento_avatar;
                                }
                                ?>
                                <div class="position-absolute" style="top: 15px; left: 15px; z-index: 20;">
                                    <img src="<?= $avatarUrl ?>" style="max-height: 60px; max-width: 180px; object-fit: contain;">
                                </div>
                            <?php endif; ?>
                            <div class="ticket-card-buttons">
                                <a href="<?= site_url('/ingressos/gerarIngressoPdf/' . $i->id) ?>" target="_blank" title="Baixar">
                                    <i class="bi bi-download"></i>
                                </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#participante<?= $i->id; ?>Modal" title="Favoritar">
                                    <i class="bi bi-heart"></i>
                                </a>
                            </div>
                            <?php if ($i->tipo == 'produto') : ?>
                                <div class="position-absolute top-0 start-0 m-2" style="z-index: 10;">
                                    <span class="badge bg-danger">Produto - Não válido para acesso</span>
                                </div>
                            <?php endif ?>
                        </div>
                        
                        <!-- Cortes laterais -->
                        <div class="ticket-notch"></div>
                        
                        <!-- Conteúdo do Card -->
                        <div class="ticket-card-body p-3">
                            <!-- Nome do Evento -->
                            <h4 class="fw-bold text-white mb-3"><?= $i->nome_evento ?></h4>
                            
                            <!-- Data, Horário e Local do Evento -->
                            <div class="row mb-2">
                                <div class="col-6 col-md-4 mb-2">
                                    <small class="text-muted text-uppercase d-block" style="font-size: 0.7rem;"><i class="bi bi-calendar3 me-1"></i>DATA</small>
                                    <p class="mb-0 text-white">
                                        <?php 
                                        // Prioriza data do ticket, se não existir usa ticket_dia
                                        if (!empty($i->ticket_data_inicio)) {
                                            $data_inicio = ($i->ticket_data_inicio instanceof DateTimeInterface) 
                                                ? $i->ticket_data_inicio->format('d/m/Y') 
                                                : (($dt = DateTime::createFromFormat('!Y-m-d', (string)$i->ticket_data_inicio)) ? $dt->format('d/m/Y') : '');
                                            $data_fim = !empty($i->ticket_data_fim) 
                                                ? (($i->ticket_data_fim instanceof DateTimeInterface) 
                                                    ? $i->ticket_data_fim->format('d/m/Y') 
                                                    : (($dt = DateTime::createFromFormat('!Y-m-d', (string)$i->ticket_data_fim)) ? $dt->format('d/m/Y') : ''))
                                                : $data_inicio;
                                        } elseif (!empty($i->ticket_dia)) {
                                            // Se não tem data específica, usa o campo dia (texto)
                                            $data_inicio = esc($i->ticket_dia);
                                            $data_fim = null;
                                        } else {
                                            // Fallback: usa data do evento
                                            $data_inicio = ($i->data_inicio instanceof DateTimeInterface) 
                                                ? $i->data_inicio->format('d/m/Y') 
                                                : (($dt = DateTime::createFromFormat('!Y-m-d', (string)$i->data_inicio)) ? $dt->format('d/m/Y') : '');
                                            $data_fim = ($i->data_fim instanceof DateTimeInterface) 
                                                ? $i->data_fim->format('d/m/Y') 
                                                : (($dt = DateTime::createFromFormat('!Y-m-d', (string)$i->data_fim)) ? $dt->format('d/m/Y') : '');
                                        }
                                        ?>
                                        <?php if (empty($data_fim) || $data_inicio === $data_fim) : ?>
                                            <?= $data_inicio ?>
                                        <?php else : ?>
                                            <?= $data_inicio ?> - <?= $data_fim ?>
                                        <?php endif ?>
                                    </p>
                                </div>
                                <div class="col-6 col-md-4 mb-2">
                                    <small class="text-muted text-uppercase d-block" style="font-size: 0.7rem;"><i class="bi bi-clock me-1"></i>HORÁRIO</small>
                                    <p class="mb-0 text-white">
                                        <?php 
                                        $hora_inicio = !empty($i->hora_inicio) ? substr($i->hora_inicio, 0, 5) : '';
                                        $hora_fim = !empty($i->hora_fim) ? substr($i->hora_fim, 0, 5) : '';
                                        ?>
                                        <?php if (!empty($hora_inicio)) : ?>
                                            <?= $hora_inicio ?><?php if (!empty($hora_fim) && $hora_fim !== $hora_inicio) : ?> - <?= $hora_fim ?><?php endif ?>
                                        <?php else : ?>
                                            --:--
                                        <?php endif ?>
                                    </p>
                                </div>
                                <div class="col-12 col-md-4">
                                    <small class="text-muted text-uppercase d-block" style="font-size: 0.7rem;"><i class="bi bi-geo-alt me-1"></i>LOCAL</small>
                                    <p class="mb-0 text-white" style="font-size: 0.95rem;"><?= !empty($i->local) ? esc($i->local) : 'Não informado' ?></p>
                                </div>
                            </div>
                            
                            <hr class="border-secondary my-3">
                            
                            <!-- Código + QR Code e Informações -->
                            <div class="d-flex gap-3">
                                <!-- QR Code -->
                                <div class="flex-shrink-0">
                                    <small class="text-muted d-block mb-1" style="font-size: 0.7rem;"><?= $i->codigo ?></small>
                                    <img src="<?= $i->qr ?>" style="width: 100px; height: 100px; background-color:#fff; padding: 4px; border-radius: 8px;">
                                </div>
                                
                                <!-- Informações do Ingresso -->
                                <div class="flex-grow-1">
                                    <div class="mb-2">
                                        <small class="text-muted text-uppercase" style="font-size: 0.65rem;">INGRESSO</small>
                                        <p class="mb-0 text-white fw-semibold"><?= $i->nome ?></p>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted text-uppercase" style="font-size: 0.65rem;">PARTICIPANTE</small>
                                        <p class="mb-0 text-white"><?= $i->participante ?? $cliente->nome ?></p>
                                    </div>
                                    <div>
                                        <small class="text-muted text-uppercase" style="font-size: 0.65rem;">ACESSO</small>
                                        <p class="mb-0 text-white"><?= $i->frete == null || $i->frete == 0 ? "Retirar no local" : "Receber em casa" ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <?php 
                            // Bonus Cinemark
                            $bonus_cinemark = null;
                            if (isset($bonus_por_ingresso[$i->id])) {
                                foreach ($bonus_por_ingresso[$i->id] as $bonus) {
                                    if ($bonus->tipo_bonus === 'cinemark') {
                                        $bonus_cinemark = $bonus;
                                        break;
                                    }
                                }
                            }
                            ?>
                            
                            <?php if ($bonus_cinemark != null) : ?>
                                <hr class="border-secondary my-3">
                                <div class="p-3 rounded" style="background: rgba(255, 204, 0, 0.1); border: 1px solid rgba(255, 204, 0, 0.3);">
                                    <strong style="color: #ffcc00"><i class="bi bi-film me-1"></i>Seu ingresso CINEMARK!</strong><br>
                                    <small class="text-muted"><?= nl2br(esc($bonus_cinemark->instrucoes)) ?></small><br>
                                    <span class="badge bg-warning text-dark mt-2" style="font-size: 0.9rem;"><?= esc($bonus_cinemark->codigo) ?></span>
                                    <span class="badge bg-success ms-1">Validade: 20 dias</span>
                                </div>
                            <?php endif ?>
                            
                            <?php if ($i->frete == 1) : ?>
                                <hr class="border-secondary my-3">
                                <div class="d-flex gap-2 flex-wrap">
                                    <?php if ($i->rastreio != null) : ?>
                                        <a href="https://rastreamento.correios.com.br/app/index.php?objetos=<?= $i->rastreio ?>" target="_blank" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-truck me-1"></i>Rastrear entrega
                                        </a>
                                    <?php else : ?>
                                        <span class="btn btn-sm btn-outline-secondary disabled">
                                            <i class="bi bi-hourglass-split me-1"></i>Preparando envio...
                                        </span>
                                    <?php endif ?>
                                    <a href="<?= site_url('/pedidos/gerenciarendereco/' . $i->pedido_id) ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-geo-alt me-1"></i>Endereço
                                    </a>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    
                    <!-- Modal participante -->
                    <div class="modal fade bd-example-modal-lg" id="participante<?= $i->id; ?>Modal" tabindex="-1" role="dialog" aria-labelledby="participante<?= $i->id; ?>Modal" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="participante<?= $i->id; ?>Modal">Gerenciamento de ingresso</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php echo form_open("ingressos/atualizar/$i->id") ?>
                                    <?= csrf_field() ?>
                                    <div class="form-group col-md-12">
                                        <label class="form-control-label">Informe o nome do novo participante</label>
                                        <input type="text" name="participante" class="form-control">
                                    </div>
                                    <p class="text-muted font-13"> Este é o nome que aparecerá no seu ingresso!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                    <input id="btn-salvar" type="submit" value="Alterar" class="btn btn-primary btn-sm">
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                    <?php else : ?>
                        <center>
                            <hr>
                        <p>Nenhum ingresso atual encontrado</p>
                        <a href="<?= site_url('/') ?>" target="_blank" class="btn btn-primary">Comprar ingresso!</a>
                            <hr>
                        </center>
                    <?php endif; ?>
            </div>
            <div class="tab-pane fade" id="anteriores" role="tabpanel" aria-labelledby="anteriores-tab">
                <?php if (!empty($ingressos_anteriores)) : ?>
                <?php foreach ($ingressos_anteriores as $i) : ?>
                    <!-- Card de Ingresso Anterior - Mesmo Design dos Atuais -->
                    <div class="ticket-card card mb-4" style="opacity: 0.85;">
                        <!-- Header com imagem/capa do evento -->
                        <?php 
                        $header_class = 'ticket-card-header';
                        $header_style = '';
                        if (stripos($i->nome_evento, 'Dream') !== false) {
                            $header_style = 'background: linear-gradient(135deg, #ffffff 0%, #ffffff 20%, #672eba 80%, #8b4ecf 100%);';
                        } elseif (stripos($i->nome_evento, 'Anime') !== false) {
                            $header_style = 'background: linear-gradient(135deg, #ffffff 0%, #ffffff 20%, #ff0063 80%, #ff3385 100%);';
                        } else {
                            $header_style = 'background: linear-gradient(135deg, #ffffff 0%, #ffffff 20%, #16213e 80%, #0f3460 100%);';
                        }
                        ?>
                        <div class="<?= $header_class ?>" style="<?= $header_style ?>">
                            <?php if (!empty($i->evento_avatar)): ?>
                                <?php 
                                // Composição da URL do avatar (mesma lógica do externo.php)
                                if (strpos($i->evento_avatar, 'http') === 0) {
                                    $avatarUrl = $i->evento_avatar;
                                } elseif (strpos($i->evento_avatar, 'eventos/imagem/') === 0) {
                                    $avatarUrl = 'https://backoffice.mundodream.com.br/' . $i->evento_avatar;
                                } else {
                                    $avatarUrl = 'https://backoffice.mundodream.com.br/eventos/imagem/' . $i->evento_avatar;
                                }
                                ?>
                                <div class="position-absolute" style="top: 15px; left: 15px; z-index: 20;">
                                    <img src="<?= $avatarUrl ?>" style="max-height: 60px; max-width: 180px; object-fit: contain; opacity: 0.8;">
                                </div>
                            <?php endif; ?>
                            <div class="position-absolute top-0 end-0 m-2" style="z-index: 10;">
                                <span class="badge bg-secondary">Evento encerrado</span>
                            </div>
                            <?php if ($i->tipo == 'produto') : ?>
                                <div class="position-absolute top-0 start-0 m-2" style="z-index: 10;">
                                    <span class="badge bg-danger">Produto</span>
                                </div>
                            <?php endif ?>
                        </div>
                        
                        <!-- Cortes laterais -->
                        <div class="ticket-notch"></div>
                        
                        <!-- Conteúdo do Card -->
                        <div class="ticket-card-body p-3">
                            <!-- Nome do Evento -->
                            <h4 class="fw-bold text-white mb-3"><?= $i->nome_evento ?></h4>
                            
                            <!-- Data, Horário e Local do Evento -->
                            <div class="row mb-2">
                                <div class="col-6 col-md-4 mb-2">
                                    <small class="text-muted text-uppercase d-block" style="font-size: 0.7rem;"><i class="bi bi-calendar3 me-1"></i>DATA</small>
                                    <p class="mb-0 text-white">
                                        <?php 
                                        // Prioriza data do ticket, se não existir usa ticket_dia
                                        if (!empty($i->ticket_data_inicio)) {
                                            $data_inicio = date('d/m/Y', strtotime($i->ticket_data_inicio));
                                            $data_fim = !empty($i->ticket_data_fim) 
                                                ? date('d/m/Y', strtotime($i->ticket_data_fim))
                                                : $data_inicio;
                                        } elseif (!empty($i->ticket_dia)) {
                                            $data_inicio = esc($i->ticket_dia);
                                            $data_fim = null;
                                        } else {
                                            $data_inicio = date('d/m/Y', strtotime($i->data_inicio));
                                            $data_fim = date('d/m/Y', strtotime($i->data_fim));
                                        }
                                        ?>
                                        <?php if (empty($data_fim) || $data_inicio === $data_fim) : ?>
                                            <?= $data_inicio ?>
                                        <?php else : ?>
                                            <?= $data_inicio ?> - <?= $data_fim ?>
                                        <?php endif ?>
                                    </p>
                                </div>
                                <div class="col-6 col-md-4 mb-2">
                                    <small class="text-muted text-uppercase d-block" style="font-size: 0.7rem;"><i class="bi bi-clock me-1"></i>HORÁRIO</small>
                                    <p class="mb-0 text-white">
                                        <?php 
                                        $hora_inicio = !empty($i->hora_inicio) ? substr($i->hora_inicio, 0, 5) : '';
                                        $hora_fim = !empty($i->hora_fim) ? substr($i->hora_fim, 0, 5) : '';
                                        ?>
                                        <?php if (!empty($hora_inicio)) : ?>
                                            <?= $hora_inicio ?><?php if (!empty($hora_fim) && $hora_fim !== $hora_inicio) : ?> - <?= $hora_fim ?><?php endif ?>
                                        <?php else : ?>
                                            --:--
                                        <?php endif ?>
                                    </p>
                                </div>
                                <div class="col-12 col-md-4">
                                    <small class="text-muted text-uppercase d-block" style="font-size: 0.7rem;"><i class="bi bi-geo-alt me-1"></i>LOCAL</small>
                                    <p class="mb-0 text-white" style="font-size: 0.95rem;"><?= !empty($i->local) ? esc($i->local) : 'Não informado' ?></p>
                                </div>
                            </div>
                            
                            <hr class="border-secondary my-3">
                            
                            <!-- Código + QR Code e Informações -->
                            <div class="d-flex gap-3">
                                <!-- QR Code -->
                                <div class="flex-shrink-0">
                                    <small class="text-muted d-block mb-1" style="font-size: 0.7rem;"><?= $i->codigo ?></small>
                                    <img src="<?= $i->qr ?>" style="width: 100px; height: 100px; background-color:#fff; padding: 4px; border-radius: 8px; opacity: 0.7;">
                                </div>
                                
                                <!-- Informações do Ingresso -->
                                <div class="flex-grow-1">
                                    <div class="mb-2">
                                        <small class="text-muted text-uppercase" style="font-size: 0.65rem;">INGRESSO</small>
                                        <p class="mb-0 text-white fw-semibold"><?= $i->nome ?></p>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted text-uppercase" style="font-size: 0.65rem;">PARTICIPANTE</small>
                                        <p class="mb-0 text-white"><?= $i->participante ?? $cliente->nome ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <?php 
                            // Bonus Cinemark
                            $bonus_cinemark = null;
                            if (isset($bonus_por_ingresso[$i->id])) {
                                foreach ($bonus_por_ingresso[$i->id] as $bonus) {
                                    if ($bonus->tipo_bonus === 'cinemark') {
                                        $bonus_cinemark = $bonus;
                                        break;
                                    }
                                }
                            }
                            ?>
                            
                            <?php if ($bonus_cinemark != null) : ?>
                                <hr class="border-secondary my-3">
                                <div class="p-3 rounded" style="background: rgba(255, 204, 0, 0.1); border: 1px solid rgba(255, 204, 0, 0.3);">
                                    <strong style="color: #ffcc00"><i class="bi bi-film me-1"></i>Seu ingresso CINEMARK!</strong><br>
                                    <small class="text-muted"><?= nl2br(esc($bonus_cinemark->instrucoes)) ?></small><br>
                                    <span class="badge bg-warning text-dark mt-2" style="font-size: 0.9rem;"><?= esc($bonus_cinemark->codigo) ?></span>
                                    <span class="badge bg-success ms-1">Validade: 20 dias</span>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php else : ?>
                    <center>
                        <hr>
                        <p>Nenhum ingresso anterior encontrado</p>
                        <a href="<?= site_url('/') ?>" target="_blank" class="btn btn-primary">Comprar ingresso!</a>
                        <hr>
                    </center>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Card DreamCard -->
        <div class="mt-4" style="max-width: 500px;">
            <?php if ($card == null) : ?>
                <div class="card w-100 shadow bg-dark radius-10">
                    <div class="card-body">
                        <h5>Seu DreamCard </h5>
                        Você ainda não solicitou o seu cartão de membro!
                    </div>
                    <div class="d-grid" style="padding: 10px;">
                        <a href="#" target="_blank" class="btn btn-primary disabled">Solicitar cartão</a>
                    </div>
                </div>
            <?php else : ?>
                <div class="card w-100 shadow bg-purple radius-10">
                    <div class="card-body">
                        <h5>Seu DreamCard <span class="badge bg-success"><?= $card->status ?></span></h5>
                        <div class="d-flex align-items-center gap-3">
                            <div class="fs-1">
                                <i class="bi bi-credit-card-2-back-fill"></i>
                            </div>
                            <div class="">
                                <p class="mb-0 fs-6"><strong><?= $card->matricula ?></strong> </p>
                            </div>
                        </div>
                        <?php echo esc(usuario_logado()->nome); ?><br>
                        Expira em: <?= date("d/m/Y", strtotime($card->expiration)) ?>
                    </div>
                </div>
                <?php if ($card->status == 'Confecção') : ?>
                    <div class="d-grid mt-2">
                        <a href="<?= site_url('/pedidos/recebercartao') ?>" class="btn btn-outline-danger">Receber meu cartão em casa!</a>
                    </div>
                <?php elseif ($card->status == 'Enviado') : ?>
                    <div class="d-grid mt-2">
                        <a href="https://melhorrastreio.com.br/rastreio/<?= $card->rastreio ?>" target="_blank" class="btn btn-outline-success">Acompanhe a entrega</a>
                    </div>
                <?php elseif ($card->status == 'Preparando') : ?>
                    <div class="d-grid mt-2">
                        <a href="<?= site_url('/pedidos/recebercartao') ?>" class="btn btn-outline-success disabled">Aguardando rastreio</a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>




<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>


<script type="text/javascript" src="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.js') ?>"></script>



<script>
    $(document).ready(function() {


        const DATATABLE_PTBR = {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            }
        }


        $(' #ajaxTable').DataTable({
            "oLanguage": DATATABLE_PTBR,
            "ajax": "<?php echo site_url('declarations/recuperaDeclaracoesPorUsuario'); ?>",
            "columns": [{
                "data": "nome"
            }, {
                "data": "month"
            }, {
                "data": "type"
            }, {
                "data": "status"
            }, {
                "data": "created_at"
            }, ],
            "order": [],
            "deferRender": true,
            "processing": true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
            },
            "responsive": true,
            "pagingType": $(window).width() < 768 ? "simple" : "simple_numbers",
        });
    });
</script>



<?php echo $this->endSection() ?>