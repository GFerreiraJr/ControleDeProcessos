$(document).ready(function () {

  posicaoLogin();
  tamanhoTabela();
  posicaoConfimar();

  // toggle botão cadastrar  
  $("#cadastrar-btn").click(function () {
    $("#cadastrar-div").toggleClass("show-cadastrar-div");
  });

  // tamanho da tabela on riseze
  $(window).on("resize", function () {
    posicaoLogin();
    tamanhoTabela();
    posicaoConfimar();
  });

  // abrir janela confirmar exlução de processo
  $(".excluir-btn").click(function () {
    let sgp = $(this).parent().parent().find('#sgp').text();
    $("#sgp-processo").val(sgp);
    $("#confirmar-window").toggleClass("show-confirmar-window");
  });

  // abrir janela editar linha
  $(".editar-btn").click(function () {
    $("#cadastrar-form").attr("action","editar.php");
    $("#cadastrar-editar-btn").attr("value","Editar");
    $(".editar-div").css({"display": "flex"});

    let requerente = $(this).parent().parent().find('#requerente').text();
    let tipo_pedido = $(this).parent().parent().find('#tipo_pedido').text();
    let sgp = $(this).parent().parent().find('#sgp').text();
    let cpf = $(this).parent().parent().find('#cpf').text();
    let data_entrada = $(this).parent().parent().find('#data_entrada').text();
    let data_saida = $(this).parent().parent().find('#data_saida').text();
    let estagio = $(this).parent().parent().find('#estagio').text();

    $("#sgp-editar").val(sgp);
    $("#requerente-input").val(requerente);
    $("#tipo_pedido-input").val(tipo_pedido);
    $("#sgp-input").val(sgp);
    $("#cpf-input").val(cpf);
    $("#data_entrada-input").val(data_entrada);
    $("#data_saida-input").val(data_saida);
    $("#estagio-input").val(estagio);

    $("#cadastrar-div").toggleClass("show-cadastrar-div");
    
  })

  function posicaoConfimar() {
    var alturaWindow = $(window).outerHeight(true);
    var larguraWindow = $(window).outerWidth(true);
    var topWindow = alturaWindow / 2 - 85 + "px";
    var rightWindow = larguraWindow / 2 - 200 + "px";
    $("#confirmar-window").css({ "top": topWindow, "right": rightWindow });
  }

  function tamanhoTabela() {
    var tamanhoWindow = $(window).outerHeight(true);
    var tamanhoHeader = $("#index-header").outerHeight(true);
    var tamanhoToolBar = $("#tools-bar").outerHeight(true);
    var tamanhoTabelaHeader = $(".Table-header").outerHeight(true);
    var tamanhoTotal = tamanhoWindow - tamanhoHeader - tamanhoToolBar - tamanhoTabelaHeader + "px";

    $(".row-collection").height(tamanhoTotal);
  }

  function posicaoLogin() {
    var alturaWindow = $(window).outerHeight(true);
    var larguraWindow = $(window).outerWidth(true);
    var topWindow = alturaWindow / 2 - 100 + "px";
    var rightWindow = larguraWindow / 2 - 200 + "px";
    $("#form-login").css({ "top": topWindow, "right": rightWindow });
  }
});