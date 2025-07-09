<div class="row">
    <div class="form-group col-lg-3">
        <label class="form-control-label">ID Estação</label>
        <input type="text" name="id_estacao" class="form-control" value="<?php echo esc($plano->id_estacao); ?>">
    </div>

    <div class="form-group col-lg-3">
        <label class="form-control-label">Nº Estação</label>
        <input type="text" name="numestacao" class="form-control" value="<?php echo esc($plano->numestacao); ?>">
    </div>

    <div class="form-group col-lg-3">
        <label class="form-control-label">Latitude</label>
        <input type="text" name="lat" class="form-control" value="<?php echo esc($plano->lat); ?>">
    </div>

    <div class="form-group col-lg-3">
        <label class="form-control-label">Longitude</label>
        <input type="text" name="long" class="form-control" value="<?php echo esc($plano->long); ?>">
    </div>

    <div class="form-group col-lg-10">
        <label class="form-control-label">Endereço da estação (Rua,
            nº, bairro, cidade e CEP)</label>
        <input type="text" name="endereco" class="form-control" value="<?php echo esc($plano->endereco); ?>">
    </div>

    <div class="form-group col-md-2">
        <label class="form-control-label" for="DADO_INFORMADO">Abertura</label>
        <select id="abertura" name="abertura" class="form-control">
            <option value="<?php echo esc($plano->abertura); ?>"><?php echo esc($plano->abertura); ?></option>
            <option>--</option>
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>
    </div>
</div>