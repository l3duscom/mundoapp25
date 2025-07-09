<input type="hidden" id="declaration_id" name="declaration_id" value="<?php echo $declaration->id; ?>">
<div class="row">

    <div class="form-group col-lg-4">
        <label class="form-control-label">Estação de Origem</label>
        <input type="text" name="estacao_a_id" class="form-control">
    </div>

    <div class="form-group col-lg-4">
        <label class="form-control-label">ID Satélite</label>
        <i class="fas fa-info" title="Identificação da estação de destino segundo os sistemas da prestadora." style="padding-right: 5px"></i>
        <input type="text" name="enlaces_satelites_id" class="form-control">
    </div>

    <div class="form-group col-lg-4">
        <i class="fas fa-info" title="Identificação do satélite segundo o sistema Mosaico da ANATEL." style="padding-right: 5px"></i>
        <label class="form-control-label">Código Satélite </label>
        <input type="text" name="enlaces_satelites_cod_satelite" class="form-control">
    </div>

    <div class="form-group col-lg-4">
        <i class="fas fa-info" title="Frequência central do canal de uplink em MHz. Valores válidos: IIII,DDDDDD (quatro dígitos representando a parte inteira, incluindo zeros à esquerda e seis dígitos representando a parte decimal, incluindo zeros à Manual de Coleta de Dados de Infraestrutura Agência Nacional de Telecomunicações – ANATEL 10 direita, e a vírgula como separador decimal)." style="padding-right: 5px"></i>
        <label class="form-control-label">Frequência Central (UP) </label>
        <input type="text" name="enlaces_satelites_freq_central_canal_uplink_mhz" class="form-control">
    </div>

    <div class="form-group col-lg-4">
        <i class="fas fa-info" title="Frequência central do canal de downlink em MHz. Valores válidos: IIII,DDDDDD (quatro dígitos representando a parte inteira, incluindo zeros à esquerda e seis dígitos representando a parte decimal, incluindo zeros à direita, e a vírgula como separador decimal)." style="padding-right: 5px"></i>
        <label class="form-control-label">Frequência Central (DOWN) </label>
        <input type="text" name="enlaces_satelites_freq_central_canal_downlink_mhz" class="form-control">
    </div>

    <div class="form-group col-lg-4">
        <i class="fas fa-info" title="Largura de banda do canal de uplink em MHz. Valores válidos: IIII,DDDDDD (quatro dígitos representando a parte inteira, incluindo zeros à esquerda e seis dígitos representando a parte decimal, incluindo zeros à direita, e a vírgula como separador decimal)" style="padding-right: 5px"></i>
        <label class="form-control-label">Largura de banda (UP) </label>
        <input type="text" name="enlaces_satelites_cap_uso_canal_uplink_mhz" class="form-control">
    </div>

    <div class="form-group col-lg-4">
        <i class="fas fa-info" title="Capacidade do canal de uplink em Mbps. Valores válidos: números positivos de ponto flutuante" style="padding-right: 5px"></i>
        <label class="form-control-label">Capacidade do canal (UP) </label>
        <input type="text" name="enlaces_satelites_cap_uso_canal_uplink_mbps" class="form-control">
    </div>

    <div class="form-group col-lg-4">
        <i class="fas fa-info" title="Largura de banda do canal de downlink em MHz. Valores válidos: IIII,DDDDDD (quatro dígitos representando a parte inteira, incluindo zeros à esquerda e seis dígitos representando a parte decimal, incluindo zeros à direita, e a vírgula como separador decimal)" style="padding-right: 5px"></i>
        <label class="form-control-label">Largura de banda (DOW) </label>
        <input type="text" name="enlaces_satelites_cap_uso_canal_downlink_mhz" class="form-control">
    </div>

    <div class="form-group col-lg-4">
        <i class="fas fa-info" title="Capacidade do canal de downlink em Mbps. Valores válidos: números positivos de ponto flutuante" style="padding-right: 5px"></i>
        <label class="form-control-label">Capacidade do canal (DOWN) </label>
        <input type="text" name="enlaces_satelites_cap_uso_canal_downlink_mbps" class="form-control">
    </div>



</div>