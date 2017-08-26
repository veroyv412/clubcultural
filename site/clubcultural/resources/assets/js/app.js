/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.filter('truncate', function(text, stop, clamp){
    return text.slice(0, stop) + (stop < text.length ? clamp || '...' : '')
});

Vue.component('owl-slider', require('./components/OwlSlider.vue'));
Vue.component('ad-slider', require('./components/AdSlider.vue'));
Vue.component('featured-one-box', require('./components/FeaturedOneBox.vue'));
Vue.component('featured-one-boxes', require('./components/FeaturedOneBoxes.vue'));
Vue.component('featured-two-box', require('./components/FeaturedTwoBox.vue'));
Vue.component('featured-two-boxes', require('./components/FeaturedTwoBoxes.vue'));
Vue.component('search-deal', require('./components/SearchDeal.vue'));
Vue.component('search-deals', require('./components/SearchDeals.vue'));
Vue.component('business-form', require('./components/BusinessForm.vue'));
Vue.component('upload-image', require('./components/UploadImage.vue'));

const app = new Vue({
    delimiters: ['{{{', '}}}'],
    el: '#application'
});