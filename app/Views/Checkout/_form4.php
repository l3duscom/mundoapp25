<div class="d-flex align-items-center mt-0">
    <div class="card border shadow-none w-100">


        <div class="card-body">
            <div class="row">
                <input type="hidden" name="total" value="<?= $_SESSION['total'] ?>">
                <input type="hidden" name="convite" value="<?= $_SESSION['convite'] ?>">
                <input type="hidden" id="forma_pagamento" name="forma_pagamento" value="">



                <div class="form-group col-md-12">

                    <input type="email" name="email" placeholder="Informe seu email" class="form-control form-control-lg mb-2 shadow text-dark" style="padding:13px;" required>
                    <div id="email"></div>
                </div>

            </div>


        </div>
    </div>
</div>






<script>
    function setaPagamento(forma) {
        var elemento = document.getElementById("forma_pagamento");
        elemento.value = forma;

    }
</script>