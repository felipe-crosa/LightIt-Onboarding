@props(['columns','object'])
<tr class="bg-white">
    @foreach ($columns as $column)
        @if ($object[$column] !== null)
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$object[$column]}}</td>
        @else
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
             <a href="#" class="text-indigo-600 hover:text-indigo-900">{{$column}}</a>
            </td>
        @endif
            
    @endforeach
</tr>
