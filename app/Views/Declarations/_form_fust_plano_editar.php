<div class="row">

    <div class="form-group col-lg-3">
        <label class="form-control-label">Referência</label>
        <input type="date" name="referencia" class="form-control" value="<?php echo esc($plano->referencia); ?>">
    </div>
    <div class="form-group col-lg-3">
        <label class="form-control-label">PIS</label>
        <input type="decimal" name="pis" class="form-control" value="<?php echo esc($plano->pis); ?>">
    </div>
    <div class="form-group col-lg-3">
        <label class="form-control-label">COFINS</label>
        <input type="decimal" name="cofins" class="form-control" value="<?php echo esc($plano->cofins); ?>">
    </div>
    <div class="form-group col-lg-3">
        <label class="form-control-label">ICMS</label>
        <input type="decimal" name="icms" class="form-control" value="<?php echo esc($plano->icms); ?>">
    </div>
    <div class="col-12">
        <div class="block">

            <strong>Faturamento por processos</strong>
            <hr>
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="processo">Processo</label>
                    <select id="processo" name="processo" class="form-control">
                        <option value="<?php echo esc($plano->processo); ?>"><?php echo esc($plano->processo); ?></option>
                        <option>--</option>
                        <option value="Simples Nacional">Simples Nacional</option>
                        <option value="Lucro Real">Lucro Real</option>
                        <option value="Lucro Presumido">Lucro Presumido</option>
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <label class="form-control-label">Faturamento</label>
                    <input type="text" name="faturamento" class="form-control money" value="<?php echo esc($plano->faturamento); ?>">
                </div>

                <div class="form-group col-lg-4">
                    <label class="form-control-label">Quantidade NFE</label>
                    <input type="number" name="qtd_nfe" class="form-control" value="<?php echo esc($plano->qtd_nfe); ?>">
                </div>
            </div>
        </div>
    </div>
</div>