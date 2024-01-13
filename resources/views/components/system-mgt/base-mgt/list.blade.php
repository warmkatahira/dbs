<table class="text-sm block whitespace-nowrap">
    <thead>
        <tr class="text-left text-white bg-gray-600 sticky top-0">
            <th class="font-thin py-3 px-2 text-center">拠点ID</th>
            <th class="font-thin py-3 px-2 text-center">拠点名</th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @foreach($bases as $base)
            <tr class="text-left cursor-default">
                <td class="py-1 px-2 border">{{ $base->base_id }}</td>
                <td class="py-1 px-2 border">{{ $base->base_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>