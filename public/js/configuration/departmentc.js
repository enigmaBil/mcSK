$(document).ready(function(){

});
function edit(id, msg){
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
function validate(id, msg){
    $("#name"+id).attr('contenteditable',false);
    $("#scolarity"+id).attr('contenteditable',false);
    $("#status"+id).unbind('click');

    statuse=0;
        coche=$("#status"+id).find(':first');
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
            url: '/configuration/department/' + id,
            data: {
                name: $("#name"+id).text(),
                scolarity: $("#scolarity"+id).text(),
                status: statuse,
            },
            dataType: 'json',
            success: function(data) {
             toastada.info(msg);

              //  $('#frmEditTask').trigger("reset");
        // window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                $.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
}
function back(id,name,scolarity,status){
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
    $("#scolarity"+id).text(scolarity);
    msg='Mise à jour annulée'
    validate(id, msg);
}

function add(){
    console.log($("#name").val()+"addin"+$("#scolarity").val());
    
    $.ajax({		
	 url: "/configuration/department",
        type: "POST",
		method : "post",
        data: {			
			"_token": $('meta[name="csrf-token"]').attr('content'),
            name: $("#name").val(),
            scolarity: $("#scolarity").val(),
            status:0,
        },
		headers: { 'CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		datatType : 'json',
		cache: false,
		contentType: false,
		processData: false, 
		
        success: function(data) {
			
            toastada.success(data.msg);
 
           // datae=JSON.parse(datas);
            data=data["department"];
            var news = "<tr id='tr"+data.id+"'> <form id="+data.id+"> <td  contenteditable='false'>";
            news +="<a id='name"+data.id+"' href='/configuration/department/discipline/"+data.id+"') }}'>";
            news+=data.name+"</a> </td>";
            news+="<td id='scolarity"+data.id+"' contenteditable='false'><div> "+data.scolarity+"</div></td>";
            news+="<td contenteditable='false'> <a  id='status"+data.id+"'><i class='icon fa fa-eye-slash'></i> </a></td>";
            news+='<td><div class="form-group"><a  onclick="edit('+data.id+')"><i class="fa fa-fw fa-pencil"></i></a><a  onclick="validate('+data.id+', \'Mise à jour effectuée avec succès\' )">';
            news+='<i class="icon fa fa-check"></i></a>';
            news+='  <a onclick="back('+data.id+',\''+data.name+'\','+data.scolarity+','+data.status+')">';
            news+='<i class="icon fa fa-reply"></i></a>';
            news+='  <a onclick="destroy('+data.id+')">';
            news+='<i class="fa fa-fw fa-trash"></i></a></div></td> </form></tr>';


            $("#tbody").prepend(news);
            //**********ajout de la nouvelle valeur dans le tableau

        },
        error: function(data) {
			console.log (data);
            /*var errors = JSON.parse(data.responseText);
               toastada.error(data.responseText) ;
            $.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });*/
        }
    });

}

function destroy(id){
    if(confirm("Voulez vous vraiment supprimer cet élément")){
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
            dataType: 'json',
            success: function(data) {
             toastada.info(data.msg);
             $("#tr"+id).remove();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                $.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
    }
}