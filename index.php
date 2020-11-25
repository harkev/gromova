
<?php
require_once "amocrm.php";
//var_dump(json_decode(access_token(),true));
//var_dump(refresh_token());
$leads =leads();
$contacts = contacts();
$users=users();
$res_user=$_GET['user'];
$url=$_GET['url'];
$url=substr($url,1,strlen($url));
$param=substr($url,0,strpos($url,"/"));
$paramid=substr($url,strrpos($url,"/")+1,strlen($url));
if ($res_user==""){
    echo "Данный пользователь не найден в amocrm, произведите вход через widget";
} else{
//var_dump($users);
    if (($_GET['name']=='kandidat')||($param=='contacts'))
        require_once "kandidat.php";
    elseif (($_GET['name']==Null)||($_GET['name']=='vakansia'))
        require_once "vakansia.php";
    // elseif ($_GET['name']=='add')
    //     require_once "add.php";
}