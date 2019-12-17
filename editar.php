<?php

include("db.php");

$sgp_editar = $_POST['sgp-editar'];
$requerente = $_POST['requerente'];
$tipo_pedido = $_POST['tipo_pedido'];
$sgp = $_POST['sgp'];
$cpf = $_POST['cpf'];
$data_entrada = $_POST['data_entrada'];
$data_saida = $_POST['data_saida'];
$estagio = $_POST['status'];

// echo ('0' . $sgp_editar . '<br>');
// echo ('1' . $requerente . '<br>');
// echo ('2' . $tipo_pedido . '<br>');
// echo ('3' . $sgp . '<br>');
// echo ('4' . $cpf . '<br>');
// echo ('5' . $data_saida . '<br>');
// echo ('6' . $data_entrada . '<br>');
// echo ('7' . $estagio . '<br>');

$query_atualizar = "UPDATE processos SET requerente = '$requerente', tipo_pedido = '$tipo_pedido', sgp = '$sgp', cpf = '$cpf', estagio = '$estagio', data_entrada = '$data_entrada', data_saida = '$data_saida' WHERE sgp = '$sgp_editar'";

if (mysqli_query($con, $query_atualizar))
header("Location: index.php");
else
printf (mysqli_error($con));

mysqli_close($con);

?>