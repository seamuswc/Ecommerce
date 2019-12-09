
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';

import PageScripts from './page-scripts';

/* Global vue components */
Vue.component('stock-adjust', require('./components/admin/StockAdjust.vue').default);

/* Initialize vue */
const app = new Vue({
    el: '#app',
    data: {
        qty: '',
        rate:0
    },
    methods: {
        isNumber: function(evt) {

            evt = (evt) ? evt : window.event;

            let  charCode = (evt.which) ? evt.which : evt.keyCode;

            if ((charCode > 31 && (charCode < 48 || charCode > 57)) || charCode === 46) {
                evt.preventDefault();;
            } else {
                return true;
            }
        }
    },
    mounted() {
        PageScripts.init();
    }
});
