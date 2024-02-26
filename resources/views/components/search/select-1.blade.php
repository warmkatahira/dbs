<label for="{{ $id }}" class="text-sm text-center bg-theme-main text-white mt-2">{{ $label }}</label>
<select id="{{ $id }}" name="{{ $id }}" class="text-sm py-0 whitespace-normal">
    <option value="" @if(is_null(session($id))) selected @endif></option>
    @foreach($searchConditions as $search_condition)
        <option value="{{ $search_condition->$value }}" @if(!is_null(session($id)) && $search_condition->$value == session($id)) selected @endif>{{ $search_condition->$text }}</option>
    @endforeach
</select>