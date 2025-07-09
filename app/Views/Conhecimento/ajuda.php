<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<!-- Aqui coloco os estilos da view-->

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">
    <div class="col-lg-12">
        <div class="block">
            <strong><i class="fas fa-info-circle text-secondary" style="padding-right: 10px;"></i><?php echo $titulo; ?></strong>
            <hr>
            <p>
                Consolidação das informações a respeito das coletas de acessos em vigor a partir de 2021.
                <br><br>
                Com a aprovação da Resolução n° 712/2019, o processo de coleta de informações setoriais realizado pela Agência passou a ser organizado segundo o Regulamento para Coleta de Dados Setoriais.
                <br><br>
                No âmbito de suas atribuições, a Gerência de Universalização e Ampliação do Acesso é responsável por manter e acompanhar a evolução dos acessos dos serviços de telecomunicações de grande interesse coletivo. Com isso, conduziu o processo de estruturação de coletas de dados de acessos do Serviço de Comunicação Multimídia (SCM), Serviço Móvel Pessoal (SMP), Serviço de Telefonia Fixa Comutada (STFC) e dos diversos serviços de TV mediante assinatura (TVA, TVC, DTH, MMDS e SeAC). A partir de 1° de fevereiro de 2021, as coletas de acessos serão realizadas mediante o sistema DICI.
            </p>
        </div>
    </div>
    <?php foreach ($conhecimentos as $conhecimento) : ?>
        <div class="col-lg-12">
            <div class="block">
                <p><strong><?= $conhecimento->titulo; ?></strong><br><span class="text-muted mb-0" style="font-size: 10px; font-weight: 600;"><?= $conhecimento->categoria_titulo; ?></span>
                    <hr>
                </p>
                <p><?= $conhecimento->descricao; ?></p>

            </div> <!-- ./ block -->
        </div>
    <?php endforeach; ?>

</div>


<?php echo $this->endSection() ?>




<?php echo $this->section('scripts') ?>


<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>


<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>





<?php echo $this->endSection() ?>