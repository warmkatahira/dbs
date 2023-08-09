<div class="flex text-sm bg-gray-600 py-1 text-white pl-5">
    <p>{{ $label }}@if($tippy != 0)<i class="lar la-question-circle la-lg ml-1 {{ $tippy }}"></i>@endif</p>
    @if($required == 1)
        <span class="text-red-600 text-xs bg-red-100 text-center px-2 py-0.5 ml-auto mr-2">必須</span>
    @endif
</div>
<div class="border px-10 py-5">
    <select name="{{ $id }}" class="text-sm w-96">
        @foreach($forValue as $for)
            <option value="{{ $for->$forId }}" @if($for->$forId == old($id, $db)) selected @endif>{{ $for->$forText }}</option>
        @endforeach
    </select>
</div>