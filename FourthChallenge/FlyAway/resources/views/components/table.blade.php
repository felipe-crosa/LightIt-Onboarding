@props(['id'])
<div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-md rounded-lg bg-gray-800 ">
            <table class="min-w-full" id="{{$id}}">
                <thead class="bg-gray-700">
                    <tr>
                        {{$headers}}
                    </tr>
                </thead>
                <tbody>
                    {{$body}}
                </tbody>
            </table>
            <div class="ml-16 w-1/2 h-12 pt-2">
             {{$pagination}}
            </div>
        </div>
    </div>
</div>