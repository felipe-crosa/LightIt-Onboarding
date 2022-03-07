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
                <div class="flex">
                    <label class="w-40 ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">Available
                        Cities:</label>
                    <select class="rounded" id="selectCities" name="Cities" title="Cities">
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                    <button id="selectCityButton"
                        class="ml-10 bg-gray-600 text-white uppercase font-semibold text-xs py-2 px-10 rounded-xl hover:bg-gray-700">
                        Select </button>
                </div>
                <div id="selectedCities" class="grid grid-cols-3">
                    @foreach ($airline->cities as $city)
                        <x-city-tag :city_id='"{{ $city->id }}"'>{{ $city->name }}</x-city-tag>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <x-leave-popup :href="route('airline.index')">
        Airline has been edited!
        <x-slot name='button'> Go Back to Airlines </x-slot>
    </x-leave-popup>

    <script>
        reloadCancelCityButtons()
        var cities = {{ $airline->cities->pluck('id')->toJson() }}
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
                    description: document.getElementById('description').value,
                    cities:cities
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
        document.getElementById('selectCityButton').addEventListener('click', function(event) {
            let select = document.getElementById('selectCities')
            let city_id = select.value

            let text = select.options[select.selectedIndex].text
            if (!cities.includes(city_id)) {
                document.getElementById('selectedCities').innerHTML +=
                    `<x-city-tag :city_id="'${city_id}'">${text}</x-city-tag>`
                cities.push(city_id)

                reloadCancelCityButtons()
            }



            //  

        })

        function reloadCancelCityButtons() {
            let city_tags = document.getElementsByClassName('cancelCityButton')
            for (let i = 0; i < city_tags.length; i++) {
                city_tags[i].addEventListener('click', function(event) {

                    id=event.currentTarget.value

                    let tag = document.getElementById('city-tag-' + id)

                    tag.remove()
                    cities.splice(cities.indexOf(id), 1)


                })
            }

        }
    </script>

</x-layout>
