<x-layout>
    <div id="app">
        <table-component @delete-flight="(id)=>deleteFlight(id)"  @edit-flight="(flight_id)=>editFlight(flight_id)" flights-collection="{{$flights->toJson()}}"></table-component>

        <modal-component @close-modal="closeModal" v-show="showEdit">
            <template v-slot:header>Edit</template>
            <flight-form :flight_id="edit_flight_id" ></flight-form>
        </modal-component>

        <modal-component @close-modal="closeModal" v-show="showDelete">
            <template v-slot:header>Delete</template>
            <delete-flight-form :flight_id="delete_flight_id"/>

        </modal-component>

        <modal-component @close-modal="closeModal" v-show="showAdd">
            <template v-slot:header>Add</template>
            <flight-form/>
        </modal-component>
    </div>
    <script src="/js/app.js"> </script>
</x-layout>


