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
                <tr id="table-row-{{ $airline->id }}" class="border-b bg-gray-800 border-gray-700">
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
                            <button value="{{ $airline->id }}" type='submit'
                                class="deleteButton text-red-600 hover:underline">Delete</button>
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
                        <label
                            class="w-40 ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">Airline
                            name:</label>

                        <input id="name" required name="name" class="border border-gray-200 p-2 rounded"
                            value="{{ old('name') }}" type="text" />
                        @error('name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex">
                        <label
                            class="w-40 ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">Airline
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
            <div class="flex">
                <label
                class="w-40 ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">Available
                Cities:</label>
                <select class="rounded" id="selectCities" name="Cities" title="Cities">
                    @foreach ($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
                <button id="selectCityButton" class="ml-10 bg-gray-600 text-white uppercase font-semibold text-xs py-2 px-10 rounded-xl hover:bg-gray-700"> Select </button>
            </div>
            <div id="selectedCities" class="grid grid-cols-3">

            </div>
        </div>
        <div id="errors"></div>






        <script>
            var cities=[]
                function reloadDeleteAirlineButtons() {
                    let deleteButtons = document.getElementsByClassName('deleteButton');
                    for (let i = 0; i < deleteButtons.length; i++) {
                        deleteButtons[i].addEventListener('click', function(event) {
                            event.preventDefault();
                            deleteAirline(event.target.value)
                        })
                    }

                }
                reloadDeleteAirlineButtons();
                document.getElementById("addAirlineForm").addEventListener("submit", function(event) {

                    event.preventDefault();
                    addAirline()
                    async function addAirline() {

                        let response = await fetch("{{ route('airline.store') }}", {
                            method: 'POST',
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
                        
                            response = await response.json()
                            console.log(response)
                            let table = document.getElementById('airlinesTable');
                            let tBody = table.getElementsByTagName('tbody')[0];
                            tBody.innerHTML = (`<tr id="table-row-${ response.id }" class="border-b bg-gray-800 border-gray-700">
                    <x-table-body-entry>${ response.id }</x-table-body-entry>
                    <x-table-body-entry>${ response.name }</x-table-body-entry>
                    <x-table-body-entry>${ response.description }</x-table-body-entry>
                    <x-table-body-entry>0</x-table-body-entry>

                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                        <a href="/airlines/${ response.id }/edit" class="text-blue-500 hover:underline">Edit</a>
                    </td>
                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                        <form method="post" action="/airlines/${ response.id }">
                            @csrf
                            @method('DELETE')
                            <button value="${ response.id }" type='submit'
                                class="deleteButton text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>`) + tBody.innerHTML
                            document.getElementById('errors').innerHTML = ''
                            document.getElementById('name').value=""
                            document.getElementById('description').value=""
                        } else {
                            response = await response.json()
                            let errors = document.getElementById('errors')
                            console.log(errors)
                            errors.innerHTML = `<x-alert>${response.message}</x-alert>`
                        }




                    reloadDeleteAirlineButtons()
                    document.getElementById('selectedCities').innerHTML=""
                    }
                    

                })



                async function deleteAirline(id) {

                    let response = await fetch(`/airlines/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Content-Type': 'application/json'
                        }

                    });

                    response = await response.json()

                    let row = document.getElementById(`table-row-${id}`)
                    row.remove()

                }

                document.getElementById('selectCityButton').addEventListener('click',function(event){
                    let select=document.getElementById('selectCities')
                    let city_id=select.value
                    
                    let text=select.options[select.selectedIndex].text
                    if(!cities.includes(city_id)){
                        document.getElementById('selectedCities').innerHTML+=`<x-city-tag :city_id="'${city_id}'">${text}</x-city-tag>`
                        cities.push(city_id)
                        
                        reloadCancelCityButtons()
                    }
                    
                    
                    
                  //  

                })

                function reloadCancelCityButtons(){
                    let city_tags=document.getElementsByClassName('cancelCityButton')
                    for(let i=0;i<city_tags.length;i++){
                        city_tags[i].addEventListener('click',function(event){
                            
                            id=event.target.parentElement.value
                        
                            let tag=document.getElementById('city-tag-'+id)
                           
                            tag.remove()
                            cities.splice(cities.indexOf(id),1)
                           

                        })
                    }

                }
                
            
        </script>

    </div>

</x-layout>
