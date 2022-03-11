<template>
    <div id="modal" class="fixed z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
        <div class="relative top-40 mx-auto shadow-lg rounded-md bg-white  max-w-md">

            <!-- Modal header -->
            <div class="flex justify-between items-center bg-green-500 text-white text-xl rounded-t-md px-4 py-2">
                <h3><slot name="header"></slot> </h3>
                <button @click="$emit('close-modal')">x</button>
            </div>

            <!-- Modal body -->
            <div class="min-h-fit overflow-y-scroll p-4">
                <slot></slot>
            </div>



        </div>
    </div>
</template>

<script>
export default {

    name: "modalComponent",
    mounted() {
        //console.log(this.flight_id)
    }
}
</script>

<style scoped>

</style>
