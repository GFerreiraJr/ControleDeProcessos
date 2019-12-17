<?php
include("db.php");

$requerente = $_POST['requerente'];
$tipo_pedido = $_POST['tipo_pedido'];
$sgp = $_POST['sgp'];
$status = $_POST['status'];
$cpf = $_POST['cpf'];
$data_entrada = $_POST['data_entrada'];
$data_saida = $_POST['data_saida'];

$query_cadastro = "INSERT INTO processos (requerente, tipo_pedido, sgp, cpf, estagio, data_entrada, data_saida) VALUES ('$requerente', '$tipo_pedido', '$sgp', '$cpf', '$status', '$data_entrada', '$data_saida')";

if (mysqli_query($con, $query_cadastro))
  header('Location: index.php');
else
echo (mysqli_error($con));

mysqli_close($con);
