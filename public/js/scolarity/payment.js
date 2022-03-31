function validate(id){
    coche=$("#tr"+id+" .validable").find(':first');;
        if(confirm("Cette action est irreversible:voulez vous vraiment confirmer cette action?")){
       // coche=$(".validable").find(':first');;
        coche.removeClass('fa fa-close');
        coche.addClass('glyphicon glyphicon-ok');
        $("#tr"+id).addClass("MarkLigne");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/scolarity/payment/'+id,
            data: {
               
                status:1,
                
            },
            //dataType: 'json',
            success: function(datas) {
                toastadaSuccess();               $("#tr"+id).append("<td> <a href='/scolarity/payment/print-pdf/"+id+"'><i class='fa fa-print'></i></a></td>");
               $("#tr"+id).removeClass("MarkLigne");
            },
            error: function(data) {
                toastada.error('Oups :(')
                var errors = $.parseJSON(data.responseText);
                    
                toastadaError();$.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
    };
}
function create(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/scolarity/payment',
        data: {
            amount: $("#amount").val(),
            inscription_id: id,
            status:0,
            payment_reason:$("#payment_reason").val(),

            
        },
        //dataType: 'json',
        success: function(datas) {
            data=datas["payment"];
            selector=document.getElementById('classe');
            toastada.success('inscription N°:'+id+"payment N°"+data.id+":) succes");
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
}

function create(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/scolarity/payment',
        data: {
            amount: $("#amount").val(),
            inscription_id: $("#inscriptionId").val(),
            slice_id: $("#slice_id").val(),
            status:0,
            payment_reason:$("#payment_reason").val(),
           
            

        },
        //dataType: 'json',
        success: function(datas) {
            data=datas["payment"];
            var news = "<tr id='tr"+data.id+"'> <form id="+data.id+"> <td  contenteditable='false'>"+data.name+"</a> </td>";
            $("#tbody").prepend(news);
            $("#cd"+data.id).prepend($('#head_of_department').clone());
            $('#cd'+data.id+' select').attr("id", "head_of_department"+data.id);
            $('#head_of_department'+data.id).attr('disabled', true);
           toastada.success('inscription N°:'+data.inscription_id+"payment N°"+data.id+":) succes");
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
}
