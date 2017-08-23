<template>
    <div><featured-two-box v-for="deal in deals" :deal="deal"></featured-two-box></div>
</template>

<script>
    export default {
        data(){
            return { deals: [] }
        },

        mounted() {
            axios.get('/featured-deals/2').then(response => {
                this.deals = response.data;
            }, response => {});
        }
    }
</script>
