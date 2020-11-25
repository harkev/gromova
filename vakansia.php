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
<header>
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="">Вакансия</a>
            </li>
            <!--<li class="nav-item">-->
            <!--    <a class="nav-link" href="index.php?name=add&user=<?=$res_user?>">Добавить нового кандидата</a>-->
            <!--</li>-->
            <!--<li class="nav-item">-->
            <!--    <a class="nav-link" href="">Аналитика</a>-->
            <!--</li>-->
            <li class="nav-item">
                <a class="nav-link" href="index.php?name=kandidat&user=<?=$res_user?>">Кандидат</a>
            </li>
        </ul>
    </div>
</header>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <span>Вакансия</span>
            <select class="custom-select vakansia">
                <?
                $onelead = current($leads);
                $idlead=$onelead['id'];
                $price=$onelead['price'];
                $tags=$onelead['_embedded']['tags'][0]['name'];
                $data=$onelead['created_at'];
                foreach ($leads as $lead){
                    if($paramid==$lead['id']){
                        $idlead=$lead['id'];
                        $price=$lead['price'];
                        $tags=$lead['_embedded']['tags'][0]['name'];
                        $data=$lead['created_at'];
                        echo '<option value="'.$lead['id'].'" selected>'.$lead['name'].'</option>';
                    }else{
                    echo '<option value="'.$lead['id'].'">'.$lead['name'].'</option>';
                    }
                }
                ?>
            </select>
            <span>Теги</span>
            <input class="form-control tags" type="text" placeholder="<?=$tags;?>" readonly="">
        </div>
        <div class="col">
            <span>Дата обратной связи</span>
            <input class="form-control data" type="text" placeholder=<?=date("d.m.Y", $data);?> readonly="">
            <span>Бюджет</span>
            <input class="form-control price" type="text" placeholder=<?=$price;?> readonly="">
        </div>
    </div>
    <div class="row">
        <div class="col">
            Добавить кандидата
            <select class="custom-select kandidat">
                <?
                foreach ($contacts as $contact) {
                    echo '<option value="'.$contact['id'].'">'.$contact['name'].'</option>';
                } 
                ?>
            </select>
        </div>
    </div>
    <table class="table table-hover" style="margin-top: 10px; table-layout: fixed">
        <thead>
        <tr>
            <th colspan="1">Дата</th>
            <th colspan="2">Кандидат</th>
            <th colspan="1"></th>
            <!--<th colspan="2">Этап вакансии</th>-->
            <th colspan="2">Этап кандидата</th>
            <th colspan="3">Комментарии</th>
            <th colspan="1">Ответственный</th>
            <th colspan="1"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $taskList=bdlead($idlead);
        foreach ($taskList as $row){
                    echo '<tr id="'.$row[2].'">';
                    echo  '<th colspan="1" >'.$row[10].'</th>';
                    echo  '<th colspan="2" >'.$row[3].'</th>';
                    echo "<td colspan='1'><button type='button' data-toggle='modal' data-target='#exampleModalCenter' class='btn btn-primary' href='#' data-class='success' data-id=".$row[2].">Изменить</button></td>";
                    // echo '<td colspan="2" style="word-break:break-all">'.$row[4].'</td>';
                    echo '<td colspan="2" style="word-break:break-all">'.$row[5].'</td>';
                    echo '<td colspan="3" style="word-break:break-all">'.$row[6].'</td>';
                    echo '<td colspan="1">'.$row[7].'</td>';
                    echo '<td colspan="1"><button type="button" id="'.$row[2].'" class="btn btn-danger">Удалить</button></td>';
                    echo '</tr>';
                }
        ?>
        </tbody>
    </table>
    <button type="button" class="btn btn-primary open" style="margin-top: 10px; margin-left: 10px; float: right">Открыть окно в amocrm</button>
    <button type="button" class="btn btn-success add" style="margin-top: 10px; float: right">Сохранить</button>
    <!--   Блок с модальным окном -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Редактирование данные по кандидату</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container" style="" id="target">
                        <!--окно выпадающее-->
                        <div class="row">
                            <div class="col">
                                <span>Кандидат</span>
                                <input class="form-control mName" type="text" placeholder="NAME" readonly="">
                                <!--<span>Этап вакансии</span>-->
                                <!--<select class="custom-select mStag">-->
                                <!--    <option  value="Неразобранное (лид)">Неразобранное (лид)</option>-->
                                <!--    <option value="Первичный контракт">Первичный контракт</option>-->
                                <!--    <option  value="Вакансии в очереди">Вакансии в очереди</option>-->
                                <!--    <option value="Подбор кандидатов">Подбор кандидатов</option>-->
                                <!--    <option  value="Обратная связь по резюме">Обратная связь по резюме</option>-->
                                <!--    <option value="Интервью">Интервью</option>-->
                                <!--    <option  value="Согласование и оффер">Согласование и оффер</option>-->
                                <!--    <option value="Онбоардинг">Онбоардинг</option>-->
                                <!--    <option  value="Оплата">Оплата</option>-->
                                <!--    <option value="Успешно реализовано">Успешно реализовано</option>-->
                                <!--    <option  value="Закрыто и не реализовано">Закрыто и не реализовано</option>-->
                                <!--    <option value="Пропала потребность">Пропала потребность</option>-->
                                <!--    <option  value="Не устроили условия">Не устроили условия</option>-->
                                <!--    <option value="Выбрали других">Выбрали других</option>-->
                                <!--    <option value="Неизвестно">Неизвестно</option>-->
                                <!--</select>-->
                            </div>
                            <div class="col">
                                <span>Ответственный</span>
                                <input class="form-control mUser" type="text" placeholder="из amoCRM" readonly="">
                                <span>Этап кандидата</span>
                                <select class="custom-select mStagk">
                                    <option  value="Новый кандидат">Новый кандидат</option>
                                    <option value="Обновление статуса">Обновление статуса</option>
                                    <option  value="Сорсинг">Сорсинг</option>
                                    <option value="Интервью с рекрутером">Интервью с рекрутером</option>
                                    <option  value="Представлен на вакансию">Представлен на вакансию</option>
                                    <option value="Трудоустроен на вакансию">Трудоустроен на вакансию</option>
                                    <option  value="Отклонен клиентом">Отклонен клиентом</option>
                                    <option value="Отклонен рекрутером">Отклонен рекрутером</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                                <span>Комментарий</span>
                                <textarea rows="5" class="form-control mComment" type="text" placeholder="текст комментария"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary savecomment" data-dismiss="modal">Сохранить изменения</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="print">
</div>
</body>
</html>
<script>
    var leads = <?php echo json_encode($leads) ?>;
    var contacts = <?php echo json_encode($contacts) ?>;
    var users = <?php echo json_encode($users) ?>;
    var taskList = <?php echo json_encode($taskList) ?>;
    var res_user = <?=$res_user?>;
    $(document).ready(function(){
        var select = $(".vakansia").val();
        var data=leads[select]['created_at'];
                var  DataJS= new Date(data*1000);
                var day=DataJS.getDate();
                if (day<10) day="0"+day;
                var month=DataJS.getMonth()+1;
                if (month<10) month="0"+month;
                data=day+'.'+month+'.'+DataJS.getFullYear();
                $(".price").attr({"placeholder":leads[select]['price']});
                $(".tags").attr({"placeholder":leads[select]['_embedded']['tags'][0]['name']});
                $(".data").attr({"placeholder": data});
        $('tbody> tr').remove();
        var str="";
        $.ajax({
            type: "POST",
            url: "vakansiabdall.php",
            data: {'id':select,'res_user':res_user},
            success: function (data) {
                data = JSON.parse(data);
                if (data.length > 0) {
                    data.forEach(function (row) {
                        str += '<tr id="' + row[2] + '">';
                        str += '<th colspan="1">' + row[10] + '</th>';
                        str += '<th colspan="2">' + row[3] + '</th>';
                        str += "<td colspan='1'><button type='button' data-toggle='modal' data-target='#exampleModalCenter' class='btn btn-primary' href='#' data-class='success' data-id=" + row[2] + ">Изменить</button></td>";
                        // str += '<td colspan="2" style="word-break:break-all">' + row[4] + '</td>';
                        str += '<td colspan="2" style="word-break:break-all">' + row[5]+ '</td>';
                        str += '<td colspan="3" style="word-break:break-all">' + row[6]+ '</td>';
                        str += '<td colspan="1" style="word-break:break-all">' + row[7] + '</td>';
                        str += '<td colspan="1"><button type="button" id="' + row[2] + '" class="btn btn-danger">Удалить</button></td>';
                        str += '</tr>';
                    })
                }
                $('tbody').html(str);
            }
        });
    });
    
    $(document).on('change', ".vakansia" , function() {
        var select = $(this).val();
                var data=leads[select]['created_at'];
                var  DataJS= new Date(data*1000);
                var day=DataJS.getDate();
                if (day<10) day="0"+day;
                var month=DataJS.getMonth()+1;
                if (month<10) month="0"+month;
                data=day+'.'+month+'.'+DataJS.getFullYear();
                $(".price").attr({"placeholder":leads[select]['price']});
                $(".tags").attr({"placeholder":leads[select]['_embedded']['tags'][0]['name']});
                $(".data").attr({"placeholder": data});
        $('tbody> tr').remove();
        var str="";
        $.ajax({
            type: "POST",
            url: "vakansiabdall.php",
            data: {'id':select,'res_user':res_user},
            success: function (data) {
                data = JSON.parse(data);
                if (data.length > 0) {
                    data.forEach(function (row) {
                        str += '<tr id="' + row[2] + '">';
                        str += '<th colspan="1">' + row[10] + '</th>';
                        str += '<th colspan="2">' + row[3] + '</th>';
                        str += "<td colspan='1'><button type='button' data-toggle='modal' data-target='#exampleModalCenter' class='btn btn-primary' href='#' data-class='success' data-id=" + row[2] + ">Изменить</button></td>";
                        // str += '<td colspan="2" style="word-break:break-all">' + row[4] + '</td>';
                        str += '<td colspan="2" style="word-break:break-all">' + row[5]+ '</td>';
                        str += '<td colspan="3" style="word-break:break-all">' + row[6]+ '</td>';
                        str += '<td colspan="1" style="word-break:break-all">' + row[7] + '</td>';
                        str += '<td colspan="1"><button type="button" id="' + row[2] + '" class="btn btn-danger">Удалить</button></td>';
                        str += '</tr>';
                    })
                }
                $('tbody').html(str);
            }
        });
    });

    $(document).on('click', ".btn-danger" , function() {
        $('tr[id='+this.id+']').remove();
    });

    $(document).on('change', ".kandidat" , function() {
        var id = $(this).val();
        var resid = contacts[id]['responsible_user_id'];
        var b = true;
        $('table>tbody tr').each(function () {
            if (id == $(this).attr("id")) b = false;
        });
        if (b) {
            dat=new Date();
            dat=dat.getFullYear()+'-'+(dat.getMonth()+1)+'-'+dat.getDate();
            $('.table > tbody:last-child').prepend('<tr id="' + contacts[id]['id'] + '"><th colspan="1">' + dat + '</th>\n' + '<th colspan="2">' + contacts[id]['name'] + '</th>\n' +
                "<td colspan='1'><button type='button' data-toggle='modal' data-target='#exampleModalCenter' class='btn btn-primary' href='#' data-class='success' data-id=" + contacts[id]['id'] + ">Изменить</button></td>" + '\n' +
                // '                <td colspan="2">Приглашение</td>\n' +
                '                <td colspan="2">Новый кандидат</td>\n' +
                '                <td colspan="3"></td>\n' +
                '                <td colspan="1">'+ users[resid]['name']+'</td>\n' +
                '                <td colspan="1"><button type="button" id="' + contacts[id]['id'] + '" class="btn btn-danger">Удалить</button></td></tr>');
        }
    });

    $(document).on('click', ".add" , function() {
        var name =($("option[value='"+$('.vakansia').val()+"']").text());
        var data = '{"id":"' + $('.vakansia').val() + '","name":"'+convChar(name) + '","res_user":"' + res_user +'","values":[';
        $('table>tbody tr').each(function (indx, element) {
            var idcontact = $(this).attr("id");
            var date = $(this).find("th:eq(0)").text();
            var name = $(this).find("th:eq(1)").text();
            var stag = $(this).find("td:eq(1)").text();
            var stagk = $(this).find("td:eq(1)").text();
            var comment = $(this).find("td:eq(2)").html();
            var responsible = $(this).find("td:eq(3)").text();
            data += '{"idcontact":"' + idcontact + '","name":"' + convChar(name) + '","stag":"' + convChar(stag) + '","stagk":"' + convChar(stagk) +'","comment":"' + convChar(comment) + '","responsible":"' + convChar(responsible) +'","date":"' + date + '","res_user":"' + res_user+  '"},'
        });
        if ((data[data.length-1])==',')
            data=data.slice(0,data.length-1)+']}';
        else data+=']}';
         //alert(data);
         var person = JSON.parse(data);
        // alert(person);
        $.ajax({
            type: "POST",
            url: "vakansiabdupdate.php",
            data: person,
            success: function (data) {
                $('.open').before(function () {
                    return '    <div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                        '        Изменения сохранены\n' +
                        '        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                        '            <span aria-hidden="true">&times;</span>\n' +
                        '        </button>\n' +
                        '    </div>';
                });
            },
            failure: function (errMsg) {
                alert(errMsg);
            },
        });
    });
    //открываем ссылку в новом окне
    $(document).on('click', ".open" , function() {
        window.open('https://itrec.amocrm.ru/leads/detail/'+$(".vakansia").val());
    });
    // запоминаем данные откуда запустилось модальное окно
    $('#exampleModalCenter').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        idblock = button.data('id');
        name = $('tr#'+idblock+' >th').text();
        username = $('tr#'+idblock+'>td:eq(3)').text();
        comment= $('tr#'+idblock+'>td:eq(2)').html();
         stagk=$('tr#'+idblock+'>td:eq(1)').text();
        //stag=$('tr#'+idblock+'>td:eq(1)').text();
        $('.mName').val(name);
        $('.mName').attr('id',idblock);
        $('.mUser').val(username);
        $('.mComment').val(comment.replace(/<br>/g,'\r\n'));
        // $('.mStag').val(stag);
        $('.mStagk').val(stagk);
    });

    $(document).on('click', ".savecomment" , function() {
        var idblock =$('.mName').attr('id');
        //var mStag = $('.mStag').val();
         var mStagk = $('.mStagk').val();
        var mComment=$('.mComment').val();
        $('tr#'+idblock+" td:eq(1)").attr("style","word-break:break-all");
        // $('tr#'+idblock+" td:eq(1)").text(mStag);
        // $('tr#'+idblock+" td:eq(2)").attr("style","word-break:break-all");
        $('tr#'+idblock+" td:eq(1)").text(mStagk);
        $('tr#'+idblock+" td:eq(2)").attr("style","word-break:break-all");
        $('tr#'+idblock+" td:eq(2)").html(mComment.replace(/\r?\n/g,'<br/>'));
    });

    $(".vakansia").select2({
    });
    $(".kandidat").select2({
    });
    function convChar(str) {
      str = str.replace(/&/g, "&amp;");
      str = str.replace(/>/g, "&gt;");
      str = str.replace(/</g, "&lt;");
      str = str.replace(/"/g, "&quot;");
      str = str.replace(/'/g, "&#039;");
        return str;
    }
</script>
