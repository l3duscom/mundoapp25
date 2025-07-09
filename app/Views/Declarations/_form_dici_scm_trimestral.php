<div class="row">
    <input type="hidden" id="type" name="type" value="<?php echo $type; ?>">
    <input type="hidden" id="client_id" name="client_id" value="<?php echo $client_id; ?>">
    <input type="hidden" id="code" name="code" value="<?php echo $code; ?>">
    <input type="hidden" id="status" name="status" value="ABERTA">

    <div class="form-group col-md-3">
        <label class="form-control-label" for="trimestre">Trimestre</label>
        <select id="trimestre" name="trimestre" class="form-control">
            <option>--</option>
            <option value="1">1º Trimestre</option>
            <option value="2">2º Trimestre</option>
            <option value="3">3º Trimestre</option>
            <option value="4">4º Trimestre</option>

        </select>
    </div>

    <div class="form-group col-md-3">
        <label class="form-control-label" for="year">Ano</label>
        <select id="year" name="year" class="form-control">
            <option>--</option>
            <option value="2030">2030</option>
            <option value="2029">2029</option>
            <option value="2028">2028</option>
            <option value="2027">2027</option>
            <option value="2026">2026</option>
            <option value="2025">2025</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
            <option value="2020">2020</option>
            <option value="2019">2019</option>
            <option value="2018">2018</option>
        </select>
    </div>
</div>