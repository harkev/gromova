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
                <a class="nav-link" href="index.php?user=<?=$res_user?>">Вакансия</a>
            </li>
            <!--<li class="nav-item">-->
            <!--    <a class="nav-link" href="index.php?name=add&user=<?//$res_user?>">Добавить нового кандидата</a>-->
            <!--</li>-->
            <!--<li class="nav-item">-->
            <!--    <a class="nav-link" href="">Аналитика</a>-->
            <!--</li>-->
            <li class="nav-item">
                <a class="nav-link active" href="">Кандидат</a>
            </li>
        </ul>
    </div>
</header>
<body>
    
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <span>Кандидат</span>
            <select class="custom-select kandidat">
                <?
                $b=true;
                foreach ($contacts as $cont){
                    if($paramid==$cont['id']){
                        $onelead=$cont;
                        $tag=$cont['tags']['name'];
                        if ($tag=='') $tag="Нет навыков";
                        $itrec=$cont['id'];
                        $id=$cont['id'];    
                        $b=false;
                        echo '<option value="'.$cont['id'].'" selected>'.$cont['name'].'</option>';
                    } else{
                        if ($b){
                            $onelead=$cont;
                            $tag=$cont['tags']['name'];
                            if ($tag=='') $tag="Нет навыков";
                            $itrec=$cont['id'];
                            $id=$cont['id'];    
                            $b=false;
                        }
                        echo '<option value="'.$cont['id'].'">'.$cont['name'].'</option>';
                    }
                }   
                ?>
            </select>
        </div>
        <div class="col">
            <span>Ответственный</span>
            <input class="form-control manager" type="text" placeholder="<?=$users[$onelead['responsible_user_id']]['name']?>" readonly="">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div class="d-flex flex-row">
                <div class="p-2">Навыки:</div>
                <div class="p-2 tag"><?=$tag?></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            Добавить кандидата в вакансию
            <select class="custom-select vakansia">
                <?
                foreach ($leads as $lead) {
                    echo '<option value="'.$lead['id'].'">'.$lead['name'].'</option>';
                }
                ?>
            </select>
        <div class="col">
    </div>
    <table class="table table-hover" style="margin-top: 10px; table-layout: fixed">
        <thead>
        <tr>
            <th colspan="1">Дата</th>
            <th colspan="1">Вакансия</th>
            <th colspan="1"></th>
            <!--<th colspan="2">Этап вакансии</th>-->
            <th colspan="2">Этап кандидата</th>
            <th colspan="3">Комментарии</th>
            <th colspan="2">Отзыв от клиента</th>
            <th colspan="1">Ответственный</th>
            <th colspan="1"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $taskList=bdcontact($id);
        foreach ($taskList as $row){
            echo '<tr id="'.$row[0].'">';
            echo  '<th colspan="1">'.$row[10].'</th>';
            echo  '<th colspan="1">'.$row[1].'</th>';
            echo "<td colspan='1'><button type='button' data-toggle='modal' data-target='#exampleModalCenter' class='btn btn-primary' href='#' data-class='success' data-id=".$row[0].">Изменить</button></td>";
            // echo '<td colspan="2" style="word-break:break-all">'.$row[4].'</td>';
            echo '<td colspan="2" style="word-break:break-all">'.$row[5].'</td>';
            echo '<td colspan="3" style="word-break:break-all">'.$row[6].'</td>';
            echo '<td colspan="2" style="word-break:break-all">'.$row[9].'</td>';
            echo '<td colspan="1">'.$row[7].'</td>';
            echo '<td colspan="1"><button type="button" id="'.$row[0].'" class="btn btn-danger">Удалить</button></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
    <button type="button" class="btn btn-primary open" style="margin-top: 10px; margin-left: 10px; float: right">Открыть окно в amocrm</button>
    <button type="button" class="btn btn-success add" style="margin-top: 10px; float: right ">Сохранить</button>

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
                                <span>Вакансия</span>
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
                        <div class="row">
                            <span>Отзыв от клиента</span>
                            <textarea rows="5" class="form-control mReview" type="text" placeholder="текст отзыва"></textarea>
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
<div>
</div>
</body>
</html>
<script>
    var leads = <?php echo json_encode($leads) ?>;
    var contacts = <?php echo json_encode($contacts) ?>;
    var users = <?php echo json_encode($users) ?>;
    var res_user = <?=$res_user?>;
    $(document).ready(function(){
        var select = $(".kandidat").val();
        var itrec=contacts[select]['id'];
                var  id=contacts[select]['id'];
                var resid =contacts[select]['responsible_user_id'];
                var  user=users[resid]['name'];
                try {
                    var tag = contacts[select]['tags'][0]['name'];
                }catch (e) {
                    tag="Нет навыков";
                }
                $(".itrec").attr({"placeholder":itrec});
                $(".id").attr({"placeholder":id});
                $(".manager").attr({"placeholder": user});
                $(".tag").text(tag);

        $('tbody> tr').remove();

        var str="";

        $.ajax({
            type: "POST",
            url: "kandidatbdall.php",
            data: {'id':select,'res_user':res_user},
            success: function (data) {
                data = JSON.parse(data);
                if (data.length > 0) {
                    data.forEach(function (row) {
                        str += '<tr id="' + row[0] + '">';
                         str += '<th colspan="1">' + row[10] + '</th>';
                        str += '<th colspan="1">' + row[1] + '</th>';
                        str += "<td colspan='1'><button type='button' data-toggle='modal' data-target='#exampleModalCenter' class='btn btn-primary' href='#' data-class='success' data-id=" + row[0] + ">Изменить</button></td>";
                        // str += '<td colspan="2" style="word-break:break-all">' + row[4] + '</td>';
                        str += '<td colspan="2" style="word-break:break-all">' + row[5] + '</td>';
                        str += '<td colspan="3" style="word-break:break-all">' + row[6] + '</td>';
                        str += '<td colspan="2" style="word-break:break-all">' + row[9] + '</td>';
                        str += '<td colspan="1" style="word-break:break-all">' + row[7] + '</td>';
                        str += '<td colspan="1"><button type="button" id="' + row[0] + '" class="btn btn-danger">Удалить</button></td>';
                        str += '</tr>';
                    })
                }
                $('tbody').html(str);
            }
        });
    });
    $(document).on('change', ".kandidat" , function() {
        var select = $(this).val();
                var itrec=contacts[select]['id'];
                var  id=contacts[select]['id'];
                var resid =contacts[select]['responsible_user_id'];
                var  user=users[resid]['name'];
                try {
                    var tag = contacts[select]['tags'][0]['name'];
                }catch (e) {
                    tag="Нет навыков";
                }
                $(".itrec").attr({"placeholder":itrec});
                $(".id").attr({"placeholder":id});
                $(".manager").attr({"placeholder": user});
                $(".tag").text(tag);

        $('tbody> tr').remove();

        var str="";

        $.ajax({
            type: "POST",
            url: "kandidatbdall.php",
            data: {'id':select,'res_user':res_user},
            success: function (data) {
                data = JSON.parse(data);
                if (data.length > 0) {
                    data.forEach(function (row) {
                        str += '<tr id="' + row[0] + '">';
                         str += '<th colspan="1">' + row[10] + '</th>';
                        str += '<th colspan="1">' + row[1] + '</th>';
                        str += "<td colspan='1'><button type='button' data-toggle='modal' data-target='#exampleModalCenter' class='btn btn-primary' href='#' data-class='success' data-id=" + row[0] + ">Изменить</button></td>";
                        // str += '<td colspan="2" style="word-break:break-all">' + row[4] + '</td>';
                        str += '<td colspan="2" style="word-break:break-all">' + row[5] + '</td>';
                        str += '<td colspan="3" style="word-break:break-all">' + row[6] + '</td>';
                        str += '<td colspan="2" style="word-break:break-all">' + row[9] + '</td>';
                        str += '<td colspan="1" style="word-break:break-all">' + row[7] + '</td>';
                        str += '<td colspan="1"><button type="button" id="' + row[0] + '" class="btn btn-danger">Удалить</button></td>';
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

    $(document).on('change', ".vakansia" , function() {
        var id = $(this).val();
        var idc= $('.kandidat').val();
        var resid = contacts[idc]['responsible_user_id'];
        var b = true;
        $('table>tbody tr').each(function () {
            if (id == $(this).attr("id")) b = false;
        });
        if (b) {
            dat=new Date();
            dat=dat.getFullYear()+'-'+(dat.getMonth()+1)+'-'+dat.getDate();
            $('.table > tbody:last-child').append('<tr id="' + leads[id]['id'] + '"><th colspan="1">' + dat + '</th>\n' +'<th colspan="1">' + leads[id]['name'] + '</th>\n' +
                "<td colspan='1'><button type='button' data-toggle='modal' data-target='#exampleModalCenter' class='btn btn-primary' href='#' data-class='success' data-id=" + leads[id]['id'] + ">Изменить</button></td>" + '\n' +
                // '                <td colspan="2">Приглашение</td>\n' +
                '                <td colspan="2">Новый кандидат</td>\n' +
                '                <td colspan="3"></td>\n' +
                '                <td colspan="2">Нет отзыва</td>\n' +
                '                <td colspan="1">'+users[resid]['name']+'</td>\n' +
                '                <td colspan="1"><button type="button" id="' + leads[id]['id'] + '" class="btn btn-danger">Удалить</button></td></tr>');
        }
    });

    $(document).on('click', ".add" , function() {
        var name = ($("option[value='" + $('.kandidat').val() + "']").text());
        var data = '{"id":"' + $('.kandidat').val() + '","name":"' + convChar(name) + '","res_user":"' + res_user+ '","values":[';
        $('table>tbody tr').each(function (indx, element) {
            var idcontact = $(this).attr("id");
            var date = $(this).find("th:eq(0)").text();
            var name = $(this).find("th:eq(1)").text();
            var stag = $(this).find("td:eq(1)").text();
            var stagk = $(this).find("td:eq(1)").text();
            var comment = $(this).find("td:eq(2)").html();
            var review = $(this).find("td:eq(3)").html();
            var responsible = $(this).find("td:eq(4)").text();
            data += '{"idcontact":"' + idcontact + '","name":"' + convChar(name) + '","stag":"' + convChar(stag) + '","stagk":"' + convChar(stagk) +'","comment":"' + convChar(comment) +'","review":"' + convChar(review) + '","responsible":"' + convChar(responsible) +'","date":"' + date + '","res_user":"' + res_user+ '"},'
        });
        if ((data[data.length-1])==',')
            data=data.slice(0,data.length-1)+']}';
        else data+=']}';
         //alert(data);
         var person = JSON.parse(data);
        $.ajax({
            type: "POST",
            url: "kandidatbdupdate.php",
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

    // запоминаем данные откуда запустилось модальное окно
    $('#exampleModalCenter').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        idblock = button.data('id');
        name = $('tr#'+idblock+' >th').text();
        username = $('tr#'+idblock+'>td:eq(4)').text();
        review= $('tr#'+idblock+'>td:eq(3)').html();
       // alert($('tr#'+idblock+'>td:eq(4)').text());
        comment= $('tr#'+idblock+'>td:eq(2)').html();
        stagk=$('tr#'+idblock+'>td:eq(1)').text();
        // stag=$('tr#'+idblock+'>td:eq(1)').text();
        $('.mName').val(name);
        $('.mName').attr('id',idblock);
        $('.mUser').val(username);
        $('.mReview').val(review.replace(/<br>/g,'\r\n'));
        $('.mComment').val(comment.replace(/<br>/g,'\r\n'));
        // $('.mStag').val(stag);
        $('.mStagk').val(stagk);
    });

    $(document).on('click', ".savecomment" , function() {
        var idblock =$('.mName').attr('id');
        // var mStag = $('.mStag').val();
        var mStagk = $('.mStagk').val();
        var mComment=$('.mComment').val();
        var mReview=$('.mReview').val();
        // $('tr#'+idblock+" td:eq(1)").attr("style","word-break:break-all");
        // $('tr#'+idblock+" td:eq(1)").text(mStag);
        $('tr#'+idblock+" td:eq(1)").attr("style","word-break:break-all");
        $('tr#'+idblock+" td:eq(1)").text(mStagk);
        $('tr#'+idblock+" td:eq(2)").attr("style","word-break:break-all");
        $('tr#'+idblock+" td:eq(2)").html(mComment.replace(/\r?\n/g,'<br/>'));
        $('tr#'+idblock+" td:eq(3)").attr("style","word-break:break-all");
        $('tr#'+idblock+" td:eq(3)").html(mReview.replace(/\r?\n/g,'<br/>'));
    });
        //открываем ссылку в новом окне
    $(document).on('click', ".open" , function() {
        window.open('https://itrec.amocrm.ru/contacts/detail/'+$(".kandidat").val());
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