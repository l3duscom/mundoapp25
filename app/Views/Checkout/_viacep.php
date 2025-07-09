$('[name=cep]').on('keyup', function() {


var cep = $(this).val();

if (cep.length === 9) {

$.ajax({

type: 'GET',
url: '<?php echo site_url('clientes/consultacep'); ?>',
data: {
cep: cep
},
dataType: 'json',
beforeSend: function() {


$("#formulario_pagamento").LoadingOverlay("show");

$("#cep").html('');

},
success: function(response) {

$("#formulario_pagamento").LoadingOverlay("hide", true);


if (!response.erro) {

if (!response.rua) {

$('[name=rua]').prop('readonly', false);

$('[name=rua]').focus();

}


if (!response.bairro) {

$('[name=bairro]').prop('readonly', false);

}


// Preenchemos os inputs com os valores do response
$('[name=rua]').val(response.rua);
$('[name=bairro]').val(response.bairro);
$('[name=cidade]').val(response.cidade);
$('[name=estado]').val(response.estado);

}

if (response.erro) {

// Exitem erros de validação

$("#cep").html(response.erro);
}

},
error: function() {

$("#formulario_pagamento").LoadingOverlay("hide", true);

alert(
'Não foi possível procesar a solicitação. Por favor entre em contato com o suporte técnico.'
);

}



});



}

});