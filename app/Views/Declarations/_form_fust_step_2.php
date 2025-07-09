<input type="hidden" id="declaration_id" name="declaration_id" value="<?php echo $declaration->id; ?>">
<div class="row">

    <div class="form-group col-lg-3">
        <label class="form-control-label">Referência</label>
        <input type="date" name="referencia" class="form-control">
    </div>
    <div class="form-group col-lg-3">
        <label class="form-control-label">PIS</label>
        <input type="decimal" name="pis" class="form-control">
    </div>
    <div class="form-group col-lg-3">
        <label class="form-control-label">COFINS</label>
        <input type="decimal" name="cofins" class="form-control">
    </div>
    <div class="form-group col-lg-3">
        <label class="form-control-label">ICMS</label>
        <input type="decimal" name="icms" class="form-control">
    </div>
    <div class="col-12">
        <div class="block">

            <strong>Faturamento por processos</strong>
            <hr>
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="processo">Processo</label>
                    <select id="processo" name="processo" class="form-control">
                        <option>--</option>
                        <option value="Simples Nacional">Simples Nacional</option>
                        <option value="Lucro Real">Lucro Real</option>
                        <option value="Lucro Presumido">Lucro Presumido</option>
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <label class="form-control-label">Faturamento</label>
                    <input type="text" name="faturamento" class="form-control money">
                </div>

                <div class="form-group col-lg-4">
                    <label class="form-control-label">Quantidade NFE</label>
                    <input type="number" name="qtd_nfe" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>