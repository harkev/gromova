<?php
$str=$_POST['id']." , '".$_POST['name']."', '";
$res_user=$_POST['res_user'];
if (!empty($_POST['values']))
    foreach ($_POST['values'] as $value) {
        $arraystr[] =  $value['idcontact'] . " , '" . $value['name'] . "' , " .$str .$value['stag'] . "' , '".$value['stagk'] . "' , '" . $value['comment'] . "' , '" .$value['review'] . "' , '". $value['responsible']. "' , '". $value['date'] . "' , '" . $value['res_user']. "'";
    }

//подключение к БД
require_once 'configbd.php';

$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных удаляет все
$query ="DELETE FROM itrec where idcontact= ".$_POST['id'];
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных добавляет новые значения
if (!empty($_POST['values']))
    foreach ($arraystr as $value){
        $query = "INSERT itrec(idlead,namelead,idcontact,namecontact,stag,stagk,comment,review,responsible,data,idresponsible) VALUES (" . $value . ")";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    }