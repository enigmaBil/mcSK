<select onchange="reloadnotes()" class="form-control select2" id="selected_sequence">
    @foreach ($academic_year->sessions as $session)
    @foreach ($session->session->sequences as $sequence )
    @if($sequence->status==1)
    <option value={{$sequence->id}}>{{$sequence->name}}</option>
    @endif
    @endforeach
        
    @endforeach
</select>