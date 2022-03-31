
function edit(){
    alert("we are inside ")
    $(".editable").attr("contenteditable" ,true);
    $('.editable').addClass('MarkLigne');

}
$(document).ready(function(){
})
function reload(){
    reloader='<i class="fa fa-refresh fa-spin" style="font-size:24px"></i>';
    $("#reloader").html(reloader);
    loader='<div>'
    loader+='<div class="row text-center">'
    loader+='<div class = "centered">'
    loader+='<div class = "blob-1"></div>'
    loader+='<div class = "blob-2"></div>'
    loader+='</div>';
    $('#loader').html(loader);    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('')
        }
    });
    $.ajax({
        type: 'GET',
        url: '/mark/marks/'+$('#course').val()+'/'+$('#academic_year').val(),
        data: {
                  },
        dataType: 'html',
        success: function(data) {
            ok='<i class="glyphicon glyphicon-thumbs-up"> </i>';
          toastada.success(ok)
          
          $("#all_notes").html(data);
          $("#loader").html('');
          $("#reloader").html('<i  style="font-size:24px" class="glyphicon glyphicon-repeat"></i>')

        },
        error: function(data) {
            nope='<i class="glyphicon glyphicon-thumbs-down"> </i>';
            toastada.error(nope);
            $("#loader").html('');
            $("#reloader").html('<i  style="font-size:24px" class="glyphicon glyphicon-repeat"></i>')
        }
    });
    
}

function validate(course_id,class_id){
        $(".editable").attr("contenteditable" ,false);

    $('.editable').removeClass('MarkLigne');
    notes=[]
    students.forEach(function(value,index,array) {
        $( "#"+value+" > .editable" ).each(function( value,index,array ) {
            a=parseFloat($( this).text());
            
            notes.push({"note": ""+a,"student_id":$( this).attr("student_id"),
        "sequence_id":$( this).attr("sequence_id"),
        "session_academic_year_id":$( this).attr("session_id"),
        "course_id":$( this).attr("course_id")})
           
    
            });
    });console.log(notes);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/mark/mark',
        data: {
          notes:notes,
          class_id:class_id,
          course_id:course_id,
        },
        dataType: 'json',
        success: function(data) {
            ok='<i class="glyphicon glyphicon-thumbs-up"> </i>';
            toastada.success(ok)
           
        },
        error: function(data) {
            
          nope='<i class="glyphicon glyphicon-thumbs-down"> </i>';
          toastada.error(nope);
            var errors = $.parseJSON(data.responseText);
            
            $.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });
        }
    });
    reload();
}