<h3>Saudações <?php echo esc($cliente->nome); ?></h3>

<p>Sua inscrição <?= $inscricao->codigo ?> para o <?= $concurso->nome ?> foi <strong>CANCELADA</strong> :(</p>

<p>Infelizmente a sua inscrição foi rejeiatda. Provavelmente algum dos itens obrigatórios foi preenchido incorretamente. Refaça sua inscrição ou entre em contato conosco através do whatsapp!</p>
<hr>
<h3>Resumo da inscrição:</h3>
<p>
    <strong><?= $inscricao->status ?></strong>
    <?php if ($inscricao->categoria == null) : ?>
        <br>Personagem: <?= $inscricao->personagem ?>
        <br>Obra: <?= $inscricao->obra ?>
        <br>Gênero: <?= $inscricao->genero ?>
        <br>Imagem de referência: <a href="<?= site_url("concursos/imagem/$inscricao->referencia"); ?>" target="_blank"> Visualizar imagem de referência</a>

    <?php else : ?>
        <br>Video classificatórias: <a href="<?= $inscricao->video_apresentacao ?>" target="_blank"> <?= $inscricao->video_apresentacao ?></a>
        <br>Imagem de referência: <a href="<?= site_url("concursos/imagem/$inscricao->referencia"); ?>" target="_blank"> Visualizar imagem de referência</a>
        <br>Áudio da apresentação: <a href="<?= site_url("concursos/imagem/$inscricao->musica"); ?>" target="_blank"> Tocar música</a>
        <br>Video classificatórias: <a href="<?= site_url("concursos/imagem/$inscricao->video_led"); ?>" target="_blank"> Visualizar video</a>
    <?php endif; ?>

    <hr>
</p>
<hr>
<p><strong>Acesse:</strong><a href="https://ingressos.dreamfest.com.br"> sua área de membros</a> com o email <?= $cliente->email ?> para Visualizar sua inscrição!</p>
<hr>
<h3>Detalhes do evento:</h3>
<p>
    <strong>Dreamfest 25 Parte 2 - Mega Convenção Geek</strong>
    <br>6 e 7 de dezembro das 11h às 19h
    <br>Centro de eventos da FENAC - NH
    <hr>
    Geek que é geek não 😴 no ponto!
</p>