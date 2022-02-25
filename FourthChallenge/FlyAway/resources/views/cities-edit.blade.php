<x-layout>
    <div class="h-min-full w-min-full  my-10 h-80 ">
        
            <div class="mt-20 bg-slate-400 rounded-xl w-2/5 mx-auto">
                <div class="pt-2 w-min-full h-8 rounded-xl bg-gray-700">
                    <h1 class="text-xs font-medium tracking-wider text-left uppercase text-gray-400 ml-16">Edit City:</h1>
                </div>
                <div class=" h-20 my-5">
                    <form method="POST" action="/cities/{{$city->id}}" class="py-5 self-center inline-flex items-baseline">
                        @csrf
                        @method("PATCH")
                        <label class="ml-4 mr-8 text-sm font-medium  whitespace-nowrap text-white uppercase">City name:</label>
                            <div>
                            <input required name="name" class="border border-gray-200 p-2 rounded" value="{{$city->name}}" type="text" /> 
                            @error('name')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                            </div>
                        
                        <button class="ml-10 bg-gray-600 text-white uppercase font-semibold text-xs py-2 px-10 rounded-xl hover:bg-gray-700" type="submit">Edit</button>
                    </form>
    
                </div>
        </div>
    </div>
</x-layout>