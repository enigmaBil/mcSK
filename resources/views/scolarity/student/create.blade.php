<form id="frmEditStudent">
                <div class="col">
                                <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                                <li class="active"><a href="#personnal" data-toggle="tab" aria-expanded="true">{{__('personnal')}}</a></li>
                                            <li class=""><a href="#father" data-toggle="tab" aria-expanded="false">Information du père</a></li>
                                            <li class=""><a href="#mother" data-toggle="tab" aria-expanded="false">Information de la mère</a></li>
                                                <li class=""><a href="#tutor" data-toggle="tab" aria-expanded="false">{{__('tutor_informations')}}</a></li>
                                        <li class=""><a href="#administrative" data-toggle="tab" aria-expanded="false">{{__('administrative')}}</a></li>
                                        </ul>
                                        <div class="tab-content">
                                        
                                                <div class="tab-pane active" id="personnal" autofocus>

                                                        <div class="box-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    {{__('last name')}} <span class="required">*</span>
                                                                                </label>
                                                                                <input class="form-control" id="createlast_name"  >
                                                                            </div>
                                                                                <div class="form-group">
                                                                                        <label>
                                                                                                {{__('birth_date')}} <span class="required">*</span>
                                                                                        </label>
                                                                                        <input id="createbirth_date" class="form-control"   required="" type="date">
                                                                                </div>

                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Lieu de résidence <span class="required">*</span>
                                                                                </label>
                                                                                <input class="form-control" id="residence_place"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Région d'origine
                                                                                </label>
                                                                                <input class="form-control" id="region_of_origin"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Diplôme présenté à la préinscription
                                                                                </label>
                                                                                <input class="form-control" id="present_diploma"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Dernier établissement fréquenté
                                                                                </label>
                                                                                <input class="form-control" id="previous_school"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Première langue
                                                                                </label>
                                                                                <input class="form-control" id="first_language"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Activité professionnelle
                                                                                </label>
                                                                                <input id="professional_activity" class="form-control"    type="text">
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    {{__('first name')}}
                                                                                </label>
                                                                                <input class="form-control" id="createfirst_name" >
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>
                                                                                    {{__('birth_place')}} <span class="required">*</span>
                                                                                </label>
                                                                                <input id="createbirth_place" class="form-control"   required="" type="text">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Statut matrimonial
                                                                                </label>
                                                                                <input class="form-control" id="marital_status"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Département d'origine
                                                                                </label>
                                                                                <input class="form-control" id="department_of_origin"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Année de l'obtention
                                                                                </label>
                                                                                <input class="form-control" id="year_obtained" type="number" >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Année de sortie
                                                                                </label>
                                                                                <input class="form-control" id="release_year"  type="number" >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Deuxième langue
                                                                                </label>
                                                                                <input class="form-control" id="second_language"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    {{__('gender')}}
                                                                                </label>
                                                                                <select class="form-control" name="createSex" id="createSex">
                                                                                    <option value="M">{{__('masculin')}} </option>
                                                                                    <option value="F">{{__('Feminin')}} </option>
                                                                                </select>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Adresse email
                                                                                </label>
                                                                                <input class="form-control" id="email_address"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    {{__('nationality')}} <span class="required">*</span>
                                                                                </label>
                                                                                <input id="createnationality" class="form-control"   required="" type="text">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>
                                                                                    {{__('particular disease')}}
                                                                                </label>
                                                                                <input id="createparticular_disease" class="form-control"   required="" type="text">
                                                                            </div>


                                                                            <div class="form-group">
                                                                                <label>
                                                                                    {{__('phone')}}
                                                                                </label>
                                                                                <input id="createtelephone" class="form-control"   required="" type="number">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Pays de l'obtention
                                                                                </label>
                                                                                <input class="form-control" id="country_obtained"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Diplôme obtenu
                                                                                </label>
                                                                                <input class="form-control" id="diploma_obtained"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Autre langue(s)
                                                                                </label>
                                                                                <input class="form-control" id="other_languages"  >
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    Liens avec son tuteur(Optionnel)
                                                                                </label>
                                                                                <input id="relationship_with_teacher" class="form-control"    type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                        </div>
                                                </div>
                                                <div class="tab-pane" id="administrative">
                                                                <div class="box-body">
                                                                                <div class="row">
                                                                                                <div class="col-sm-4">
                                                                                                        <div class="form-group">
                                                                                                                <label>
                                                                                                                        {{__('code')}}<span class="required">*</span>
                                                                                                                </label>
                                                                                                                <input class="form-control" id="createcode" >
                                                                                                        </div>
                                                                                                        <div >
                                                                                                                        <label>
                                                                                                                                {{__('chosen discipline')}}<span class="required">*</span>
                                                                                                                        </label>
                                                                                                                        <select name="" id="createchosen_discpiline" class="select2" style="width: 400px;"  >
                                                                                                                                @foreach ($disciplines as $discipline )
                                                                                                                                <option value="{{$discipline->id}}" >{{$discipline->oneDepartment->name}} : {{$discipline->name}}</option>
                                                                                                                                @endforeach
                                                                                                                        
                                                                                                                        </select>
                                                                                                                </div>
                                                                                                        <div class="form-group">
                                                                                                                <label>
                                                                                                                        {{__('assurance')}} <span class="required">*</span>
                                                                                                                </label>
                                                                                                                <span id ="createassurance" class="fa fa-close">

                                                                                                                </span>
                                                                                                        </div>
                                                                                                     {{--   <div class="form-group">
                                                                                                                <label>
                                                                                                                        {{__('entrance diploma')}}
                                                                                                                </label>
                                                                                                                <input class="form-control" id="createentrance_diploma" >
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                                <label>
                                                                                                                        {{__('entrance diploma year')}}
                                                                                                                </label>
                                                                                                                <input class="form-control" type="date" id="createentrance_diploma_year" >
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                                <label>
                                                                                                                        {{__('diploma average')}}
                                                                                                                </label>
                                                                                                                <input class="form-control" id="creatediploma_average" >
                                                                                                        </div> --}}
                                                                                                        <div class="modal-footer">
                                                                                                                        <input class="btn btn-default" data-dismiss="modal" type="reset" value="{{__('cancel')}}">
                                                                                                                        <button class="btn btn-info" onclick="add()" id="btn-createStudent" type="button">
                                                                                                                                {{__('save')}}
                                                                                                                        </button>
                                                                                                        </div>                                                                   
                                                                                                </div>
                                                                                
                                                                                </div>
                                                                </div>
                                                
                                                </div>
                                                <div class="tab-pane" id="tutor">
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>
                                                                        {{__('name')}}<span class="required">*</span>
                                                                    </label>
                                                                    <input class="form-control" id="tutor_name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>
                                                                        Ville
                                                                    </label>
                                                                    <input class="form-control" id="tutor_town" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>
                                                                        {{__('phone')}} 1
                                                                    </label>
                                                                    <input class="form-control" id="tutor_phone_1" type="number" >
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>
                                                                        Activité professionnelle
                                                                    </label>
                                                                    <input class="form-control" id="tutor_professional_activity" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>
                                                                        Adresse
                                                                    </label>
                                                                    <input class="form-control" id="tutor_address" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>
                                                                        {{__('phone')}} 2
                                                                    </label>
                                                                    <input class="form-control" id="tutor_phone_2" type="number" >
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            <div class="tab-pane" id="father">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    {{__('name')}}<span class="required">*</span>
                                                                </label>
                                                                <input class="form-control" id="father_name" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>
                                                                    Ville
                                                                </label>
                                                                <input class="form-control" id="father_town" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>
                                                                    {{__('phone')}} 1
                                                                </label>
                                                                <input class="form-control" id="father_phone_1" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    Activité professionnelle
                                                                </label>
                                                                <input class="form-control" id="father_profession" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>
                                                                    Adresse
                                                                </label>
                                                                <input class="form-control" id="father_address" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>
                                                                    {{__('phone')}} 2
                                                                </label>
                                                                <input class="form-control" id="father_phone_2" >
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane" id="mother">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    {{__('name')}}<span class="required">*</span>
                                                                </label>
                                                                <input class="form-control" id="mother_name" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>
                                                                    Ville
                                                                </label>
                                                                <input class="form-control" id="mother_town" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>
                                                                    {{__('phone')}} 1
                                                                </label>
                                                                <input class="form-control" id="mother_phone_1" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    Activité professionnelle
                                                                </label>
                                                                <input class="form-control" id="mother_profession" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>
                                                                    Adresse
                                                                </label>
                                                                <input class="form-control" id="mother_address" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>
                                                                    {{__('phone')}} 2
                                                                </label>
                                                                <input class="form-control" id="mother_phone_2" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                

                                        </div>
                                </div>
                </div>
</form>
