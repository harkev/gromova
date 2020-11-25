<?php
$idlead=$_POST['id'];
$res_user=$_POST['res_user'];
require_once 'configbd.php';

$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных

$query ="SELECT * FROM itrec where idlead= $idlead ORDER BY data DESC";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$res = array();
while ($row = $result->fetch_row()) {
    $res[] = $row;
}
// закрываем подключение
mysqli_close($link);
echo json_encode($res);
return $res;