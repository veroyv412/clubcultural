<template>
    <div>
        <div>
            <search-deal v-for="deal in deals" :deal="deal"></search-deal>
        </div>
        <div v-empty>
            <span class="btn btn-flat ripple-effect btn-primary">{{message}}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['category_slug', 'search'],

        data(){
            return { deals: [], message: '' }
        },

        mounted() {
            this.message = 'Cargando Descuentos...'
            axios.get('/c/' + this.category_slug +  '/' + this.search).then(response => {
                //this is data.
                this.deals = response.data.data.deals;
                if ( this.deals.length == 0 ){
                    this.message = 'No hay descuentos para la categoría seleccionda.';
                }
            }, response => {});
        }
    }
</script>
