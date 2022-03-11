/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



require('./bootstrap');

import {createApp} from "vue";
import TableComponent from "./components/TableComponent";
import FlightForm from "./components/FlightForm";
import modalComponent from "./components/modalComponent";
import deleteFlightForm from "./components/deleteFlightForm";


createApp({
    data() {
        return {
            "showDelete": false,
            "showEdit": false,
            "showAdd": false,
            "edit_flight_id":'',
            "delete_flight_id":""

        }
    }
    ,
    components:{
        deleteFlightForm,
        TableComponent,
        FlightForm,
        modalComponent

    },
    methods:{
        deleteFlight:function(id){
            this.showDelete=!this.showDelete
            this.delete_flight_id=id
        },
        editFlight:function(flight_id){
            this.edit_flight_id=flight_id
            this.showEdit=true;

        },
        closeModal:function(){
            this.showEdit=false;
            this.showDelete=false;
            this.showAdd=false;
        },
        prueba:function(){

        }
    },
    computed:{

    }



}).mount('#app')
