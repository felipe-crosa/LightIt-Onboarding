@props(['city_id'])
<div id="city-tag-{{$city_id}}" class="rounded-xl bg-blue-200 py-1  ">
    <p class="text-center float-left ml-2">{{$slot}}</p>
    <button value="{{$city_id}}" class="cancelCityButton float-right mr-2">
        <x-cross-svg :size='20'/>
    </button>
</div>