<?php

$sgp = $_POST['sgp'];

include("db.php");

$query_excluir = ("DELETE FROM processos WHERE sgp = '$sgp'");

if (mysqli_query($con, $query_excluir))
header("Location: index.php");

mysqli_close($con);