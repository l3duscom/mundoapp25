<?= $this->extend('Layout/principal'); ?>

<?= $this->section('titulo'); ?>
<?= esc($titulo); ?>
<?= $this->endSection(); ?>

<?= $this->section('estilos'); ?>
<style>
    .image-preview {
        display: inline-block;
        position: relative;
        margin: 5px;
    }
    .image-preview img {
        height: 50px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 3px;
        background: #fff;
    }
    .image-preview .btn-remove {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 20px;
        height: 20px;
        padding: 0;
        font-size: 12px;
        line-height: 1;
        border-radius: 50%;
    }
    .upload-area {
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background: #fafafa;
        cursor: pointer;
        transition: all 0.3s;
    }
    .upload-area:hover {
        border-color: #007bff;
        background: #f0f7ff;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('conteudo'); ?>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Configurações</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= site_url('/') ?>"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Footer</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bx bx-cog me-2"></i><?= esc($titulo) ?></h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('footer-settings/salvar') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <!-- Seção de Pagamento -->
            <div class="border rounded p-3 mb-4">
                <h6 class="fw-bold mb-3"><i class="bx bx-credit-card me-2"></i>Métodos de Pagamento</h6>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Título</label>
                        <input type="text" name="pagamento_titulo" class="form-control" 
                               value="<?= esc($config['pagamento_titulo'] ?? 'Métodos de pagamento') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Texto de Parcelamento</label>
                        <input type="text" name="pagamento_parcelamento" class="form-control" 
                               value="<?= esc($config['pagamento_parcelamento'] ?? 'Parcele sua compra em até 12x') ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bandeiras de Cartão</label>
                    <div id="bandeiras-preview" class="mb-2">
                        <?php 
                        $bandeiras = $config['pagamento_imagens'] ?? [];
                        if (is_string($bandeiras)) $bandeiras = json_decode($bandeiras, true) ?? [];
                        foreach ($bandeiras as $img): 
                        ?>
                        <div class="image-preview" data-chave="pagamento_imagens" data-imagem="<?= esc($img) ?>">
                            <img src="<?= site_url('uploads/footer/' . $img) ?>" alt="Bandeira">
                            <button type="button" class="btn btn-danger btn-remove" onclick="removerImagem(this)">×</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="upload-area" onclick="document.getElementById('bandeiras').click()">
                        <i class="bx bx-cloud-upload" style="font-size: 32px; color: #999;"></i>
                        <p class="mb-0 text-muted small">Clique para adicionar bandeiras de cartão</p>
                    </div>
                    <input type="file" name="bandeiras[]" id="bandeiras" multiple accept="image/*" class="d-none">
                </div>
            </div>

            <!-- Seção de Segurança -->
            <div class="border rounded p-3 mb-4">
                <h6 class="fw-bold mb-3"><i class="bx bx-shield-alt-2 me-2"></i>Segurança</h6>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Título</label>
                        <input type="text" name="seguranca_titulo" class="form-control" 
                               value="<?= esc($config['seguranca_titulo'] ?? 'Compre com total segurança') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Texto</label>
                        <input type="text" name="seguranca_texto" class="form-control" 
                               value="<?= esc($config['seguranca_texto'] ?? '') ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Selos de Segurança</label>
                    <div id="selos-preview" class="mb-2">
                        <?php 
                        $selos = $config['seguranca_selos'] ?? [];
                        if (is_string($selos)) $selos = json_decode($selos, true) ?? [];
                        foreach ($selos as $img): 
                        ?>
                        <div class="image-preview" data-chave="seguranca_selos" data-imagem="<?= esc($img) ?>">
                            <img src="<?= site_url('uploads/footer/' . $img) ?>" alt="Selo">
                            <button type="button" class="btn btn-danger btn-remove" onclick="removerImagem(this)">×</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="upload-area" onclick="document.getElementById('selos').click()">
                        <i class="bx bx-cloud-upload" style="font-size: 32px; color: #999;"></i>
                        <p class="mb-0 text-muted small">Clique para adicionar selos de segurança</p>
                    </div>
                    <input type="file" name="selos[]" id="selos" multiple accept="image/*" class="d-none">
                </div>
            </div>

            <!-- Seção de Ajuda -->
            <div class="border rounded p-3 mb-4">
                <h6 class="fw-bold mb-3"><i class="bx bx-help-circle me-2"></i>Ajuda</h6>
                
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Título</label>
                        <input type="text" name="ajuda_titulo" class="form-control" 
                               value="<?= esc($config['ajuda_titulo'] ?? 'Precisando de ajuda?') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Texto</label>
                        <input type="text" name="ajuda_texto" class="form-control" 
                               value="<?= esc($config['ajuda_texto'] ?? '') ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label">Link (WhatsApp/Email)</label>
                        <input type="text" name="ajuda_link" class="form-control" 
                               value="<?= esc($config['ajuda_link'] ?? '') ?>" placeholder="https://wa.me/5551...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Texto do Botão</label>
                        <input type="text" name="ajuda_link_texto" class="form-control" 
                               value="<?= esc($config['ajuda_link_texto'] ?? 'Fale conosco') ?>">
                    </div>
                </div>
            </div>

            <!-- Redes Sociais -->
            <div class="border rounded p-3 mb-4">
                <h6 class="fw-bold mb-3"><i class="bx bx-share-alt me-2"></i>Redes Sociais</h6>
                
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label"><i class="bx bxl-facebook me-1"></i>Facebook</label>
                        <input type="url" name="social_facebook" class="form-control" 
                               value="<?= esc($config['social_facebook'] ?? '') ?>" placeholder="https://facebook.com/...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="bx bxl-instagram me-1"></i>Instagram</label>
                        <input type="url" name="social_instagram" class="form-control" 
                               value="<?= esc($config['social_instagram'] ?? '') ?>" placeholder="https://instagram.com/...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="bx bxl-twitter me-1"></i>Twitter</label>
                        <input type="url" name="social_twitter" class="form-control" 
                               value="<?= esc($config['social_twitter'] ?? '') ?>" placeholder="https://twitter.com/...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="bx bxl-linkedin me-1"></i>LinkedIn</label>
                        <input type="url" name="social_linkedin" class="form-control" 
                               value="<?= esc($config['social_linkedin'] ?? '') ?>" placeholder="https://linkedin.com/...">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i>Salvar Configurações
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    // Preview de novas imagens
    document.getElementById('bandeiras').addEventListener('change', function(e) {
        previewImages(e.target.files, 'bandeiras-preview');
    });

    document.getElementById('selos').addEventListener('change', function(e) {
        previewImages(e.target.files, 'selos-preview');
    });

    function previewImages(files, containerId) {
        const container = document.getElementById(containerId);
        for (let file of files) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'image-preview';
                div.innerHTML = `<img src="${e.target.result}" alt="Preview"><span class="badge bg-success" style="position: absolute; top: -8px; left: -8px; font-size: 10px;">Novo</span>`;
                container.appendChild(div);
            }
            reader.readAsDataURL(file);
        }
    }

    function removerImagem(btn) {
        const parent = btn.closest('.image-preview');
        const chave = parent.dataset.chave;
        const imagem = parent.dataset.imagem;

        if (!imagem) {
            parent.remove();
            return;
        }

        if (confirm('Deseja remover esta imagem?')) {
            $.ajax({
                url: '<?= site_url('footer-settings/remover-imagem') ?>',
                method: 'POST',
                data: {
                    chave: chave,
                    imagem: imagem,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                success: function(res) {
                    if (res.success) {
                        parent.remove();
                    } else {
                        alert('Erro ao remover imagem');
                    }
                }
            });
        }
    }
</script>
<?= $this->endSection(); ?>
