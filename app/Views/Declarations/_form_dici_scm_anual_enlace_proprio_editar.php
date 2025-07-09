<div class="row">
    <div class="form-group col-lg-3">
        <label class="form-control-label">Estação de Origem</label>
        <input type="text" name="estacao_a_id" class="form-control" value="<?php echo esc($plano->estacao_a_id); ?>">
    </div>

    <div class="form-group col-lg-3">
        <label class="form-control-label">Estação de Destino</label>
        <input type="text" name="estacao_b_id" class="form-control" value="<?php echo esc($plano->estacao_b_id); ?>">
    </div>

    <div class="form-group col-lg-3">
        <i class="fas fa-info" title="Identificação da estação de destino segundo os sistemas da prestadora." style="padding-right: 5px"></i>
        <label class="form-control-label">ID Enlaces Terrestres </label>
        <input type="text" name="enlaces_proprios_terrestres_id" class="form-control" value="<?php echo esc($plano->enlaces_proprios_terrestres_id); ?>">
    </div>

    <div class="form-group col-lg-3">
        <label class="form-control-label" for="enlaces_proprios_terrestres_meio">Meio</label>
        <select id="enlaces_proprios_terrestres_meio" name="enlaces_proprios_terrestres_meio" class="form-control">
            <option value="<?php echo esc($plano->enlaces_proprios_terrestres_meio); ?>"><?php echo esc($plano->enlaces_proprios_terrestres_meio); ?></option>
            <option>--</option>
            <option value="cabo_metalico">Cabo Metálico</option>
            <option value="radio">Rádio</option>
            <option value="fibra">Fibra</option>
        </select>
    </div>

    <div class="form-group col-lg-3">
        <i class="fas fa-info" title="Capacidade disponível (em Gbps). Valores válidos: números positivos de ponto flutuante" style="padding-right: 5px"></i>
        <label class="form-control-label">Capacidade Nominal </label>
        <input type="text" name="enlaces_proprios_terrestres_c_nominal" class="form-control" value="<?php echo esc($plano->enlaces_proprios_terrestres_c_nominal); ?>">
    </div>

    <div class="form-group col-md-3">
        <label class="form-control-label" for="DADO_INFORMADO">Enlaces Terrestres Swap</label>
        <select id="abertura" name="enlaces_proprios_terrestres_swap" class="form-control">
            <option value="<?php echo esc($plano->enlaces_proprios_terrestres_swap); ?>"><?php echo esc($plano->enlaces_proprios_terrestres_swap); ?></option>
            <option>--</option>
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>
    </div>

    <div class="form-group col-lg-3">
        <i class="fas fa-info" title="Valores válidos: expressão WKT (Well Known Text) LINESTRING" style="padding-right: 5px"></i>
        <label class="form-control-label">Geometria WKT </label>
        <input type="text" name="geometria_wkt" class="form-control" value="<?php echo esc($plano->geometria_wkt); ?>">
    </div>

    <div class="form-group col-lg-3">
        <i class="fas fa-info" title="Identificador do sistema de referências usado na topologia" style="padding-right: 5px"></i>
        <label class="form-control-label">SRID </label>
        <input type="text" name="srid" class="form-control" value="<?php echo esc($plano->srid); ?>">
    </div>
</div>