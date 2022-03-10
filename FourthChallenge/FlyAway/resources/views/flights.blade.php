<x-layout>
    <div id="app">
    <table-component @delete-flight="(id)=>deleteFlight(id)"  @edit-flight="(flight)=>editFlight(flight)" flights-collection="{{$flights->toJson()}}"></table-component>
       <flight-form flight="{{$flights[0]->toJson()}}"/>

        <div v-show="showEdit" ><p>Edit</p></div>
    </div>
    <script src="/js/app.js"> </script>
</x-layout>


