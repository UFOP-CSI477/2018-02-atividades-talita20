$(document).ready(function () {
    $('#altura').mask("#0.00", {reverse: true});
    $('#peso').mask("#00.00", {reverse: true});
});

function calculoIMC() {
    var peso = $('#peso').val();
    var altura = $('#altura').val();

    var espaco = $('<p><p></p></p>');
    if (peso === '' || altura === '') {
        var labelError = $('<h4>Favor preencher todos os campos! </h4>');
        $('#resultadoIMC').append(espaco).append(labelError);
        return false;
    }
    var imc = peso / Math.pow(altura, 2);

    var label = $('<h4>Resultado IMC: </h4>');
    var span = $('<h3>').text(imc.toFixed(1));
    $('#resultadoIMC').append(espaco).append(label).append(span);

    var pesoIdealMenor = 18.5 * (altura * altura);
    var pesoIdealMaior = 24.9 * (altura * altura);

    var labelPeso = $('<h4>O peso ideal deve estar entre: ' + pesoIdealMenor.toFixed(1) + ' Kg e ' + pesoIdealMaior.toFixed(1) + ' Kg </h4>');
    $('#pesoIdeal').append(espaco).append(labelPeso);

    $('tr').each(function () {
        if (imc < 18.5) {
            $('#subnutricao').css("color", "red");
        } else if (imc >= 18.5 && imc < 24.9) {
            $('#peso_saudavel').css("color", "red");
        } else if (imc >= 25 && imc < 29.9) {
            $('#sobrepeso').css("color", "red");
        } else if (imc >= 30 && imc < 34.9) {
            $('#obesidade1').css("color", "red");
        } else if (imc >= 35 && imc < 39.9) {
            $('#obesidade2').css("color", "red");
        } else {
            $('#obesidade3').css("color", "red");
        }
    });
}

function calcularResultado() {
    var comp1 = $('#comp1').val();
    var comp2 = $('#comp2').val();
    var comp3 = $('#comp3').val();
    var comp4 = $('#comp4').val();
    var comp5 = $('#comp5').val();
    var comp6 = $('#comp6').val();

    var temp1 = $('#tempo1').val();
    var temp2 = $('#tempo2').val();
    var temp3 = $('#tempo3').val();
    var temp4 = $('#tempo4').val();
    var temp5 = $('#tempo5').val();
    var temp6 = $('#tempo6').val();

    var larg1 = 1;
    var larg2 = 2;
    var larg3 = 3;
    var larg4 = 4;
    var larg5 = 5;
    var larg6 = 6;

    var espaco = $('<p><p></p></p>');
    if (comp1 === '' || temp1 === '' || comp2 === '' || temp2 === '' || comp3 === '' || temp3 === '' || comp4 === '' || temp4 === '' || comp5 === '' || temp5 === '' || comp6 === '' || temp6 === '') {
        var labelError = $('<h4>Favor preencher todos os campos! </h4>');
        $('.error').append(espaco).append(labelError);
        return false;
    }

    var classificacao = [];
    classificacao = [
        {"tempo": temp1, "nome": comp1, "largada": larg1},
        {"tempo": temp2, "nome": comp2, "largada": larg2},
        {"tempo": temp3, "nome": comp3, "largada": larg3},
        {"tempo": temp4, "nome": comp4, "largada": larg4},
        {"tempo": temp5, "nome": comp5, "largada": larg5},
        {"tempo": temp6, "nome": comp6, "largada": larg6}
    ];

    classificacao.sort(function (obj1, obj2) {
        return obj1.tempo - obj2.tempo;
    });

    var posicao;
    var flag;

    for (var i = 0; i < classificacao.length; i++) {
        posicao = i + 1;
        if (classificacao[0].tempo === classificacao[i].tempo) {
            posicao = 1;
            flag = 'Vencedor(a)!';
        } else {
            posicao = i + 1;
            flag = '-';
        }

        var tr = $('<tr>');
        var pos = $('<td>' + posicao + 'º</td>');
        var larg = $('<td>' + classificacao[i].largada + '</td>');
        var name = $('<td>' + classificacao[i].nome + '</td>');
        var time = $('<td>' + classificacao[i].tempo + '</td>');
        var result = $('<td>' + flag + '</td>');
        var tr2 = $('</tr>');

        $('#tabela').append(tr).append(pos).append(larg).append(name).append(time).append(result).append(tr2);
    }
}