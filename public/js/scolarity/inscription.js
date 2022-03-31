$(document).ready(function(){
   
})
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
            url: '/scolarity/inscription/'+id,
            data: {
               
                status:1,
                
            },
            //dataType: 'json',
            success: function(datas) {
                toastadaSuccess();               $("#tr"+id).append("<td> <a href='/scolarity/inscription/print-pdf/"+id+"'><i class='fa fa-print'></i></a></td>");
               $("#tr"+id).removeClass("MarkLigne");
            },
            error: function(data) {
                toastada.error('Oups :(')
                var errors = $.parseJSON(data.responseText);
                    
                toastadaError(); $.each(errors.messages,function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
    };
}
function create(){
    rest=0+ $("#amount_education").val() ; 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/scolarity/inscription',
        data: {
            reduction: $("#reduction").val(),
            creation_date: $("#date").val(),
            discipline_level_study_id:$("#classe").val(),
            academic_year_id:$("#academic_year").val(),
            student_id:$("#student_id").val(),
            rest:rest,
            status:0,
            code:"1",
            
        },
        //dataType: 'json',
        success: function(datas) {
            data=datas["inscription"];
            selector=document.getElementById('classe');
            inscriptionId=selector.selectedIndex;
           text=selector.options[inscriptionId].text;
           toastada.success('the new inscription in class:'+text+"has been done successfully with the number"+data.id);
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
function addCourse(){
    moduleId=$("#Courseadd-error-bag").text();
   
        

}