$(document).ready(function(){

});
function edit(id){
    $('#tr'+id).addClass('MarkLigne');

    $("#name"+id).attr('contenteditable',true);
    $("#coefficient"+id).attr('contenteditable',true);
    $("#session"+id).attr('contenteditable',true);
    $("#teacher"+id).attr('disabled',false);
    $("#module"+id).attr('disabled',false);
    $("#discipline"+id).attr('disabled',false);
    $("#level"+id).attr('disabled',false);
    $("#amount_hour"+id).attr('contenteditable',true);
    $("#selectcourse"+id).attr('disabled',false);
    $("#status"+id).click(function(){
        coche=$("#status"+id).find(':first');;
    if ( coche.hasClass('fa-eye') ){
        coche.removeClass('fa-eye');
        coche.addClass('fa-eye-slash');
    }   
    else{
        coche.removeClass('fa-eye-slash');
        coche.addClass('fa-eye');

    }

    });
    toastada.info('vous pouvez modifier la ligne ');
    toastada.info("n'oubliez pas de valider");

}
function validate(id){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name"+id).attr('contenteditable',false);
    $("#coefficient"+id).attr('contenteditable',false);
    $("#session"+id).attr('contenteditable',false);
    $("#teacher"+id).attr('disabled',true);
    $("#module"+id).attr('disabled',true);
    $("#discipline"+id).attr('disabled',true);
    $("#level"+id).attr('disabled',true);
    $("#amount_hour"+id).attr('contenteditable',false);
    $("#status"+id).unbind('click');

    statuse=0;
        coche=$("#status"+id).find(':first');;
    if ( coche.hasClass('fa-eye') ){
       statuse=1;
    }   
    else{
       statuse=0;

    }
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/configuration/course/' + id,
            data: {
                name: $("#name"+id).text(),
                amount_hour: $("#amount_hour"+id).text(),
                coefficient: $("#coefficient"+id).text(),
                session: $("#session"+id).text(),
                teacher_id: $("#teacher"+id).val(),
                module_id: $("#module"+id).val(),
                discipline_id: $("#discipline"+id).val(),
                level_id:$("#level"+id).val(),
                status:statuse,
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info('message');

              //  $('#frmEditTask').trigger("reset");
        // window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                toastadaError();$.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
}
function back(id,name,amount_hour, coefficient,session,status, teacherId, moduleId, disciplineId, levelId){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name"+id).attr('contenteditable',false);
    $("#coefficient"+id).attr('contenteditable',false);
    $("#session"+id).attr('contenteditable',false);
    $("#teacher"+id).attr('disabled',true);
    $("#module"+id).attr('disabled',true);
    $("#discipline"+id).attr('disabled',true);
    $("#level"+id).attr('disabled',true);
    $("#amount_hour"+id).attr('contenteditable',false);
    statuse=0;
    coche=$("#status"+id).find(':first');;
    if ( coche.hasClass('fa-eye') ){
    statuse=1;
    }   
    else{
    statuse=0;

    }
    if(statuse!=status){
        console.log(statuse);

        if ( coche.hasClass('fa-eye') ){
            coche=$("#status"+id).find(':first');;

            coche.removeClass('fa-eye');
            coche.addClass('fa-eye-slash');
        }   
        else{
            coche.removeClass('fa-eye-slash');
            coche.addClass('fa-eye');

        }

    }
    $("#name"+id).text(name);
    $("#coefficient"+id).text(coefficient);
    $("#session"+id).text(session);
    $('#teacher'+id+' option[value="'+teacherId+'"]').prop('selected', true);
    $('#module'+id+' option[value="'+moduleId+'"]').prop('selected', true);
    $('#discipline'+id+' option[value="'+disciplineId+'"]').prop('selected', true);
    $('#level'+id+' option[value="'+levelId+'"]').prop('selected', true);
    $("#amount_hour"+id).text(amount_hour);
    validate(id, teacherId, moduleId, disciplineId, levelId);
}
function add(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        beforeSend: function() {
            $("#btn-add").attr('disabled', true);
        },
        complete:function(){
            $("#btn-add").attr('disabled', false);
        },
        type: 'POST',
        url: '/configuration/course',
        data: {
            name: $("#Createname").val(),
            content: $("#Createcontent").val(),
            teacher_id:$("#Createteacher").val(),
            module_id:$("#Createmodule").val(),
            amount_hour:$("#Createamount_hour").val(),
            coefficient:$("#Createcoefficient").val(),
            session_id:"",
            course_sequences:course_sequence,
            status:0,
        },
        //dataType: 'json',
        success: function(datas) {
            toastadaSuccess();
           window.location.reload();
            $("#btn-add").attr('disabled', false);
            /*
           // datae=JSON.parse(datas);
            data=datas["course"];
            selector=document.getElementById('AddCourseteacher');
            teacherId=selector.selectedIndex;
            console.log(teacherId);
            console.log(selector.options[teacherId].value);
            var news = " <tr id='tr"+data.id+"'> <td id=name"+data.id+" contenteditable=\"false\">"+data.name;
            news += "</td><td id='content"+data.id+"' contenteditable='false'>"+data.content;

            news +="</td><td  contenteditable='false'><select id='teacher"+data.id+"'>";
            news +=' <option selected value=\''+data.teacher_id+'\'> '+selector.options[teacherId].text ; 
            news +="</option> </select></td>";
            news += "<td id='coefficient"+data.id+"' contenteditable='false'>"+data.coefficient+"</td>";
            news += "<td id='amount_hour"+data.id+"' contenteditable='false'>"+data.amount_hour+"</td>";

            news+="<td contenteditable='false'> <a  id='Coursestatus"+data.id+"'><i class='icon fa fa-eye-slash'></i> </a></td>";
            news +="<td><div class='form-group'><a  onclick='editCourse("+data.id+")'><i class='fa fa-fw fa-pencil'></i></a><a  onclick='validateCourse("+data.id+","+moduleId+")'>";
            news +="<i class='icon fa fa-check'></i></a>";
            news +="<a onclick='back()'>";
            news +="<i class='icon fa fa-close'></i></a>";
            news +="<a onclick='destroyCourse("+data.id+")'>";
            news +="<i class='icon fa fa-trash'></i></a></div></td> </tr>";
                   

            $("#tbody").prepend(news);
            //**********ajout de la nouvelle valeur dans le tableau */

        },
        error: function(data) {
            var errors = $.parseJSON(data.responseText);
                
            toastadaError();$.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });
        }
    });

}

function destroy(id){
    $('#tr'+id).addClass('MarkLigne');

    if(confirm("Voulez vous vraiment supprimer cet élément")){
        $('#tr'+id).addClass('MarkLigne');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'delete',
            url: '/configuration/course/'+id,
            data: {
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info(data.msg);
             $("#tr"+id).remove();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                toastadaError();$.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
    }
    
}

function loadcheck(id) {
    sequence = course_sequence[id];
    sequence.choice = !sequence.choice;
    console.log("choix" + sequence.choice);
    sequence.percentage = $("#cpercentage"+id).val();;
    console.log("percentage" + sequence.percentage);
    console.log(course_sequence);
}


function  loadcourse_sequence(id){
    $('#course_sequenceModal').modal('show');

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/configuration/course/course_sequence/'+id,
            data: {
            },
            dataType: 'json',
            success: function(data) {
              course_sequences=data.course_sequences;
              sequences=data.Allsequences;
              sequences.forEach(function(value,index,array){
                $('#percentage'+value["id"]).val("0");
                $('#checkbox'+value["id"]).prop("checked", false); 

              })
             course_sequences.forEach(function(value,index,array){
                $('#percentage'+value["sequence_id"]).val(value['percentage']);
                $('#checkbox'+value["sequence_id"]).prop("checked", true); 

              });
                $('#send_course_sequences').click(function(){
                  sequences=data.Allsequences;
                  course_sequences=[];
                  sequences.forEach(function(value,index,array){
                    console.log(index);
                    if( $('#checkbox'+value["id"]).prop('checked')===true){
                      console.log("ok");
                      course_sequences.push({"sequence_id":value["id"],"course_id":id,
                      "percentage":$('#percentage'+value["id"]).val()})
                    }
                  })
                  console.log("starting ajax");
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      type: 'POST',
                      url: '/configuration/course/course_sequence',
                      data: {
                        course_sequences:course_sequences,
                        course_id:id,
                      },
                      dataType: 'json',
                      success: function(data) {
                        toastadaSuccess();                      },
                      error: function(data) {
                          var errors = $.parseJSON(data.responseText);
                          
                          toastadaError();$.each(errors.messages, function(key, value) {
                              toastada.error(value+"");
                          });
                      }
                  });
                });
              },
                  error: function(data) {
                      var errors = $.parseJSON(data.responseText);
                      
                      toastadaError();$.each(errors.messages, function(key, value) {
                          toastada.error(value+"");
                      });
            },
        });
  

  }
