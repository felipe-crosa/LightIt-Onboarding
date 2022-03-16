<x-layout>

    <div id="app">
        <button class=" mt-8 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="showAdd=true" > Add Flight</button>
        <table-component :addedflight="addedFlight" :deletedflight="deletedFlight"  :editedflight="editedFlight"  @delete-flight="(id)=>deleteFlight(id)"  @edit-flight="(flight_id)=>editFlight(flight_id)" ></table-component>



        <modal-component @close-modal="closeModal" v-if="showEdit">
            <template v-slot:header>Edit</template>
            <flight-form @edited-flight="edited" :flight_id="edit_flight_id" ></flight-form>
        </modal-component>

        <modal-component @close-modal="closeModal" v-if="showDelete">
            <template v-slot:header>Delete</template>
            <delete-flight-form @deleted-flight="deleted"  :flight_id="delete_flight_id"/>

        </modal-component>

        <modal-component   @close-modal="closeModal" v-if="showAdd">
            <template v-slot:header>Add</template>
            <flight-form @added-flight="added" />
        </modal-component>

        <alert-message @close-alert="closeAlert" v-if="showAlert">@{{alertMessage}}</alert-message>
    </div>
    <script src="/js/app.js"> </script>
</x-layout>

