<?php if (session()->has('sucesso')) : ?>
    <div id="alerta" class="alert border-0 bg-success alert-dismissible fade show py-2">
        <div class="d-flex align-items-center">
            <div class="fs-1 text-white">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="ms-3 flex-grow-1">
                <div class="text-white"><?php echo session('sucesso'); ?></div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->has('erro')) : ?>
    <div id="alerta" class="alert border-0 bg-danger alert-dismissible fade show py-2">
        <div class="d-flex align-items-center">
            <div class="fs-3 text-white"><i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="ms-3">
                <div class="text-white"><?php echo session('erro'); ?></div>

            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

<?php endif; ?>

<?php if (session()->has('info')) : ?>


    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Informação!</strong> <?php echo session('info'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


<?php endif; ?>

<?php if (session()->has('atencao')) : ?>


    <div id="alerta" class="alert border-0 bg-warning alert-dismissible fade show py-2">
        <div class="d-flex align-items-start">
            <div class="fs-1 text-dark pt-1">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="ms-3 flex-grow-1">
                <div class="text-dark"><?php echo session('atencao'); ?></div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>


<?php endif; ?>


<!-- Utilizaremos quando fizermos um post sem ajax request -->
<?php if (session()->has('erros_model')) : ?>

    <ul>

        <?php foreach (session('erros_model') as $erro) : ?>

            <li class="text-danger"><?php echo $erro; ?></li>

        <?php endforeach; ?>

    </ul>

<?php endif; ?>


<!-- Utilizamos quando o formulário é interceptado, por erro no backend, 
ou quando estamos fazendo um debug para ver o que está vindo do POST-->
<?php if (session()->has('error')) : ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo session('error'); ?>

    </div>


<?php endif; ?>

<script>
    // Selecione o elemento do alerta
    var alertElement = document.getElementById('alerta');

    // Se o elemento existir, agende a execução do botão de fechar após 10000 milissegundos (10 segundos)
    if (alertElement) {
        setTimeout(function() {
            var closeButton = alertElement.querySelector('.btn-close');
            if (closeButton) {
                closeButton.click(); // Simula um clique no botão de fechar
            }
        }, 30000);
    }
</script>