<x-layout>

    <div class="flex flex-col mt-10">
        <x-table>
            <x-slot name='headers'>
                <x-table-heading>ID</x-table-heading>
                <x-table-heading>Name</x-table-heading>
                <x-table-heading>Departing Flights</x-table-heading>
                <x-table-heading>Arriving Flights</x-table-heading>
                <x-table-heading />
                <x-table-heading />
            </x-slot>

            <x-slot name='body'>
                @foreach ($cities as $city)
                    <tr class="border-b bg-gray-800 border-gray-700">
                        <x-table-body-entry>{{ $city->id }}</x-table-body-entry>
                        <x-table-body-entry>{{ $city->name }}</x-table-body-entry>
                        <x-table-body-entry>{{ $city->departing_flights->count() }}</x-table-body-entry>
                        <x-table-body-entry>{{ $city->arriving_flights->count() }}</x-table-body-entry>

                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                            <a href="/cities/{{ $city->id }}/edit" class="text-blue-500 hover:underline">Edit</a>
                        </td>
                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                            <form method="post" action="/cities/{{ $city->id }}">
                                @csrf
                                @method('DELETE')
                                <button type='submit' class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-slot>

            <x-slot name='pagination'>
                {{ $cities->links() }}
            </x-slot>

        </x-table>

        <div class="mt-10 bg-slate-400 rounded-xl w-2/5 mx-auto">
            <div class="pt-2 w-min-full h-8 rounded-xl bg-gray-700">
                <h1 class="text-xs font-medium tracking-wider text-left uppercase text-gray-400 ml-16">Add a City:</h1>
            </div>
            <div class=" h-20 my-5">
                <form id="addCityForm" method="POST" action="/cities"
                    class="py-5 self-center inline-flex items-baseline">
                    @csrf
                    <label class="ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">City
                        name:</label>
                    <div>
                        <input id="name" required name="name" class="border border-gray-200 p-2 rounded"
                            value="{{ old('name') }}" type="text" />
                        @error('name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        class="ml-10 bg-gray-600 text-white uppercase font-semibold text-xs py-2 px-10 rounded-xl hover:bg-gray-700"
                        type="submit">Submit</button>
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#addCityForm').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('city.add') }}",

                        data: {
                            name: $("#name").val(),
                            _token: $("input[name=_token]").val()
                        },
                        success: function(response) {
                            $("#citiesTable tbody").append(`<tr class="border-b bg-gray-800 border-gray-700"> 
                        <x-table-body-entry>${response.id}</x-table-body-entry> 
                        <x-table-body-entry>${response.name}</x-table-body-entry>
                        <x-table-body-entry>0</x-table-body-entry>
                        <x-table-body-entry>0</x-table-body-entry> 
                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                        <a href="cities/${response.id}/edit" class="text-blue-500 hover:underline">Edit</a>
                        </td>
                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                            <form method="post" action="/cities/${response.id}" >
                                @csrf
                                @method('DELETE')
                                <button type='submit' class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                        </tr>`)
                            $("#addCityForm")[0].reset()
                        }

                    });
                });


            });
        </script>
</x-layout>
