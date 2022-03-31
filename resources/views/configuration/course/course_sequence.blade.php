
<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="course_sequenceModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="">
                        <div class="modal-header">
                                <h4 class="modal-title">
                                        {{__('add this module in this classroom')}}
                                </h4>
                                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    ×
                                </button>
                        </div>
                    <div class="modal-body">
                        <div style="overflow: scroll" class="col-sm-12">
                                @foreach ($sessions as $session)
                                    <br>
                        
                                    <div class="row"> @if(count($session->sequences))
                                        <div style="color: #00a65a;font-size: large;"><b> {{"session: ".$session->name}} </b></div>@endif
                                        <br>
                                        @foreach ($session->sequences as $sequence)
                                            
                        
                                            <div>
                                                <div class="col-sm-6"> <input type="checkbox" id={{"checkbox".$sequence->id}}  >
                        
                                                    <b style="font-size: medium"> {{$sequence->name}}</b>
                                                </div>
                                                <div class="col-sm-6"><label for="percentage"> <b>{{('percentage')}}</b></label>
                                                    <input list="percentage" style="width:20%;" name="percentage" value="0" id={{"percentage".$sequence->id}} required="" type="text">%
                                                    <datalist id="percentage">
                                                        @for ($i =0 ; $i <=100 ; $i++) <option value="{{$i}}">
                                                            @endfor
                                                    </datalist>
                        
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                            <input class="btn btn-default" data-dismiss="modal" type="reset" value="{{__('cancel')}}">
                                <button class="btn btn-info" id="send_course_sequences" type="reset" >
                                        {{__('save')}}
                                </button>
                    </div>
            </form>
            </div>
        </div>
    </div>