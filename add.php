<html>
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>
<div class="container">
    <ul class="nav nav-tabs ">
        <li class="nav-item">
            <a class="nav-link " href="index.php?user=<?=$res_user?>">Вакансия</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="">Добавить нового кандидата</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">Аналитика</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?name=kandidat&user=<?=$res_user?>">Кандидат</a>
        </li>
    </ul>
    <!--таблица реквизитов-->
    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col">
                <span>Фамилия *</span>
                <input class="form-control surname" type="text" placeholder="">
                <span>Имя *</span>
                <input class="form-control name" type="text" placeholder="">
                <span>Отчество</span>
                <input class="form-control patronymic" type="text" placeholder="">
            </div>
            <div class="col">
                <span>Телефон</span>
                <input class="form-control tel" type="text" placeholder="">
                <span>E-mail</span>
                <input class="form-control email" type="text" placeholder="example@mail.ru">
                <span>*обязательное поле для заполнения при проверке на дубли</span><br>
                <button type="button" class="btn btn-warning doubles">Проверить на дубли</button>
                <div class="alert alertdoubles fade" role="alert">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span>Тип контакта</span>
                <select class="custom-select typecontact">
                    <option selected value="378849">Кандидат</option>
                    <option value="378851">Клиент</option>
                    <option value="378853">Партнер</option>
                </select>
                <span>HeadHunter</span>
                <input class="form-control headhunter" type="text" placeholder="ссылка">
                <span>Linkedin</span>
                <input class="form-control linkedin" type="text" placeholder="ссылка">
                <span>Город</span>
                <input class="form-control sity" type="text" placeholder="">
                <br>
                <span>Роль</span>
                <input class="form-control role" type="text" placeholder="">
                <span>Модуль</span>
                <input class="form-control module" type="text" placeholder="">
                <span>Задачи</span>
                <input class="form-control tasks" type="text" placeholder="">
                <span>Фин. ожидание</span>
                <input class="form-control fin" type="text" placeholder="">
                <span>Опыт в отрасли</span>
                <input class="form-control experienceindustry" type="text" placeholder="">
                <span>Опыт в роли</span>
                <input class="form-control experiencerole" type="text" placeholder="">
                <span>Полные проекты</span>
                <input class="form-control projects" type="text" placeholder="">
                <span>Опыт интеграции</span>
                <input class="form-control experienceintegration" type="text" placeholder="">
                <span>Проектные решения</span>
                <input class="form-control design" type="text" placeholder="">
                <span>Версии системы</span>
                <input class="form-control versions" type="text" placeholder="">
            </div>
            <div class="col">
                <span>Ответственный</span>
                <select class="custom-select users">
                    <? foreach ($users as $user){
                        echo '<option value="'.$user['id'].'">'.$user['name'].'</option>';
                    }
                    ?>
                </select>
                <span>Доступен</span>
                <input type="date" class="form-control data" id="date" name="date" placeholder="Дата">
                <span>Статус</span>
                <select class="custom-select status">
                    <option selected value="В поиске">В поиске</option>
                    <option value="Пассивный поиск">Пассивный поиск</option>
                    <option value="Не рассматривает">Не рассматривает</option>
                </select>
                <span>Должность</span>
                <input class="form-control position" type="text" placeholder="">
                <br>
                <span>Тип вакансии</span>
                <select class="custom-select vacancy">
                    <option selected value="378355">Фриланс</option>
                    <option value="378357">Подработка</option>
                    <option value="378351">Штат консалтинга</option>
                    <option value="378353">Штат инхаус</option>
                </select>
                <span>Формат работы</span>
                <select class="custom-select formword">
                    <option selected value="378381">Онсайт</option>
                    <option value="378383">Удаленно</option>
                    <option value="378385">Part Time</option>
                    <option value="378387">Full Time</option>
                </select>
                <span>Локация</span>
                <select class="custom-select location">
                    <option selected value="Москва">Москва</option>
                    <option value="Сочи">Сочи</option>
                </select>
                <span>Командировки</span>
                <select class="custom-select trips">
                    <option selected value="Готов">Готов</option>
                    <option value="Редкие командировки">Редкие командировки</option>
                    <option value="Нет">Нет</option>
                </select>
                <span>Грейд</span>
                <select class="custom-select grade">
                    <option selected value="378447">К1</option>
                    <option value="378445">К2</option>
                    <option value="378443">К3</option>
                    <option value="378441">К4</option>
                    <option value="378439">К5</option>
                </select>
                <span>Знание модулей</span>
                <input class="form-control modules" type="text" placeholder="">

                <span>Знания процессов</span>
                <input class="form-control processes" type="text" placeholder="">

                <span>Английский</span>
                <select class="custom-select english">
                    <option selected value="Свободный">Свободный</option>
                    <option value="Средний">Средний</option>
                    <option value="Базовый">Базовый</option>
                </select>
                <span>Наличие ИП</span>
                <select class="custom-select availabilityIP">
                    <option selected value="Есть">Есть</option>
                    <option value="В процессе открытия">В процессе открытия</option>
                    <option value="Нет">Нет</option>
                </select>
            </div>
        </div>
        <span>Навыки</span>
        <textarea class="form-control tags" type="text" placeholder="Ввод тегов начинать с #, разделяя запятыми" rows="3"></textarea>
        <span>Резюме</span>
        <textarea class="form-control summary" type="text" rows="3"></textarea>
        <div class="alert alertsave fade" role="alert"></div>
        <button type="button" class="btn btn-success save" style="margin-top: 10px; float: right ">Сохранить</button>
    </div>
</div>
<div class="print">

</div>
</body>
</html>
<script>
    $( document ).ready(function() {
        var contacts = <?php echo json_encode($contacts) ?>;
        $(".doubles").click(function () {
            var b=true;
            var surname =  $(".surname").val();
            if (surname==''){
                b=false;
                $(".surname").removeClass('is-valid');
                $(".surname").addClass('is-invalid');
            }else{
                $(".surname").removeClass('is-invalid');
                $(".surname").addClass('is-valid');
            }
            var name =  $(".name").val();
            if (name==''){
                b=false;
                $(".name").removeClass('is-valid');
                $(".name").addClass('is-invalid');
            }else{
                $(".name").removeClass('is-invalid');
                $(".name").addClass('is-valid');
            }
            var tel =  $(".tel").val();
            var email =  $(".email").val();
            if (b){
                for (let contact in contacts) {
                    if  (((surname+' '+name).toUpperCase()==contacts[contact]['name'].toUpperCase())||((name.toUpperCase() == contacts[contact]['first_name'].toUpperCase()) && (surname.toUpperCase() == contacts[contact]['last_name'].toUpperCase())))
                    {
                        $(".alertdoubles").removeClass('alert-success');
                        $(".alertdoubles").addClass('alert-danger');
                        $(".alertdoubles").removeClass('fade');
                        $(".alertdoubles").text('Данный кандидат уже внесен в базу amoCRM');
                        b=false;
                    }

                }
                if (b){
                    $(".alertdoubles").removeClass('alert-danger');
                    $(".alertdoubles").addClass('alert-success');
                    $(".alertdoubles").removeClass('fade');
                    $(".alertdoubles").text('Дубликат не найден');
                }
            }
        });

        $(".save").click(function () {
            var b=true;
            var surname =  $(".surname").val();
            var name =  $(".name").val();
            var patronymic =  $(".patronymic").val();
            var tel =  $(".tel").val();
            var email =  $(".email").val();
            var typecontact =  $(".typecontact").val();
            var headhunter =  $(".headhunter").val();
            var linkedin =  $(".linkedin").val();
            var sity =  $(".sity").val();
            var role =  $(".role").val();
            var module =  $(".module").val();
            var tasks =  $(".tasks").val();
            var fin =  $(".fin").val();
            var experienceindustry =  $(".experienceindustry").val();
            var experiencerole =  $(".experiencerole").val();
            var projects =  $(".projects").val();
            var experienceintegration =  $(".experienceintegration").val();
            var design =  $(".design").val();
            var versions =  $(".versions").val();
            var data =  $(".data").val();
            var status =  $(".status").val();
            var position =  $(".position").val();
            var vacancy =  $(".vacancy").val();
            var formword =  $(".formword").val();
            var location =  $(".location").val();
            var trips =  $(".trips").val();
            var grade =  $(".grade").val();
            var modules =  $(".modules").val();
            var processes =  $(".processes").val();
            var english =  $(".english").val();
            var availabilityIP =  $(".availabilityIP").val();
            var tags =  $(".tags").val();
            var rezume =  $(".rezume").val();
            var users = $(".users").val();
            var summary=$(".summary").val();
            if (surname==''){
                b=false;
                $(".surname").removeClass('is-valid');
                $(".surname").addClass('is-invalid');
            }else{
                $(".surname").removeClass('is-invalid');
                $(".surname").addClass('is-valid');
            }
            if (name==''){
                b=false;
                $(".name").removeClass('is-valid');
                $(".name").addClass('is-invalid');
            }else{
                $(".name").removeClass('is-invalid');
                $(".name").addClass('is-valid');
            }
            if (b) {
                for (let contact in contacts) {
                    if  (((surname+' '+name).toUpperCase()==contacts[contact]['name'].toUpperCase())||((name.toUpperCase() == contacts[contact]['first_name'].toUpperCase()) && (surname.toUpperCase() == contacts[contact]['last_name'].toUpperCase())))
                    {
                        b = false;
                        $(".alertsave").removeClass('alert-success');
                        $(".alertsave").addClass('alert-danger');
                        $(".alertsave").removeClass('fade');
                        $(".alertsave").text('Данный кандидат уже внесен в базу amoCRM');
                    }
                };
                if (b) {
                    $(".alertsave").removeClass('alert-danger');
                    $(".alertsave").addClass('alert-success');
                    $(".alertsave").removeClass('fade');

                    $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        data: {'surname': surname, 'name': name, 'tel': tel, 'email': email,'patronymic':patronymic,'typecontact':typecontact,
                        'headhunter':headhunter,'linkedin':linkedin,'sity':sity,'role':role,'module':module,'tasks':tasks,'fin':fin,
                            'experienceindustry':experienceindustry,'experiencerole':experiencerole,'projects':projects,
                        'experienceintegration':experienceintegration,'design':design,'versions':versions,'data':data,
                        'status':status,'position':position,'vacancy':vacancy,'formword':formword,'location':location,
                        'trips':trips,'grade':grade,'modules':modules,'processes':processes,'english':english,
                        'availabilityIP':availabilityIP,'tags':tags,'rezume':rezume,'users':users,'summary':summary},
                        success: function (data) {
                           // $(".alertsave").text(data);
                            $(".alertsave").text('Данный кандидат добавлен №'+data+'в базу amoCRM');
                        },
                        failure: function (errMsg) {
                            alert(errMsg);
                        },
                    })
                }
            }else{
                $(".alertsave").removeClass('alert-success');
                $(".alertsave").addClass('alert-danger');
                $(".alertsave").removeClass('fade');
                $(".alertsave").text('Обязательные поля не заполнены');
            }
        });
    });
</script>