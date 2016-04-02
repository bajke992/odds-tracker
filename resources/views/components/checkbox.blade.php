<input type="checkbox" class="filled-in" id="filled-in-box-{{$id}}" data-id="{{ $id }}"
       @if(isset($checked) && $checked == \App\Models\Match::MY_GAMES_YES)checked="checked"@endif />
@if(isset($label))<label for="filled-in-box-{{$id}}">{{ $label }}</label>@endif