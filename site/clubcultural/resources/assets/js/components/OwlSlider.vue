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
            axios.get(this.jsonList).then(response => {
                // get body data
                this.items = response.data;
                setTimeout(() => {
                    jQuery("#home-client-logos-slider").owlCarousel({
                        autoPlay: 3000, //Set AutoPlay to 3 seconds
                        items : 7,
                        lazyLoad : true,
                        stopOnHover : true,
                        autoHeight : true,
                    });
            }, 0);
            }, response => {});
        }
    }
</script>
