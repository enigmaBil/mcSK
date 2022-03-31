function add(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/configuration/user',
        data: {
            name: $("#name").val(),
            email: $("#email").val(),
            username: $("#username").val(),
            phone: $("#phone").val(),
            address: $("#address").val(),
            avatar: $("#avatar").val(),
            password: $("#password").val(),
            profile_id:$("#profile").val(),
        },
        success: function(data) {
            toastada.success(data.msg);
            
            user=data["user"];

            var news = "<tr id='tr"+user.id+"'> <form id="+user.id+"> <td id='name"+user.id+"'  contenteditable='false'>";
            news +=user.name+"</td>";
            news+="<td id='email"+user.id+"' contenteditable='false'><div> "+user.email+"</div></td>";
            news+="<td id='username"+user.id+"' contenteditable='false'><div> "+user.username+"</div></td>";
            news+="<td id='phone"+user.id+"' contenteditable='false'><div> "+user.phone+"</div></td>";
            news+="<td id='address"+user.id+"' contenteditable='false'><div> "+user.address+"</div></td>";
            news+='<td id="role"'+user.id+' contenteditable="false">'+
            '<div class="id_100">'+
                '<select class="form-control select2" name="role" id="rolei'+user.id+'">'+
                    '<option value="1" > Super Administrator </option>'+
                    '<option value="2">Administrator</option>+'+
                    '<option value="3" >teacher</option>'+
                    '<option value="5" >Parent</option>'+
            '</select></div></td>';
            news+='<td><div class="form-group"><a  onclick="edit('+user.id+')"><i class="fa fa-fw fa-pencil"></i></a><a  onclick="validate('+user.id+')">';
            news+='<i class="icon fa fa-check"></i></a>';
            news+='  <a onclick="back('+user.id+',\''+user.name+'\','+user.email+','+user.username+','+user.profile_id+')">';
            news+='<i class="icon fa fa-close"></i></a>';
            news+='  <a onclick="destroy('+user.id+')">';
            news+='<i class="fa fa-fw fa-trash"></i></a></div></td> </form></tr>';
            $("#tbody").prepend(news);
            $('#rolei'+user.id+' [value="'+user.profile_id+'"]').prop('selected', true);
            $("#rolei"+user.id).attr("disabled", true);
            
        },
        error: function(data) {
            var errors = $.parseJSON(data.responseText);
            toastadaError();$.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });
        },
    });

}

function edit(id){
    $('#tr'+id).addClass('MarkLigne');

    $("#name"+id).attr('contenteditable',true);
    $("#username"+id).attr('contenteditable',true);
    $("#email"+id).attr('contenteditable',true);
    $("#phone"+id).attr('contenteditable',true);
    $("#address"+id).attr('contenteditable',true);
    $("#profile"+id).attr("disabled", false);
    toastada.info('vous pouvez modifier la ligne ');
    toastada.info("n'oubliez pas de valider");

}
function editProfile(){

    $("#name").attr('disabled',false);
    $("#email").attr('disabled',false);
    $("#phone").attr('disabled',false);
    $("#address").attr('disabled',false);
    toastada.info('vous pouvez modifier la ligne ');
    toastada.info("n'oubliez pas de valider");
    $('#validate').toggle(1000);

}

function validate(id, msg){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name"+id).attr('contenteditable',false);
    $("#username"+id).attr('contenteditable', false);
    $("#email"+id).attr('contenteditable', false);
    $("#phone"+id).attr('contenteditable', false);
    $("#address"+id).attr('contenteditable', false);
    $("#profile"+id).attr("disabled", true);
    
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/configuration/user/' + id,
            data: {
                name: $("#name"+id).text(),
                username: $("#username"+id).text(),
                email: $("#email"+id).text(),
                phone: $("#phone"+id).text(),
                address: $("#address"+id).text(),
                profile_id:$("#profile"+id).val(),
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info(msg);
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                toastadaError();$.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
}

function validateProfile(id, msg){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name").attr('disabled',true);
    $("#email").attr('disabled', true);
    $("#phone").attr('disabled', true);
    $("#address").attr('disabled', true);    
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/configuration/user/' + id,
            data: {
                name: $("#name").val(),
                username: $("#username"+id).val(),
                email: $("#email").val(),
                phone: $("#phone").val(),
                address: $("#address").val(),
                profile_id:$("#profile").val(),
            },
            dataType: 'json',
            success: function(data) {
             toastada.info(msg);
             $('#validate').toggle(1000);
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
            url: '/configuration/user/' + id,
            data: {
                
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info('supprimé avec succes');
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

function back(id,name,email,username,phone, address, profileId){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name").text(name);
    $("#username").text(username);
    $("#email").text(email);
    $("#phone").text(phone);
    $("#address").text(address);
validateProfile(id, 'Mise à jour annulée');
}


function changePassword(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'PUT',
        url: '/configuration/changePassword/',
        data: {
            password: $("#password").val(),
            newPassword: $("#newPassword").val(),
            confirmPassword: $("#confirmPassword").val(),
        },
        success: function(data) {
            toastadaSuccess();        },
        error: function(data) {
            var errors = $.parseJSON(data.responseText);
            toastadaError();$.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });
        },

    });
}
