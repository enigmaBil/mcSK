                 
      
<div class="" id="addTaskModal">
        <form id="frmAddInscription" >
            <h4 class="modal-title">{{__(' add a new classroom')}} </h4>
            <div class="box box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label >{{__('chose a level')}}</label>
                            <select name="" id="addLevel">
                                @foreach ($allLevels as $level)
                                    @if($discipline_level->is_it_in($levels["id"],$level->id)==false)
                                        <option value="{{$level->id}}">
                                            {{$level->name}}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <a href="/configuration/level_study"> <i class="fa fa-reply-all"></i></a>
                        </div>
                        <div class="form-group">
                            <label>{{__('education amount')}}</label>
                            <input class="form-control"   value="0" id="leveleducation" required="" type="number">
                        </div>
                        <div class="form-group">
                            <label>
                                {{__('inscription amount')}}
                            </label>
                            <input value="0" class="form-control" id="levelinscription"  required="" type="number">
                        </div>
                    </div>
                
                <div class="col-sm-6">
                        @foreach ($slices as $slice)
                            <label>
                                {{$slice->name}}
                            </label>
                        <input class="form-control"   value="0" id={{"amount".$slice->id}} required="" type="text">
                        @endforeach
                    </div>
                </div>
                <div class="box-footer">
                    <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="reset" value="Annuler"> <tr>
                    <button class="btn btn-info"  type ="button" onclick="addclass({{$levels['id']}}, {{$slices}})" type="reset" >
                        {{__('save')}}
                    </button>
                </div>
            </div>        
        </form>
</div>