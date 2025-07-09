<div class="row">

    <div class="form-group col-lg-8">
        <label class="form-control-label">Título</label>
        <input type="text" name="titulo" placeholder="Título do conhecimento" class="form-control" value="<?php echo esc($conhecimento->titulo); ?>">
    </div>

    <div class="form-group col-lg-4">
        <label class="form-control-label" for="categoria_id">Categoria</label>
        <select id="categoria_id" name="categoria_id" class="form-control"><?php echo $categorias; ?></select>
    </div>

    <div class="form-group col-lg-12">
        <label class="form-control-label">Descrição</label>
        <textarea name="descricao" placeholder="Insira a descrição" class="form-control"><?php echo esc($conhecimento->descricao); ?></textarea>
    </div>






</div>