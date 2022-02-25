<x-layout>
    
    <div class="flex flex-col mt-10">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-md rounded-lg bg-gray-800 ">
                    <table class="min-w-full">
                        <thead class="bg-gray-700">
                            <tr>
                                <x-table-heading>ID</x-table-heading>
                                <x-table-heading>Name</x-table-heading>
                                <x-table-heading>Departing Flights</x-table-heading>
                                <x-table-heading>Arriving Flights</x-table-heading>
                                <x-table-heading/>
                                <x-table-heading/>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                                <tr class="border-b bg-gray-800 border-gray-700">
                                    <x-table-body-entry>{{$city->id}}</x-table-body-entry>
                                    <x-table-body-entry>{{$city->name}}</x-table-body-entry>
                                    <x-table-body-entry>{{$city->departing_flights->count()}}</x-table-body-entry>
                                    <x-table-body-entry>{{$city->arriving_flights->count()}}</x-table-body-entry>
                                    
                                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                        <a href="cities/{{$city->id}}/edit" class="text-blue-500 hover:underline">Edit</a>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                        <form method="post" action="/cities/{{$city->id}}" >
                                            @csrf
                                            @method('DELETE')
                                            <button type='submit' class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                           
                        </tbody>
                    </table>
                    <div class="ml-16 w-1/2 h-12 pt-2">
                    {{ $cities->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-10 bg-slate-400 rounded-xl w-2/5 mx-auto">
            <div class="pt-2 w-min-full h-8 rounded-xl bg-gray-700">
                <h1 class="text-xs font-medium tracking-wider text-left uppercase text-gray-400 ml-16">Add a City:</h1>
            </div>
            <div class=" h-20 my-5">
                <form method="POST" action="/cities" class="py-5 self-center inline-flex items-baseline">
                    @csrf
                    <label class="ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">City name:</label>
                        <div>
                        <input required name="name" class="border border-gray-200 p-2 rounded" value="{{old('name')}}" type="text" /> 
                        @error('name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                        </div>
                    
                    <button class="ml-10 bg-gray-600 text-white uppercase font-semibold text-xs py-2 px-10 rounded-xl hover:bg-gray-700" type="submit">Submit</button>
                </form>

            </div>
    </div>
</x-layout>