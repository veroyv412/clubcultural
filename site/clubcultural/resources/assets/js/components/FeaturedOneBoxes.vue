
<script>
    import jQuery from 'jquery';

    export default {
        props:['identifier'],

        data(){
            return { deals: [] }
        },

        mounted() {
            axios.get('/featured-deals/1').then(response => {
                this.deals = response.data;
                //we need this timeout to let DOM be created
                setTimeout(() => {
                    jQuery('#grid-slider').flexslider({
                        animation: "slide",
                        smoothHeight: true,
                        controlNav: false,
                        nextText: '<i class="ti-angle-right"></i>',
                        prevText: '<i class="ti-angle-left"></i>'
                    });

                }, 0);

            }, response => {});
        },
    }
</script>
