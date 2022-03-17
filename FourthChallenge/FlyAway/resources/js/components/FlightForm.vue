<template>

    <form class="w-full max-w-lg">
        <div class="md:flex md:items-center mb-1">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" >
                    Airline
                </label>
            </div>
            <div class="md:w-2/3">
                <VueMultiselect v-model="state.airline"  :options="state.airlines" track-by="id" label="name" model-value="id"></VueMultiselect>
            </div>
        </div>
        <div class="mb-6">
            <span class="ml-40 text-xs text-red-700" v-if="state.form.errors.has('airline_id')" v-text="state.form.errors.get('airline_id')"></span>
        </div>

        <div class="md:flex md:items-center mb-1">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" >
                    Departure
                </label>
            </div>
            <div class="md:w-2/3">
                <VueMultiselect v-model="state.departure" :options="departures" label="name" track-by="id"></VueMultiselect>
            </div>

        </div>
        <div class="mb-6">
            <span class="ml-40 text-xs text-red-700" v-if="state.form.errors.has('departure_id')" v-text="state.form.errors.get('departure_id')"></span>
        </div>

        <div class="md:flex md:items-center mb-1">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="DepartingDate">
                    Departure Date
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="DepartingDate" type="datetime-local" :max="state.form.arrival_date" v-model="state.form.departure_date">
            </div>

        </div>
        <div class="mb-6">
            <span class="ml-40 text-xs text-red-700" v-if="state.form.errors.has('departure_date')" v-text="state.form.errors.get('departure_date')"></span>
        </div>


        <div class="md:flex md:items-center mb-1">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" >
                    Arrival
                </label>
            </div>
            <div class="md:w-2/3">
                <VueMultiselect v-model="state.arrival" :options="arrivals"  label="name" track-by="id"></VueMultiselect>
            </div>
        </div>
        <div class="mb-6">
            <span class="ml-40 text-xs text-red-700" v-if="state.form.errors.has('arrival_id')" v-text="state.form.errors.get('arrival_id')"></span>
        </div>

        <div class="md:flex md:items-center mb-1">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="ArrivingDate">
                    Arrival Date
                </label>
            </div>
            <div class="md:w-2/3">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="ArrivingDate" type="datetime-local" :min="state.form.departure_date" v-model="state.form.arrival_date">
            </div>
        </div>
        <div class="mb-6">
            <span class="ml-40 text-xs text-red-700" v-if="state.form.errors.has('arrival_date')" v-text="state.form.errors.get('arrival_date')"></span>
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
import {reactive} from "vue";
import VueMultiselect from 'vue-multiselect'
export default {
    components:{
        VueMultiselect
    },
    name: "Form",
    props:['flight_id'],
    emits:['edited-flight','added-flight'],
    setup(props, {emit}){

        const state=reactive({
            form:new Form({
                airline_id:'',
                departure_id:'',
                arrival_id:'',
                departure_date:'',
                arrival_date:'',
            }),
            airline:'',
            arrival:'',
            departure:'',

            airlines:[],


        })




        function submit(type,url){
            url='/flights'
            type='post'
            let event='added-flight'
            if(props.flight_id){
                url='/flights/'+props.flight_id
                type='patch'
                event='edited-flight'
            }
            state.form.submit(type,url)
                .then(response=>{
                    emit(event,response)
                    if(type=='post'){
                        this.reset()
                    }

                })
                .catch(error=> {

                    console.log(error)
                })

        }

        function reset(){
            state.airline=''
            state.arrival=''
            state.departure=''
            state.form.reset()

        }



        return {
            state,submit,reset
        }



    },
    mounted() {
        if(this.flight_id){
            axios.get('flights/'+this.flight_id).then(response=>{
                let flight=response.data
                this.state.airline=flight.airline
                this.state.arrival=flight.arrival
                this.state.departure=flight.departure

                this.state.form.departure_date=flight.departure_date.replace(' ','T')
                this.state.form.arrival_date=flight.arrival_date.replace(' ','T')
            })
        }
        this.getAllAirlines()


    },

    computed:{
        departures(){
            let departures=[]
            let arrival=this.state.arrival

            if(this.state.form.airline_id){
                departures=this.state.airline.cities

                if(arrival) {
                    departures=(departures.filter((city) => arrival.id != city.id))
                }
            }
            return departures
        },
        arrivals(){
            let arrivals=[]
            let departure=this.state.departure

            if(this.state.form.airline_id){

                arrivals=this.state.airline.cities

                if(departure) {

                   arrivals=(arrivals.filter((city) => departure.id != city.id))
                }
            }
            return arrivals
        }

    },
    methods:{


        getAllAirlines(){
            axios.get('/airlines/all').then(response=>{
                this.state.airlines=response.data
            })
        },


    },
    watch:{

        'state.airline':function(newVal,oldVal){
            if(newVal){
                this.state.form.airline_id=newVal.id
            }else{
                this.state.form.airline_id=''
            }
            if(oldVal){
                this.state.arrival=''
                this.state.departure=''
            }


        },
        'state.arrival':function(newVal,oldVal){
            if(newVal){
                this.state.form.arrival_id=newVal.id
            }else{
                this.state.form.arrival_id=''
            }

        },
        'state.departure':function(newVal,oldVal){
            if(newVal){
                this.state.form.departure_id=newVal.id
            }else{
                this.state.form.departure_id=''
            }

        },
    }



}


</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>


