<x-layout>
    <div class="h-min-full w-min-full  my-10 h-80 ">
        <div id="errors"></div>
            <div class="mt-20 bg-slate-400 rounded-xl w-2/5 mx-auto">
                <div class="pt-2 w-min-full h-8 rounded-xl bg-gray-700">
                    <h1 class="text-xs font-medium tracking-wider text-left uppercase text-gray-400 ml-16">Edit City:</h1>
                </div>
                <div class=" h-20 my-5">
                    <form id="editCityForm" method="POST" action="/cities/{{$city->id}}" class="py-5 self-center inline-flex items-baseline">
                        @csrf
                        @method("PATCH")
                        <label class="ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">City name:</label>
                            <div>
                            <input id="name" required name="name" class="border border-gray-200 p-2 rounded" value="{{old('name',$city->name)}}" type="text" /> 
                            @error('name')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                            </div>
                        
                        <button class="ml-10 bg-gray-600 text-white uppercase font-semibold text-xs py-2 px-10 rounded-xl hover:bg-gray-700" type="submit">Edit</button>
                    </form>
    
                </div>
        </div>
    </div>



    <x-leave-popup :href="route('city.index')">
        City has been edited!
        <x-slot name='button'> Go Back to Cities </x-slot>
    </x-leave-popup>

    <script>
        $(document).ready(function() {
            
            $('#editCityForm').submit(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type: "PATCH",
                    url: "/cities/{{$city->id}}",
                    dataType:"json",
                    data: {
                        name: $("#name").val()   
                    },
                    success: function(response) {
                        $("#errors").html("");
                        
                        
                            showMenu(true)
                        
                        
                    },
                    error:function(error){
                        $("#errors").html("");
                            
                        $("#errors").prepend(`<x-alert>${error.responseJSON.message}</x-alert>`);
                    }


                });
            });
        });
    </script>
</x-layout>