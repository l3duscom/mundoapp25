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

/* Tabs customizadas para o layout dark */
#ingressosTabs {
    border-bottom: none;
    gap: 8px;
}
#ingressosTabs .nav-link {
    background: transparent;
    border: 1px solid #343a40;
    border-radius: 8px;
    color: #adb5bd;
    padding: 10px 20px;
    transition: all 0.2s ease;
}
#ingressosTabs .nav-link:hover {
    background: rgba(255,255,255,0.05);
    border-color: #495057;
    color: #fff;
}
#ingressosTabs .nav-link.active {
    background: linear-gradient(135deg, #672eba 0%, #8b4ecf 100%);
    border-color: transparent;
    color: #fff;
    font-weight: 500;
}

/* ====== ESTILOS PREMIUM ESPECIAIS ====== */
.premium-card {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    border: 2px solid transparent;
    border-image: linear-gradient(135deg, #ffd700, #ff6b35, #ff1493, #00ff88, #ffd700) 1;
    animation: premium-border-glow 3s ease-in-out infinite;
}

@keyframes premium-border-glow {
    0%, 100% { box-shadow: 0 0 20px rgba(255, 215, 0, 0.4), 0 0 40px rgba(255, 107, 53, 0.2); }
    50% { box-shadow: 0 0 30px rgba(255, 20, 147, 0.4), 0 0 60px rgba(0, 255, 136, 0.2); }
}

.premium-crown {
    animation: crown-bounce 2s ease-in-out infinite;
}

@keyframes crown-bounce {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    25% { transform: translateY(-5px) rotate(-5deg); }
    75% { transform: translateY(-5px) rotate(5deg); }
}

.premium-shimmer {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

.premium-confetti {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
    overflow: hidden;
}

.confetti-piece {
    position: absolute;
    width: 8px;
    height: 8px;
    animation: confetti-fall 4s linear infinite;
    opacity: 0.8;
}

@keyframes confetti-fall {
    0% { transform: translateY(-20px) rotate(0deg); opacity: 1; }
    100% { transform: translateY(150px) rotate(720deg); opacity: 0; }
}

.premium-stars {
    position: absolute;
    top: 10px;
    right: 10px;
}

.star {
    color: #ffd700;
    animation: star-twinkle 1.5s ease-in-out infinite;
    display: inline-block;
}

.star:nth-child(2) { animation-delay: 0.3s; }
.star:nth-child(3) { animation-delay: 0.6s; }

@keyframes star-twinkle {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(0.8); }
}

.premium-badge-animated {
    display: inline-block;
    background: linear-gradient(135deg, #ffd700 0%, #ff8c00 50%, #ffd700 100%);
    background-size: 200% 200%;
    animation: gradient-shift 2s ease infinite;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

@keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.premium-emoji-float {
    animation: emoji-float 3s ease-in-out infinite;
    display: inline-block;
}

@keyframes emoji-float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

.premium-pulse {
    animation: premium-pulse 2s ease-in-out infinite;
}

@keyframes premium-pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
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

        <?php if (usuario_logado()->is_premium): ?>
        <!-- 🎉 CARD PREMIUM CELEBRATIVO 🎉 -->
        <div class="card w-100 shadow-lg mb-3 premium-card premium-pulse" style="border-radius: 16px;">
            <!-- Efeito shimmer -->
            <div class="premium-shimmer"></div>
            
            <!-- Confetti decorativo -->
            <div class="premium-confetti">
                <span class="confetti-piece" style="left: 10%; background: #ffd700; animation-delay: 0s;"></span>
                <span class="confetti-piece" style="left: 25%; background: #ff6b35; animation-delay: 0.5s;"></span>
                <span class="confetti-piece" style="left: 40%; background: #ff1493; animation-delay: 1s;"></span>
                <span class="confetti-piece" style="left: 55%; background: #00ff88; animation-delay: 1.5s;"></span>
                <span class="confetti-piece" style="left: 70%; background: #00bfff; animation-delay: 2s;"></span>
                <span class="confetti-piece" style="left: 85%; background: #ff69b4; animation-delay: 2.5s;"></span>
            </div>
            
            <!-- Estrelas piscando -->
            <div class="premium-stars">
                <span class="star">⭐</span>
                <span class="star">✨</span>
                <span class="star">🌟</span>
            </div>
            
            <div class="card-body py-4 px-3 position-relative" style="z-index: 1;">
                <div class="text-center">
                    <!-- Coroa animada -->
                    <div class="premium-crown mb-2" style="font-size: 3rem;">
                        👑
                    </div>
                    
                    <!-- Título premium -->
                    <h4 class="fw-bold mb-2">
                        <span class="premium-badge-animated" style="font-size: 1.3rem;">VOCÊ É PREMIUM!</span>
                    </h4>
                    
                    <!-- Mensagem divertida -->
                    <p class="text-white-50 small mb-3">
                        <span class="premium-emoji-float">🎉</span>
                        Aproveite todos os benefícios exclusivos!
                        <span class="premium-emoji-float" style="animation-delay: 0.5s;">🚀</span>
                    </p>
                    
                    <!-- Validade da assinatura -->
                    <?php if (!empty(usuario_logado()->premium_ate)): ?>
                    <div class="d-flex justify-content-center gap-2 flex-wrap mb-3">
                        <span class="badge" style="background: rgba(255,215,0,0.2); color: #ffd700; font-size: 0.75rem;">
                            <i class="bi bi-calendar-check me-1"></i>
                            Válido até: <?= date('d/m/Y', strtotime(usuario_logado()->premium_ate)) ?>
                        </span>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Badges de benefícios -->
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <span class="badge" style="background: linear-gradient(135deg, rgba(139,78,207,0.3), rgba(103,46,186,0.5)); color: #fff; font-size: 0.7rem;">
                            <i class="bi bi-lightning-charge-fill text-warning"></i> Acesso VIP
                        </span>
                        <span class="badge" style="background: linear-gradient(135deg, rgba(0,191,255,0.3), rgba(0,150,199,0.5)); color: #fff; font-size: 0.7rem;">
                            <i class="bi bi-gift-fill text-info"></i> Ofertas Exclusivas
                        </span>
                        <span class="badge" style="background: linear-gradient(135deg, rgba(255,107,53,0.3), rgba(255,140,0,0.5)); color: #fff; font-size: 0.7rem;">
                            <i class="bi bi-star-fill text-warning"></i> Suporte Prioritário
                        </span>
                    </div>
                </div>
                
                <!-- Botão para gerenciar assinatura -->
                <div class="text-center mt-3">
                    <a href="<?= site_url('assinaturas/minhas') ?>" class="btn btn-sm" style="background: linear-gradient(135deg, #ffd700, #ff8c00); color: #000; font-weight: 600; border-radius: 20px; padding: 8px 20px;">
                        <i class="bx bx-crown me-1"></i> Gerenciar Assinatura
                    </a>
                </div>
            </div>
        </div>
        <?php elseif (isset($plano_premium) && $plano_premium): ?>
        <!-- Banner Premium para não-premium -->
        <a href="<?= site_url('assinaturas') ?>" class="card w-100 shadow-lg mb-2 text-decoration-none position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px;">
            <div class="position-absolute" style="top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
            <div class="position-absolute" style="bottom: -30px; left: -30px; width: 100px; height: 100px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div class="card-body py-3 px-3 position-relative">
                <div class="d-flex align-items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: rgba(255,255,255,0.2);">
                            <i class="bx bx-crown text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <span class="text-white fw-bold d-block" style="font-size: 1rem;">Seja Premium!</span>
                        <span class="text-white-50" style="font-size: 0.8rem;"><?= $plano_premium->getPrecoFormatado() ?>/mês</span>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 0.7rem;">
                            <i class="bx bx-right-arrow-alt"></i>
                        </span>
                    </div>
                </div>
                <?php $beneficios = $plano_premium->getBeneficios(); ?>
                <?php if (!empty($beneficios)): ?>
                <div class="mt-2 d-flex gap-1 flex-wrap">
                    <?php foreach (array_slice($beneficios, 0, 3) as $beneficio): ?>
                    <span class="badge text-white-50" style="font-size: 0.65rem; background: rgba(255,255,255,0.15);">
                        <i class="bx bx-check"></i> <?= esc($beneficio) ?>
                    </span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
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
            <?php if (!empty($orderbumps)) : ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="produtos-tab" data-bs-toggle="tab" data-bs-target="#produtos" type="button" role="tab" aria-controls="produtos" aria-selected="false">
                    <i class="bi bi-bag-check me-1"></i>Meus Produtos
                    <span class="badge bg-purple ms-1"><?= count($orderbumps) ?></span>
                </button>
            </li>
            <?php endif; ?>
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
                                <div class="position-absolute" style="top: 50%; left: 15px; transform: translateY(-50%); z-index: 20;">
                                    <img src="<?= $avatarUrl ?>" style="max-height: 80px; max-width: 200px; object-fit: contain;">
                                </div>
                            <?php endif; ?>
                            <div class="ticket-card-buttons">
                                <a href="<?= site_url('/ingressos/gerarIngressoPdf/' . $i->id) ?>" target="_blank" title="Baixar">
                                    <i class="bi bi-download"></i>
                                </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#participante<?= $i->id; ?>Modal" title="Editar participante" style="width: auto; padding: 0 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">
                                    <i class="bi bi-pencil me-1"></i>Editar
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
                                <div class="flex-shrink-0 text-center">
                                    <small class="text-muted d-block mb-1" style="font-size: 0.7rem;"><?= $i->codigo ?></small>
                                    <?php 
                                    $ultimoAcesso = isset($ultimo_acesso_por_ingresso[$i->id]) ? $ultimo_acesso_por_ingresso[$i->id] : null;
                                    $totalAcessos = isset($total_acessos_por_ingresso[$i->id]) ? $total_acessos_por_ingresso[$i->id] : 0;
                                    ?>
                                    <img src="<?= $i->qr ?>" class="qr-zoom" style="width: 120px; height: 120px; background-color:#fff; padding: 2px; border-radius: 8px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#qrModal" data-qr="<?= $i->qr ?>" data-codigo="<?= $i->codigo ?>" data-acesso="<?= $ultimoAcesso ? date('d/m/Y H:i', strtotime($ultimoAcesso)) : '' ?>" data-total="<?= $totalAcessos ?>" title="Clique para ampliar">
                                    <?php if ($ultimoAcesso): ?>
                                        <span class="badge bg-success mt-2 d-block" style="font-size: 0.65rem;"><i class="bi bi-check-circle me-1"></i><?= date('d/m/Y H:i', strtotime($ultimoAcesso)) ?> <span class="badge bg-light text-success ms-1"><?= $totalAcessos ?></span></span>
                                    <?php endif; ?>
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
                                <div class="position-absolute" style="top: 50%; left: 15px; transform: translateY(-50%); z-index: 20;">
                                    <img src="<?= $avatarUrl ?>" style="max-height: 80px; max-width: 200px; object-fit: contain; opacity: 0.8;">
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
                                <div class="flex-shrink-0 text-center">
                                    <small class="text-muted d-block mb-1" style="font-size: 0.7rem;"><?= $i->codigo ?></small>
                                    <?php 
                                    $ultimoAcesso = isset($ultimo_acesso_por_ingresso[$i->id]) ? $ultimo_acesso_por_ingresso[$i->id] : null;
                                    $totalAcessos = isset($total_acessos_por_ingresso[$i->id]) ? $total_acessos_por_ingresso[$i->id] : 0;
                                    ?>
                                    <img src="<?= $i->qr ?>" class="qr-zoom" style="width: 120px; height: 120px; background-color:#fff; padding: 2px; border-radius: 8px; opacity: 0.7; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#qrModal" data-qr="<?= $i->qr ?>" data-codigo="<?= $i->codigo ?>" data-acesso="<?= $ultimoAcesso ? date('d/m/Y H:i', strtotime($ultimoAcesso)) : '' ?>" data-total="<?= $totalAcessos ?>" title="Clique para ampliar">
                                    <?php if ($ultimoAcesso): ?>
                                        <span class="badge bg-success mt-2 d-block" style="font-size: 0.65rem;"><i class="bi bi-check-circle me-1"></i><?= date('d/m/Y H:i', strtotime($ultimoAcesso)) ?> <span class="badge bg-light text-success ms-1"><?= $totalAcessos ?></span></span>
                                    <?php endif; ?>
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
            
            <!-- Aba Meus Produtos -->
            <?php if (!empty($orderbumps)) : ?>
            <div class="tab-pane fade" id="produtos" role="tabpanel" aria-labelledby="produtos-tab">
                <div class="card bg-dark border-0 shadow">
                    <div class="card-body">
                        <h5 class="text-white mb-4"><i class="bi bi-bag-check me-2" style="color: #a855f7"></i>Meus Produtos</h5>
                        <div class="row g-3">
                            <?php foreach ($orderbumps as $ob) : ?>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-center gap-3 p-3 rounded" style="background: rgba(103, 46, 186, 0.1); border: 1px solid rgba(103, 46, 186, 0.3);" id="orderbump-item-<?= $ob->id ?>">
                                        <?php if (!empty($ob->imagem)) : ?>
                                            <?php 
                                            // Imagens dos orderbumps ficam no backoffice externo
                                            if (strpos($ob->imagem, 'http') === 0) {
                                                $imagemUrl = $ob->imagem;
                                            } else {
                                                $imagemUrl = 'https://backoffice.mundodream.com.br/uploads/order_bumps/' . $ob->imagem;
                                            }
                                            ?>
                                            <img src="<?= $imagemUrl ?>" 
                                                 alt="<?= esc($ob->nome) ?>" 
                                                 style="width: 70px; height: 70px; object-fit: cover; border-radius: 10px;">
                                        <?php else : ?>
                                            <div style="width: 70px; height: 70px; background: rgba(255,255,255,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-box text-muted" style="font-size: 2rem;"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="flex-grow-1">
                                            <p class="mb-1 text-white fw-semibold"><?= esc($ob->nome) ?></p>
                                            <small class="text-muted d-block">R$ <?= number_format($ob->preco_unitario, 2, ',', '.') ?></small>
                                            <small class="text-muted">Pedido #<?= esc($ob->pedido_codigo) ?></small>
                                        </div>
                                        <div class="text-end">
                                            <?php if ($ob->usado) : ?>
                                                <span class="badge bg-secondary d-block mb-1">
                                                    <i class="bi bi-check-circle me-1"></i>Usado
                                                </span>
                                                <small class="text-muted" style="font-size: 0.7rem;"><?= date('d/m/Y H:i', strtotime($ob->usado_em)) ?></small>
                                            <?php else : ?>
                                                <span class="badge bg-success d-block mb-2">Disponível</span>
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-light btn-marcar-usado" 
                                                        data-id="<?= $ob->id ?>"
                                                        data-nome="<?= esc($ob->nome) ?>">
                                                    <i class="bi bi-check2-square me-1"></i>Usar
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
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



<!-- Modal QR Code Ampliado -->
<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-secondary">
                <h5 class="modal-title" id="qrModalLabel">QR Code</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body text-center py-4">
                <img id="qrModalImage" src="" style="width: 320px; height: 320px; background-color:#fff; padding: 8px; border-radius: 12px;">
                <p class="mt-3 mb-1 text-muted" id="qrModalCodigo"></p>
                <div id="qrModalAcesso" class="mt-2" style="display: none;">
                    <span class="badge bg-success" style="font-size: 0.85rem;"><i class="bi bi-check-circle me-1"></i>Último acesso: <span id="qrModalAcessoData"></span> <span class="badge bg-light text-success ms-1" id="qrModalTotal"></span></span>
                </div>
            </div>
        </div>
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

<script>
    // Modal do QR Code
    document.getElementById('qrModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var qrSrc = button.getAttribute('data-qr');
        var codigo = button.getAttribute('data-codigo');
        var acesso = button.getAttribute('data-acesso');
        var total = button.getAttribute('data-total');
        
        document.getElementById('qrModalImage').src = qrSrc;
        document.getElementById('qrModalCodigo').textContent = 'Código: ' + codigo;
        
        var acessoDiv = document.getElementById('qrModalAcesso');
        var acessoData = document.getElementById('qrModalAcessoData');
        var acessoTotal = document.getElementById('qrModalTotal');
        if (acesso && acesso !== '') {
            acessoData.textContent = acesso;
            acessoTotal.textContent = total;
            acessoDiv.style.display = 'block';
        } else {
            acessoDiv.style.display = 'none';
        }
    });
</script>

<!-- Modal de Confirmação para Marcar OrderBump como Usado -->
<div class="modal fade" id="confirmarUsadoModal" tabindex="-1" aria-labelledby="confirmarUsadoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-secondary">
                <h5 class="modal-title" id="confirmarUsadoModalLabel">
                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                    Confirmar Ação
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body py-4">
                <p class="mb-3">Você está marcando o produto abaixo como <strong>usado</strong>:</p>
                <div class="p-3 rounded mb-3" style="background: rgba(255,255,255,0.1);">
                    <strong id="confirmarUsadoNome" class="text-white"></strong>
                </div>
                <div class="alert alert-warning mb-0">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <strong>Atenção:</strong> Esta operação não pode ser desfeita!
                </div>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-danger" id="btnConfirmarUsado">
                    <i class="bi bi-check-circle me-1"></i>Confirmar - Marcar como Usado
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Script para marcar orderbump como usado com dupla verificação
    (function() {
        let orderbumpIdAtual = null;
        const modal = new bootstrap.Modal(document.getElementById('confirmarUsadoModal'));
        
        // Primeiro clique: abre o modal de confirmação
        document.querySelectorAll('.btn-marcar-usado').forEach(btn => {
            btn.addEventListener('click', function() {
                orderbumpIdAtual = this.getAttribute('data-id');
                const nome = this.getAttribute('data-nome');
                document.getElementById('confirmarUsadoNome').textContent = nome;
                modal.show();
            });
        });
        
        // Segundo clique (no modal): confirma e processa
        document.getElementById('btnConfirmarUsado').addEventListener('click', function() {
            if (!orderbumpIdAtual) return;
            
            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Processando...';
            
            fetch('<?= site_url('console/marcarOrderBumpUsado/') ?>' + orderbumpIdAtual, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                modal.hide();
                
                if (data.success) {
                    // Atualizar a UI
                    const item = document.getElementById('orderbump-item-' + orderbumpIdAtual);
                    if (item) {
                        const btnContainer = item.querySelector('div:last-child');
                        btnContainer.innerHTML = `
                            <span class="badge bg-secondary" title="Usado agora">
                                <i class="bi bi-check-circle me-1"></i>Usado
                            </span>
                        `;
                    }
                    
                    // Toast de sucesso
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#28a745",
                    }).showToast();
                } else {
                    // Toast de erro
                    Toastify({
                        text: data.message,
                        duration: 4000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#dc3545",
                    }).showToast();
                }
            })
            .catch(error => {
                modal.hide();
                console.error('Erro:', error);
                Toastify({
                    text: 'Erro ao processar a requisição. Tente novamente.',
                    duration: 4000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#dc3545",
                }).showToast();
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-check-circle me-1"></i>Confirmar - Marcar como Usado';
                orderbumpIdAtual = null;
            });
        });
    })();
</script>


<?php echo $this->endSection() ?>