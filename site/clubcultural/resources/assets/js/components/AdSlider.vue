<template>
    <div class="widget widget-add">
        <hr data-symbol="PUBLICIDAD">
        <div :id="identifier" class="flexslider">
            <ul class="slides">
                <li v-for="item in items">
                    <img :src="item.image" :title="item.title" alt="add" class="img-responsive">
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import jQuery from 'jquery';

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
                    jQuery('#ad-slider').flexslider({
                        slideshowSpeed: 3000,
                        animation: "fade",
                        smoothHeight: true,
                        controlNav: false,
                    });
                }, 0);
            }, response => {});
        }
    }
</script>
