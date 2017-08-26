<template>
    <li>
        <div class="col-sm-7 col-lg-8 omega">
            <article class="bg-image entry-lg"
                     :style="{ backgroundImage: 'url(' + deal.featured_image + ')', backgroundPosition: 'center center', backgroundSize: 'cover', backgroundRepeat: 'no-repeat' }"
                     :data-image-src="deal.featured_image">
                    <div class="deal-short-entry bg-green">
                        <p>{{ deal.description | truncate(200) }}</p>
                    </div>
            </article>
        </div>
        <div class="col-sm-5 col-lg-4 alpha entry-lg">
            <div class="buyPanel animated fadeInLeft bg-white Aligner shadow">
                <div class="content">
                    <div class="deal-content">
                        <h3>{{ deal.title }}</h3>
                        <p>{{ deal.description | truncate(200) }}</p>
                    </div>
                    <ul class="deal-price list-unstyled list-inline">
                        <li class="price">
                            <h3>${{ deal.discount_price }}</h3>
                        </li>
                        <li class="buy-now">
                            <a :href="'/deal/' + deal.id " class="btn btn-success btn-raised ripple-effect">
                                Ver Mas
                            </a>
                        </li>
                    </ul>
                    <div class="dealAttributes">
                        <div class="valueInfo bg-light shadow">
                            <div class="value">
                                <p class="value">
                                    ${{ deal.price }}
                                </p>
                                <p class="text">
                                    Valor
                                </p>
                            </div>
                            <div class="discount">
                                <p class="value">{{ deal.discount }}%</p>
                                <p class="text">Descuento</p>
                            </div>
                            <div class="save">
                                <p class="value">
                                    ${{ deal.price - deal.discount_price}}
                                </p>
                                <p class="text">
                                    AHORRO
                                </p>
                            </div>
                        </div>
                        <!-- /.value info -->
                        <div class="timeLeft text-center">
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ deal.business.company_name }}</p>
                        </div>
                        <div class="social-sharing text-center" data-permalink="http://labs.carsonshold.com/social-sharing-buttons">
                            <!-- https://developers.facebook.com/docs/plugins/share-button/ -->
                            <a target="_blank" :href="'http://www.facebook.com/sharer.php?u=' + getDealUrl(deal.id)" class="share-facebook">
                                <span class="icon icon-facebook"></span>
                                  <span class="share-title">
                                    Comparte
                                  </span>
                                  <span class="share-count is-loaded">
                                    150
                                  </span>
                            </a>
                            <!-- https://dev.twitter.com/docs/intents -->
                            <a target="_blank" :href="'http://twitter.com/share?url='+ getDealUrl(deal.id)" class="share-twitter">
                                <span class="icon icon-twitter"></span>
                                  <span class="share-title">
                                    Tweet
                                  </span>
                            </a>

                        </div>
                        <!--/.social sharing -->
                    </div>
                </div>
            </div>
        </div>
    </li>
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
            getDealUrl(deal_id){
                return window.baseURL + '/deal/' + deal_id;
            }
        }
    }
</script>
