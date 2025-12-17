<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>
<style>
    .cancelamento-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 30px 20px;
    }
    
    .cancelamento-header {
        margin-bottom: 40px;
    }
    
    .cancelamento-header h1 {
        font-size: 28px;
        font-weight: 400;
        color: #333;
        margin-bottom: 10px;
    }
    
    .cancelamento-header p {
        color: #666;
        font-size: 14px;
    }
    
    .cancelamento-content {
        display: flex;
        gap: 60px;
    }
    
    /* Stepper Lateral */
    .stepper-sidebar {
        min-width: 200px;
    }
    
    .stepper-item {
        display: flex;
        align-items: flex-start;
        position: relative;
        padding-bottom: 30px;
    }
    
    .stepper-item:last-child {
        padding-bottom: 0;
    }
    
    .stepper-item::before {
        content: '';
        position: absolute;
        left: 7px;
        top: 20px;
        width: 2px;
        height: calc(100% - 10px);
        background-color: #e0e0e0;
    }
    
    .stepper-item:last-child::before {
        display: none;
    }
    
    .stepper-indicator {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 2px solid #e0e0e0;
        background: #fff;
        margin-right: 15px;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }
    
    .stepper-item.active .stepper-indicator {
        border-color: #6366f1;
        background: #6366f1;
    }
    
    .stepper-item.active .stepper-indicator::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 6px;
        height: 6px;
        background: #fff;
        border-radius: 50%;
    }
    
    .stepper-label {
        font-size: 14px;
        color: #999;
    }
    
    .stepper-item.active .stepper-label {
        color: #333;
        font-weight: 500;
    }
    
    /* Formulário */
    .form-section {
        flex: 1;
    }
    
    .form-section h2 {
        font-size: 20px;
        font-weight: 500;
        color: #333;
        margin-bottom: 30px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-size: 14px;
        color: #333;
        margin-bottom: 8px;
    }
    
    .form-group label .required {
        color: #e53935;
    }
    
    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.2s;
    }
    
    .form-group input:focus {
        outline: none;
        border-color: #6366f1;
    }
    
    .form-group input::placeholder {
        color: #bbb;
    }
    
    .form-hint {
        font-size: 12px;
        color: #888;
        margin-top: 8px;
        line-height: 1.5;
    }
    
    .form-hint a {
        color: #6366f1;
        text-decoration: underline;
    }
    
    .btn-link {
        display: inline-block;
        padding: 10px 20px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background: #fff;
        color: #666;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        margin-top: 15px;
    }
    
    .btn-link:hover {
        border-color: #6366f1;
        color: #6366f1;
    }
    
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: #6366f1;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s;
        float: right;
        margin-top: 20px;
    }
    
    .btn-primary:hover {
        background: #4f46e5;
    }
    
    .form-actions {
        margin-top: 30px;
        overflow: hidden;
    }
    
    @media (max-width: 768px) {
        .cancelamento-content {
            flex-direction: column;
            gap: 30px;
        }
        
        .stepper-sidebar {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 20px;
        }
        
        .stepper-item {
            flex-direction: column;
            align-items: center;
            padding-bottom: 0;
            min-width: fit-content;
        }
        
        .stepper-item::before {
            display: none;
        }
        
        .stepper-indicator {
            margin-right: 0;
            margin-bottom: 8px;
        }
        
        .stepper-label {
            font-size: 12px;
            text-align: center;
        }
    }
</style>
<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<div class="cancelamento-container">
    <!-- Header -->
    <div class="cancelamento-header">
        <h1>Solicitar reembolso</h1>
        <p>Ao fazer isso, sua compra será cancelada e não será mais possível acessar o produto.</p>
    </div>
    
    <div class="cancelamento-content">
        <!-- Stepper Lateral -->
        <div class="stepper-sidebar">
            <div class="stepper-item active">
                <div class="stepper-indicator"></div>
                <span class="stepper-label">Localizar compra</span>
            </div>
            <div class="stepper-item">
                <div class="stepper-indicator"></div>
                <span class="stepper-label">Verificação de segurança</span>
            </div>
            <div class="stepper-item">
                <div class="stepper-indicator"></div>
                <span class="stepper-label">Motivo do reembolso</span>
            </div>
            <div class="stepper-item">
                <div class="stepper-indicator"></div>
                <span class="stepper-label">Conferir informações</span>
            </div>
            <div class="stepper-item">
                <div class="stepper-indicator"></div>
                <span class="stepper-label">Feedback</span>
            </div>
        </div>
        
        <!-- Formulário -->
        <div class="form-section">
            <h2>Informe o código e email da compra</h2>
            
            <?php if (session()->getFlashdata('erro')): ?>
            <div class="alert alert-danger" style="background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;">
                <i class="bi bi-exclamation-circle"></i>
                <?= session()->getFlashdata('erro') ?>
            </div>
            <?php endif; ?>
            
            <?php echo form_open('cancelamento/localizar', ['id' => 'form-cancelamento']) ?>
            
            <div class="form-group">
                <label>Número do pedido <span class="required">*</span></label>
                <input type="text" name="codigo_transacao" placeholder="Ex: BX00000000000001" value="<?= old('codigo_transacao') ?>" required>
                <p class="form-hint">
                    Você encontra este número do pedido no email recebido com os detalhes de acesso ao produto e na aba PEDIDOS do seu perfil Mundo Dream (O mesmo que você acessou seus ingressos). 
                    
                </p>
            </div>
            
            <div class="form-group">
                <label>Digite o email que você recebeu a compra <span class="required">*</span></label>
                <input type="email" name="email" placeholder="" value="<?= old('email') ?>" required>
            </div>
           
            
            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    Avançar
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>
            
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<?php echo $this->endSection() ?>
