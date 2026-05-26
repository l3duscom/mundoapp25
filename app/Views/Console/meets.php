<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>
<style>
.mg-page-title {
    color: #fff;
    font-weight: 700;
    margin-bottom: 1.5rem;
}
.mg-section-title {
    color: #adb5bd;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 1.5rem 0 1rem;
    display: flex;
    align-items: center;
    gap: 8px;
}
.mg-section-title i { font-size: 1.1rem; }
.mg-slot-card {
    background: #212529;
    border: 1px solid #2d343b;
    border-radius: 12px;
    padding: 14px 18px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    transition: border-color .2s ease;
}
.mg-slot-card:hover { border-color: #3a4149; }
.mg-slot-info { display: flex; flex-direction: column; gap: 2px; min-width: 0; }
.mg-slot-name { color: #fff; font-weight: 600; font-size: .95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.mg-slot-sub { color: #6c757d; font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; }
.mg-slot-lock {
    background: #2d343b;
    color: #adb5bd;
    border: 1px solid #3a4149;
    border-radius: 999px;
    padding: 6px 14px;
    font-size: .8rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    cursor: not-allowed;
}
.mg-slot-lock i { font-size: .9rem; }

/* VIP — destaque amarelo */
.mg-slot-card.vip {
    border: 1px solid #f5c518;
    background:
        repeating-linear-gradient(
            -45deg,
            rgba(245,197,24,0.08) 0,
            rgba(245,197,24,0.08) 8px,
            transparent 8px,
            transparent 16px
        ),
        #212529;
    box-shadow: 0 0 0 1px rgba(245,197,24,0.15);
}
.mg-slot-card.vip .mg-slot-name { color: #f5c518; }
.mg-slot-card.vip .mg-slot-sub { color: #f5c518; opacity: .8; }
.mg-vip-msg {
    margin-top: 6px;
    color: #f5c518;
    font-size: .8rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
}
.mg-vip-msg i { font-size: 1rem; }
.mg-vip-badge {
    background: rgba(245,197,24,.15);
    color: #f5c518;
    border: 1px solid #f5c518;
    border-radius: 999px;
    padding: 6px 14px;
    font-size: .8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    text-transform: uppercase;
    letter-spacing: .5px;
}
.mg-meet-card {
    background: #212529;
    border: 1px solid #2d343b;
    border-radius: 14px;
    padding: 18px;
    margin-bottom: 14px;
}
.mg-meet-card.past { opacity: .75; }
.mg-meet-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 8px;
}
.mg-meet-artista { color: #fff; font-weight: 700; font-size: 1.25rem; margin: 0; }
.mg-meet-event { color: #6c757d; font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 10px; }
.mg-meet-meta { display: flex; flex-wrap: wrap; gap: 12px; font-size: .85rem; color: #adb5bd; }
.mg-meet-meta span { display: inline-flex; align-items: center; gap: 5px; }
.mg-meet-meta .mg-ordem { color: #b4ff48; font-weight: 700; }
.mg-tipo-badge {
    background: rgba(180,255,72,.12);
    color: #b4ff48;
    border: 1px solid rgba(180,255,72,.3);
    border-radius: 999px;
    padding: 3px 10px;
    font-size: .7rem;
    text-transform: uppercase;
    letter-spacing: .5px;
    font-weight: 600;
}
.mg-qr-wrap {
    margin-top: 14px;
    background: #fff;
    border-radius: 10px;
    padding: 8px;
    max-width: 220px;
}
.mg-qr-wrap img { width: 100%; display: block; }
.mg-empty {
    color: #6c757d;
    font-size: .9rem;
    text-align: center;
    padding: 24px 12px;
    border: 1px dashed #2d343b;
    border-radius: 10px;
    background: rgba(255,255,255,.01);
}
.mg-help {
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid #2d343b;
    color: #6c757d;
    font-size: .8rem;
}
.mg-help a { color: #b4ff48; text-decoration: none; }
.mg-help a:hover { text-decoration: underline; }
</style>
<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">
    <div class="col-lg-8">
        <div id="response"></div>

        <h3 class="mg-page-title">Meus Meet &amp; Greet</h3>

        <?php
        $renderMeet = function ($meet, $exibirQr = true) {
        ?>
            <div class="mg-meet-card <?= $exibirQr ? '' : 'past' ?>">
                <div class="mg-meet-header">
                    <h4 class="mg-meet-artista"><?= esc($meet->artista) ?></h4>
                    <span class="mg-tipo-badge"><?= esc($meet->tipo) ?></span>
                </div>
                <?php if (!empty($meet->evento_nome)) : ?>
                    <div class="mg-meet-event"><i class="bx bx-calendar-event"></i> <?= esc($meet->evento_nome) ?></div>
                <?php endif; ?>
                <div class="mg-meet-meta">
                    <span><i class="bx bx-calendar"></i> <?= date('d/m/Y', strtotime($meet->data_meet)) ?></span>
                    <span><i class="bx bx-time-five"></i> <?= esc($meet->hora_inicial) ?></span>
                    <span>Posição: <span class="mg-ordem"><?= esc($meet->ordem) ?>º</span></span>
                </div>
                <?php if ($exibirQr) : ?>
                    <div class="mg-qr-wrap">
                        <img src="<?= $meet->qr ?>" alt="QR Code">
                    </div>
                <?php endif; ?>
            </div>
        <?php
        };
        ?>

        <!-- ============ EVENTO ATUAL ============ -->
        <div class="mg-section-title"><i class="bx bx-time-five"></i> Evento atual</div>

        <?php if (!empty($ingressosAtuais)) : ?>
            <?php foreach ($ingressosAtuais as $ing) : ?>
                <?php
                $nomeIng = strtolower((string)($ing->nome ?? ''));
                $isVip  = stripos($nomeIng, 'vip')  !== false;
                $isEpic = !$isVip && stripos($nomeIng, 'epic') !== false;
                $dataLiberacao = $isEpic ? '28/05/2026' : '31/05/2026';
                ?>
                <?php if ($isVip) : ?>
                    <div class="mg-slot-card vip">
                        <div class="mg-slot-info" style="flex: 1;">
                            <span class="mg-slot-name"><?= esc($ing->nome) ?></span>
                            <span class="mg-slot-sub">VIP FULL</span>
                            <div class="mg-vip-msg">
                                <i class="bx bxs-star"></i>
                                Meet &amp; Greet liberado para VIP FULL sem necessidade de check-in.
                            </div>
                        </div>
                        <span class="mg-vip-badge">
                            <i class="bx bxs-crown"></i> Acesso liberado
                        </span>
                    </div>
                <?php else : ?>
                    <div class="mg-slot-card">
                        <div class="mg-slot-info">
                            <span class="mg-slot-name"><?= esc($ing->nome) ?></span>
                            <span class="mg-slot-sub">Slot Meet &amp; Greet</span>
                        </div>
                        <button type="button" class="mg-slot-lock" disabled>
                            <i class="bx bxs-lock-alt"></i> <?= $dataLiberacao ?>
                        </button>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($meetsAtuais)) : ?>
            <?php foreach ($meetsAtuais as $meet) : ?>
                <?php $renderMeet($meet, true); ?>
            <?php endforeach; ?>
        <?php elseif (empty($ingressosAtuais)) : ?>
            <div class="mg-empty">Nenhum meet &amp; greet para o evento atual.</div>
        <?php endif; ?>

        <!-- ============ EVENTOS ANTERIORES ============ -->
        <div class="mg-section-title"><i class="bx bx-archive"></i> Eventos anteriores</div>

        <?php if (!empty($meetsAnteriores)) : ?>
            <?php foreach ($meetsAnteriores as $meet) : ?>
                <?php $renderMeet($meet, false); ?>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="mg-empty">Nenhum meet &amp; greet em eventos anteriores.</div>
        <?php endif; ?>

        <div class="mg-help">
            Dúvidas sobre o meet &amp; greet? <a href="https://dreamfest.com.br/central-de-ajuda/como-funciona-o-meet-greet" target="_blank">Clique aqui</a>
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
                url: '<?php echo site_url('pedidos/editar_endereco_pedido'); ?>',
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
                                "<?php echo site_url("ingressos/"); ?>";

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