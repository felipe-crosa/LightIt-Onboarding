<template>
    <label for="confirmDeleteButton">Are you sure you want to delete this flight?</label>
    <button @click="deletingflight" class="ml-20 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id="confirmDeleteButton">Delete</button>
</template>

<script>
import {reactive} from "vue";

export default {
    props:['flight_id'],
    name: "deleteFlightForm",
    emits:['deleted-flight'],

    setup(props,{emit}){
        const state= reactive({

        })
        function deletingflight(){
            axios.delete('flights/'+props.flight_id).then(emit('deleted-flight',props.flight_id))
        }

        return {
            state,deletingflight
        }
    },




}
</script>

<style scoped>

</style>
