<x-layout>
    <div class="h-min-full w-min-full  my-10 h-80 ">
        <div id="errors"></div>
        <div class="mt-10 bg-slate-400 rounded-xl w-2/5 mx-auto">
            <div class="pt-2 w-min-full h-8 rounded-xl bg-gray-700">
                <h1 class="text-xs font-medium tracking-wider text-left uppercase text-gray-400 ml-16">Edit a Airline:
                </h1>
            </div>
            <div class=" h-35 my-5">
                <form id="editAirlineForm" method="POST" action="/airlines/{{ $airline->id }}"
                    class="py-5 self-center inline-flex items-baseline">
                    @csrf
                    @method('PATCH')
                    <div>
                        <div class="flex">
                            <label
                                class="w-40 ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">Airline
                                name:</label>

                            <input id="name" required name="name" class="border border-gray-200 p-2 rounded"
                                value="{{ old('name', $airline->name) }}" type="text" />
                            @error('name')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex">
                            <label
                                class="w-40 ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">Airline
                                description:</label>

                            <input id="description" required name="description"
                                class="border border-gray-200 p-2 rounded"
                                value="{{ old('description', $airline->description) }}" type="text" />
                            @error('description')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button id="editButton"
                        class="ml-10 bg-gray-600 text-white uppercase font-semibold text-xs py-2 px-10 rounded-xl hover:bg-gray-700"
                        type="submit">Edit</button>
                </form>
            </div>
        </div>
    </div>

    <x-leave-popup :href="route('airline.index')">
        Airline has been edited!
        <x-slot name='button'> Go Back to Airlines </x-slot>
    </x-leave-popup>

    <script>
        document.getElementById('editButton').addEventListener('click', function(event) {
            event.preventDefault();
            editAirline()
        })
        async function editAirline() {

            let response = await fetch(`/airlines/{{ $airline->id }}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: document.getElementById('name').value,
                    description: document.getElementById('description').value

                })

            });
            if (response.ok) {

                console.log("Edited")
                document.getElementById('errors').innerHTML = ''
                showMenu(true)
            } else {
                response = await response.json()
                let errors = document.getElementById('errors')
                
                errors.innerHTML = `<x-alert>${response.message}</x-alert>`
            }





        }
    </script>

</x-layout>
