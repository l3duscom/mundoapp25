<div class="row">
    <input type="hidden" name="ingresso_id" value="<?php echo $id ?>">
    <input type="hidden" name="pedido_id" value="<?php echo $pedido ?>">


    <div class="form-group col-md-6">
        <label class="form-control-label">Código Pulseira/credencial</label>
        <input type="text" name="codigo" autofocus class="form-control " value="<?php if ($credencial) echo esc($credencial->codigo); ?>" <?php if ($credencial) echo 'disabled' ?>>
    </div>


</div>