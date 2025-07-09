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
    <div class="form-group col-md-5">
        <label class="form-control-label" for="tipo_tecnologia">Tipo de tecnologia</label>
        <select id="tipo_tecnologia" name="tipo_tecnologia" class="form-control">
            <option value="<?php echo esc($plano->tipo_tecnologia); ?>"><?php echo esc($plano->tipo_tecnologia); ?></option>
            <option>--</option>
            <option value="ETHERNET">Ethernet</option>
            <option value="FTTH">FTTH</option>
            <option value="NR">NR</option>
        </select>
    </div>


</div>