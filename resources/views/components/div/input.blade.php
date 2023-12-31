<div class="flex text-sm bg-gray-600 py-1 text-white pl-5">
    <p>{{ $label }}@if($tippy != 0)<i class="lar la-question-circle la-lg ml-1 {{ $tippy }}"></i>@endif</p>
    @if($required == 1)
        <span class="text-red-600 text-xs bg-red-100 text-center px-2 py-0.5 ml-auto mr-2">必須</span>
    @endif
</div>
<div class="border px-10 py-5">
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $id }}" class="w-96 text-sm" value="{{ old($id, $db) }}" autocomplete="off">
</div>