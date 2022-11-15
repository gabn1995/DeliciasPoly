$(function () {
    mascaras();

    function mascaras() {
        $('#cpf').mask('000.000.000-00');
        $('#celular').mask('(00) 00000-0000');
        $("#cep").mask("00000-000");
    }
});


var base_dir = $('.base_dir-js').val();

$('.deletar-cliente-js').bind('click', function (e) {
    e.preventDefault();
    //pegar endereço
    var url = $(this).attr('href');
    //mensagem de confirmação
    var confirmar = confirm('Confirmar exclusão do cliente?');

    if(confirmar){
        window.location.href = url;
    }
});

$('.deletar-produto-js').bind('click', function (e) {
    e.preventDefault();
    //pegar endereço
    var url = $(this).attr('href');
    //mensagem de confirmação
    var confirmar = confirm('Confirmar exclusão do produto?');

    if(confirmar){
        window.location.href = url;
    }
});

$('.arquivo-imagem-js').on('change', function(e){
    e.preventDefault();

    //$('.preview-js').attr('src', base_dir+'/assets/img/produtos/bolo1.jpg');
    $('#formulario').trigger('submit');

});

$('.recibo-js').on('click', function(e){
    e.preventDefault();

    var url = $(this).attr('href');

    $.ajax({
        type: "post",
        url: url,
        success: function (response) {
            window.open(response);
        }
    });
});


