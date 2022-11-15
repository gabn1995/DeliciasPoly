// import {show} from './modulo.js';
// show();

$(function () {
    //ler diretório principal
    var base_dir = $('.base_dir-js').val();

    //declaração de variáveis globais
    let cart = [];

    //pega variável do localStorage
    ler_carrinho();
    quant_produto_carrinho();

    //regularizar os slides devido a nav-bar fixo
    var altura_navBar = $('.nav-js').css('height');
    $('.body-js').css('margin-top', altura_navBar);

    //função do botão aumentar
    $('.aumentar-js').each(function () {
        $(this).bind('click', function () {
            let grupo_botoes = $(this).closest('.botoes-js');
            let bt_quant = grupo_botoes.find('.quantidade-js');
            let quant = bt_quant.html();
            bt_quant.html(++quant);
        });
    });

    //função do botão diminuir
    $('.diminuir-js').each(function () {
        $(this).bind('click', function () {
            let grupo_botoes = $(this).closest('.botoes-js');
            let bt_quant = grupo_botoes.find('.quantidade-js');
            let quant = bt_quant.html();

            //verificação se quantidade é maior que 1
            if (quant > 1) {
                bt_quant.html(--quant);
            }
        });
    });

    //função do botão adicionar
    $('.adicionar-js').each(function () {
        $(this).bind('click', function (e) {
            e.preventDefault();
            let card_produto = $(this).closest('.card-js');

            //pegar valores dos produtos para colocar no carrinho
            const id = card_produto.find('.id-js').val();
            const categoria = card_produto.find('.categoria-js').val();
            const nome = card_produto.find('.nome-js').html();

            const src = card_produto.find('.imagem-js').attr('src');
            const arraySrc = src.split('/');
            const tam = arraySrc.length;
            const imagem = arraySrc[tam - 1];

            const preco = card_produto.find('.preco-js').html();
            const quant = card_produto.find('.quantidade-js').html();

            //verifica se já possui no carrinho, se sim acrescenta quantidade senão adiciona ao carrinho
            const index = cart.findIndex((item) => item.id == id);
            if (index > -1) {
                cart[index].quant = parseInt(cart[index].quant) + parseInt(quant);
            } else {
                cart.push({ id, categoria, nome, preco, imagem, quant });
            }

            //atualiza quantidade de produto do carrinho mostrado no menu
            quant_produto_carrinho();

            //atualiza ou adiciona o carrinho no localStorage
            salvar_carrinho();
        });
    });

    //função que mostra quantidade de produto no carrinho
    function quant_produto_carrinho() {
        //mostra a quantidade do carrinho no menu
        $('.quant_carrinho-js').html(cart.length.toString());
    }


    //salvar carrinho no localStorage e fazer requisição para salvar carrinho no DATABASE
    function salvar_carrinho() {
        const cart_text = JSON.stringify(cart);
        localStorage.setItem('cart', cart_text);

        //fazer requisiçao ao carrinho para mandar CART
        let url = base_dir + '/salvarCarrinho';
        $.ajax({
            type: "post",
            url,
            data: { 'cart': cart },
            success: function (response) {
                if (response == 'true') {
                    alerta('success', 'Produto inserido no carrinho');
                } else {
                    alerta('success', 'Faça Login para ver o carrinho');
                }
            }
        });
    }

    //salvar carrinho no localStorage e fazer requisição para salvar carrinho no DATABASE
    function ler_carrinho() {
        //fazer requisiçao ao carrinho para ler carrinho do DATABASE
        let url = base_dir + '/lerCarrinho';
        $.ajax({
            type: "get",
            url,
            success: function (response) {
                if(response == "Array"){
                    cart = [];
                }else{
                    cart = JSON.parse(response);
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                quant_produto_carrinho();
            },
            error: function () {
                console.log('erro');
            }
        });
    }

    //fazer a função que irá mostrar a alerta na tela
    function alerta(tipo, texto) {
        //verificar os tipos de aviso
        const tipos = ['danger', 'success', 'warning', 'info'];

        tipos.find(function (item) {
            if (item === tipo) {
                $('.alerta-js').html(`
                    <div class="alert alert-${tipo} alert-dismissible fade show w-100 text-center" role="alert">
                        ${texto}
                        <button class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
            }
            //colocar o tempo para sumir de tela
            setTimeout(function () {
                $('.alert').alert('close')
            }, 3000);
        });
    }

    //filtrar por categorias
    $('.filtrosCategorias-js').bind('change', function () {
        //pegar o filtro
        const filtro = $(this).val();
        //manipular dados do endereço
        // let endereco = window.location.href;
        // let array = endereco.split('/');
        // array.pop();
        // array.push('filtro');
        // array.push(filtro+'#produtos');
        // //let url = array.join('/');
        let url = base_dir + '/filtro/' + filtro + '#produtos'
        //redirecionar para endereço
        window.location.href = url;
    });

    //funcionalidade de mostrar os produtos no modal
    $('.carrinho-modal-js').on('click', function () {
        carregarModal();
    });
    //função de carregar modal
    function carregarModal() {
        //declara valor dos produtos do carrinho
        let total = 0.0;
        //limpa o carrinho
        $('.produtos-modal-js').html("");

        //verifica se o carrinho tem produtos
        //se tiver mostra os produtos
        //senão mostra mensagem de vazio
        if (cart.length > 0) {
            cart.map((item, index) => {
                //montar a tabela com suas devidas informações
                $('.produtos-modal-js').append(`
                <tr>
                <td>
                    <input type="hidden" class="id-modal-js" value="${item.id}">
                    <img class="imagem-modal-js" src="${base_dir}/assets/img/produtos/${item.imagem}" width="50px" height="50px" alt="" style="padding: 5px;">
                    <span class="nome-modal-js" style="margin-left: 10px;">${item.nome}</span>
                </td>
                <td class="text-right">
                    <div class="btn-group botoes-js">
                        <button class="btn btn-secondary diminuir-modal-js">-</button>
                        <button class="btn btn-secondary quantidade-modal-js">${item.quant}</button>
                        <button class="btn btn-secondary aumentar-modal-js">+</button>
                    </div>
                </td>
                </tr>`);

                //calcular o valor total
                total += parseFloat(item.preco) * parseInt(item.quant);
            });

            //montar a parte do valor total
            $('.produtos-modal-js').append(`
            <tr class="bg-info text-white">
                <td><h5>Total</h5></td>
                <td class="text-right total-modal-js"><h5>R$ ${total.toFixed(2)}</h5></td>
            </tr>
            `);
        } else {
            $('.produtos-modal-js').html("<h5>Carrinho vazio!</h5>");
        }


        //carregar funcionalidade do modal
        funcoes_modal();
    }

    //funções do modal carrinho
    function funcoes_modal() {
        ////função do botão aumentar do modal

        $('.aumentar-modal-js').each(function () {
            $(this).bind('click', function () {
                let grupo_botoes = $(this).closest('.botoes-js');
                let bt_quant = grupo_botoes.find('.quantidade-modal-js');
                let quant = bt_quant.html();

                //atualizar cart
                const id = $(this).closest('tr').find('.id-modal-js').val();

                const index = cart.findIndex((item) => item.id == id);
                if (index > -1) {
                    cart[index].quant = parseInt(cart[index].quant) + 1;
                }
                //salvar carrinho e renderizar modal
                salvar_carrinho();
                carregarModal();
            });
        });

        ////função do botão diminuir do modal
        $('.diminuir-modal-js').each(function () {
            $(this).bind('click', function () {
                let grupo_botoes = $(this).closest('.botoes-js');
                let bt_quant = grupo_botoes.find('.quantidade-modal-js');
                let quant = bt_quant.html();

                //verificação se quantidade é maior que 1
                if (quant > 0) {
                    //atualizar cart
                    const id = $(this).closest('tr').find('.id-modal-js').val();

                    const index = cart.findIndex((item) => item.id == id);
                    if (index > -1) {
                        cart[index].quant = parseInt(cart[index].quant) - 1;

                        //verificar se quantidade é igual a 0
                        if (cart[index].quant < 1) {
                            cart.splice(index, 1);
                            quant_produto_carrinho();
                        }
                    }
                    //salvar carrinho e renderizar modal
                    salvar_carrinho();
                    carregarModal();
                }
            });
        });
    }

    //funçao do modal
    //limpar carrinho
    $('.limpar-js').bind('click', function (e) {
        e.preventDefault();

        //limpar o localstorage
        //requisitar para o php limpar o banco de dado
        let url = base_dir + "/limparCarrinho";
        $.ajax({
            type: "post",
            url,
            success: function (response) {
                alerta('info', 'Carrinho vazio!');

                ler_carrinho();
                carregarModal();
            }
        });

    });


});







