

<template>
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-md rounded-lg bg-gray-800 ">
                <table class="min-w-full" >
                    <thead class="bg-gray-700">
                        <table-heading>ID</table-heading>
                        <table-heading>Airline</table-heading>
                        <table-heading>Departure</table-heading>
                        <table-heading>Departing Date</table-heading>
                        <table-heading>Arrival</table-heading>
                        <table-heading>Arrival Date</table-heading>
                        <table-heading/>
                        <table-heading/>


                    </thead>
                    <tbody>
                        <tr v-for="flight in flights" id="">
                            <table-entry>
                                {{flight.id}}
                            </table-entry>
                            <table-entry>
                                {{flight.airline.name}}
                            </table-entry>

                            <table-entry>
                                {{flight.departure.name}}
                            </table-entry>
                            <table-entry>
                                {{flight.departure_date}}
                            </table-entry>
                            <table-entry>
                                {{flight.arrival.name}}
                            </table-entry>
                            <table-entry>
                                {{flight.arrival_date}}
                            </table-entry>
                            <table-entry>
                                <a @click.prevent="$emit('editFlight',flight.id)" href="/flights/{{flight.id}}/edit" class="text-blue-500 hover:underline">Edit</a>
                            </table-entry>
                            <table-entry>

                                <button @click.prevent="$emit('deleteFlight',flight.id)" :value="flight.id" type='submit' class="deleteButton text-red-600 hover:underline">Delete</button>

                            </table-entry>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

    import TableEntry from "./TableEntry";
    import TableHeading from "./TableHeading";
    export default {
        props:['deletedflight','addedflight','editedflight'],
        components: {TableHeading, TableEntry},

        data(){
            return {
                flights:[]
            }
        },

        mounted() {
            axios.get('/flights/all').then(response=>{this.flights=(response.data)})
        },

        methods:{

            deleteFlight:function(id){
                this.flights=this.flights.filter((flight)=>flight.id!=id)
            },

            editFlight:function(editedFlight){
                for(let i=0;i<this.flights.length;i++){
                    if(this.flights[i].id==editedFlight.id){
                        this.flights[i]={...editedFlight}
                        break
                    }
                }



            },

            addFlight:function(addedFlight){
                console.log(addedFlight)
                console.log(this.flights[0])
                this.flights.push(addedFlight);
            }



        },
        watch:{
            deletedflight:function(newVal,oldVal){

                if(this.deletedflight){
                    this.deleteFlight(newVal);
                }
            },
            addedflight:function(newVal,oldVal){
                if(this.addedflight){
                    this.addFlight(newVal)
                }
            },
            editedflight:function(newVal,oldVal){
                if(this.editedflight){
                    this.editFlight(newVal)
                }
            }


        }
    }
</script>
