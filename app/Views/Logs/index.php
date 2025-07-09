<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> Logs <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/selectize/selectize.bootstrap4.css') ?>" />

<style>
    /* Estilizando o select para acompanhar a formatação do template */

    .selectize-input,
    .selectize-control.single .selectize-input.input-active {
        background: #2d3035 !important;
    }

    .selectize-dropdown,
    .selectize-input,
    .selectize-input input {
        color: #777;
    }

    .selectize-input {
        /*        height: calc(2.4rem + 2px);*/
        border: 1px solid #444951;
        border-radius: 0;
    }
</style>

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">


    <ul>
        <?php foreach ($logs as $file) : ?>
            <li><a href="<?= site_url('logs/view/' . basename($file)) ?>"><?= basename($file) ?></a></li>
        <?php endforeach; ?>
    </ul>


</div>


<?php echo $this->endSection() ?>




<?php echo $this->section('scripts') ?>

<script type="text/javascript" src="<?php echo site_url('recursos/vendor/selectize/selectize.min.js') ?>"></script>


<script>
    $(document).ready(function() {

        var $select = $(".selectize").selectize({
            create: false,
            // sortField: "text",

            maxItem: 1,
            valueField: 'id',
            labelField: 'nome',
            searchField: ['nome'],

            load: function(query, callback) {

                if (query.length < 4) {

                    return callback();

                }

                $.ajax({

                    url: '<?php echo site_url("logs/buscausuarios/") ?>',
                    data: {
                        termo: encodeURIComponent(query)
                    },

                    success: function(response) {

                        $select.options = response;

                        callback(response);

                    },
                    error: function() {

                        alert(
                            'Não foi possível procesar a solicitação. Por favor entre em contato com o suporte técnico.'
                        );


                    }

                });


            }

        }); // fim selectize


    });
</script>

<?php echo $this->endSection() ?>