$(document).ready(function(){

});
function edit(id){
    $('#tr'+id).addClass('MarkLigne');

    $("#name"+id).attr('contenteditable',true);
    $("#speciality"+id).attr('contenteditable',true);
    $("#study_level"+id).attr('contenteditable',true);
    $("#sex"+id).attr('contenteditable',true);
    $("#contact"+id).attr('contenteditable',true);
    $("#address"+id).attr('contenteditable',true);
    $("#content"+id).attr('contenteditable',true);
    $("#code"+id).attr('contenteditable',true);
    $("#salary"+id).attr('contenteditable',true);
    $("#status"+id).attr('disabled',false);
    $("#department"+id).attr('disabled',false);
    $("#email"+id).attr('contenteditable',true);
    $("#number_of_hour"+id).attr('contenteditable',true);
    $("#salary"+id).attr('contenteditable',true);


    toastada.info('vous pouvez modifier la ligne ');

}
function validate(id){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name"+id).attr('contenteditable',false);
    $("#speciality"+id).attr('contenteditable',false);
    $("#study_level"+id).attr('contenteditable',false);
    $("#sex"+id).attr('contenteditable',false);
    $("#contact"+id).attr('contenteditable',false);
    $("#address"+id).attr('contenteditable',false);
    $("#content"+id).attr('contenteditable',false);
    $("#code"+id).attr('contenteditable',false);
    $("#salary"+id).attr('contenteditable',false);
    $("#status"+id).attr('disabled',true);
    $("#department"+id).attr('disabled',true);
    $("#email"+id).attr('contenteditable',false);
    $("#number_of_hour"+id).attr('contenteditable',false);
    $("#salary"+id).attr('contenteditable',false);

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/configuration/enseignant/' + id,
            data: {
                name: $("#name"+id).text(),
                code: $("#code"+id).text(),
                speciality: $("#speciality"+id).text(),
                study_level: $("#study_level"+id).text(),
                sex: $("#sex"+id).text(),
                contact: $("#contact"+id).text(),
                address: $("#address"+id).text(),
                content: $("#content"+id).text(),
                salary: $("#salary"+id).text(),
                status:$("#status"+id).text(),
                email:$("#email"+id).text(),
                number_of_hour:$("#number_of_hour"+id).text(),
                department_id:$("#department"+id).val(),
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info(data.msg);

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
function back(id,code,name, speciality,study_level,sex,contact,address,status){
    $('#tr'+id).removeClass('MarkLigne');
    $("#status"+id).attr('disabled',true);
    $("#name"+id).attr('contenteditable',false);
    $("#speciality"+id).attr('contenteditable',false);
    $("#study_level"+id).attr('contenteditable',false);
    $("#sex"+id).attr('contenteditable',false);
    $("#contact"+id).attr('contenteditable',false);
    $("#address"+id).attr('contenteditable',false);
    $("#code"+id).attr('contenteditable',false);
    $("#salary"+id).attr('contenteditable',false);

    $("#department"+id).attr('disabled',true);
    $("#email"+id).attr('contenteditable',false);
    $("#number_of_hour"+id).attr('contenteditable',false);
    $("#salary"+id).attr('contenteditable',false);
    //$("#name"+id).html('<a  href="/configuration/department/discipline/'+id+'>'+name+'</a>');
    $("#name"+id).text(name);
    $("#speciality"+id).text(speciality);
    $("#study_level"+id).text(study_level);
    $("#sex"+id).text(sex);
    $("#contact"+id).text(contact);
    $("#address"+id).text(address);
    $("#code"+id).text(code);
    document.getElementById("status"+id).selectedIndex=status;
   
    validate(id);
}
function add(){

    console.log($("#name").val()+"addin"+$("#scolarity").val());
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
        url: '/configuration/enseignant',
        data: {

            name: $("#name").val(),
            code: $("#code").val(),
            speciality: $("#speciality").val(),
            study_level: $("#study_level").val(),
            sex: $("#sex").val(),
            contact: $("#contact").val(),
            address: $("#address").val(),
            content: $("#content").val(),
            salary: $("#salary").val(),
            status: $("#status").val(),
            email: $("#email").val(),
            number_of_hour: $("#number_of_hour").val(),
            salary: $("#salary").val(),
            department_id: $("#department").val(),
        },
        //dataType: 'json',
        success: function(data) {
toastadaSuccess();            data=data["teacher"];
            var news =' <tr id="tr'+data.id+'"><form action="">';
            news +='<td id="code'+data.id+'" contenteditable="false">';
            news +=''+data.code+'</td><td id="name'+data.id+'" contenteditable="false">'+data.name+'</td>';
            news +='<td id="speciality'+data.id+'" contenteditable="false">'+data.speciality+'</td>';
            news +='<td id="study_level'+data.id+'"contenteditable="false">'+data.study_level+'</td>';
            news +='<td id="courses'+data.id+'" contenteditable="false"> <select name="" id="">';
            news +='</select></td>'; 
            news +='<td id="sex'+data.id+'" contenteditable="false">'+data.sex+'</td>';
            news +='<td id="contact'+data.id+'"contenteditable="false">'+data.contact+'</td> ';  
            news +='<td id="address'+data.id+'" contenteditable="false">'+data.address+'</td>';
            news +=' <td id="statu'+data.id+'"  contenteditable="false">';
            news +='';var check=true;
            news += " <select disabled id='status"+data.id+"'> <option"+( check=data.status=="0" ? 'selected':'unselected' )+" value='0'>inactive</option><option"+( check=(data.status==1) ? "selected":"")+" value='1'>permanent </option><option"+( (data.status==0)? "selected":"")+" value='0'>vacataire </option> </select></td>";
            news+='<td id="depart'+data.id+'" contenteditable="false">'+data.department_id+'</td>';
            news+='<td id="email'+data.id+'" contenteditable="false">'+data.email+'</td>';
            news+='<td id="number_of_hour'+data.id+'" contenteditable="false">'+data.number_of_hour+'</td>';
            news+='<td id="salary'+data.id+'" contenteditable="false">'+data.salary+'</td>';
            news +=' <td> <div class="form-group"><a  onclick="edit('+data.id+')">';
            news +=' <i class="fa fa-fw fa-pencil"></i> </a>';
            news +='<a  onclick="validate('+data.id+')"><i class="icon fa fa-check"></i></a>';
            news +='<a onclick="back('+data.id+',\''+data.code+'\',\''+data.name+'\',\''+data.speciality+'\',';
            news +='\''+data.study_level+'\',\''+data.sex+'\',\''+data.contact+'\',\''+data.address+'\',\''+data.status+'\',';
            news +='\''+data.content+'\',\''+data.status+'\')"><i class="icon fa fa-reply"></i> </a>';
            news+='  <a onclick="destroy('+data.id+')"> ';
            news +='<i class="fa fa-fw fa-trash"></i></a></div></td></div></td></form></tr>';
           
            $("#tbody").prepend(news);
            $("#depart"+data.id).prepend($('#department').clone());
            $('#depart'+data.id+' select').attr("id", "department"+data.id);
            $('#department'+data.id+' option[value="'+data.department_id+'"]').prop('selected', true);
            $('#department'+data.id).attr('disabled', true);
            $("#statu"+data.id).prepend($('#status').clone());
            $('#statu'+data.id+' select').attr("id", "status"+data.id);
            $('#status'+data.id+' option[value="'+data.status+'"]').prop('selected', true);
            $('#status'+data.id).attr('disabled', true);

            $("#btn-add").attr('disabled', false);
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
            url: '/configuration/enseignant/'+id,
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