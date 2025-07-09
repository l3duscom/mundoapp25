<input type="hidden" id="declaration_id" name="declaration_id" value="<?php echo $declaration->id; ?>">
<div class="row">
    <div class="form-group col-md-6">
        <label class="form-control-label" for="estados">Estado</label>
        <select id="estados" name="estados" class="form-control"><?php echo $options_estados; ?></select>
    </div>

    <div class="form-group col-md-6">
        <label class="form-control-label" for="city_code">Cidade</label>
        <select id="city_code" name="city_code" class="form-control" disabled>
            <option>--</option>
        </select>
    </div>
    <div class="form-group col-md-2">
        <label class="form-control-label" for="tipo_cliente">Cliente</label>
        <select id="tipo_cliente" name="tipo_cliente" class="form-control">
            <option>--</option>
            <option value="PF">PF</option>
            <option value="PJ">PJ</option>
        </select>
    </div>

    <div class="form-group col-md-4">
        <label class="form-control-label" for="tipo_meio">Tipo de meio</label>
        <select id="tipo_meio" name="tipo_meio" class="form-control">
            <option>--</option>
            <option value="fibra">Fibra Ótica</option>
            <option value="satelite">Satélite</option>
            <option value="radio">Radio</option>
            <option value="cabo_coaxial">Cabo Coaxial</option>
            <option value="cabo_metalico">Cabo Metálico</option>
        </select>
    </div>

    <div class="form-group col-md-3">
        <label class="form-control-label" for="tipo_tecnologia">Tipo de tecnologia</label>
        <select id="tipo_tecnologia" name="tipo_tecnologia" class="form-control">
            <option>--</option>
            <option value="ETHERNET">Ethernet</option>
            <option value="FTTH">FTTH</option>
            <option value="NR">NR</option>
        </select>
    </div>



    <div class="form-group col-lg-3">
        <label class="form-control-label">Quantidade de acessos</label>
        <input type="number" name="qtd_acessos" class="form-control">
    </div>

</div>