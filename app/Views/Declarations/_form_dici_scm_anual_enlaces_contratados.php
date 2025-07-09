<input type="hidden" id="declaration_id" name="declaration_id" value="<?php echo $declaration->id; ?>">
<div class="row">

    <div class="form-group col-lg-4">
        <label class="form-control-label">Estação de Origem</label>
        <input type="text" name="estacao_a_id" class="form-control">
    </div>

    <div class="form-group col-lg-4">
        <label class="form-control-label">Estação de Destino</label>
        <input type="text" name="estacao_b_id" class="form-control">
    </div>

    <div class="form-group col-lg-4">
        <i class="fas fa-info" title="Identificação da estação de destino segundo os sistemas da prestadora." style="padding-right: 5px"></i>
        <label class="form-control-label">ID Enlaces Contratados </label>
        <input type="text" name="enlaces_contratados_id" class="form-control">
    </div>

    <div class="form-group col-lg-6">
        <label class="form-control-label" for="enlaces_contratados_meio">Meio</label>
        <select id="enlaces_contratados_meio" name="enlaces_contratados_meio" class="form-control">
            <option>--</option>
            <option value="cabo_metalico">Cabo Metálico</option>
            <option value="radio">Rádio</option>
            <option value="fibra">Fibra</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <i class="fas fa-info" title="CNPJ da empresa contratada, com 14 dígitos numéricos, sem pontos, nem traço." style="padding-right: 5px"></i>
        <label class="form-control-label">CNPJ Prestadora</label>
        <input type="text" name="enlaces_contratados_prestadora" class="form-control cnpj">
    </div>



</div>