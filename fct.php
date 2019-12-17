 ?php


function resultTodos()
{
    include("db.php");
    $keyword = stripslashes($_REQUEST['keyword']);
    $keyword = mysqli_real_escape_string($con, $keyword);
    $tabela = stripslashes($_REQUEST['tabela']);
    $tabela = mysqli_real_escape_string($con, $tabela);

    $result_count = mysqli_query($con, "SELECT * FROM processos WHERE '$tabela' LIKE '%$keyword%'");
    $total_records = mysqli_num_rows($result_count);

    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1
};