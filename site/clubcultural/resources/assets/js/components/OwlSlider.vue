<template>
    <div class="container">
        <div :id="identifier">
            <div class="item" v-for="item in items">
                <img class="lazyOwl" :data-src="item.image" :alt="item.title">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['identifier', 'json-list'],

        data(){
            return { items: [] }
        },

        mounted() {
            this.$http.get(this.jsonList).then(response => {
                // get body data
                this.items = response.body;
            }, response => {});
        }
    }
</script>
