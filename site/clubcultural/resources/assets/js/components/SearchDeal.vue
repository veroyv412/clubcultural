<template>
    <div class="deal-entry green result-entry clearfix">
        <div class="entry-left col-sm-5 col-lg-6">
            <div class="offer-discount">
                -{{ deal.discount }}%
            </div>
            <div class="image bg-image entry-xs" style="color: red"
                 :style="{ backgroundImage: 'url(' + deal.featured_image + ')', backgroundPosition: 'center center', backgroundSize: 'cover', backgroundRepeat: 'no-repeat' }"
                 :data-image-src="deal.featured_image"></div>
        </div>
        <!-- /.image wrap -->
        <div class="entry-right col-sm-7 col-lg-6">
            <div class="title">
                <a :href="'/deal/' + deal.id" target="_blank" :title="deal.title">
                    {{ deal.title }}
                </a>
            </div>
            <div class="entry-content">
                <div class="prices clearfix">
                    <div class="procent">
                        -{{ deal.discount }}%
                    </div>
                    <div class="price">
                        <i class="ti-money">
                        </i>

                        <b>
                            {{ deal.discount_price }}
                        </b>
                    </div>
                    <div class="old-price">
                            <span>
                              <i class="ti-money"></i>{{ deal.price }}
                            </span>
                    </div>
                </div>
                <p class="truncate">
                    {{ deal.description | truncate(200) }}
                </p>

            </div>
            <!--/.entry content -->
            <footer class="info_bar clearfix">
                <ul class="unstyled list-inline row">
                    <li class="info_link col-sm-5 cl-xs-6 cl-lg-4">
                        <a :href="'/deal/' + deal.id " class="btn btn-primary btn-raised btn-sm">
                            Ver Descuento
                        </a>
                    </li>
                </ul>
            </footer>
        </div>
        <!-- /entry right -->

    </div>
</template>

<script>
    export default {
        props: ['deal'],

        data(){
            return {  }
        },

        mounted() {

        },

        methods: {
            getBackgroundImage(image_src){
                return 'background: url('+image_src+') center center cover no-repeat';
            }
        }
    }
</script>
