<table id="example2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>N°</th>
                <th>{{__('student')}}</th>
                <th>{{__('status')}}</th>
                <th>{{__('discipline')}}</th>
                <th>{{__('level')}}</th>
                <th>{{__('inscriptionDate')}}</th>
                <th>{{__('report_card')}}</th>
            </tr>
        </thead>
        
        <tbody id='tbody'>
            @foreach ($inscriptions as $inscription)

            <tr id={{"tr".$inscription->id}}>

                <form id={{"frmEditinscription".$inscription->id}}>
                    <td contenteditable="false">{{$inscription->id}}</td>
                    <td>
                        {{$inscription->oneStudent->code}} : {{$inscription->oneStudent->first_name}}
                        {{$inscription->oneStudent->last_name}}
                    </td>
                    <td class="validable">
                        @php
                        if ($inscription->status==1)
                        echo '<span class="glyphicon glyphicon-ok"></span>';
                        else {
                        echo '<i onclick="validate('.$inscription->id.')" class=" icon fa fa-close"></i>';
                        }
                        @endphp


                    </td>
                    <td contenteditable="false">{{$inscription->oneClass->oneDiscipline->name}}</td>
                    <td contenteditable="false">{{$inscription->oneClass->oneLevel->name}}</td>

                    <td>{{$inscription->creation_date}}</td>
                    <td>
                        <a href="{{ route('report_card.reportcard',$inscription->id) }}" title="{{__('goto_report_card')}}">
                            <i class="fa fa-mail-forward "></i>
                        </a>
                    </td>

                </form>
            </tr>
            @endforeach
        </tbody>
    </table>