<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />



<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">

    <?php $id = usuario_logado()->id ?>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3 text-muted"><a href="<?php echo site_url('/eventos'); ?>">Eventos</a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <?php if (usuario_logado()->is_membro) : ?>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('/'); ?>"><i class="fadeIn animated bx bx-crown" style="color: #ffd700;" title="Membro Premium"></i> </a></li>
                    <?php else : ?>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('/'); ?>"><i class="bx bx-home-alt"></i></a></li>
                    <?php endif; ?>
                    <li class="breadcrumb-item active" aria-current="page"><?= $titulo; ?></li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="col-lg-12">

        <div class="card shadow radius-10">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="card-title text-danger">Confirmar Exclusão</h5>
                        <hr>
                        <div class="alert alert-warning">
                            <h6 class="alert-heading">Atenção!</h6>
                            <p>Tem certeza que deseja excluir o evento <strong><?= esc($evento->nome) ?></strong>?</p>
                            <hr>
                            <p class="mb-0">Esta ação não pode ser desfeita. O evento será marcado como excluído e não aparecerá mais na listagem principal.</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h6>Informações do Evento:</h6>
                                <p><strong>Nome:</strong> <?= esc($evento->nome) ?></p>
                                <p><strong>Data Início:</strong> <?= $evento->data_inicio ? date('d/m/Y', strtotime($evento->data_inicio)) : 'Não informado' ?></p>
                                <p><strong>Data Fim:</strong> <?= $evento->data_fim ? date('d/m/Y', strtotime($evento->data_fim)) : 'Não informado' ?></p>
                                <p><strong>Categoria:</strong> <?= esc($evento->categoria ?? 'Não informado') ?></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Local:</h6>
                                <p><strong>Local:</strong> <?= esc($evento->local ?? 'Não informado') ?></p>
                                <p><strong>Endereço:</strong> <?= esc($evento->endereco ?? 'Não informado') ?>, <?= esc($evento->numero ?? '') ?></p>
                                <p><strong>Cidade:</strong> <?= esc($evento->cidade ?? 'Não informado') ?> - <?= esc($evento->estado ?? '') ?></p>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo site_url('eventos'); ?>" class="btn btn-secondary">
                                <i class="bx bx-arrow-back"></i> Cancelar
                            </a>
                            <?php echo form_open("eventos/excluir/$evento->id"); ?>
                                <button type="submit" class="btn btn-danger">
                                    <i class="bx bx-trash"></i> Confirmar Exclusão
                                </button>
                            <?php echo form_close(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




</div>





<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>


<script type="text/javascript" src="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.js') ?>"></script>



<?php echo $this->endSection() ?> 