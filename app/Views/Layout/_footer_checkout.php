<?php
/**
 * Footer para páginas do fluxo de checkout
 * Inclui seções de: Métodos de Pagamento, Segurança, Ajuda e Rodapé
 */

// Carregar configurações do footer
$footerModel = new \App\Models\FooterSettingModel();
$footerConfig = [];

try {
    $footerConfig = $footerModel->getAllAsArray();
} catch (\Exception $e) {
    // Tabela pode não existir ainda, usar valores padrão
    $footerConfig = [
        'pagamento_titulo' => 'Métodos de pagamento',
        'pagamento_parcelamento' => 'Parcele sua compra em até 12x',
        'seguranca_titulo' => 'Compre com total segurança',
        'seguranca_texto' => 'Os dados sensíveis são criptografados e não serão salvos em nossos servidores.',
        'ajuda_titulo' => 'Precisando de ajuda?',
        'ajuda_texto' => 'Acesse nossa Central de Ajuda ou Fale Conosco',
        'ajuda_link' => 'https://wa.me/5551993406154',
        'ajuda_link_texto' => 'Fale conosco',
        'footer_copyright' => '© ' . date('Y') . ' Mundo Dream. Todos os direitos reservados.',
        'social_instagram' => 'https://instagram.com/mundodream',
    ];
}
?>

<!-- Footer Checkout -->
<footer class="checkout-footer mt-5">
    <!-- Seção Superior - Fundo Branco -->
    <div class="footer-top bg-white border-top py-4">
        <div class="container">
            <div class="row g-4">
                <!-- Métodos de Pagamento -->
                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold mb-3"><?= $footerConfig['pagamento_titulo'] ?? 'Métodos de pagamento' ?></h6>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <?php 
                        $bandeiras = $footerConfig['pagamento_imagens'] ?? [];
                        if (is_string($bandeiras)) $bandeiras = json_decode($bandeiras, true) ?? [];
                        if (!empty($bandeiras)): 
                            foreach ($bandeiras as $img): 
                        ?>
                        <img src="<?= site_url('uploads/footer/' . $img) ?>" alt="Bandeira" height="28" class="border rounded" style="background: #fff;">
                        <?php endforeach; else: ?>
                        <span class="badge bg-primary px-2 py-1" style="font-size: 11px;">VISA</span>
                        <span class="badge bg-danger px-2 py-1" style="font-size: 11px;">Mastercard</span>
                        <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 11px;">Elo</span>
                        <span class="badge bg-info px-2 py-1" style="font-size: 11px;">Amex</span>
                        <span class="badge px-2 py-1" style="font-size: 11px; background: #32bcad;">PIX</span>
                        <?php endif; ?>
                    </div>
                    <div class="text-success small">
                        <i class="bx bx-refresh me-1"></i><?= $footerConfig['pagamento_parcelamento'] ?? 'Parcele sua compra em até 12x' ?>
                    </div>
                </div>

                <!-- Segurança -->
                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold mb-3"><?= $footerConfig['seguranca_titulo'] ?? 'Compre com total segurança' ?></h6>
                    <p class="text-muted small mb-3"><?= $footerConfig['seguranca_texto'] ?? 'Os dados sensíveis são criptografados e não serão salvos em nossos servidores.' ?></p>
                    <div class="d-flex gap-3 align-items-center">
                        <?php 
                        $selos = $footerConfig['seguranca_selos'] ?? [];
                        if (is_string($selos)) $selos = json_decode($selos, true) ?? [];
                        if (!empty($selos)): 
                            foreach ($selos as $img): 
                        ?>
                        <img src="<?= site_url('uploads/footer/' . $img) ?>" alt="Selo de Segurança" height="40">
                        <?php endforeach; else: ?>
                        <div class="d-flex align-items-center">
                            <i class="bx bxs-shield-alt-2 text-success me-1" style="font-size: 24px;"></i>
                            <span class="small">SSL<br><strong>Seguro</strong></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bx bx-lock-alt text-primary me-1" style="font-size: 24px;"></i>
                            <span class="small">Dados<br><strong>Protegidos</strong></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Ajuda -->
                <div class="col-lg-4 col-md-12">
                    <h6 class="fw-bold mb-3"><?= $footerConfig['ajuda_titulo'] ?? 'Precisando de ajuda?' ?></h6>
                    <p class="text-muted small mb-3"><?= $footerConfig['ajuda_texto'] ?? 'Acesse nossa Central de Ajuda ou Fale Conosco' ?></p>
                    <?php if (!empty($footerConfig['ajuda_link'])): ?>
                    <a href="<?= $footerConfig['ajuda_link'] ?>" target="_blank" class="btn btn-outline-success btn-sm">
                        <i class="bx bx-envelope me-1"></i><?= $footerConfig['ajuda_link_texto'] ?? 'Fale conosco' ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Seção Inferior - Fundo Cinza Claro -->
    <div class="footer-bottom py-4" style="background-color: #f5f5f5; border-top: 1px solid #e0e0e0;">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                    <?php $eventoFooter = evento_selecionado_com_validacao(); ?>
                    <?php if ($eventoFooter && !empty($eventoFooter->avatar)) : ?>
                        <?php
                            if (strpos($eventoFooter->avatar, 'http') === 0) {
                                $footerAvatarUrl = $eventoFooter->avatar;
                            } elseif (strpos($eventoFooter->avatar, 'eventos/imagem/') === 0) {
                                $footerAvatarUrl = 'https://backoffice.mundodream.com.br/' . $eventoFooter->avatar;
                            } else {
                                $footerAvatarUrl = 'https://backoffice.mundodream.com.br/eventos/imagem/' . $eventoFooter->avatar;
                            }
                        ?>
                        <a href="<?= site_url() ?>">
                            <img src="<?= $footerAvatarUrl ?>" alt="<?= esc($eventoFooter->nome) ?>" height="40" style="max-width: 200px; object-fit: contain;">
                        </a>
                    <?php else : ?>
                        <a href="<?= site_url() ?>">
                            <img src="<?= site_url('recursos/front/images/logo-25-2-negativo.png') ?>" alt="Mundo Dream" height="40">
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Links Rápidos -->
                <div class="col-lg-4 col-md-6 mb-3 mb-lg-0 text-center">
                    <div class="d-flex justify-content-center gap-3 small">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#politicaModal" class="text-secondary text-decoration-none">Política de Cancelamento</a>
                    </div>
                </div>

                <!-- Redes Sociais -->
                <div class="col-lg-4 col-md-12 text-lg-end text-center">
                    <div class="d-flex justify-content-lg-end justify-content-center gap-3">
                        <?php if (!empty($footerConfig['social_facebook'])): ?>
                        <a href="<?= $footerConfig['social_facebook'] ?>" target="_blank" class="text-secondary"><i class="bx bxl-facebook-circle" style="font-size: 24px;"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($footerConfig['social_instagram'])): ?>
                        <a href="<?= $footerConfig['social_instagram'] ?>" target="_blank" class="text-secondary"><i class="bx bxl-instagram" style="font-size: 24px;"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($footerConfig['social_twitter'])): ?>
                        <a href="<?= $footerConfig['social_twitter'] ?>" target="_blank" class="text-secondary"><i class="bx bxl-twitter" style="font-size: 24px;"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($footerConfig['social_linkedin'])): ?>
                        <a href="<?= $footerConfig['social_linkedin'] ?>" target="_blank" class="text-secondary"><i class="bx bxl-linkedin" style="font-size: 24px;"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <small class="text-secondary">MUNDO DREAM EVENTOS E PRODUCOES LTDA © 2024 - Todos os direitos reservados</small>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.checkout-footer .footer-top {
    border-top: 1px solid #e9ecef;
}
.checkout-footer .footer-bottom a:hover {
    color: #333 !important;
}
.checkout-footer img[alt="Visa"],
.checkout-footer img[alt="Mastercard"],
.checkout-footer img[alt="Elo"],
.checkout-footer img[alt="Amex"],
.checkout-footer img[alt="PIX"] {
    background: #fff;
}
</style>
