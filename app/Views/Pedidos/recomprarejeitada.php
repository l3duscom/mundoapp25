<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo') ?>
<?php echo $titulo; ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('estilos') ?>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />
<?php echo $this->endSection() ?>

<?php echo $this->section('conteudo') ?>
<div class="row">
    <!--end breadcrumb-->
    <div class="ms-auto"></div>

    <div class="row">
        <div class="btn-group mb-4">
            <a href="<?php echo site_url('pedidos/recompra'); ?>" class="btn btn-secondary"><i class='bx bx-time'></i> Aguardando contato</a>
            <a href="<?php echo site_url('pedidos/recomprainiciada'); ?>" class="btn btn-primary"><i class='bx bxl-whatsapp'></i> Contato Iniciado</a>
            <a href="<?php echo site_url('pedidos/recomprarevertida'); ?>" class="btn btn-success"><i class='bx bxs-like'></i> Compra Revertida</a>
            <a href="<?php echo site_url('pedidos/recomprarejeitada'); ?>" class="btn btn-danger"><i class='bx bxs-dislike'></i> Compra Rejeitada</a>
        </div>
        <?php foreach ($recompra as $r) : ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow radius-10">
                            <div class="card-body">
                                <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
                                    <div class="breadcrumb-title pe-3"><strong class="font-20"><?= $r->nome ?></strong></div>
                                    <div class="ps-3">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb mb-0 p-0">
                                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-star"></i></a></li>
                                                <li class="breadcrumb-item active" aria-current="page">R$ <?= number_format($r->total, 2, ',', '.') ?></li>
                                            </ol>
                                        </nav>
                                    </div>

                                    <div class="ms-auto">
                                        <div class="btn-group mt-2">
                                            <?php if ($r->crm == '' || $r->crm == null) : ?>
                                                <a href="<?= site_url('/pedidos/checkContact/' . $r->id) ?>" class="btn btn-outline-primary mt-0 shadow">Iniciar Contato</a>
                                            <?php elseif ($r->crm == 'INICIADO') : ?>
                                                <a href="" class="btn btn-dark mt-0 shadow disabled">Contato iniciado <?= date('d/m/Y H:i:s', strtotime($r->updated_at)) ?></a>
                                                <a href="<?= site_url('/pedidos/revertido/' . $r->id) ?>" class="btn btn-outline-success mt-0 shadow">Comprou novamente</a>
                                                <a href="<?= site_url('/pedidos/rejeitado/' . $r->id) ?>" class="btn btn-outline-danger mt-0 shadow">Rejeitou compra</a>
                                            <?php elseif ($r->crm == 'REJEITADO' && $r->crmobs == null) : ?>
                                                <?php echo form_open("pedidos/motivo/$r->id") ?>
                                                <?= csrf_field() ?>
                                                <div class="row align-items-center">
                                                    <div class="col-md-8">
                                                        <label for="crmobs" class="form-label">Motivo:</label>
                                                        <textarea class="form-control" name="crmobs" rows="2" required></textarea>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <button type="submit" class="btn btn-outline-info w-100">Adicionar motivo</button>
                                                    </div>
                                                </div>
                                                <?php echo form_close(); ?>
                                            <?php elseif ($r->crm == 'REJEITADO' && ($r->crmobs != null || $r->crmobs != '')) : ?>
                                                <a href="" class="btn btn-outline-danger mt-0 shadow disabled">Recompra rejeitada em <?= date('d/m/Y H:i:s', strtotime($r->updated_at)) ?> <span style="color:aliceblue">Motivo da recusa: <?= $r->crmobs ?></span></a>
                                                <a href="<?= site_url('/pedidos/checkContact/' . $r->id) ?>" class="btn btn-outline-primary mt-0 shadow">Tentar novamente</a>


                                            <?php elseif ($r->crm == 'REVERTIDO') : ?>
                                                <a href="" class="btn btn-outline-success mt-0 shadow disabled">Revertido em <?= date('d/m/Y H:i:s', strtotime($r->updated_at)) ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <hr class="mt-2">
                                    <div class="col-lg-3">
                                        <p class="mb-0 text-muted" style="font-size: 10px;">Nome completo</p>
                                        <strong><?= $r->nome ?></strong>
                                    </div>
                                    <div class="col-lg-3">
                                        <p class="mb-0 text-muted" style="font-size: 10px;">Whatsapp</p>
                                        <strong><a href="<?= $r->whatsapp ?>" target="_blank"><?= str_replace("https://wa.me/", "", $r->whatsapp) ?></a></strong>
                                    </div>
                                    <div class="col-lg-3">
                                        <p class="mb-0 text-muted" style="font-size: 10px;">E-mail</p>
                                        <strong><a href="mailto:<?= $r->email ?>" target="_blank"><?= $r->email ?></a></strong>
                                    </div>
                                    <div class="col-lg-3">
                                        <p class="mb-0 text-muted" style="font-size: 10px;">Identificação</p>
                                        <strong><?= $r->cpf ?></strong>
                                    </div>
                                    <div class="mt-2"></div>
                                    <div class="col-lg-3">
                                        <p class="mb-0 text-muted" style="font-size: 10px;">Total do pedido</p>
                                        <strong>R$ <?= number_format($r->total, 2, ',', '.') ?></strong>
                                    </div>
                                    <div class="col-lg-3">
                                        <p class="mb-0 text-muted" style="font-size: 10px;">Forma de Pagamento</p>
                                        <strong><?= $r->pagamento ?></strong>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="mb-0 text-muted" style="font-size: 10px;">Entrega</p>
                                        <strong><?= $r->Entrega ?></strong>
                                    </div>
                                </div>
                                <hr class="mt-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <hr>
    </div>
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>
<script type="text/javascript" src="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.js') ?>"></script>
<?php echo $this->endSection() ?>