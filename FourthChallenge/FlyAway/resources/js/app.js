/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import {createApp} from "vue";
import TableComponent from "./components/TableComponent";
import FlightForm from "./components/FlightForm";


createApp({
    data(){
        return{
            "showDelete":false,
            "showEdit":false
        }

    },
    components:{
        TableComponent,
        FlightForm,

    },
    methods:{
        deleteFlight:function(id){
            this.showDelete=!this.showDelete
        },
        editFlight:function(flight){
            this.showEdit=!this.showEdit
        },
    }

}).mount('#app')
