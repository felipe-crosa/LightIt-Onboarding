<template>
    <label for="confirmDeleteButton">Are you sure you want to delete this flight?</label>
    <button @click="deletingFlight" class="ml-20 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id="confirmDeleteButton">Delete</button>
</template>

<script>
import {reactive} from "vue";

export default {
    props:['flight_id'],
    name: "deleteFlightForm",
    setup(props){
        const state= reactive({
            id:'',
        })
        function deletingFlight(){
            console.log('deleting '+state.id)
        }
        return {
            state,deletingFlight
        }
    },
    watch:{
        flight_id:function(newVal,oldVal){
            //axios request to get flight with new id
            this.state.id=newVal
        }
    }


}
</script>

<style scoped>

</style>
