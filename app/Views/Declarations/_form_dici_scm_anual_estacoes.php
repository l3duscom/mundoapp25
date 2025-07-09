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


    <div class="form-group col-lg-3">
        <label class="form-control-label">ID Estação</label>
        <input type="text" name="id_estacao" class="form-control">
    </div>

    <div class="form-group col-lg-3">
        <label class="form-control-label">Nº Estação</label>
        <input type="text" name="numestacao" class="form-control">
    </div>

    <div class="form-group col-lg-3">
        <label class="form-control-label">Latitude</label>
        <input type="text" name="lat" class="form-control">
    </div>

    <div class="form-group col-lg-3">
        <label class="form-control-label">Longitude</label>
        <input type="text" name="long" class="form-control">
    </div>

    <div class="form-group col-lg-10">
        <label class="form-control-label">Endereço da estação (Rua,
            nº, bairro, cidade e CEP)</label>
        <input type="text" name="endereco" class="form-control">
    </div>

    <div class="form-group col-md-2">
        <label class="form-control-label" for="DADO_INFORMADO">Abertura</label>
        <select id="abertura" name="abertura" class="form-control">
            <option>--</option>
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>
    </div>

</div>