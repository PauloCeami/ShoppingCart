$(document).ready(function () {

    var BASE_URL = $('#URL').val();
    console.log("url base do sistema ::: " + BASE_URL)

    $("#adicionar").click(function () {
        var idproduto = $('#idprod').val();
        var qtde = $('#quant').val();

        $.ajax({
            url: BASE_URL + 'Ajax/cart.php',
            type: 'POST',
            data: 'produto=' + idproduto + '&qtd=' + qtde + '&acao=add',
            dataType: 'json',
            beforeSend: function () {
                $("#adicionar").attr('disabled', 'disabled');
                $("#loading").fadeIn('slow');
                $("#alert").hide();
            },
            success: function (data) {
                console.log(data)

                if (data == 'PRDNOT') {
                    $("#alert").fadeIn('slow');
                    loading();
                    return;
                }
                if (data == 'PRDNOTENC') {
                    alert('Este produto não pode ser adicionado..');
                    loading();
                    return;
                }

                loading();
                getCart(data);
            }
        });

    });

    function loading() {
        $("#loading").fadeOut('slow', function () {
            $("#adicionar").attr('disabled', false);
        });
    }

    $("#CartAll").on('click', '#removeIten', function (e) {
        var prd_id_session = $(this).attr('data-id');
        $.post(BASE_URL + 'Ajax/cart.php', {acao: 'deleteItem', id: prd_id_session}, function (retorno) {
            if (retorno == 'ok') {
                loadPage();
            }
        }, "json");
        return false;
    });

    loadPage();

    function loadPage() {
        $.post(BASE_URL + 'Ajax/cart.php', {acao: 'loadItens'}, getCart, "json");
    }


    function getCart(data) {

        var cart = $("#CartAll");
        var countCart = cart.find("#countCart");
        var tbody = cart.find("tbody");
        var totalCart = cart.find("#totalCart");
        var tr = '';
        if (data.count > 0) {
            $.each(data.dados, function (i, val) {

                tr += '<tr>';
                tr += '<td><img src="' + data.dados[i].foto + '" width="50" heigth="50" /></td>';
                tr += '<td>' + data.dados[i].titulo + '</td>';
                tr += '<td>' + data.dados[i].qtd + '</td>';
                tr += '<td>' + data.dados[i].total + '</td>';
                tr += '<td><a href="#" id="removeIten" data-id="' + data.dados[i].id + '" class="button small">excluir</a></td>';
                tr += '</tr>';
            });
        } else {
            tr += '<tr><td colspan="3">Nenhum produto Adicionado</td></tr>';
        }

        //INSERIR INFORMAÇÔES
        countCart.text("Carrinho(" + data.count + ")");
        totalCart.text("R$ " + data.subTotalCart);
        tbody.empty().append(tr);
    }
});