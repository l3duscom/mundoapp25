<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>
<style>
/* Wizard Stepper Styles */
.wizard-container {
    max-width: 800px;
    margin: 0 auto;
}

.wizard-header {
    background: linear-gradient(135deg, #672eba 0%, #8b5cf6 100%);
    border-radius: 16px 16px 0 0;
    padding: 30px 20px;
    color: white;
    text-align: center;
}

.wizard-header h4 {
    margin: 0 0 25px 0;
    font-weight: 600;
    font-size: 1.4rem;
}

.wizard-stepper {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0;
    position: relative;
}

.wizard-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    cursor: pointer;
    transition: all 0.3s ease;
}

.wizard-step.disabled {
    cursor: not-allowed;
    opacity: 0.7;
}

.step-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    border: 3px solid rgba(255,255,255,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1rem;
    transition: all 0.3s ease;
    color: white;
}

.wizard-step.active .step-circle {
    background: white;
    color: #672eba;
    border-color: white;
    box-shadow: 0 0 0 4px rgba(255,255,255,0.3);
    animation: pulse 2s infinite;
}

.wizard-step.completed .step-circle {
    background: #22c55e;
    border-color: #22c55e;
    color: white;
}

.step-label {
    margin-top: 10px;
    font-size: 0.8rem;
    font-weight: 500;
    opacity: 0.8;
    white-space: nowrap;
}

.wizard-step.active .step-label,
.wizard-step.completed .step-label {
    opacity: 1;
    font-weight: 600;
}

.step-connector {
    width: 80px;
    height: 3px;
    background: rgba(255,255,255,0.3);
    position: relative;
    top: -18px;
    z-index: 1;
}

.step-connector.active {
    background: white;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(255,255,255,0.5); }
    50% { box-shadow: 0 0 0 8px rgba(255,255,255,0); }
    100% { box-shadow: 0 0 0 0 rgba(255,255,255,0); }
}

.wizard-body {
    background: white;
    border-radius: 0 0 16px 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}

.wizard-content {
    padding: 30px;
}

.wizard-step-content {
    display: none;
    animation: fadeIn 0.4s ease;
}

.wizard-step-content.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.step-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.step-title i {
    color: #672eba;
    font-size: 1.4rem;
}

.step-subtitle {
    color: #64748b;
    font-size: 0.9rem;
    margin-bottom: 25px;
}

.wizard-navigation {
    display: flex;
    justify-content: space-between;
    padding: 20px 30px 30px;
    border-top: 1px solid #e2e8f0;
    background: #f8fafc;
    border-radius: 0 0 16px 16px;
}

.btn-wizard {
    padding: 12px 28px;
    font-weight: 600;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.btn-wizard-prev {
    background: #e2e8f0;
    color: #475569;
    border: none;
}

.btn-wizard-prev:hover {
    background: #cbd5e1;
    color: #334155;
}

.btn-wizard-next {
    background: linear-gradient(135deg, #672eba 0%, #8b5cf6 100%);
    color: white;
    border: none;
}

.btn-wizard-next:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(103, 46, 186, 0.4);
}

.btn-wizard-submit {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    color: white;
    border: none;
}

.btn-wizard-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(34, 197, 94, 0.4);
}

.form-group-modern {
    margin-bottom: 20px;
}

.form-group-modern label {
    font-weight: 600;
    color: #334155;
    margin-bottom: 8px;
    display: block;
    font-size: 0.9rem;
}

.form-group-modern .form-control {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-group-modern .form-control:focus {
    border-color: #672eba;
    box-shadow: 0 0 0 4px rgba(103, 46, 186, 0.1);
}

.form-hint {
    font-size: 0.8rem;
    color: #64748b;
    margin-top: 6px;
    display: flex;
    align-items: flex-start;
    gap: 6px;
}

.form-hint i {
    color: #672eba;
    margin-top: 2px;
}

.file-upload-area {
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    background: #f8fafc;
    transition: all 0.3s ease;
    margin-bottom: 15px;
}

.file-upload-area:hover {
    border-color: #672eba;
    background: #faf5ff;
}

.file-upload-area label {
    display: block;
    margin-bottom: 10px;
    font-weight: 600;
    color: #334155;
}

.file-upload-area input[type="file"] {
    width: 100%;
}

.file-upload-hint {
    font-size: 0.75rem;
    color: #64748b;
    margin-top: 8px;
}

.alert-info-wizard {
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    border: none;
    border-left: 4px solid #3b82f6;
    border-radius: 8px;
    padding: 15px 20px;
    margin-bottom: 20px;
}

.alert-info-wizard strong {
    color: #1e40af;
}

@media (max-width: 576px) {
    .wizard-header {
        padding: 20px 15px;
    }
    
    .step-circle {
        width: 36px;
        height: 36px;
        font-size: 0.85rem;
    }
    
    .step-connector {
        width: 40px;
    }
    
    .step-label {
        font-size: 0.7rem;
    }
    
    .wizard-navigation {
        flex-direction: column;
        gap: 10px;
    }
    
    .btn-wizard {
        width: 100%;
        justify-content: center;
    }
}
</style>
<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        
        <!-- Container para erros de validação JS -->
        <div id="response" class="mb-3"></div>

        <div class="wizard-container">
            <!-- Wizard Header com Stepper -->
            <div class="wizard-header">
                <h4><i class="bx bx-music me-2"></i><?= $concurso->nome ?></h4>
                
                <div class="wizard-stepper">
                    <div class="wizard-step active" data-step="1" onclick="goToStep(1)">
                        <div class="step-circle">1</div>
                        <span class="step-label">Dados Pessoais</span>
                    </div>
                    <div class="step-connector"></div>
                    <div class="wizard-step disabled" data-step="2" onclick="goToStep(2)">
                        <div class="step-circle">2</div>
                        <span class="step-label">Detalhes</span>
                    </div>
                    <div class="step-connector"></div>
                    <div class="wizard-step disabled" data-step="3" onclick="goToStep(3)">
                        <div class="step-circle">3</div>
                        <span class="step-label">Arquivos</span>
                    </div>
                </div>
            </div>

            <!-- Wizard Body -->
            <div class="wizard-body">
                <?php echo form_open_multipart('Concursos/registrar_inscricao_kpop_open', ['id' => 'form-inscricao']) ?>
                
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_token_field">
                <input type="hidden" name="concurso_id" value="<?= $concurso->id ?>">

                <div class="wizard-content">
                    
                    <!-- ETAPA 1: Dados Pessoais -->
                    <div class="wizard-step-content active" data-step="1">
                        <div class="step-title">
                            <i class="bx bx-user"></i>
                            Dados Pessoais
                        </div>
                        <p class="step-subtitle">Informe seus dados para identificação e contato</p>

                        <div class="form-group-modern">
                            <label><i class="bx bx-envelope me-1"></i>E-mail</label>
                            <input type="email" name="email" placeholder="seu@email.com" class="form-control" required>
                            <div class="form-hint">
                                <i class="bx bx-info-circle"></i>
                                <span>Este e-mail será usado para confirmar sua inscrição e acompanhar suas notas</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label><i class="bx bx-id-card me-1"></i>Nome Social</label>
                                    <input type="text" name="nome_social" placeholder="Como você quer ser chamado(a)" class="form-control" required>
                                    <div class="form-hint">
                                        <i class="bx bx-info-circle"></i>
                                        <span>Será usado na divulgação</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label><i class="bx bx-user-check me-1"></i>Nome Completo (RG)</label>
                                    <input type="text" name="nome" placeholder="Nome igual ao documento" class="form-control" required>
                                    <div class="form-hint">
                                        <i class="bx bx-lock-alt"></i>
                                        <span>Não será divulgado</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label><i class="bx bxl-whatsapp me-1"></i>Celular/WhatsApp</label>
                                    <input type="text" name="telefone" placeholder="(00) 00000-0000" class="form-control sp_celphones" required>
                                    <div class="form-hint">
                                        <i class="bx bx-info-circle"></i>
                                        <span>Para contato sobre a competição</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label><i class="bx bx-id-card me-1"></i>CPF</label>
                                    <input type="text" name="cpf" placeholder="000.000.000-00" class="form-control cpf" required>
                                    <div class="form-hint">
                                        <i class="bx bx-lock-alt"></i>
                                        <span>Apenas para identificação interna</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ETAPA 2: Detalhes da Inscrição -->
                    <div class="wizard-step-content" data-step="2">
                        <div class="step-title">
                            <i class="bx bx-detail"></i>
                            Detalhes da Inscrição
                        </div>
                        <p class="step-subtitle">Conte-nos sobre sua apresentação</p>

                        <div class="form-group-modern">
                            <label><i class="bx bx-video me-1"></i>Vídeo de Apresentação</label>
                            <input type="text" name="video_apresentacao" placeholder="https://youtube.com/..." class="form-control" required>
                            <div class="form-hint">
                                <i class="bx bx-info-circle"></i>
                                <span>Link do YouTube, Google Drive ou similar. Usado na triagem (fase classificatória)</span>
                            </div>
                        </div>

                        <div class="form-group-modern">
                            <label><i class="bx bx-category me-1"></i>Categoria</label>
                            <select id="categoria" name="categoria" class="form-control">
                                <option value="">Selecione a categoria</option>
                                <option value="solo">Solo</option>
                                <option value="dupla">Dupla</option>
                                <option value="grupo">Grupo</option>
                            </select>
                            <div class="form-hint">
                                <i class="bx bx-info-circle"></i>
                                <span>Selecione como você vai participar da competição</span>
                            </div>
                        </div>

                        <!-- Campos exibidos apenas para Grupo ou Dupla -->
                        <div class="row" id="campos-grupo" style="display: none;">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label><i class="bx bx-group me-1"></i>Nome do Grupo/Dupla</label>
                                    <input type="text" name="grupo" placeholder="Nome do grupo ou dupla" class="form-control">
                                    <div class="form-hint">
                                        <i class="bx bx-info-circle"></i>
                                        <span>Este nome será usado na divulgação</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label><i class="bx bx-user-plus me-1"></i>Quantidade de Integrantes</label>
                                    <input type="number" name="integrantes" placeholder="Ex: 5" class="form-control" min="2">
                                    <div class="form-hint">
                                        <i class="bx bx-info-circle"></i>
                                        <span>Total de participantes do grupo/dupla</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ETAPA 3: Arquivos -->
                    <div class="wizard-step-content" data-step="3">
                        <div class="step-title">
                            <i class="bx bx-cloud-upload"></i>
                            Arquivos da Apresentação
                        </div>
                        <p class="step-subtitle">Envie os arquivos necessários para sua apresentação</p>

                        <div class="alert alert-info-wizard">
                            <i class="bx bx-info-circle me-2"></i>
                            <strong>Atenção!</strong> O tamanho máximo total dos arquivos é 95MB. Arquivos aceitos: JPG/PNG (imagem), MP3 (música), MP4 (vídeo).
                        </div>

                        <div class="file-upload-area">
                            <label><i class="bx bx-image me-2"></i>Imagem de Referência (Figurino)</label>
                            <input type="file" name="referencia" class="form-control" required accept=".jpg,.jpeg,.png">
                            <div class="file-upload-hint">
                                <i class="bx bx-info-circle"></i> Formato: JPG ou PNG | Máx: 50MB
                            </div>
                        </div>

                        <div class="form-group-modern">
                            <label><i class="bx bx-music me-1"></i>Nome da Música</label>
                            <input type="text" name="nome_musica" placeholder="Ex: Dynamite - BTS" class="form-control" required>
                            <div class="form-hint">
                                <i class="bx bx-info-circle"></i>
                                <span>Nome da música e artista que será usada na apresentação</span>
                            </div>
                        </div>

                        <!-- Seletor de tipo de mídia -->
                        <div class="form-group-modern">
                            <label><i class="bx bx-cog me-1"></i>Como você vai enviar a sua música?</label>
                            <div class="alert alert-light border mt-2 mb-3" style="background: #f8fafc;">
                                <small class="text-muted">
                                    <i class="bx bx-info-circle text-primary"></i>
                                    Escolha <strong>uma</strong> das opções abaixo:
                                    <ul class="mb-0 mt-2">
                                        <li><strong>Música MP3:</strong> Envie apenas o arquivo de áudio da música. Um vídeo padrão será usado no telão LED.</li>
                                        <li><strong>Vídeo LED:</strong> Envie um vídeo MP4 que já contenha a música embutida. Este vídeo será exibido no telão durante sua apresentação. <a href="https://www.youtube.com/watch?v=gSoFw92w-zo" target="_blank" class="text-primary">(Ver Exemplo)</a></li>
                                    </ul>
                                </small>
                            </div>
                            <select id="tipo_midia" name="tipo_midia" class="form-control">
                                <option value="">Selecione uma opção</option>
                                <option value="mp3">🎵 Música MP3 (apenas áudio)</option>
                                <option value="video">🎬 Vídeo LED (vídeo com música embutida)</option>
                            </select>
                        </div>

                        <!-- Campo de upload de Música MP3 -->
                        <div class="file-upload-area" id="campo-musica" style="display: none;">
                            <label><i class="bx bx-music me-2"></i>Arquivo de Música (MP3)</label>
                            <input type="file" name="musica" class="form-control" accept=".mp3">
                            <div class="file-upload-hint">
                                <i class="bx bx-info-circle"></i> Formato: MP3 | Máx: 50MB | Música completa para sua apresentação
                            </div>
                        </div>

                        <!-- Campo de upload de Vídeo LED -->
                        <div class="file-upload-area" id="campo-video" style="display: none;">
                            <label><i class="bx bx-video me-2"></i>Vídeo LED com Música <a href="https://www.youtube.com/watch?v=gSoFw92w-zo" target="_blank" class="text-primary">(Ver Exemplo)</a></label>
                            <input type="file" name="video_led" class="form-control" accept=".mp4">
                            <div class="file-upload-hint">
                                <i class="bx bx-info-circle"></i> Formato: MP4 | Máx: 100MB | Vídeo com música embutida para exibição no telão LED
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Navegação do Wizard -->
                <div class="wizard-navigation">
                    <button type="button" class="btn btn-wizard btn-wizard-prev" id="btnPrev" style="visibility: hidden;">
                        <i class="bx bx-chevron-left"></i> Anterior
                    </button>
                    
                    <button type="button" class="btn btn-wizard btn-wizard-next" id="btnNext">
                        Próximo <i class="bx bx-chevron-right"></i>
                    </button>
                    
                    <button type="submit" class="btn btn-wizard btn-wizard-submit" id="btnSubmit" style="display: none;">
                        <i class="bx bx-check"></i> Realizar Inscrição
                        <span id="btn-spinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                    </button>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>

<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>

<!-- Modal de Processamento -->
<div class="modal fade" id="modalProcessando" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalProcessandoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="text-align:center;">
      <div class="modal-body py-5">
        <div class="spinner-border text-primary mb-3" style="width: 4rem; height: 4rem;" role="status">
            <span class="visually-hidden">Processando...</span>
        </div>
        <h5 class="mb-3 mt-2">Processando sua inscrição...</h5>
        <p class="text-muted">Não feche ou atualize esta página.<br>Estamos enviando seus dados e arquivos.</p>
        <small class="text-muted"><i class="bx bx-info-circle"></i> Isso pode levar alguns instantes dependendo do tamanho dos arquivos.</small>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>

<script>
let currentStep = 1;
const totalSteps = 3;

// Campos obrigatórios por etapa (base)
const requiredFieldsByStep = {
    1: ['email', 'nome_social', 'nome', 'telefone', 'cpf'],
    2: ['video_apresentacao', 'categoria'],
    3: ['referencia', 'nome_musica', 'tipo_midia']
};

// Campos condicionais que dependem da categoria
function getConditionalFields() {
    const categoria = document.getElementById('categoria').value;
    if (categoria === 'grupo' || categoria === 'dupla') {
        return ['grupo', 'integrantes'];
    }
    return [];
}

// Campos condicionais baseados no tipo de mídia (para etapa 3)
function getMediaFields() {
    const tipoMidia = document.getElementById('tipo_midia').value;
    if (tipoMidia === 'mp3') {
        return ['musica'];
    } else if (tipoMidia === 'video') {
        return ['video_led'];
    }
    return [];
}

function updateStepperUI() {
    document.querySelectorAll('.wizard-step').forEach((step, index) => {
        const stepNum = index + 1;
        step.classList.remove('active', 'completed', 'disabled');
        
        if (stepNum < currentStep) {
            step.classList.add('completed');
            step.querySelector('.step-circle').innerHTML = '<i class="bx bx-check"></i>';
        } else if (stepNum === currentStep) {
            step.classList.add('active');
            step.querySelector('.step-circle').textContent = stepNum;
        } else {
            step.classList.add('disabled');
            step.querySelector('.step-circle').textContent = stepNum;
        }
    });
    
    // Atualizar conectores
    document.querySelectorAll('.step-connector').forEach((conn, index) => {
        conn.classList.toggle('active', index < currentStep - 1);
    });
    
    // Atualizar conteúdo
    document.querySelectorAll('.wizard-step-content').forEach(content => {
        content.classList.remove('active');
        if (parseInt(content.dataset.step) === currentStep) {
            content.classList.add('active');
        }
    });
    
    // Atualizar botões
    document.getElementById('btnPrev').style.visibility = currentStep > 1 ? 'visible' : 'hidden';
    document.getElementById('btnNext').style.display = currentStep < totalSteps ? 'flex' : 'none';
    document.getElementById('btnSubmit').style.display = currentStep === totalSteps ? 'flex' : 'none';
}

function validateStep(step) {
    let fields = [...requiredFieldsByStep[step]];
    
    // Adicionar campos condicionais da etapa 3 (mídia)
    if (step === 3) {
        fields = fields.concat(getMediaFields());
    }
    
    let isValid = true;
    let firstInvalid = null;
    
    fields.forEach(fieldName => {
        const field = document.querySelector(`[name="${fieldName}"]`);
        if (!field) return;
        
        let fieldValid = true;
        
        if (field.type === 'file') {
            fieldValid = field.files.length > 0;
        } else if (field.type === 'email') {
            fieldValid = field.value.trim() !== '' && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value);
        } else if (field.tagName === 'SELECT') {
            fieldValid = field.value !== '' && field.value !== '---';
        } else {
            fieldValid = field.value.trim() !== '';
        }
        
        // Feedback visual
        if (!fieldValid) {
            field.classList.add('is-invalid');
            field.style.borderColor = '#dc3545';
            isValid = false;
            if (!firstInvalid) firstInvalid = field;
        } else {
            field.classList.remove('is-invalid');
            field.style.borderColor = '';
        }
    });
    
    if (firstInvalid) {
        firstInvalid.focus();
        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    
    return isValid;
}

function goToStep(step) {
    if (step < 1 || step > totalSteps) return;
    
    // Só pode voltar, ou avançar se validar
    if (step > currentStep) {
        // Validar todas as etapas anteriores
        for (let i = currentStep; i < step; i++) {
            if (!validateStep(i)) {
                return;
            }
        }
    }
    
    currentStep = step;
    updateStepperUI();
    
    // Scroll suave para o topo do wizard
    document.querySelector('.wizard-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function nextStep() {
    if (validateStep(currentStep) && currentStep < totalSteps) {
        currentStep++;
        updateStepperUI();
        document.querySelector('.wizard-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateStepperUI();
        document.querySelector('.wizard-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Se houver mensagem de sucesso ou erro, faz scroll até ela
    const responseDiv = document.getElementById('response');
    if (responseDiv && responseDiv.querySelector('.alert')) {
        responseDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    
    // Inicializar stepper
    updateStepperUI();
    
    // Botões de navegação
    document.getElementById('btnNext').addEventListener('click', nextStep);
    document.getElementById('btnPrev').addEventListener('click', prevStep);
    
    // Controle de exibição dos campos de Grupo/Dupla
    const categoriaSelect = document.getElementById('categoria');
    const camposGrupo = document.getElementById('campos-grupo');
    const grupoInput = document.querySelector('[name="grupo"]');
    const integrantesInput = document.querySelector('[name="integrantes"]');
    
    function toggleCamposGrupo() {
        const valor = categoriaSelect.value;
        const mostrar = valor === 'grupo' || valor === 'dupla';
        
        camposGrupo.style.display = mostrar ? 'flex' : 'none';
        
        // Limpar campos quando ocultar
        if (!mostrar) {
            grupoInput.value = '';
            integrantesInput.value = '';
        }
    }
    
    categoriaSelect.addEventListener('change', toggleCamposGrupo);
    toggleCamposGrupo(); // Verificar estado inicial
    
    // Controle de exibição dos campos de Mídia (MP3 ou Vídeo LED)
    const tipoMidiaSelect = document.getElementById('tipo_midia');
    const campoMusica = document.getElementById('campo-musica');
    const campoVideo = document.getElementById('campo-video');
    const musicaInput = document.querySelector('[name="musica"]');
    const videoLedInput = document.querySelector('[name="video_led"]');
    
    function toggleCamposMidia() {
        const valor = tipoMidiaSelect.value;
        
        // Ocultar ambos primeiro
        campoMusica.style.display = 'none';
        campoVideo.style.display = 'none';
        
        // Limpar campos e remover required
        musicaInput.value = '';
        videoLedInput.value = '';
        musicaInput.classList.remove('is-invalid');
        videoLedInput.classList.remove('is-invalid');
        musicaInput.style.borderColor = '';
        videoLedInput.style.borderColor = '';
        
        // Exibir campo correspondente
        if (valor === 'mp3') {
            campoMusica.style.display = 'block';
        } else if (valor === 'video') {
            campoVideo.style.display = 'block';
        }
    }
    
    tipoMidiaSelect.addEventListener('change', toggleCamposMidia);
    toggleCamposMidia(); // Verificar estado inicial
    
    // Validação de arquivos
    const form = document.getElementById('form-inscricao');
    const MAX_TOTAL_SIZE = 95 * 1024 * 1024;
    const ALLOWED_IMAGE = ['image/jpeg', 'image/png'];
    const ALLOWED_AUDIO = ['audio/mpeg', 'audio/mp3'];
    const ALLOWED_VIDEO = ['video/mp4'];
    
    function formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    function validateFiles() {
        let totalSize = 0;
        const errors = [];
        
        const fileInputs = form.querySelectorAll('input[type="file"]');
        fileInputs.forEach(input => {
            if (input.files.length > 0) {
                const file = input.files[0];
                totalSize += file.size;
                
                if (input.name === 'referencia' && !ALLOWED_IMAGE.includes(file.type)) {
                    errors.push('A imagem de referência deve estar no formato JPG ou PNG.');
                }
                if (input.name === 'musica' && !ALLOWED_AUDIO.includes(file.type)) {
                    errors.push('O arquivo de música deve estar no formato MP3.');
                }
                if (input.name === 'video_led' && !ALLOWED_VIDEO.includes(file.type)) {
                    errors.push('O vídeo LED deve estar no formato MP4.');
                }
            }
        });
        
        if (totalSize > MAX_TOTAL_SIZE) {
            errors.push(`O tamanho total dos arquivos (${formatBytes(totalSize)}) excede o limite de 95MB.`);
        }
        
        return errors;
    }
    
    function showFileErrors(errors) {
        const existingAlert = document.getElementById('file-error-alert');
        if (existingAlert) existingAlert.remove();
        
        const alertDiv = document.createElement('div');
        alertDiv.id = 'file-error-alert';
        alertDiv.className = 'alert alert-danger alert-dismissible fade show';
        alertDiv.innerHTML = `
            <i class="bx bx-x-circle me-2"></i>
            <strong>Erro nos arquivos:</strong>
            <ul class="mb-0 mt-2">${errors.map(e => `<li>${e}</li>`).join('')}</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        responseDiv.prepend(alertDiv);
        alertDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    
    form.addEventListener('submit', function(e) {
        // Valida a etapa atual primeiro
        if (!validateStep(currentStep)) {
            e.preventDefault();
            return false;
        }
        
        // Valida arquivos
        const fileErrors = validateFiles();
        if (fileErrors.length > 0) {
            e.preventDefault();
            showFileErrors(fileErrors);
            return false;
        }
        
        // Valida campos obrigatórios
        if (!form.checkValidity()) {
            form.reportValidity();
            return false;
        }
        
        // Atualiza CSRF token
        const csrfField = document.getElementById('csrf_token_field');
        if (csrfField) {
            const metaCsrf = document.querySelector('meta[name="<?= csrf_token() ?>"]');
            if (metaCsrf) {
                csrfField.value = metaCsrf.content;
            }
        }
        
        // Desabilita o botão e mostra spinner
        const btnSubmit = document.getElementById('btnSubmit');
        const btnSpinner = document.getElementById('btn-spinner');
        btnSubmit.disabled = true;
        btnSpinner.classList.remove('d-none');
        
        // Mostra modal de processamento
        setTimeout(function() {
            var modalProcessando = new bootstrap.Modal(document.getElementById('modalProcessando'));
            modalProcessando.show();
        }, 100);
        
        return true;
    });
    
    // Limpar validação ao digitar
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
            this.style.borderColor = '';
        });
    });
});
</script>

<?php echo $this->endSection() ?>