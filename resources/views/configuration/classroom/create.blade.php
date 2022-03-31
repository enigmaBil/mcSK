
<div class="modal fade" id="createClassModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <h4 class="modal-title">{{__(' add a new classroom')}} </h4>
                <div class="modal-body">
                    <div class="col-sm-6">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label >{{__('chose a level')}}</label>
                                <select name="" id="addLevel">
                                       
                                </select>
                                <a href="/configuration/level_study"> <i class="fa fa-reply-all"></i></a>
                            </div>
                            <div class="form-group">
                                <label>
                                        {{__('price of education')}}
                                </label>
                                <input class="form-control"   value="0" id="leveleducation" required="" type="text">
                            </div>
                            <div class="form-group">
                                <label>
                                        {{__('price of inscription')}}
                                </label>
                                <input value="0" class="form-control" id="levelinscription"  required="" type="text">
                            </div>
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
                    <div class="box-footer">
                        <input class="btn btn-default" onclick="return $('#create_new_').toggle(1000);" type="reset" value="Annuler"> <tr>
                        <button class="btn btn-info" id="btnCreateClass"  type ="reset" type="button" >
                            {{__('save')}}
                        </button>
                    </div>
                </div>        
            </div>
        </div>
</div>

















                   
      

















