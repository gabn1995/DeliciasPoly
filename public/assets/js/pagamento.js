$(function () {
    mascaras();

    function mascaras() {
        $('#cpf').mask('000.000.000-00');
        $('#celular').mask('(00) 00000-0000');
        $("#cep").mask("00000-000");
    }

    $(".form_pagamento").bind("submit", function (e) {
        e.preventDefault();

        let base = $("#endereco").val();

        let dados = {
            nome: $("#nome").val(),
            cpf: $("#cpf").val(),
            email: $("#email").val(),
            celular: $("#celular").val(),

            rua: $("#rua").val(),
            numero: $("#numero").val(),
            complemento: $("#complemento").val(),
            bairro: $("#bairro").val(),
            cidade: $("#cidade").val(),
            uf: $("#uf").val(),
            cep: $("#cep").val(),
        };

        $.ajax({
            type: "POST",
            url: base + "/pagamentoAction",
            data: dados,
            dataType: "json",

            beforeSend: function () {
                $("#submit").val("Gerando Boleto!");
            },
            success: function (response) {
                if(response){
                    let url_boleto = response.create_request.bank_slip.url_slip;
                    window.open(url_boleto);

                    alert("Boleto gerado com sucesso!");
        
                    setTimeout(function () {
                        document.location.href = base;
                    }, 5000);

                }
            },
            error: function(){
                $("#submit").val("Gerar Boleto!");
                alert("Preencha os dados corretamente!");
            }
        });
    });
});

$("#cep").on("keyup", function (e) {
    let cep_valor = $("#cep").val();
    let cep_tam = cep_valor.length;

    if (cep_tam == 9) {
        pesquisacep(this.value);
    }else{
        limpa_formulário_cep();
    }
});

function cobertura_endereco(endereco) {
    //cidade de cobertura
    let cidade = 'Poá';

    if(endereco.localidade == cidade){
        return true;
    }else{
        return false;
    }

}

function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById("rua").value = "";
    document.getElementById("bairro").value = "";
    document.getElementById("cidade").value = "";
    document.getElementById("uf").value = "";
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //ver se o endereço está na area de cobertura
        let status = cobertura_endereco(conteudo);
        
        if(status){
            //Atualiza os campos com os valores.
            document.getElementById("rua").value = conteudo.logradouro;
            document.getElementById("bairro").value = conteudo.bairro;
            document.getElementById("cidade").value = conteudo.localidade;
            document.getElementById("uf").value = conteudo.uf;
        }else{
            limpa_formulário_cep();

            alert('Cidade fora de cobertura!');
        }

    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, "");

    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById("rua").value = "...";
            document.getElementById("bairro").value = "...";
            document.getElementById("cidade").value = "...";
            document.getElementById("uf").value = "...";

            //Cria um elemento javascript.
            var script = document.createElement("script");

            //Sincroniza com o callback.
            script.src =
                "https://viacep.com.br/ws/" + cep + "/json/?callback=meu_callback";

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);
        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
}
