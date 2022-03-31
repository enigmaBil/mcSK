$(document).ready(function () {
    $('#createassurance').click(function () {
        coche = $('#createassurance');
        if (coche.hasClass('fa-close')) {
            coche.removeClass('fa-close');
            coche.removeClass('fa');
            coche.addClass('glyphicon glyphicon-ok');
        } else {
            coche.removeClass('glyphicon glyphicon-ok');
            coche.addClass('fa fa-close');

        }
    });
    $('#sex').click(function () {
        coche = $('#sex');
        if (coche.hasClass('fa-close')) {
            coche.removeClass('fa-close');
            coche.removeClass('fa');
            coche.addClass('glyphicon glyphicon-ok');
        } else {
            coche.removeClass('glyphicon glyphicon-ok');
            coche.addClass('fa fa-close');

        }
    });
});

function edit(arra, id) {
    $('#tr' + id).addClass('MarkLigne');

    arra.forEach(function (item, index, array) {

        if (item == "assurance") {
            $("#assurance" + id).click(function () {
                coche = $("#assurance" + id).find(':first');;
                if (coche.hasClass('fa-close')) {
                    coche.removeClass('fa-close');
                    coche.removeClass('fa');
                    coche.addClass('glyphicon glyphicon-ok');
                }
                else {
                    coche.removeClass('glyphicon glyphicon-ok');
                    coche.addClass('fa fa-close');

                }

            });
        }
        else if (item == "chosen_discipline") {
            $("#" + item + "" + id).attr('disabled', false);

        }
        else {
            $("#" + item + "" + id).attr('contenteditable', true);
        }
    });


    toastada.info('vous pouvez modifier la ligne ');
    toastada.info("n'oubliez pas de valider");

}
function modal(name, id, arra) {
    $(document).ready(function () {
        $("#" + name + "").modal('show');
    });
    $.ajax({
        type: 'GET',
        url: '/scolarity/student/' + id,
        success: function (data) {

            data = data["Student"]
            $("#" + name + "-error").text(id);
            $("#" + name + "-error").hide();
            arra.forEach(function (item, index, array) {
                $("input[name=" + item + "]").val(data["" + item]);
                console.log(item + "")
                if (item == "sex") {
                    coche = $("#sex");
                    if (data["" + item] == "M") {
                        coche.addClass('fa fa-close');
                    } else {
                        coche.addClass('glyphicon glyphicon-ok');
                    }

                }
            });




            $(document).ready(function () {
                //   $('#editModuleModal').modal('show');
                $("#sex").click(function () {
                    coche = $("#Estatus").find(':first');;
                    if (coche.hasClass('fa-eye')) {
                        coche.removeClass('fa-eye');
                        coche.addClass('fa-eye-slash');
                    }
                    else {
                        coche.removeClass('fa-eye-slash');
                        coche.addClass('fa-eye');

                    }

                });

            });

            $("#btn-" + name + "").click(function () {

                sex = 'M';
                coche = $("#sex");
                if (coche.hasClass('fa-close')) {
                    sex = 'M';
                }
                else {
                    sex = 'F';
                }
                ajaxput(id, null, sex);
            });
        },
        error: function (data) {
            console.log(data);
        }
    });
}
function ajaxput(id, assurance, sex) {
    $('#tr' + id).addClass('MarkLigne');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if ($('#editStudent').hasClass('in')) {
        $.ajax({
            type: 'PUT',
            url: '/scolarity/studentM/' + id,
            data: {
                first_name: $("input[name=first_name]").val(),
                last_name: $("input[name=last_name]").val(),
                birth_date: $("input[name=birth_date]").val(),
                sex: sex,
                telephone: $("input[name=telephone]").val(),
                nationality: $("input[name=nationality]").val(),
                particular_disease: $("input[name= particular_disease]").val(),
                tutor_name: $('input[name=tutor_name]').val(),
                tutor_address: $('input[name=tutor_address]').val(),
                //tutor_occupation: $('input[name=tutor_occupation]').val(),
                //tutor_contact: $('input[name=tutor_contact]').val(),
                //tutor_email: $('input[name=tutor_email]').val(),
                tutor_professional_activity: $('input[name=tutor_professional_activity]').val(),
                tutor_town: $('input[name=tutor_town]').val(),
                tutor_phone_1: $('input[name=tutor_phone_1]').val(),
                tutor_phone_2: $('input[name=tutor_phone_2]').val(),
                birth_place: $('input[name=birth_place]').val(),
                department_of_origin: $('input[name=department_of_origin]').val(),
               // present_diploma: $('input[name=present_diploma]').val(),
                previous_school: $('input[name=previous_school]').val(),
                first_language: $('input[name=first_language]').val(),
                professional_activity: $('input[name=professional_activity]').val(),
                marital_status: $('input[name=marital_status]').val(),
               // diploma_year_obtained: $('input[name=diploma_year_obtained]').val(),
                release_year_prev_school: $('input[name=release_year_prev_school]').val(),
                second_language: $('input[name=second_language]').val(),
                country_obtained_diploma: $('input[name=country_obtained_diploma]').val(),
                diploma_obtained: $('input[name=diploma_obtained]').val(),
                other_languages: $('input[name=other_languages]').val(),
                relationship_with_teacher: $('input[name=relationship_with_teacher]').val(),
                father_name: $('input[name=father_name]').val(),
                father_town: $('input[name=father_town]').val(),
                father_profession: $('input[name=father_profession]').val(),
                father_address: $('input[name=father_address]').val(),
                father_phone_1: $('input[name=father_phone_1]').val(),
                father_phone_2: $('input[name=father_phone_2]').val(),
                mother_name: $('input[name=mother_name]').val(),
                mother_town: $('input[name=mother_town]').val(),
                mother_profession: $('input[name=mother_profession]').val(),
                mother_address: $('input[name=mother_address]').val(),
                mother_phone_1: $('input[name=mother_phone_1]').val(),
                mother_phone_2: $('input[name=mother_phone_2]').val(),
                //chosen_discipline: $('input[name=chosen_discipline]').val(),
                //code: $('input[name=code]').val(),
            }
            ,
            //dataType: 'json',
            success: function (data) {
                toastada.info('Ok :)');


            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);

                toastadaError();$.each(errors.messages, function (key, value) {
                    toastada.error(":( Oups: " + value + "");
                });
            }
        });
    }
    else {
        $.ajax({
            type: 'PUT',
            url: '/scolarity/student/' + id,
            data: {
                code: $("#code" + id).text(),
                assurance: assurance,
                present_diploma: $("#present_diploma" + id).text(),
                diploma_year_obtained: $("#diploma_year_obtained" + id).text(),
               // diploma_average: $("#diploma_average" + id).text(),
                chosen_discipline: $("#chosen_discipline" + id).val(),


            }
            ,
            //dataType: 'json',
            success: function (data) {
                toastada.info('enregistré avec succes');


            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);

                toastadaError();$.each(errors.messages, function (key, value) {
                    toastada.error(value + "");
                });
            }
        });
    }
}
function validate(arra, id, msg) {
    $('#tr' + id).removeClass('MarkLigne');

    arra.forEach(function (item, index, array) {

        if (item == "assurance") {
            $("#assurance" + id).unbind('click');
        }
        else if (item == "chosen_discipline") {
            $("#" + item + "" + id).attr('disabled', true);

        }
        else {
            $("#" + item + "" + id).attr('contenteditable', false);
        }
    });



    assurance = 0;
    coche = $("#assurance" + id).find(':first');;
    if (coche.hasClass('fa-close')) {
        assurance = 0;
    }
    else {
        assurance = 1;

    }
    ajaxput(id, assurance, null);

}
function add() {
    assurance = 0;
    coche = $("#createassurance");
    if (coche.hasClass('fa-close')) {
        assurance = 0;
    }
    else {
        assurance = 1;

    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        beforeSend: function() {
            $("#btn-createStudent").attr('disabled', true);
        },
        complete:function(){
            $("#btn-createStudent").attr('disabled', false);
        },
        type: 'POST',
        url: '/scolarity/student',
        data: {
            first_name: $('#createfirst_name').val(),
            last_name: $('#createlast_name').val(),
            birth_date: $("#createbirth_date").val(),
            code: $("#createcode").val(),
            sex: $("#createSex").val(),
            telephone: $("#createtelephone").val(),
            nationality: $("#createnationality").val(),
            particular_disease: $("#createparticular_disease").val(),
            secondary_contact: $("#createsecondary_contact").val(),
            assurance: assurance,
            //entrance_diploma: $("#createentrance_diploma").val(),
           // entrance_diploma_year: $("#createentrance_diploma_year").val(),
            //diploma_average: $("#creatediploma_average").val(),
            tutor_name: $('#tutor_name').val(),
            tutor_address: $('#tutor_address').val(),
            //tutor_occupation: $('#createtutor_occupation').val(),
            //tutor_contact: $('#createtutor_contact').val(),
            student_email: $('#email_address').val(),
            birth_place: $('#createbirth_place').val(),
            chosen_discipline: $('#createchosen_discpiline').val(),
            student_residence: $('#residence_place').val(),
            region_of_origin: $('#region_of_origin').val(),
            department_of_origin: $('#department_of_origin').val(),
            present_diploma: $('#present_diploma').val(),
            previous_school: $('#previous_school').val(),
            first_language: $('#first_language').val(),
            professional_activity: $('#professional_activity').val(),
            marital_status: $('#marital_status').val(),
            diploma_year_obtained: $('#year_obtained').val(),
            release_year_prev_school: $('#release_year').val(),
            second_language: $('#second_language').val(),
            country_obtained_diploma: $('#country_obtained').val(),
            diploma_obtained: $('#diploma_obtained').val(),
            other_languages: $('#other_languages').val(),
            relationship_with_teacher: $('#relationship_with_teacher').val(),
            tutor_town: $('#tutor_town').val(),
            tutor_professional_activity: $('#tutor_professional_activity').val(),
            tutor_phone_1: $('#tutor_phone_1').val(),
            tutor_phone_2: $('#tutor_phone_2').val(),
            father_name: $('#father_name').val(),
            father_town: $('#father_town').val(),
            father_profession: $('#father_profession').val(),
            father_address: $('#father_address').val(),
            father_phone_1: $('#father_phone_1').val(),
            father_phone_2: $('#father_phone_2').val(),
            mother_name: $('#mother_name').val(),
            mother_town: $('#mother_town').val(),
            mother_profession: $('#mother_profession').val(),
            mother_address: $('#mother_address').val(),
            mother_phone_1: $('#mother_phone_1').val(),
            mother_phone_2: $('#mother_phone_2').val(),

        },
        //dataType: 'json',
        success: function (data) {
            toastada.success(data.msg);
            toastadaSuccess();
            window.location.reload();
            $("#btn-createStudent").attr('disabled', false);

            // datae=JSON.parse(datas);
            data = data["department"];
            var news = "<tr id='tr" + data.id + "'> <form id=" + data.id + "> <td  contenteditable='false'>";
            news += "<a id='name" + data.id + "' href='/configuration/department/discipline/" + data.id + "') }}'>";
            news += data.name + "</a> </td>";
            news += "<td id='scolarity" + data.id + "' contenteditable='false'><div> " + data.scolarity + "</div></td>";
            news += "<td contenteditable='false'> <a  id='status" + data.id + "'><i class='icon fa fa-eye-slash'></i> </a></td>";
            news += '<td><div class="form-group"><a  onclick="edit(' + data.id + ')"><i class="fa fa-fw fa-pencil"></i></a><a  onclick="validate(' + data.id + ', "Mise à jour effectuée avec succès" )">';
            news += '<i class="icon fa fa-check"></i></a>';
            news += '  <a onclick="back(' + data.id + ',\'' + data.name + '\',' + data.scolarity + ',' + data.status + ')">';
            news += '<i class="icon fa fa-close"></i></a>';
            news += '  <a onclick="destroy(' + data.id + ')">';
            news += '<i class="fa fa-fw fa-trash"></i></a></div></td> </form></tr>';


            //   $("#tbody").prepend(news);
            //**********ajout de la nouvelle valeur dans le tableau */
        },
        error: function (data) {
            var errors = JSON.parse(data.responseText);
            // toastada.error(data.responseText) ;
            toastadaError();$.each(errors.messages, function (key, value) {
                toastada.error(value + "");
            });
        }
    });
}


function back(id, name, scolarity, status) {
    $('#tr' + id).removeClass('MarkLigne');

    $("#name" + id).attr('contenteditable', false);
    $("#scolarity" + id).attr('contenteditable', false);
    assurance = 0;
    coche = $("#status" + id).find(':first');;
    if (coche.hasClass('glyphicon-ok')) {
        assurance = 1;
    }
    else {
        assurance = 0;

    }
    if (assurance != status) {
        console.log(assurance);

        if (coche.hasClass('fa-eye')) {
            coche = $("#status" + id).find(':first');;

            coche.removeClass('fa-eye');
            coche.addClass('fa-eye-slash');
        }
        else {
            coche.removeClass('fa-eye-slash');
            coche.addClass('fa-eye');

        }

    }
    $("#name" + id).text(name);
    $("#scolarity" + id).text(scolarity);
    msg = 'Mise à jour annulée'
    validate(id, msg);
}
function eadd(kdjlkje) {
    console.log($("#name").val() + "addin" + $("#scolarity").val());
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'public/configuration/department',
        data: {
            name: $("#name").val(),
            scolarity: $("#scolarity").val(),
        },
        //dataType: 'json',
        success: function (data) {
            toastada.success(data.msg);
            toastadaSuccess();

            // datae=JSON.parse(datas);
            data = data["department"];
            var news = "<tr id='tr" + data.id + "'> <form id=" + data.id + "> <td  contenteditable='false'>";
            news += "<a id='name" + data.id + "' href='/configuration/department/discipline/" + data.id + "') }}'>";
            news += data.name + "</a> </td>";
            news += "<td id='scolarity" + data.id + "' contenteditable='false'><div> " + data.scolarity + "</div></td>";
            news += "<td contenteditable='false'> <a  id='status" + data.id + "'><i class='icon fa fa-eye-slash'></i> </a></td>";
            news += '<td><div class="form-group"><a  onclick="edit(' + data.id + ')"><i class="fa fa-fw fa-pencil"></i></a><a  onclick="validate(' + data.id + ', "Mise à jour effectuée avec succès" )">';
            news += '<i class="icon fa fa-check"></i></a>';
            news += '  <a onclick="back(' + data.id + ',\'' + data.name + '\',' + data.scolarity + ',' + data.status + ')">';
            news += '<i class="icon fa fa-close"></i></a>';
            news += '  <a onclick="destroy(' + data.id + ')">';
            news += '<i class="fa fa-fw fa-trash"></i></a></div></td> </form></tr>';


            $("#tbody").prepend(news);
            //**********ajout de la nouvelle valeur dans le tableau */

        },
        error: function (data) {
            var errors = JSON.parse(data.responseText);
            // toastada.error(data.responseText) ;
            toastadaError();$.each(errors.messages, function (key, value) {
                toastada.error(value + "");
            });
        }
    });

}

function destroy(id) {
    if (confirm("Voulez vous vraiment supprimer cet élément")) {
        $('#tr' + id).addClass('MarkLigne');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'delete',
            url: '/configuration/department/' + id,
            data: {
            },
            //dataType: 'json',
            success: function (data) {
                toastada.info(data.msg);
                $("#tr" + id).remove();
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);

                toastadaError();$.each(errors.messages, function (key, value) {
                    toastada.error(value + "");
                });
            }
        });
    }
}
