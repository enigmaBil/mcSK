
@php
    $totalDebt = 0;
@endphp
            <table  class="table table-bordered table-striped debtorsTable">
                <thead>
                <tr>
                    <th>Année scolaire</th>
                    <th>Nom de l'étudiant</th>
                    <th>{{__('matricule')}}</th>
                    <th>{{__('discipline')}}</th>
                    <th>{{__('level')}}</th>
                    <th>{{__('rest')}}</th>
                </tr>
                </thead>
                <tbody>

                @if(!$academic_year_id && !$level_id)
                    @foreach ($irregularStudents as $inscription)
                        <tr>
                            <td contenteditable="false">{{$inscription->oneAcademic_year->name}}</td>
                            <td contenteditable="false">{{$inscription->oneStudent->last_name}} {{$inscription->oneStudent->first_name}}</td>
                            <td contenteditable="false">{{$inscription->oneStudent->code}} </td>
                            <td contenteditable="false">{{$inscription->oneClass->oneDiscipline->name}}</td>
                            <td contenteditable="false"  >{{$inscription->oneClass->oneLevel->name}}</td>
                            <td contenteditable="false">{{number_format($inscription->rest, 2, ',', ' ')}}</td>
                            @php
                                $totalDebt += $inscription->rest
                            @endphp
                        </tr>
                    @endforeach
                    <tr>
                        <form>
                            <td contenteditable="false"style="font-size: 16px;font-weight:bold;border-right: none" >Montant total</td>
                            <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                            <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalDebt, 2, ',', ' ')}}</td>
                        </form>
                    </tr>
                @endif
                    @if($academic_year_id && !$level_id)
                        @foreach ($irregularStudents as $inscription)
                            @if($inscription->oneAcademic_year->id == $academic_year_id)
                                <tr>
                                    <td contenteditable="false">{{$inscription->oneAcademic_year->name}}</td>
                                    <td contenteditable="false">{{$inscription->oneStudent->last_name}} {{$inscription->oneStudent->first_name}}</td>
                                    <td contenteditable="false">{{$inscription->oneStudent->code}} </td>
                                    <td contenteditable="false">{{$inscription->oneClass->oneDiscipline->name}}</td>
                                    <td contenteditable="false"  >{{$inscription->oneClass->oneLevel->name}}</td>
                                    <td contenteditable="false">{{number_format($inscription->rest, 2, ',', ' ')}}</td>
                                    @php
                                        $totalDebt += $inscription->rest
                                    @endphp

                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <form>
                                <td contenteditable="false"style="font-size: 16px;font-weight:bold;border-right: none" >Montant total</td>
                                <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                                <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalDebt, 2, ',', ' ')}}</td>
                            </form>
                        </tr>
               @endif
                @if(!$academic_year_id && $level_id)
                    @foreach ($irregularStudents as $inscription)
                        @if($inscription->oneClass->oneLevel->id == $level_id)
                            <tr>
                                <td contenteditable="false">{{$inscription->oneAcademic_year->name}}</td>
                                <td contenteditable="false">{{$inscription->oneStudent->last_name}} {{$inscription->oneStudent->first_name}}</td>
                                <td contenteditable="false">{{$inscription->oneStudent->code}} </td>
                                <td contenteditable="false">{{$inscription->oneClass->oneDiscipline->name}}</td>
                                <td contenteditable="false"  >{{$inscription->oneClass->oneLevel->name}}</td>
                                <td contenteditable="false">{{number_format($inscription->rest, 2, ',', ' ')}}</td>
                                @php
                                    $totalDebt += $inscription->rest
                                @endphp

                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <form>
                            <td contenteditable="false"style="font-size: 16px;font-weight:bold;border-right: none" >Montant total</td>
                            <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                            <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalDebt, 2, ',', ' ')}}</td>
                        </form>
                    </tr>
                @endif
                 @if($level_id && $academic_year_id)
                    @foreach ($irregularStudents as $inscription)
                        @if($inscription->oneClass->oneLevel->id == $level_id && $inscription->oneAcademic_year->id == $academic_year_id)
                            <tr>
                                <td contenteditable="false">{{$inscription->oneAcademic_year->name}}</td>
                                <td contenteditable="false">{{$inscription->oneStudent->last_name}} {{$inscription->oneStudent->first_name}}</td>
                                <td contenteditable="false">{{$inscription->oneStudent->code}} </td>
                                <td contenteditable="false">{{$inscription->oneClass->oneDiscipline->name}}</td>
                                <td contenteditable="false"  >{{$inscription->oneClass->oneLevel->name}}</td>
                                <td contenteditable="false">{{number_format($inscription->rest, 2, ',', ' ')}}</td>
                                @php
                                    $totalDebt += $inscription->rest
                                @endphp

                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <form>
                            <td contenteditable="false"style="font-size: 16px;font-weight:bold;border-right: none" >Montant total</td>
                            <td style="border-right: none"></td><td style="border-right: none"></td><td style="border-right: none"></td><td></td>
                            <td contenteditable="false" style="font-size: 15px;font-weight:bold">{{number_format($totalDebt, 2, ',', ' ')}}</td>
                        </form>
                    </tr>
                @endif



                </tbody>
            </table>
