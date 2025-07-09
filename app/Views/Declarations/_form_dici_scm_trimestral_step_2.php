<input type="hidden" id="declaration_id" name="declaration_id" value="<?php echo $declaration->id; ?>">
<div class="row">
    <div class="form-group col-md-5">
        <label class="form-control-label" for="DADO_INFORMADO">Dado</label>
        <select id="DADO_INFORMADO" name="DADO_INFORMADO" class="form-control">
            <option>--</option>
            <option value="Receita_Operacional_Líquida_ROL">Receita_Operacional_Líquida_ROL</option>
            <option value="Capital_Expenditure_CAPEX">Capital_Expenditure_CAPEX</option>
            <option value="Tráfego_SCM_Total_MB">Tráfego_SCM_Total_MB</option>
        </select>
    </div>

    <div class="form-group col-md-2">
        <label class="form-control-label" for="UNIDADE_DA_FEDERACAO_UF">Unidade</label>
        <select id="UNIDADE_DA_FEDERACAO_UF" name="UNIDADE_DA_FEDERACAO_UF" class="form-control">
            <?php echo $options_estados; ?>
        </select>
    </div>

    <div class="form-group col-md-2">
        <label class="form-control-label" for="SERVICO">Serviço</label>
        <select id="SERVICO" name="SERVICO" class="form-control">
            <option value="SCM">SCM</option>
        </select>
    </div>


    <div class="form-group col-lg-3">
        <label class="form-control-label">Valores</label>
        <input type="text" name="VALORES" class="form-control">
    </div>

</div>