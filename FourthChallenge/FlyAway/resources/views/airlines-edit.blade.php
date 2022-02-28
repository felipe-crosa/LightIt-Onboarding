<x-layout>
    <div class="h-min-full w-min-full  my-10 h-80 ">
    <div class="mt-10 bg-slate-400 rounded-xl w-2/5 mx-auto">
        <div class="pt-2 w-min-full h-8 rounded-xl bg-gray-700">
            <h1 class="text-xs font-medium tracking-wider text-left uppercase text-gray-400 ml-16">Edit a Airline:</h1>
        </div>
        <div class=" h-35 my-5">
            <form id="editAirlineForm" method="POST"action="/airlines/{{$airline->id}}"
                class="py-5 self-center inline-flex items-baseline">
                @csrf
                @method('PATCH')
                <div>
                <div class="flex">
                    <label class="w-40 ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">Airline
                        name:</label>

                    <input id="name" required name="name" class="border border-gray-200 p-2 rounded"
                        value="{{$airline->name}}" type="text" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex">
                    <label class="w-40 ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">Airline
                        description:</label>

                    <input id="description" required name="description" class="border border-gray-200 p-2 rounded"
                        value="{{$airline->description}}" type="text" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
                <button
                    class="ml-10 bg-gray-600 text-white uppercase font-semibold text-xs py-2 px-10 rounded-xl hover:bg-gray-700"
                    type="submit">Edit</button>
            </form>
        </div>
    </div>
    </div>
</x-layout>