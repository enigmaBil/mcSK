$(document).ready(function(){
});
function edit(id){
    $("#name"+id).attr('contenteditable',true);
    $("#scolarity"+id).attr('contenteditable',true);
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
    $("#name"+id).attr('contenteditable',false);
    $("#scolarity"+id).attr('contenteditable',false);

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
            url: '/configuration/classroom/' + id,
            data: {
                name: $("#name"+id).text(),
                scolarity: $("#scolarity"+id).text(),
                status: statuse,
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info('enregistré avec succes');

              //  $('#frmEditTask').trigger("reset");
        // window.location.reload();
            },
            error: function(data) {toastadaError();
                var errors = $.parseJSON(data.responseText);
                
                $.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
}

function add(){
    console.log($("#name").val()+"addin"+$("#scolarity").val());
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/configuration/classroom',
        data: {
            name: $("#name").val(),
            scolarity: $("#scolarity").val(),
        },
        //dataType: 'json',
        success: function(datas) {
            toastadaSuccess();

           // datae=JSON.parse(datas);
            data=datas["department"];
            console.log(data.type);
            var news = "<tr> <form id="+data.id+"> <td id='name"+data.id+"'  contenteditable='false'>";
            news +="<a  href='/configuration/department/discipline/"+data.id+"') }}'>";
            news+=data.name+"</a> </td>";
            news+="<td id='scolarity"+data.id+"' contenteditable='false'><div> "+data.scolarity+"</div></td>";
            news+="<td contenteditable='false'> <a  id='status"+data.id+"'><i class='icon fa fa-eye-slash'></i> </a></td>";
            news+='<td><div class="form-group"><a  onclick="edit('+data.id+')"><i class="fa fa-fw fa-pencil"></i></a><a  onclick="validate('+data.id+')">';
            news+='<i class="icon fa fa-check"></i></a>';
            news+='  <a onclick="back('+data.id+',\''+data.name+'\','+data.scolarity+','+data.status+')">';
            news+='<i class="icon fa fa-close"></i></a></div></td> </form></tr>';


            $("#tbody").prepend(news);
            //**********ajout de la nouvelle valeur dans le tableau */

        },
        error: function(data) {toastadaError();
            var errors = $.parseJSON(data.responseText);
                
            $.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });
        }
    });

}
///*******au dessus ca ne sert à irien juste un hr*elper */
/*********ici ca permet de recupérer */
function createClass(id, slice){//créer une classe avec le model
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('')
        }
    });
    $.ajax({
        type: 'GET',
        url: '/configuration/dClassroom/'+id,
        data: {
        },
        dataType: 'json',
        success: function(data) {
         levels=data["levelsPrenable"]
         option=''
         if(levels!=null){
         levels.forEach(element => {
           option += "<option value= '"+element.id+"'> "+element.name+"</option>"
         });
        }
         $('#addLevel')
          .find('option')
          .remove()
          .end()
          .append(option)
        },
        error: function(data) {
            var errors = $.parseJSON(data.responseText);
            
            $.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });
        }
    });

    $('#createClassModal').modal('show');
    $('#btnCreateClass').click(function(){
        addclass(id, slice);
    });
}


function addCourseModal($id){
        $(document).ready(function() {
            $("#Courseadd-error-bag").text($id);
            $("#Courseadd-error-bag").hide();
            $('#addCourse').modal('show');
        });
}
function addCourse(){
    moduleId=$("#Courseadd-error-bag").text();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/configuration/course',
        data: {
            name: $("#Coursename").val(),
            content: $("#coursesseion").val(),
            teacher_id:$("#AddCourseteacher").val(),
            module_id:moduleId,
            amount_hour:$("#Courseamount_hour").val(),
            coefficient:$("#Coursecoefficient").val(),
            session_id:"",
            status:0,
            course_sequences:course_sequence,

        },
        //dataType: 'json',
        success: function(datas) {
            $('#addCourse').modal('hide');

            toastadaSuccess();

           // datae=JSON.parse(datas);
            data=datas["course"];
            selector=document.getElementById('AddCourseteacher');
            teacherId=selector.selectedIndex;
            selector=document.getElementById('coursesession');
            selector2=document.getElementById('AddCourseteacher');
            sessionId=selector.selectedIndex;
            console.log(teacherId);
            console.log(selector.options[teacherId].value);
            var news = " <tr id='tr"+data.id+"'> <td id=name"+data.id+" contenteditable=\"false\">"+data.name;
            news += "</td><td id='sess"+data.id+"' contenteditable='false'><select id='session"+data.id+"'>";
            news +=' <option selected value=\''+data.sesssion_id+'\'> '+selector.options[sessionId].text ; 
            news +="</option> </select></td>";
            news +="</td><td  contenteditable='false'><select id='teacher"+data.id+"'>";
            news +=' <option selected value=\''+data.teacher_id+'\'> '+selector2.options[teacherId].text ; 
            news +="</option> </select></td>";
            news += "<td id='coefficient"+data.id+"' contenteditable='false'>"+data.coefficient+"</td>";
            news += "<td id='amount_hour"+data.id+"' contenteditable='false'>"+data.amount_hour+"</td>";

            news+="<td contenteditable='false'> <a  id='Coursestatus"+data.id+"'><i class='icon fa fa-eye-slash'></i> </a></td>";
            news+="<td><a onclick=' loadcourse_sequence("+data.id+")' >configure percentages</a></td>";
            
            news +="<td><div class='form-group'><a  onclick='editCourse("+data.id+")'><i class='fa fa-fw fa-pencil'></i></a><a  onclick='validateCourse("+data.id+","+moduleId+")'>";
            news +="<i class='icon fa fa-check'></i></a>";
            news +="<a onclick='back()'>";
            news +="<i class='icon fa fa-close'></i></a>";
            news +="<a onclick='destroyCourse("+data.id+")'>";
            news +="<i class='icon fa fa-trash'></i></a></div></td> </tr>";
                   

            $("#addCourse"+moduleId).prepend(news);
            //**********ajout de la nouvelle valeur dans le tableau */

        },
        error: function(data) {
            toastadaError();
            var errors = $.parseJSON(data.responseText);
                
            $.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });
        }
    });

}
function destroyCourse(id){

    if(confirm("Voulez vous vraiment supprimer cet élément")){

        $('#tr'+id).addClass('MarkLigne');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'delete',
            url: '/configuration/course/' + id,
            data: {
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info(data.msg);
             $("#tr"+id).remove();
            },
            error: function(data) {toastadaError();
                var errors = $.parseJSON(data.responseText);
                
                toastadaError();$.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
    }
}
function addModule(classId){
    $(document).ready(function() {
        $("#Moduleadd-error-bag").text(classId);
        $("#Moduleadd-error-bag").hide();
        $('#addModule').modal('show');
    });
    $("#btn-addModule").click(function(){
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/configuration/module',
            data: {
                name: $("#modulename").val(),
                description: $("#moduledescription").val(),
                discipline_level_study_id: classId,
            },
            //dataType: 'json',
            success: function(datas) {
                $('#addModule').modal('show');
                toastadaSuccess();
                window.location.reload();
    
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                    
                toastadaError();$.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });

    })  
}
function addclass(_id, slice){
    discipline_id=_id;
    selector=document.getElementById('addLevel');
    slice.forEach(element => {
        element["amount"]=$('#amount'+element["id"]).val()
    });
    levelid=selector.selectedIndex;
    if(levelid==-1){
        toastada.error('vous ne pouvez plus ajouter un niveau dans cette discipline créez un nouveau niveau et réessayez à nouveau');
    }else{
        levelid=selector.options[levelid].value;

   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   $.ajax({
       type: 'POST',
       url: '/configuration/classroom',
       data: {
           discipline_id: discipline_id,
           level_study_id:levelid,
           education_amount: $("#leveleducation").val(),
           inscription_amount: $("#levelinscription").val(),
           amount:slice,

       },
       //dataType: 'json',
       success: function(datas) {   
            $('#createClassModal').modal('hide');
            toastadaSuccess();
            window.location.reload()

       },
       error: function(data) {
        var errors = JSON.parse(data.responseText);
               
           toastadaError();$.each(errors.messages, function(key, value) {
               toastada.error(value+"");
           });
       }
   });
  
}
}
function editModule(id,classroom){
    
    $.ajax({
        type: 'GET',
        url: '/configuration/module/'+id,
        success: function(data) {
            data=data["module"]
            $("#frmEditModule .alert-danger").hide();
            $("#frmEditModule .alert-danger").text(id);
            $("#frmEditModule input[name=name]").val(data.name);
            $("#frmEditModule input[name=description]").val(data.description);
            if(data.status ==0){
              $("#Modulestatus").html("<h4><a id='Estatus'> <i class='icon fa fa-eye-slash'></i><\a><\h4>");
              }
              else {
                $("#Modulestatus").html("<h4><a id='Estatus'><i class='icon fa fa-eye'></i><\a><\h4>");
              }     
              $('#SelectLevel option[value="'+classroom+'"]').prop('selected', true);


            $(document).ready(function() {
               
                $('#editModuleModal').modal('show');
                $("#Estatus").click(function(){
                    coche=$("#Estatus").find(':first');;
                if ( coche.hasClass('fa-eye') ){
                    coche.removeClass('fa-eye');
                    coche.addClass('fa-eye-slash');
                }   
                else{
                    coche.removeClass('fa-eye-slash');
                    coche.addClass('fa-eye');
            
                }
            
                });

            });
       
       $("#btn-editModule").click(function(){
        selector=document.getElementById('SelectLevel');
        classId=selector.selectedIndex;
       classId= selector.options[classId].value

        statuse=0;
            coche=$("#Estatus").find(':first');;
        if ( coche.hasClass('fa-eye') ){
           statuse=1;
        }   
        else{
           statuse=0;
    
        }
        

       if(confirm("voulez vous vraiment deplacer ce module?")){ $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'PUT',
                url: '/configuration/module/' + id,
                data: {
                    name: $("#frmEditModule input[name=name]").val(),
                    description: $("#frmEditModule input[name=description]").val(),
                    status: statuse,
                    discipline_level_study_id:classId,
                },
                //dataType: 'json',
                success: function(data) {
                 toastada.info('enregistré avec succes');
                 if(classId!= classroom){
                     alert(classId+" "+classroom);
                   $('#classroom'+classId).prepend($('#module'+id));
                  // selector.selectedIndex=classId
                  // selector.options[classId].value
                   // $('#classroom'.classroom).remove('#module'+id)
                    
                       // $('#module'+id).remove();
                        
                       
            }
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    
                    toastadaError(); $.each(errors.messages, function(key, value) {
                        toastada.error(value+"");
                    });
                }
            });}
       });
        },
        error: function(data) {
            console.log(data);
        }
    });
}
function editCourse(id){
    $('#tr'+id).addClass('MarkLigne');

    $("#name"+id).attr('contenteditable',true);
    $("#content"+id).attr('contenteditable',true);
    $("#coefficient"+id).attr('contenteditable',true);
    $("#amount_hour"+id).attr('contenteditable',true);
    $("#teacher"+id).attr('disabled',false);
    $("#session"+id).attr('disabled',false);


    $("#Coursestatus"+id).click(function(){
        coche=$("#Coursestatus"+id).find(':first');
    if ( coche.hasClass('fa-eye-slash') ){
        
        coche.removeClass('fa-eye-slash');
        coche.addClass('fa-eye');
        
    }   
    else{coche.removeClass('fa-eye');
    coche.addClass('fa-eye-slash');

    }

    });
    toastada.info('vous pouvez modifier la ligne ');
    toastada.info("n'oubliez pas de valider");

}
function validateCourse(id,module){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name"+id).attr('contenteditable',false);
    $("#content"+id).attr('contenteditable',false);
    $("#coefficient"+id).attr('contenteditable',false);
    $("#amount_hour"+id).attr('contenteditable',false);
    $("#teacher"+id).attr('disabled',true);
    $("#session"+id).attr('disabled',true);
    $("#status"+id).unbind('click');

    selector=document.getElementById("teacher"+id);
    teacherId=selector.selectedIndex;
    teacherId= selector.options[teacherId].value
    statuse=0;
        coche=$("#Coursestatus"+id).find(':first');;
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
                session_id: $("#session"+id).val(),
                amount_hour: $("#amount_hour"+id).text(),
                coefficient: $("#coefficient"+id).text(),
                teacher_id: teacherId,
                status: statuse,
                module_id: module,
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info('enregistré avec succes');
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                toastadaError(); $.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });

}
function editClass(id){
    $("#inscription"+id).attr('contenteditable',true);
    $("#education"+id).attr('contenteditable',true);
    $("#discipline"+id).attr('disabled',false);
    
    toastada.info('vous pouvez modifier la ligne ');
    toastada.info("n'oubliez pas de valider");

}
function validateClass(id,discipline,type){
    $("#inscription"+id).attr('contenteditable',false);
    $("#education"+id).attr('contenteditable',false);
    $("#discipline"+id).attr('disabled',true);
   /* selector=document.getElementById("teacher"+id);
    teacherId=selector.selectedIndex;
    teacherId= selector.options[teacherId].value
    */
   disc=discipline;
   if(discipline!=$("#discipline"+id).val()){
    if(confirm("Voulez vous vraiment deplacer cette salle de classe ")){
        disc=$("#discipline"+id).val();
    }}
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/configuration/classroom/' + id,
            data: {
                education_amount: $("#education"+id).text(),
               inscription_amount: $("#inscription"+id).text(),
               discipline_id: disc,
                
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info('enregistré avec succes');
             if(discipline!=$("#discipline"+id).val()){
                 if(type>1){
                $('#rootdiscipline'+$("#discipline"+id).val()).append($('#class'+id))}
                else{
                    $('#class'+id).remove();
                }
                //
                 //window.location.reload();
                }
             
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                toastadaError(); $.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
   

    

}
function backClass(id,discipline_id,type,education_amount,inscription_amount){

    $("#education_amount"+id).attr('contenteditable',false);
    $("#inscription_amount"+id).attr('contenteditable',false);
    $("#inscription_amount"+id).text(inscription_amount);
$("#education_amount"+id).text(education_amount);
validateClass(id,discipline_id,type);
}

function backCourse(id,name,amount_hour, coefficient,sessionId, status, teacherId, module){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name"+id).attr('contenteditable',false);
    $("#coefficient"+id).attr('contenteditable',false);
    $("#amount_hour"+id).attr('contenteditable',false);
    $("#teacher"+id).attr('disabled',true);
    $("#session"+id).attr('disabled',true);
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
    $('#session'+id+' option[value="'+sessionId+'"]').prop('selected', true);
    $('#teacher'+id+' option[value="'+teacherId+'"]').prop('selected', true);
    $("#amount_hour"+id).text(amount_hour);
    validateCourse(id, module);
}


function editAmount(id){
    $("#value"+id).addClass('MarkLigne');
    $("#value"+id).attr('contenteditable',true);
    
    toastada.info('vous pouvez modifier la ligne ');
    toastada.info("n'oubliez pas de valider");
}

function validateAmount(id, msg) {
    $("#value"+id).removeClass('MarkLigne');
    $("#value"+id).attr('contenteditable',false);

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/scolarity/class_slice/' + id,
            data: {
                value: $("#value"+id).text(),
            },
            success: function(data) {
             toastada.info(msg);
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                toastadaError(); $.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
}

function backAmount(id,value){
    $("#value"+id).text(value);
    msg='Mise à jour annulée'
    validateAmount(id, msg);
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
                        toastadaSuccess();
                      },
                      error: function(data) {
                          var errors = $.parseJSON(data.responseText);
                          
                          toastadaError();   $.each(errors.messages, function(key, value) {
                              toastada.error(value+"");
                          });
                      }
                  });
                });
              },
                  error: function(data) {
                      var errors = $.parseJSON(data.responseText);
                      
                      toastadaError();   $.each(errors.messages, function(key, value) {
                          toastada.error(value+"");
                      });
            },
        });
  

  }