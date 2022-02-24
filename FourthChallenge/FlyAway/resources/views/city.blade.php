<x-layout>
    
    <div class="flex flex-col mt-10">
        <h1 class="pb-4">View all Cities:</h1>
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-md sm:rounded-lg">
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
                                        <a href="#" class="text-blue-500 hover:underline">Edit</a>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                        <a href="#" class="text-red-600 hover:underline">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-10 bg-slate-400 rounded-xl w-8/12 mx-auto">
            
            <h1 class="pt-2 w-min-full h-8 rounded-xl bg-gray-700 text-xs font-medium tracking-wider text-center uppercase text-gray-400">Add a City:</h1>
            
            <form class='h-20 '>
                <label class="mr-8 text-sm font-medium  whitespace-nowrap dark:text-white uppercase">City name:</label>
                <input class="border border-gray-200 p-2 rounded" type="text" /> 
                <button class="ml-10 bg-gray-600 text-white uppercase font-semibold text-xs py-2 px-10 rounded-xl hover:bg-gray-700" type="submit">Submit</button>
            </form>
        </div>
    </div>
</x-layout>