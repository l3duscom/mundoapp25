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
            margin-top: 15px;
            /* Margem superior para cada ingresso */
            text-align: center;
        }

        img {
            width: 160px;
            /* Ajusta a largura da imagem */
            height: auto;
            margin: 0;
            padding-left: 10px;
        }

        .no-wrap {
            white-space: nowrap;
            /* Evita que a palavra seja quebrada */
        }
    </style>
</head>

<body>
    <?php foreach ($ingressos as $item) : ?>
        <div class="ingresso-container">
            <div style="font-weight: 900;" class="no-wrap"><strong>
                    <?php
                    $participante = $item['participante'];
                    echo substr($participante, 0, 21);
                    ?>
                </strong></div>
            <div style="font-size: 8px">
                <?php
                echo $item['ingresso']->nome;
                ?></div>
            <div style="display: flex; justify-content: center;">
                <img src="<?= $item['qrcode'] ?>" style="background-color:#fff; padding:0px; width: 55px;">
            </div>
            <div style="margin-top: -5px;font-size: 6px;" class="no-wrap"> <?php echo $item['ingresso']->codigo; ?></div>

        </div>
    <?php endforeach; ?>
</body>

</html>