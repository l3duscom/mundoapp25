<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">
    <div class="col-lg-2 ">
    </div>
    <div class="col-lg-8 ">
        <div class="block">
            <div class="block-body">
                <div class="card shadow radius-10">
                    <div class="card-body">






                        <div class="col-lg-12">

                            <div class="block">

                                <div class="block-body">

                                    <!-- Exibirá os retornos do backend -->
                                    <div id="response">


                                    </div>

                                    <div class="card shadow radius-10">
                                        <div class="card-body">
                                            <?php echo form_open_multipart('Concursos/registrar_inscricao_kpop_open') ?>

                                            <?= csrf_field() ?>

                                            <input type="hidden" name="concurso_id" value="<?= $concurso->id ?>">
                                            <center>
                                                <h4>
                                                    <?= $concurso->nome ?>
                                                </h4>
                                                <hr>
                                            </center>
                                            <div class="alert alert-danger  fade show" role="alert">
                                                <strong>Atenção</strong> Todos os campos são obrigatórios!

                                            </div>

                                            <div class="row">

                                                <div class="form-group col-md-12">
                                                    <label class="form-control-label text-muted" style="padding-left: 5px;"> Informe o seu melhor e-mail</label>
                                                    <input type="email" name="email" placeholder="Informe seu email" class="form-control  mb-0 shadow" style="padding:13px;" required>
                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                        Este e-mail será usado para confirmar a sua inscrição, e lhe dar acesso ao mundo dream, para realziar check-in, acompanhar e validar as suas notas!</label>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-control-label text-muted" style="padding-left: 5px;"> Informe o seu Nome Social</label>
                                                    <input type="text" name="nome_social" placeholder="Informe seu nome social" class="form-control  mb-2 shadow " style="padding:13px;" required>
                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                        Esta informação será a única usada na divulgação da sua participação na competição.</label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-control-label text-muted" style="padding-left: 5px;"> Informe o seu nome, igual o do RG</label>
                                                    <input type="text" name="nome" placeholder="Nome completo" class="form-control  mb-2 shadow " style="padding:13px;" required>
                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                        Esta informação não será divulgada. Ela é usada unicamente para conferência com seu documento oficial.</label>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-control-label">Celular/Whatsapp</label>
                                                    <input type="text" name="telefone" placeholder="Insira o telefone" class="form-control sp_celphones mb-2 shadow" style="font-size:medium; padding:13px" required>
                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                        É por aqui que manteremos contato referente à sua participação na competição!</label>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="form-control-label">CPF</label>
                                                    <input type="text" name="cpf" placeholder="Digite o número do  seu CPF" class="form-control  mb-2 shadow cpf" style="font-size:medium; padding:13px" required>
                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                        Esta informação não será divulgada. Ela é usada únicamente para sua identificação.</label>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="form-control-label text-muted" style="padding-left: 5px;"> Possui algum video de apresentação?</label>
                                                    <input type="text" name="video_apresentacao" placeholder="https://" class="form-control  mb-2 shadow " style="padding:13px;" required>
                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                        Informe o link de algum video seu ou do seu grupo em alguma apresentação anterior. (link do Youtube, google drive ou similar). Esta video não será divulgado, e servirá como ateste para triagem (Fase classificatória) e confirmação da sua inscrição!</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="form-control-label">Nome do Grupo/dupla</label>
                                                    <input type="text" name="grupo" placeholder="Informe o nome do grupo" class="form-control mb-2 shadow " style="padding:13px;">
                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                        Preencha apenas em caso de inscrição de grupo/dupla. A divulgação será feita usando esse nome.</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="form-control-label">Integrantes</label>

                                                    <input type="number" name="integrantes" placeholder="Integrantes" class="form-control mb-2 shadow " style="padding:13px;">
                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                        Preencha apenas em caso de inscrição de grupo. Quantos integrantes tem o seu grupo?</label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="form-control-label">Categoria</label>

                                                    <select id="categoria" name="categoria" class="form-control mb-2 shadow">
                                                        <option value="---">Categoria</option>
                                                        <option value="grupo">Grupo</option>
                                                        <option value="dupla">Dupla</option>
                                                        <option value="solo">Solo</option>
                                                    </select>
                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                        Em qual categoria você irá competir?</label>
                                                </div>




                                                <div class="block">

                                                    <div class="block-body">
                                                        <div class="card shadow radius-10">
                                                            <div class="card-body">
                                                                <span style="font-weight: 600; font-size:16px">Arquivos</span>
                                                                <hr>
                                                                <div class="form-group col-md-12">
                                                                    <label class="form-control-label">Imagem de referência <span style="color: red;"> Máx. 50mb</span></label>
                                                                    <input type="file" name="referencia" class="form-control" required>
                                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                                        Figurino: 1 (uma) imagem .Jpeg, colorida.</label>
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label class="form-control-label">Música <span style="color: red;"> Máx. 50mb</span></label>
                                                                    <input type="file" name="musica" class="form-control" required>
                                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                                        Arquivo MP3 com música completa. Esta música será usada na sua apresentação.</label>
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label class="form-control-label">Vídeo LED <a href="https://www.youtube.com/watch?v=gSoFw92w-zo" target="_blank"><u>( Ver Exemplo )</u></a> <span style="color: red;"> Máx. 100mb</span></label>
                                                                    <input type="file" name="video_led" class="form-control" required>
                                                                    <label class="form-control-label text-muted mb-3" style="font-size: 10px; padding-left:5px;"><i class="fadeIn animated bx bx-info-circle" style="  font-size: 13px; font-weight: 600px"></i>
                                                                        Arquivo MP4. Se você possui um video que queira que seja utilizado na sua divulgação. <strong>Exemplo:</strong> <a href="https://www.youtube.com/watch?v=gSoFw92w-zo" target="_blank"><u>Ver exemplo usado na última competição!</u></a> </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>







                                                <div class="d-grid gap-2 mb-0 mt-3">
                                                    <input id="btn-salvar" type="submit" value="Realizar Inscrição" class="btn btn-primary btn-lg mt-0">
                                                    <center><span style="font-size: 12px;"><?= $concurso->nome ?></span></center>
                                                </div>
                                            </div>





                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>

                                </div>



                            </div> <!-- ./ block -->

                        </div>





                    </div>


                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-2 ">
    </div>


</div>

<?php echo $this->endSection() ?>
<?php echo $this->section('scripts') ?>
<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>


<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>
<?php echo $this->endSection() ?>