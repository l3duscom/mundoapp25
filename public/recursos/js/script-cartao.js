$gn.ready(function (checkout) {
  //Aplicando as mascaras nos inputs do formulário
  $("#cpf").mask("000.000.000-00");
  $("#nascimento").mask("00/00/0000");
  $("#cep").mask("00.000-000");
  $("#numero_cartao").mask("0000 0000 0000 0000");
  $("#codigo_seguranca").mask("000");
  $("#telefone").mask("(00) 90000-0000");
  $("#telefone").blur(function (event) {
    if ($(this).val().length == 15) {
      // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
      $("#telefone").mask("(00) 00000-0009");
    } else {
      $("#telefone").mask("(00) 0000-00009");
    }
  });

  $("#ver_parcelas").click(function () {
    if ($("#bandeira")[0].checkValidity()) {
      var valor_total = parseInt($("#valor_total").val());
      var bandeira = $("#bandeira").val();

      checkout.getInstallments(
        valor_total, // valor total da cobrança
        bandeira, // bandeira do cartão
        function (error, response) {
          if (error) {
            // Trata o erro ocorrido
            console.log(error);

            alert(`Código do erro: ${error.error}\nDescrição do erro: ${error.error_description}`);
          } else {
            // Trata a respostae
            console.log(response);

            var option = "";

            for (let index = 0; index < response.data.installments.length; index++) {
              option += `<option value="${response.data.installments[index].installment}">${
                response.data.installments[index].installment
              } x de R$${response.data.installments[index].currency} ${
                response.data.installments[index].has_interest === false ? "sem juros" : ""
              }</option>`;
            }

            $("#opcoes_parcelas").html(option);
            $("#modal_parcelas").modal("show");
          }
        }
      );
    } else {
      alert("o campo bandeira é obrigatório");
    }
  });

  $("#definir_parcelas").click(function () {
    if ($("#opcoes_parcelas")[0].checkValidity()) {
      var quantidade_parcelas = $("#opcoes_parcelas option:selected").val();

      $("#parcelas").val(quantidade_parcelas);

      // Alteração do botão ver_parcelas
      $("#ver_parcelas").html($("#opcoes_parcelas option:selected").text());
      $("#ver_parcelas").removeClass("btn-warning");
      $("#ver_parcelas").addClass("btn-success");

      // Alteração do botão confirmar_pagamento
      $("#confirmar_pagamento").removeClass("btn-secondary disabled");
      $("#confirmar_pagamento").addClass("btn-primary");

      // Maminizar a modal
      $("#modal_parcelas").modal("hide");
    } else {
      alert("O campo parcelas é obrigatório.");
    }
  });

  $("#confirmar_pagamento").click(function () {
    if ($("#formulario_pagamento")[0].checkValidity()) {
      var bandeira = $("#bandeira").val();
      var numero_cartao = $("#numero_cartao").val();
      var cvv = $("#codigo_seguranca").val();
      var mes_vencimento = $("#mes_vencimento").val();
      var ano_vencimento = $("#ano_vencimento").val();

      checkout.getPaymentToken(
        {
          brand: bandeira, // bandeira do cartão
          number: numero_cartao, // número do cartão
          cvv: cvv, // código de segurança
          expiration_month: mes_vencimento, // mês de vencimento
          expiration_year: ano_vencimento, // ano de vencimento
        },
        function (error, response) {
          if (error) {
            // Trata o erro ocorrido
            console.error(error);

            alert(`Código do erro: ${error.error}\nDescrição: ${error.error_description}`);
          } else {
            // Trata a resposta
            console.log(response);

            // Desabilitar os botões ver parcelas e confirmar pagamento
            $("#confirmar_pagamento").addClass("disabled");
            $("#ver_parcelas").addClass("disabled");

            $("#confirmar_pagamento").removeClass("btn-primary");
            $("#confirmar_pagamento").addClass("btn-success");
            $("#confirmar_pagamento").html("Pagamento processado");

            // Insere o payment_token e o card_mask nos inputs
            var paymentToken = response.data.payment_token;
            var marcaraCartao = response.data.card_mask;
            $("#payment_token").val(paymentToken);
            $("#mascara_cartao").val(marcaraCartao);

            // Desabilitar os inputs com os dados do cartão
            $("#numero_cartao").prop("disabled", true);
            $("#bandeira").prop("disabled", true);
            $("#mes_vencimento").prop("disabled", true);
            $("#ano_vencimento").prop("disabled", true);
            $("#codigo_seguranca").prop("disabled", true);

            $("#formulario_pagamento").submit();
          }
        }
      );
    } else {
      alert("Todos os campos são obrigatórios.");
    }
  });
});
