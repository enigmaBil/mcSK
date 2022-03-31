<!-- Add Inscription Form HTML -->
<div class="box box-primary" id="addTaskModal">
    <form id="frmAddInscription">
        <div class="box-header">
            <h4 class="modal-title">
                {{__('add payment')}}
            </h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon">{{('Inscription N°')}} <span class="required">*</span></span>
                        <input list="inscription" type="number" id="inscriptionId" class="form-control"
                               @if(isset($inscriptionId)) value={{$inscriptionId}} disabled @endif name="reduction">
                        @if(isset($inscriptions))
                            <datalist id="inscription">
                                @foreach ($inscriptions as $inscription )
                                    <option value="{{$inscription->id}}">
                                        {{$inscription->oneStudent->code}} - {{$inscription->oneStudent->last_name}} {{$inscription->oneStudent->first_name}}
                                    </option>
                                @endforeach
                            </datalist>
                        @endif
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="input-group">
                                <span class="input-group-addon">{{__('pattern')}} <span class="required">*</span> 
                                <a href="/scolarity/slice">
                                    <i class="fa fa-reply-all"></i>
                                </a> </span>

                        <select class="form-control select-payment" id="payment_reason" name="payment_reason">
                            <option value=""></option>

                            @foreach ($payment_reasons as $key=> $value)
                                <option value="{{$key}}">
                                    {{$value}}
                                </option>
                            @endforeach
                        </select>
                        <div hidden id="chowSlice">
                            <select class="form-control" id="slice_id" onchange="getAmount()" name="slice_id">
                                <option value="">Choisir une tranche</option>
                                @foreach ($slices as $slice)
                                    <option value="{{$slice->id}}">
                                        {{$slice->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon">{{__('amount')}} <span class="required">*</span> </span>
                        <input type="number" class="form-control" id="amount" name="amount">
                    </div>
                </div>

            </div>
            <br>

            <div class="modal-footer">
                <input class="btn btn-default" data-dismiss="modal" onclick="return $('#create_new_').toggle(1000);"
                       type="reset" value="{{__('cancel')}}">
                <button class="btn btn-info" id="btn-add" type="reset" value="add"
                        @if(isset($inscriptionId))onclick="create({{$inscriptionId}});"
                        @endif @if(!isset($inscriptionId)) onclick="create()"@endif>
                    {{__ ('save')}}
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    function getAmount() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/scolarity/getAmount',
            data: {
                slice_id: $("#slice_id").val(),
                inscription_id: $('#inscriptionId').val(),
                payment_reason: $("#payment_reason").val()
            },
            dataType: 'json',
            success: function (data) {
                amount = data["amount"]
                $('#amount').val(amount)
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);

                $.each(errors.messages, function (key, value) {
                    toastada.error(value + "");
                });
            }
        });
    }


    $("select.select-payment").change(function () {
        var selectedReason = $(this).children("option:selected").val();

        console.log(selectedReason);
        //console.log(c);
        if (selectedReason == 1) {
            $("#chowSlice").show();
        } else {
            $("#chowSlice").hide();
            $("#slice_id").val("").change();
        }
    });

</script>
