<x-layout>
    <x-table :id="'airlinesTable'">
        <x-slot name='headers'>
            <x-table-heading>ID</x-table-heading>
            <x-table-heading>Name</x-table-heading>
            <x-table-heading>Description</x-table-heading>
            <x-table-heading>Amount of Flights</x-table-heading>
            <x-table-heading />
            <x-table-heading />
        </x-slot>

        <x-slot name='body'>
            @foreach ($airlines as $airline)
                <tr class="border-b bg-gray-800 border-gray-700">
                    <x-table-body-entry>{{ $airline->id }}</x-table-body-entry>
                    <x-table-body-entry>{{ $airline->name }}</x-table-body-entry>
                    <x-table-body-entry>{{ $airline->description }}</x-table-body-entry>
                    <x-table-body-entry>{{ $airline->flights->count() }}</x-table-body-entry>

                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                        <a href="/airlines/{{ $airline->id }}/edit" class="text-blue-500 hover:underline">Edit</a>
                    </td>
                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                        <form method="post" action="/airlines/{{ $airline->id }}">
                            @csrf
                            @method('DELETE')
                            <button type='submit' class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name='pagination'>
            {{ $airlines->links() }}
        </x-slot>

    </x-table>

    <div class="mt-10 bg-slate-400 rounded-xl w-2/5 mx-auto">
        <div class="pt-2 w-min-full h-8 rounded-xl bg-gray-700">
            <h1 class="text-xs font-medium tracking-wider text-left uppercase text-gray-400 ml-16">Add a Airline:</h1>
        </div>
        <div class=" h-35 my-5">
            <form id="addAirlineForm" method="POST" action="/airlines"
                class="py-5 self-center inline-flex items-baseline">
                @csrf
                <div>
                <div class="flex">
                    <label class="w-40 ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">Airline
                        name:</label>

                    <input id="name" required name="name" class="border border-gray-200 p-2 rounded"
                        value="{{ old('name') }}" type="text" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex">
                    <label class="w-40 ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">Airline
                        description:</label>

                    <input id="description" required name="description" class="border border-gray-200 p-2 rounded"
                        value="{{ old('description') }}" type="text" />
                    @error('description')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
                <button
                    class="ml-10 bg-gray-600 text-white uppercase font-semibold text-xs py-2 px-10 rounded-xl hover:bg-gray-700"
                    type="submit">Submit</button>
            </form>
        </div>
        
    </div>

</x-layout>