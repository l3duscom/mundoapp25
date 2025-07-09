<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
    <style>
        html,
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            /* Usa Helvetica que é similar à Arial */
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }


        .ingresso-container {
            width: 100%;
            /* Faz com que a div ocupe toda a largura */
            /* Pode ajustar conforme necessário */
            margin-top: 50px;
            /* Margem superior para cada ingresso */
            text-align: center;
        }

        img {
            width: 160px;
            /* Ajusta a largura da imagem */
            height: auto;
            margin: 0;
            padding-right: 10px;
        }

        .no-wrap {
            white-space: nowrap;
            /* Evita que a palavra seja quebrada */

        }

        .texto-com-fundo-preto {
            border: 5px solid black;
            /* Cor de fundo preta */
            color: black;
            /* Cor do texto branca para contraste */
            width: 100%;
            /* Ocupa 100% da largura da página */
            padding: 20px;
            /* Espaço interno para não colar o texto nas bordas */
        }
    </style>
</head>

<body>
    <?php foreach ($ingressos as $item) : ?>
        <div class="ingresso-container">
            <div style="padding-bottom: 10px; margin: auto;">
                <img src="https://dreamfest.com.br/wp-content/uploads/2024/04/logo-dream24-pb.png">
            </div>
            <div style="font-weight: 900; padding: 10px;" class="no-wrap"><strong><?php echo $item['ingresso']->nome; ?></strong></div>
            <div style="font-weight: 900;" class="no-wrap">Disponível para:<br> <?php echo $item['participante'] ?></div>
            <div style="font-size: 15px;margin-top: 10px;padding-top: 10px; padding-bottom: 10px;">
                <strong>VENDA PROIBIDA</strong>
            </div>

            <div style="font-size: 11px;padding-top: 15px" class="no-wrap"><strong>Ingresso válido para os <br>dias escolhidos </strong> <br>Abertura dos portões: 10h<br>Centro de eventos PUCRS<br>Av. Ipiranga 6681, Porto Alegre, <br>Rio Grande do Sul</div>
            <div style=" display: flex; justify-content: center;">
                <img src="<?= $item['qrcode'] ?>" style="background-color:#fff; padding:0px">
            </div>
            <div style="margin-top: -20px;font-size: 10px;" class="no-wrap"> <?php echo $item['ingresso']->codigo; ?></div>
            <div style="font-size: 12px; padding-top: 10px;"><STRONG>DISTRIBUIÇÃO GRATUITA</STRONG><br>www.dreamfest.com.br</div>

            <div style="padding-top: 30px; font-size: 8px">-----------------------</div>
        </div>
    <?php endforeach; ?>
</body>

</html>