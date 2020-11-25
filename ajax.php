<?php
/* Теперь подготовим данные, необходимые для запроса к серверу */
$contacts['add'] = array(
    array(
        'name' => $_POST['name'].' '.$_POST['surname'].' '.$_POST['patronymic'],
        'first_name'=>$_POST['name'],
        'last_name'=>$_POST['surname'],
        'responsible_user_id' => $_POST['users'],
        'created_by' => $_POST['users'],
        '_embedded' => array(
            'tags' => array(
                'name' => $_POST['tags'],
            )
        ),
        'custom_fields' => array(
            array(
                'id' => 228371,
                'values' => array(
                    array(
                        'value' => $_POST['tel'],
                        'enum' => 'WORK',
                    ),
                ),
            ),
            array(
                'id' => 228373,
                'values' => array(
                    array(
                        'value' => $_POST['email'],
                        'enum' => 'WORK',
                    ),
                ),
            ),
            array(
                'id' => 239359,
                'values' => array(
                    array(
                        'enum' => intval($_POST['typecontact']),
                    ),
                ),
            ),
            array(
                'id' => 239219,
                'values' => array(
                    array(
                        'value' => $_POST['headhunter'],
                    ),
                ),
            ),
            array(
                'id' => 239221,
                'values' => array(
                    array(
                        'value' => $_POST['linkedin'],
                    ),
                ),
            ),
            array(
                'id' => 239379,
                'values' => array(
                    array(
                        'value' => $_POST['sity'],
                    ),
                ),
            ),
            array(
                'id' => 239109,
                'values' => array(
                    array(
                        'value' => $_POST['role'],
                    ),
                ),
            ),
            array(
                'id' => 239111,
                'values' => array(
                    array(
                        'value' => $_POST['module'],
                    ),
                ),
            ),
            array(
                'id' => 239119,
                'values' => array(
                    array(
                        'value' => $_POST['tasks'],
                    ),
                ),
            ),
            array(
                'id' => 239123,
                'values' => array(
                    array(
                        'value' => $_POST['fin'],
                    ),
                ),
            ),
            array(
                'id' => 239193,
                'values' => array(
                    array(
                        'value' => $_POST['experienceindustry'],
                    ),
                ),
            ),
            array(
                'id' => 239195,
                'values' => array(
                    array(
                        'value' => $_POST['experiencerole'],
                    ),
                ),
            ),
            array(
                'id' => 239141,
                'values' => array(
                    array(
                        'value' => $_POST['projects'],
                    ),
                ),
            ),
            array(
                'id' => 239157,
                'values' => array(
                    array(
                        'value' => $_POST['experienceintegration'],
                    ),
                ),
            ),
            array(
                'id' => 239169,
                'values' => array(
                    array(
                        'value' => $_POST['design'],
                    ),
                ),
            ),
            array(
                'id' => 239173,
                'values' => array(
                    array(
                        'value' => $_POST['versions'],
                    ),
                ),
            ),
            array(
                'id' => 239105,
                'values' => array(
                    array(
                        'value' => $_POST['data'],
                    ),
                ),
            ),
            array(
                'id' => 239107,
                'values' => array(
                    array(
                        'value' => $_POST['status'],
                    ),
                ),
            ),
            array(
                'id' => 228369,
                'values' => array(
                    array(
                        'value' => $_POST['position'],
                    ),
                ),
            ),
            array(
                'id' => 239113,
                'values' => array(
                    array(
                        'enum' => intval( $_POST['vacancy']),
                    ),
                ),
            ),
            array(
                'id' => 239121,
                'values' => array(
                    array(
                        'enum' => intval($_POST['formword']),
                    ),
                ),
            ),
            array(
                'id' => 239125,
                'values' => array(
                    array(
                        'value' => $_POST['location'],
                    ),
                ),
            ),
            array(
                'id' => 239129,
                'values' => array(
                    array(
                        'value' => $_POST['trips'],
                    ),
                ),
            ),
            array(
                'id' => 239197,
                'values' => array(
                    array(
                        'enum' => intval($_POST['grade']),
                    ),
                ),
            ),
            array(
                'id' => 239143,
                'values' => array(
                    array(
                        'value' => $_POST['modules'],
                    ),
                ),
            ),
            array(
                'id' => 239145,
                'values' => array(
                    array(
                        'value' => $_POST['processes'],
                    ),
                ),
            ),
            array(
                'id' => 239187,
                'values' => array(
                    array(
                        'value' => $_POST['english'],
                    ),
                ),
            ),
            array(
                'id' => 239189,
                'values' => array(
                    array(
                        'value' => $_POST['availabilityIP'],
                    ),
                ),
            ),
            array(
                'id' => 281845,
                'values' => array(
                    array(
                        'value' => $_POST['summary'],
                    ),
                ),
            ),            
        ),
    ),
);
$subdomain = 'itrec'; #Наш аккаунт - поддомен
#Формируем ссылку для запроса
$link = 'https://' . $subdomain . '.amocrm.ru/api/v2/contacts';
$file = file_get_contents('oath.json');  // Открыть файл data.json
$access_tokenjson = json_decode($file,TRUE);
$access_token = $access_tokenjson['access_token'];
/** Формируем заголовки */
$headers = [
    'Authorization: Bearer ' . $access_token
];
/* Нам необходимо инициировать запрос к серверу. Воспользуемся библиотекой cURL (поставляется в составе PHP). Подробнее о
работе с этой
библиотекой Вы можете прочитать в мануале. */
$curl = curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
curl_setopt($curl, CURLOPT_URL, $link);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($contacts));
curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
$out = curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
/* Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
$code = (int) $code;
$errors = array(
    301 => 'Moved permanently',
    400 => 'Bad request',
    401 => 'Unauthorized',
    403 => 'Forbidden',
    404 => 'Not found',
    500 => 'Internal server error',
    502 => 'Bad gateway',
    503 => 'Service unavailable',
);
try
{
    #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
    if ($code != 200 && $code != 204) {
        throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
    }
} catch (Exception $E) {
    die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
}
/*
Данные получаем в формате JSON, поэтому, для получения читаемых данных,
нам придётся перевести ответ в формат, понятный PHP
 */
$Response = json_decode($out, true);
$Response = $Response['_embedded']['items'];
$output = 'ID добавленных контактов: ' . PHP_EOL;
foreach ($Response as $v) {
    if (is_array($v)) {
        $output .= $v['id'] . PHP_EOL;
        echo $v['id'];
    }
}
?>