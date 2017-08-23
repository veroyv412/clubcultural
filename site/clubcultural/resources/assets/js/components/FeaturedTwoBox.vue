<template>
    <div class="deal-item">
        <div>&nbsp;</div>
        <div class="deal-entry green">
            <div class="offer-discount">
                -{{ deal.discount }}%
            </div>
            <img :src="deal.featured_image" alt="#" class="img-responsive">

            <!-- /.image -->
            <div class="title">
                <a :href="'/deal/' + deal.id" :title="deal.title">
                    {{ deal.title }}
                </a>
            </div>
            <div class="entry-content">
                <div class="prices clearfix">
                    <div class="procent">
                        -{{ deal.discount }}%
                    </div>
                    <div class="price">
                        <i class="ti-money"></i>
                        <b>{{ deal.discount_price }}</b>
                    </div>
                    <div class="old-price">
                        <span>
                          <i class="ti-money"></i>
                            {{ deal.price  }}
                        </span>
                    </div>
                </div>
                <p>
                    {{ deal.description }}
                </p>
            </div>
            <!--/.entry content -->
            <footer class="info_bar clearfix">
                <a :href="'/deal/' + deal.id" class="btn btn-block btn-primary btn-raised btn-sm">
                    Ver Descuento
                </a>
            </footer>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['deal'],

        data(){
            return {  }
        },

        mounted() {

        }
    }
</script>
