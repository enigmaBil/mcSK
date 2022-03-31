function getStudentByAcademicYear() {
    console.log($("#academic_year").val());
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("")
        }
    });
    $.ajax({
        type: "GET",
        url: "/mark/getStudentByAcademic_year/" + $("#academic_year").val(),
        data: {
            // course_id:$('#course').val(),
        },
        dataType: "html",
        success: function(data) {
            $("#data")
                .empty()
                .html(data);
        },
        error: function(data) {
            $("#data").css("display", "block");

            /*var errors = $.parseJSON(data.responseText);
            
            $.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });*/
        }
    });
}

function disciplineLevel() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("")
        }
    });
    $.ajax({
        type: "GET",
        url: "/configuration/disciplineLevel",
        data: {
            discipline_id: $("#discipline").val()
        },
        dataType: "json",
        success: function(data) {
            levels = data["levels"];
            option = '<option value="0"></option>';
            levels.forEach(element => {
                option +=
                    "<option value= '" +
                    element.id +
                    "'> " +
                    element.name +
                    "</option>";
            });
            $("#level")
                .find("option")
                .remove()
                .end()
                .append(option);
            getStudentByDiscipline();
        },
        error: function(data) {
            var errors = $.parseJSON(data.responseText);

            $.each(errors.messages, function(key, value) {
                toastada.error(value + "");
            });
        }
    });
}

function departmentDiscipline(id) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("")
        }
    });
    $.ajax({
        type: "GET",
        url: "/configuration/departmentDiscipline",
        data: {
            department_id: $("#department").val()
        },
        dataType: "json",
        success: function(data) {
            disciplines = data["disciplines"];
            option = '<option value="0"></option>';
            console.log(disciplines);
            disciplines.forEach(element => {
                option +=
                    "<option value= '" +
                    element.id +
                    "'> " +
                    element.name +
                    "</option>";
            });
            $("#discipline")
                .find("option")
                .remove()
                .end()
                .append(option);
            getStudentByDepartment();
        },
        error: function(data) {
            var errors = $.parseJSON(data.responseText);

            $.each(errors.messages, function(key, value) {
                toastada.error(value + "");
            });
        }
    });
}

function getStudentByDepartment(id) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("")
        }
    });
    $.ajax({
        type: "GET",
        url: "/mark/getStudentByDepartment/" + $("#department").val(),
        data: {
            // course_id:$('#course').val(),
        },
        dataType: "html",
        success: function(data) {
            $("#data")
                .empty()
                .html(data);
        },
        error: function(data) {
            $('#data').css("display", "block");

            /*var errors = $.parseJSON(data.responseText);
            
            $.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });*/
        }
    });
}

function getStudentByDiscipline(id){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("")
        }
    });
    $.ajax({
        type: "GET",
        url: "/mark/getStudentByDiscipline/" + $('#discipline').val(),
        data: {
            // course_id:$('#course').val(),
        },
        dataType: "html",
        success: function(data) {
            $('#data')
                .empty()
                .html(data);
        },
        error: function(data) {
            $('#data').css("display", "block");
        }
    });
}

function getStudentByLevel() {
    if($('#discipline').val() == 0) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("")
            }
        });
        $.ajax({
            type: "GET",
            url: "/mark/getStudentByLevel_study/" + $('#level').val(),
            data: {
            },
            dataType: "html",
            success: function(data) {
                $('#data')
                    .empty()
                    .html(data);
            },
            error: function(data) {
            }
        });
    } 
    else {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("")
            }
        });
        $.ajax({
            type: "GET",
            url:
                "/mark/getStuentByClassroom/" + $("#level").val() +"/" + $("#discipline").val(),
            data: {
            },
            dataType: "html",
            success: function(data) {
                $("#data")
                    .empty()
                    .html(data);
            },
            error: function(data) {
                $('#data').css("display", "block")

            }
        });
    }
}