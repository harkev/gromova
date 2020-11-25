<?php
function access_token(){
    $subdomain = 'itrec'; //Поддомен нужного аккаунта
    $client_id ='b089e5e3-674d-485c-aad9-ea0bf5032ae5';
    $client_secret='C29sZbMFRQqXoWxDjyhFhefonY2d9TF0U0vgT91ZaF0sHez4dIAjsWuaGUzKluUT';
    $code='def50200cf744f3b071247c90233a3f258a9f8c088bf583304100db944f8806896273c9917eca88f74297895e706410562b932bad46e4ec3a35a9afd0cc506b0bc55d41dacad0c5bd0e7f6e88114ca73a58e3b47ed1fb0d8da4806dcdadb57a5e5c653111299aa686da76946ed9da8b70e37cbede539d32237c256d037967cbc60db0b6f93bbd41dc7d159f9ea7095952528786b9debf963a079089e1949fd0a20b9c30563991db9171ff1716fc89303ac3a869a6c7c1b250843c74cfbe0552c6548290fcf3bf6bb349c9fd9ea81731b83f9883d3085889dc83c1f52c193cfff6019de4e6748f8b28fb35a32e713b37405d0987e5fc17b7547116ca140e9803689027ea646da6996a6855834e27424941463d5853e6b1114d609137b4f1b1a72e21bbfba2a80057f38cefc772776e3f3c1a2ed3a49bdde540c01acce8f75180f31df1baea87a605b5f44db5d59a333b88a516c25fda1db54d091dab0a9e2cfb6993fbf3760e23ed41c3586f50be0e3de8985987bc920e0e8a6cee450313b880619373ad2e75f47be3e0b988b6e131531d4b0512f154294e203045b32438745447c654946a82e1b586d3bb6bebe8ee37ec68d8844d576482c07ee6fa40dc8bb80610ff0493baf';
    $redirect_uri='http://u904141w.beget.tech/';

    $link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса
    /** Соберем данные для запроса */
    $data = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirect_uri,
    ];
    /**
     * Нам необходимо инициировать запрос к серверу.
     * Воспользуемся библиотекой cURL (поставляется в составе PHP).
     * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
     */
    $curl = curl_init(); //Сохраняем дескриптор сеанса cURL
    /** Устанавливаем необходимые опции для сеанса cURL  */
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
    curl_setopt($curl,CURLOPT_URL, $link);
    curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
    curl_setopt($curl,CURLOPT_HEADER, false);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
    $code = (int)$code;
    $errors = [
        400 => 'Bad request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not found',
        500 => 'Internal server error',
        502 => 'Bad gateway',
        503 => 'Service unavailable',
    ];

    try
    {
        /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
        if ($code < 200 || $code > 204) {
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
        }
    }
    catch(\Exception $e)
    {
        die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
    }

    /**
     * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
     * нам придётся перевести ответ в формат, понятный PHP
     */

    $file = 'oath.json';
// Открываем файл для получения существующего содержимого
    $current = file_get_contents($file);
// Добавляем нового человека в файл
    $current = $out;
// Пишем содержимое обратно в файл
    file_put_contents($file, $current);
    return $out;
}

//$code =$refresh_token
function refresh_token()
{
    $file = file_get_contents('oath.json');  // Открыть файл data.json
    $taskList = json_decode($file, TRUE);
    $subdomain = 'itrec'; //Поддомен нужного аккаунта
   $client_id ='b089e5e3-674d-485c-aad9-ea0bf5032ae5';
    $client_secret='C29sZbMFRQqXoWxDjyhFhefonY2d9TF0U0vgT91ZaF0sHez4dIAjsWuaGUzKluUT';
    $code = $taskList["refresh_token"];
    $redirect_uri='http://u904141w.beget.tech/';
    $link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса

    /** Соберем данные для запроса */
    $data = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => 'refresh_token',
        'refresh_token' => $code,
        'redirect_uri' => $redirect_uri,
    ];
    /**
     * Нам необходимо инициировать запрос к серверу.
     * Воспользуемся библиотекой cURL (поставляется в составе PHP).
     * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
     */
    $curl = curl_init(); //Сохраняем дескриптор сеанса cURL
    /** Устанавливаем необходимые опции для сеанса cURL  */
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
    $code = (int)$code;
    $errors = [
        400 => 'Bad request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not found',
        500 => 'Internal server error',
        502 => 'Bad gateway',
        503 => 'Service unavailable',
    ];

    try {
        /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
        if ($code < 200 || $code > 204) {
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
        }
    } catch (\Exception $e) {
        die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
    }

    /**
     * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
     * нам придётся перевести ответ в формат, понятный PHP
     */
    $file = 'oath.json';
// Открываем файл для получения существующего содержимого
    $current = file_get_contents($file);
// Добавляем нового человека в файл
    $current = $out;
// Пишем содержимое обратно в файл
    file_put_contents($file, $current);
    return $out;
}

function leads()
{
    $subdomain = 'itrec'; //Поддомен нужного аккаунта
    $link = 'https://' . $subdomain . '.amocrm.ru/api/v4/leads?limit=250&page=1&filter[pipeline_id]=3251611'; //Формируем URL для запроса
    /** Получаем access_token из вашего хранилища */
    $file = file_get_contents('oath.json');  // Открыть файл data.json
    $access_tokenjson = json_decode($file, TRUE);
    $access_token = $access_tokenjson['access_token'];
    /** Формируем заголовки */
    $headers = [
        'Authorization: Bearer ' . $access_token
    ];
    /**
     * Нам необходимо инициировать запрос к серверу.
     * Воспользуемся библиотекой cURL (поставляется в составе PHP).
     * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
     */
    $lids = array();
    $lid = "";
    $i = 1;
    do {
        if ($i == 7) {
            sleep(1);
            $i = 1;
        }
        $i++;
        $curl = curl_init(); //Сохраняем дескриптор сеанса cURL
        /** Устанавливаем необходимые опции для сеанса cURL  */
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
        $code = (int)$code;
        $errors = [
            400 => 'Bad request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not found',
            500 => 'Internal server error',
            502 => 'Bad gateway',
            503 => 'Service unavailable',
        ];
        try {
            /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
            if ($code < 200 || $code > 204) {
                throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
            }
        } catch (\Exception $e) {
           refresh_token();
            return leads();
            die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
        }

        if ($out !== "") {
            $lid = json_decode($out, true);
            $link = $lid["_links"]["next"] ["href"];
            $lid = $lid['_embedded']['leads'];
            foreach ($lid as $lead) {
                if ($lead['closed_at'] == null) $lids[$lead['id']] = $lead;
            }
        }
    } while ($out !== "");
    return $lids;
}

function contacts()
{
    $subdomain = 'itrec'; //Поддомен нужного аккаунта
    $link = 'https://' . $subdomain . '.amocrm.ru/api/v4/contacts?limit=250&page=1'; //Формируем URL для запроса
    /** Получаем access_token из вашего хранилища */
    $file = file_get_contents('oath.json');  // Открыть файл data.json
    $access_tokenjson = json_decode($file, TRUE);
    $access_token = $access_tokenjson['access_token'];
    /** Формируем заголовки */
    $headers = [
        'Authorization: Bearer ' . $access_token
    ];
    /**
     * Нам необходимо инициировать запрос к серверу.
     * Воспользуемся библиотекой cURL (поставляется в составе PHP).
     * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
     */
    $contacts = array();
    $contact = "";
    $i = 1;
    do {
        if ($i == 7) {
            sleep(1);
            $i = 1;
        }
        $i++;
        $curl = curl_init(); //Сохраняем дескриптор сеанса cURL
        /** Устанавливаем необходимые опции для сеанса cURL  */
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
        $response = json_decode($out, true);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
        $code = (int)$code;
        $errors = [
            400 => 'Bad request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not found',
            500 => 'Internal server error',
            502 => 'Bad gateway',
            503 => 'Service unavailable',
        ];

        try {
            /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
            if ($code < 200 || $code > 204) {
                throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
            }
        } catch (\Exception $e) {
            refresh_token();
            return contacts();
            die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
        }
        if ($out !== "") {
            $contact = json_decode($out, true);
            $link = $contact["_links"]["next"] ["href"];
            $contact = $contact['_embedded']['contacts'];
            foreach ($contact as $con) {
                $contacts[$con['id']] = $con;
            }
        }
    } while ($out !== "");
    return $contacts;
}

function users()
{
    $subdomain = 'itrec'; //Поддомен нужного аккаунта
    $link = 'https://' . $subdomain . '.amocrm.ru/api/v4/users'; //Формируем URL для запроса
    /** Получаем access_token из вашего хранилища */
    $file = file_get_contents('oath.json');  // Открыть файл data.json
    $access_tokenjson = json_decode($file, TRUE);
    $access_token = $access_tokenjson['access_token'];
    /** Формируем заголовки */
    $headers = [
        'Authorization: Bearer ' . $access_token
    ];
    /**
     * Нам необходимо инициировать запрос к серверу.
     * Воспользуемся библиотекой cURL (поставляется в составе PHP).
     * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
     */
    $users = array();
    $user = "";
    $curl = curl_init(); //Сохраняем дескриптор сеанса cURL
    /** Устанавливаем необходимые опции для сеанса cURL  */
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
    $response = json_decode($out, true);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
    $code = (int)$code;
    $errors = [
        400 => 'Bad request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not found',
        500 => 'Internal server error',
        502 => 'Bad gateway',
        503 => 'Service unavailable',
    ];

    try {
        /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
        if ($code < 200 || $code > 204) {
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
        }
    } catch (\Exception $e) {
        die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
    }

    $user = json_decode($out, true);
    $user = $user['_embedded']['users'];
    foreach ($user as $u) {
        $users[$u['id']] = $u;
    }

    return $users;
}

function bdlead($idlead){
    require_once 'configbd.php';
    Global $res_user;
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
        // выполняем операции с базой данных
        $query ="SELECT * FROM itrec where idlead= $idlead and idresponsible= $res_user ORDER BY data DESC";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $res = array();
        while ($row = $result->fetch_row()) {
            $res[] = $row;
        }
        // закрываем подключение
        mysqli_close($link);
        return $res;
}

function bdcontact($contact){
    require_once 'configbd.php';
    Global $res_user;
    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    // выполняем операции с базой данных
    $query ="SELECT * FROM itrec where idcontact= $contact and idresponsible= $res_user ORDER BY data DESC";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    $res = array();
    while ($row = $result->fetch_row()) {
        $res[] = $row;
    }
    // закрываем подключение
    mysqli_close($link);
    return $res;
}