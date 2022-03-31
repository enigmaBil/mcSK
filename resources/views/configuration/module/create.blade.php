<!-- Add module Form HTML -->
    <div class="box box-primary" id="addTaskModal">
            <div class="box-header">
                    <h4 class="modal-title">
                            {{__('add module')}}
                    </h4>
                </div>
            <div class="box-body">
                <form id="frmAddTask">
                    <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group">
                                <span class="input-group-addon">{{__('name')}}</span>
                                        <input type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                <span class="input-group-addon">{{__('description')}}</span>
                                        <input type="text" class="form-control" placeholder="{{__('enter....')}}">
                                </div>
                            </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="button" value="Annuler"> <tr>
                            <button class="btn btn-info" id="btn-add" type="button" value="add">
                                    {{__('add a module')}}
                            </button>
                    </div>
            </form>
    </div>
  </div>

@section('js')
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
});

$(document).ready(function() {
    $("#btn-add").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/',
            data: {
                task: $("#frmAddTask input[name=task]").val(),
                description: $("#frmAddTask input[name=description]").val(),
            },
            dataType: 'json',
            success: function(data) {
                $('#frmAddTask').trigger("reset");
                $("#frmAddTask .close").click();
                window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                $('#add-task-errors').html('');
                $.each(errors.messages, function(key, value) {
                    $('#add-task-errors').append('<li>' + value + '</li>');
                });
                $("#add-error-bag").show();
            }
        });
    })

});
    function addTaskForm() {
    $(document).ready(function() {
        $("#add-error-bag").hide();
        $('#addTaskModal').modal('show');
    });
}
</script>
@endsection