<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>
<style>
    .sucesso-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 40px 20px;
        text-align: center;
    }
    
    .sucesso-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #10b981, #059669);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        font-size: 60px;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
        }
        70% {
            box-shadow: 0 0 0 20px rgba(16, 185, 129, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }
    
    .sucesso-titulo {
        font-size: 32px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 15px;
    }
    
    .sucesso-subtitulo {
        font-size: 18px;
        color: #6b7280;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    
    .sucesso-card {
        background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
        border: 2px solid #6366f1;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        text-align: left;
    }
    
    .sucesso-card h3 {
        font-size: 18px;
        font-weight: 600;
        color: #4f46e5;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .sucesso-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }
    
    .sucesso-info-item {
        background: #fff;
        padding: 15px;
        border-radius: 8px;
    }
    
    .sucesso-info-item label {
        display: block;
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .sucesso-info-item span {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
    }
    
    .proximos-passos {
        background: #fef3c7;
        border: 1px solid #fcd34d;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        text-align: left;
    }
    
    .proximos-passos h4 {
        font-size: 16px;
        font-weight: 600;
        color: #92400e;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .proximos-passos ol {
        margin: 0;
        padding-left: 20px;
        color: #78350f;
        font-size: 14px;
        line-height: 1.8;
    }
    
    .btn-voltar {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 30px;
        background: #6366f1;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .btn-voltar:hover {
        background: #4f46e5;
        transform: translateY(-1px);
    }
    
    .redes-sociais {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }
    
    .redes-sociais p {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 15px;
    }
    
    .redes-sociais .links {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .redes-sociais a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        text-decoration: none;
        color: #1f2937;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .redes-sociais a:hover {
        border-color: #6366f1;
        box-shadow: 0 2px 10px rgba(99, 102, 241, 0.2);
    }
    
    @media (max-width: 768px) {
        .sucesso-titulo {
            font-size: 24px;
        }
        
        .sucesso-info {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<div class="sucesso-container">
    <!-- Ícone de sucesso -->
    <div class="sucesso-icon">
        ✓
    </div>
    
    <!-- Título -->
    <h1 class="sucesso-titulo">Upgrade Confirmado! 🎉</h1>
    <p class="sucesso-subtitulo">
        Parabéns! Seu upgrade foi registrado com sucesso. 
        Você garantiu uma experiência ainda melhor no próximo evento!
    </p>
    
    <!-- Card com detalhes -->
    <div class="sucesso-card">
        <h3>
            <span>📋</span>
            Detalhes do seu upgrade
        </h3>
        <div class="sucesso-info">
            <div class="sucesso-info-item">
                <label>Pedido</label>
                <span>#<?= esc($pedido->codigo) ?></span>
            </div>
            <div class="sucesso-info-item">
                <label>Novo Ingresso</label>
                <span><?= esc($oferta_titulo ?? $tipo_upgrade) ?></span>
            </div>
            <div class="sucesso-info-item">
                <label>Tipo</label>
                <span><?= esc($tipo_upgrade ?? 'VIP') ?></span>
            </div>
            <div class="sucesso-info-item">
                <label>Vantagem</label>
                <span>+ R$ <?= number_format($ganho_total ?? 0, 0, ',', '.') ?></span>
            </div>
        </div>
    </div>
    
    <!-- Próximos passos -->
    <div class="proximos-passos">
        <h4>
            <span>📌</span>
            Próximos passos
        </h4>
        <ol>
            <li>Você receberá um email de confirmação em breve</li>
            <li>Aguarde o contato da equipe para definir qual edição do evento você deseja participar</li>
            <li>Seu novo ingresso é válido por <strong>2 anos</strong> em qualquer edição do Dreamfest ou Anime Expo</li>
            <li>Acompanhe as redes sociais para ficar por dentro das próximas datas</li>
        </ol>
    </div>
    
    <!-- Botão voltar -->
    <a href="<?= site_url('/') ?>" class="btn-voltar">
        <i class="bi bi-house"></i>
        Voltar para o início
    </a>
    
    <!-- Redes sociais -->
    <div class="redes-sociais">
        <p>Acompanhe as novidades:</p>
        <div class="links">
            <a href="https://instagram.com/dreamfestoficial" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #E4405F;"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                @dreamfestoficial
            </a>
            <a href="https://instagram.com/animexpoficial" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #E4405F;"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                @animexpoficial
            </a>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>
