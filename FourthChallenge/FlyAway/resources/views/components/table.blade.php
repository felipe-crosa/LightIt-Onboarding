@props(['headers','objects'])
<div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-md sm:rounded-lg">
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        @foreach ($headers as $header)

                            @if ($header=='edit'||$header=='delete')
                                <th scope="col" class="relative py-3 px-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                            @else
                                <x-table-heading>{{$header}}</x-table-heading>
                            @endif
                            
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <!-- Product 1 -->
                    @foreach ($objects as $object)
                        <x-table-row :headers="$headers" :data="$object"/>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>