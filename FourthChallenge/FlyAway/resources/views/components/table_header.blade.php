@props(['columns'])
<thead class="bg-gray-50">
    <tr>
      @foreach ($columns as $column)
          @if ($column=='Edit')
              <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Edit</span>
                </th>
          
          @elseif($column=='Delete')
              <th scope="col" class="relative px-6 py-3">
              <span class="sr-only">Delete</span>
              </th>
          @else
              <x-table_heading>{{$column}}</x-table_heading>
          @endif

      @endforeach
      
    </tr>
  </thead>