<template>
    <form class="w-full max-w-lg">
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" >
                    Airline
                </label>
            </div>
            <div class="md:w-2/3">
                <select v-model="state.form.airline_id">
                    <option disabled>Select a Airline</option>
                    <option value="1">LATAM</option>
                    <option value="2">American</option>
                </select>
                <!--<input v-model="form.airline_id" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="flightAirline" type="text" >-->
            </div>
            <div class="md:w-2/3">
                <span v-if="state.form.errors.has('airline_id')" v-text="state.form.errors.get('airline_id')"></span>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="DepartingCity">
                    Departure
                </label>
            </div>
            <div class="md:w-2/3">
                <input v-model="state.form.departure_id" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="DepartingCity" type="text" placeholder="Paris">
            </div>
            <div class="md:w-2/3">
                <span v-if="state.form.errors.has('departure_id')" v-text="state.form.errors.get('departure_id')"></span>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="DepartingDate">
                    Departure Date
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="DepartingDate" type="datetime-local" :max="state.form.arrival_date" v-model="state.form.departure_date">
            </div>
            <div class="md:w-2/3">
                <span v-if="state.form.errors.has('departure_date')" v-text="state.form.errors.get('departure_date')"></span>
            </div>
        </div>

        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="ArrivingCity">
                    Arrival
                </label>
            </div>
            <div class="md:w-2/3">
                <input v-model="state.form.arrival_id" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="ArrivingCity" type="text" placeholder="Miami">
            </div>
            <div class="md:w-2/3">
                <span v-if="state.form.errors.has('arrival_id')" v-text="state.form.errors.get('arrival_id')"></span>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="ArrivingDate">
                    Arrival Date
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="ArrivingDate" type="datetime-local" :min="state.form.departure_date" v-model="state.form.arrival_date">
            </div>
            <div class="md:w-2/3">
                <span v-if="state.form.errors.has('arrival_date')" v-text="state.form.errors.get('arrival_date')"></span>
            </div>
        </div>

        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <button @click="submit" class="bg-gray-600 uppercase hover:bg-gray-700
                shadow focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                    {{this.flight_id ? "Edit" :"Submit" }}
                </button>
            </div>
        </div>
    </form>


</template>

<script>

import Form from "./FormTemplate"
import {reactive, watch} from "vue";
export default {
    name: "Form",
    props:['flight_id'],
    setup(){
        const state=reactive({
            form:new Form({
                airline_id:'',
                departure_id:'',
                arrival_id:'',
                departure_date:'',
                arrival_date:'',
            }),

        })

        function submit(type,url){
            url='/flights'
            type='post'
            state.post.sumbit(type,url)
        }


        return {
            state,submit
        }



    },

    watch:{
        flight_id:function(newVal,oldVal){
            //axios request to get flight with new id
            console.log("Flight id changed from "+oldVal+ " to "+ newVal)
        }
    }

}


</script>

<style scoped>

</style>

