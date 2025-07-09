<div class="row">

    <div class="form-group col-md-2">
        <label class="form-control-label" for="tipo_cliente">Cliente</label>
        <select id="tipo_cliente" name="tipo_cliente" class="form-control">
            <option value="<?php echo esc($plano->tipo_cliente); ?>"><?php echo esc($plano->tipo_cliente); ?></option>
            <option>--</option>
            <option value="PF">PF</option>
            <option value="PJ">PJ</option>
        </select>
    </div>
    <div class="form-group col-md-5">
        <label class="form-control-label" for="tipo_atendimento">Tipo de atendimento</label>
        <select id="tipo_atendimento" name="tipo_atendimento" class="form-control">
            <option value="<?php echo esc($plano->tipo_atendimento); ?>"><?php echo esc($plano->tipo_atendimento); ?></option>
            <option>--</option>
            <option value="URBANO">Urbano</option>
            <option value="RURAL">Rural</option>
        </select>
    </div>
    <div class="form-group col-md-5">
        <label class="form-control-label" for="tipo_meio">Tipo de meio</label>
        <select id="tipo_meio" name="tipo_meio" class="form-control">
            <option value="<?php echo esc($plano->tipo_meio); ?>"><?php echo esc($plano->tipo_meio); ?></option>
            <option>--</option>
            <option value="fibra">Fibra Ótica</option>
            <option value="satelite">Satélite</option>
            <option value="radio">Radio</option>
            <option value="cabo_coaxial">Cabo Coaxial</option>
            <option value="cabo_metalico">Cabo Metálico</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label class="form-control-label" for="tipo_produto">Tipo de produto</label>
        <select id="tipo_produto" name="tipo_produto" class="form-control">
            <option value="<?php echo esc($plano->tipo_produto); ?>"><?php echo esc($plano->tipo_produto); ?></option>
            <option>--</option>
            <option value="internet">Internet</option>
            <option value="linha_dedicada">Linha Dedicada</option>
            <option value="m2m">M2m</option>
            <option value="outros">Outros</option>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label class="form-control-label" for="tipo_tecnologia">Tipo de tecnologia</label>
        <select id="tipo_tecnologia" name="tipo_tecnologia" class="form-control">
            <option value="<?php echo esc($plano->tipo_tecnologia); ?>"><?php echo esc($plano->tipo_tecnologia); ?></option>
            <option>--</option>
            <option value="ETHERNET">Ethernet</option>
            <option value="FTTH">FTTH</option>
            <option value="NR">NR</option>
            <option value="Wi-Fi">Wi-Fi</option>
        </select>
    </div>

    <div class="form-group col-lg-3">
        <label class="form-control-label">Velocidade (Mbps)</label>
        <input type="number" name="velocidade" class="form-control" value="<?php echo esc($plano->velocidade); ?>">
    </div>

    <div class="form-group col-lg-3">
        <label class="form-control-label">Quantidade de acessos</label>
        <input type="number" name="qtd_acessos" class="form-control" value="<?php echo esc($plano->qtd_acessos); ?>">
    </div>

</div>