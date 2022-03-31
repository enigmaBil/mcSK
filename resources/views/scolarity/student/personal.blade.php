
<!-- Add Task Modal Form HTML -->
<div class="modal fade" id="editStudent">
    <div class="modal-dialog" style="min-width: 75%">
        <div class="modal-content">
            <form id="frmEditStudent" >
                <div class="modal-header">
                    <h4 class="modal-title">
                            {{__('studentDescription')}}
                    </h4>
                    <button aria-hnameden="true" class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"  id="editStudent-error">

                    </div>
                    <span class="user-header">
                            <div class="kv-avatar">
                                    <div class="file-loading">
                                        <input id="input-b1" name="photo" type="file" required>
                                    </div>
                                </div>
                    </span>
                    <div class="row">
                        <h3 style="border-bottom:1px solid lightskyblue; font-weight: bold; text-align: center; color:deepskyblue; margin:15px">{{__('personnal')}}</h3>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    {{__('last name')}} <span class="required">*</span>
                                </label>
                                <input class="form-control" name="last_name"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    {{__('birth_date')}} <span class="required">*</span>
                                </label>
                                <input name="birth_date" class="form-control"   required="" type="date">
                            </div>

                            <div class="form-group">
                                <label>
                                    Lieu de résnameence <span class="required">*</span>
                                </label>
                                <input class="form-control" name="student_residence"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    Région d'origine
                                </label>
                                <input class="form-control" name="region_of_origin"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    Diplôme présenté à la préinscription
                                </label>
                                <input class="form-control" name="present_diploma"  readonly>
                            </div>
                            <div class="form-group">
                                <label>
                                    Dernier établissement fréquenté
                                </label>
                                <input class="form-control" name="previous_school"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    Première langue
                                </label>
                                <input class="form-control" name="first_language"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    Activité professionnelle
                                </label>
                                <input name="professional_activity" class="form-control"    type="text">
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    {{__('first name')}}
                                </label>
                                <input class="form-control" name="first_name"  >
                            </div>

                            <div class="form-group">
                                <label>
                                    {{__('birth_place')}} <span class="required">*</span>
                                </label>
                                <input name="birth_place" class="form-control"   required="" type="text">
                            </div>

                            <div class="form-group">
                                <label>
                                    Statut matrimonial
                                </label>
                                <input class="form-control" name="marital_status"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    Département d'origine
                                </label>
                                <input class="form-control" name="department_of_origin"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    Année de l'obtention
                                </label>
                                <input class="form-control" name="diploma_year_obtained" type="number" readonly>
                            </div>
                            <div class="form-group">
                                <label>
                                    Année de sortie
                                </label>
                                <input class="form-control" name="release_year_prev_school"  type="number" >
                            </div>
                            <div class="form-group">
                                <label>
                                    Deuxième langue
                                </label>
                                <input class="form-control" name="second_language"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    {{__('gender')}}
                                </label>
                                <select class="form-control" name="sex" id="createSex">
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
                                <input class="form-control" name="student_email"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    {{__('nationality')}} <span class="required">*</span>
                                </label>
                                <input name="nationality" class="form-control"   required="" type="text">
                            </div>

                            <div class="form-group">
                                <label>
                                    {{__('particular disease')}}
                                </label>
                                <input name="particular_disease" class="form-control"   required="" type="text">
                            </div>


                            <div class="form-group">
                                <label>
                                    {{__('phone')}}
                                </label>
                                <input name="telephone" class="form-control"   required="" type="number">
                            </div>
                            <div class="form-group">
                                <label>
                                    Pays de l'obtention
                                </label>
                                <input class="form-control" name="country_obtained_diploma"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    Diplôme obtenu
                                </label>
                                <input class="form-control" name="diploma_obtained"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    Autre langue(s)
                                </label>
                                <input class="form-control" name="other_languages"  >
                            </div>
                            <div class="form-group">
                                <label>
                                    Liens avec son tuteur(Optionnel)
                                </label>
                                <input name="relationship_with_teacher" class="form-control"    type="text">
                            </div>
                        </div>

                        <h3 style="border-bottom:1px solid lightskyblue; font-weight: bold; text-align: center; color:deepskyblue; margin:15px">Information du père</h3>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    {{__('name')}}<span class="required">*</span>
                                </label>
                                <input class="form-control" name="father_name">
                            </div>
                            <div class="form-group">
                                <label>
                                    Adresse
                                </label>
                                <input class="form-control" name="father_address" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    Activité professionnelle
                                </label>
                                <input class="form-control" name="father_profession" >
                            </div>
                            <div class="form-group">
                                <label>
                                    {{__('phone')}} 1
                                </label>
                                <input class="form-control" name="father_phone_1" type="number" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    Ville
                                </label>
                                <input class="form-control" name="father_town" >
                            </div>
                            <div class="form-group">
                                <label>
                                    {{__('phone')}} 2
                                </label>
                                <input class="form-control" name="father_phone_2" type="number" >
                            </div>
                        </div>

                        <h3 style="border-bottom:1px solid lightskyblue; font-weight: bold; text-align: center; color:deepskyblue; margin:15px">Information de la mère</h3>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    {{__('name')}}<span class="required">*</span>
                                </label>
                                <input class="form-control" name="mother_name">
                            </div>
                            <div class="form-group">
                                <label>
                                    Adresse
                                </label>
                                <input class="form-control" name="mother_address" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    Activité professionnelle
                                </label>
                                <input class="form-control" name="mother_profession" >
                            </div>
                            <div class="form-group">
                                <label>
                                    {{__('phone')}} 1
                                </label>
                                <input class="form-control" name="mother_phone_1" type="number" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    Ville
                                </label>
                                <input class="form-control" name="mother_town" >
                            </div>
                            <div class="form-group">
                                <label>
                                    {{__('phone')}} 2
                                </label>
                                <input class="form-control" name="mother_phone_2" type="number" >
                            </div>
                        </div>

                        <h3 style="border-bottom:1px solid lightskyblue; font-weight: bold; text-align: center; color:deepskyblue; margin:15px">{{__('tutor_informations')}}</h3>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    {{__('name')}}<span class="required">*</span>
                                </label>
                                <input class="form-control" name="tutor_name">
                            </div>
                            <div class="form-group">
                                <label>
                                    Adresse
                                </label>
                                <input class="form-control" name="tutor_address" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    Activité professionnelle
                                </label>
                                <input class="form-control" name="tutor_professional_activity" >
                            </div>
                            <div class="form-group">
                                <label>
                                    {{__('phone')}} 1
                                </label>
                                <input class="form-control" name="tutor_phone_1" type="number" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    Ville
                                </label>
                                <input class="form-control" name="tutor_town" >
                            </div>
                            <div class="form-group">
                                <label>
                                    {{__('phone')}} 2
                                </label>
                                <input class="form-control" name="tutor_phone_2" type="number" >
                            </div>
                        </div>

                        <h3 style="border-bottom:1px solid lightskyblue; font-weight: bold; text-align: center; color:deepskyblue; margin:15px">{{__('administrative')}}</h3>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>
                                    {{__('code')}}<span class="required">*</span>
                                </label>
                                <input class="form-control"  name="code" readonly >
                            </div>

                        </div>
                        <div class="col-sm-4">
                                <div >
                                    <label>
                                        {{__('chosen discipline')}}<span class="required">*</span>
                                    </label>
                                    <select name="chosen_discipline"  class="select2" style="width: 400px;"  disabled="disabled">
                                        @foreach ($disciplines as $discipline )
                                            @if(isset($student))
                                                <option @if($discipline->id==$student->chosen_discipline)selected @endif value="{{$discipline->id}}">{{$discipline->oneDepartment->name}} : {{$discipline->name}}</option>
                                            @else
                                                <option value="{{$discipline->id}}">{{$discipline->oneDepartment->name}} : {{$discipline->name}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        <div class="col-sm-4">
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-default" data-dismiss="modal" type="reset" value="{{__('cancel')}}">
                        <button  class="btn btn-info" id="btn-editStudent" type="button">
                                {{__('saveModifications')}}
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>
