import './bootstrap';
import Vue from 'vue';
import Route from '@/js/routes';
import App from '@/js/layouts/App';
import 'vue-search-select/dist/VueSearchSelect.css'
import {ModelSelect} from 'vue-search-select'
import FlashMessage from '@smartweb/vue-flash-message'
Vue.use(FlashMessage)
Vue.component('ModelSelect', ModelSelect);
const app = new Vue({
    el: '#app',
    data: {
        user: user,
        printdate: printdate
    },
    methods: {
        job_link(ch) {
            let job_name = '';
            if (ch.job_name) {
                let from_admin = ch.job_name.toLowerCase();
                if (from_admin.includes('farmer')) {
                    job_name = 'farmer'
                }
                if (from_admin.includes('restaurant')) {
                    job_name = 'restaurant'
                }
                if (from_admin.includes('delivery')) {
                    job_name = 'delivery'
                }
                if (from_admin.includes('journalist')) {
                    job_name = 'journalist'
                }
                return "/city/" + ch.prefix + "/" + job_name + "/" + ch.job;
            }
        },
        job_visitor_link(ch) {
            let job_name = '';
            if (ch.job_name) {
                let from_admin = ch.job_name.toLowerCase();
                if (from_admin.includes('farmer')) {
                    job_name = 'farmer'
                }
                if (from_admin.includes('restaurant')) {
                    job_name = 'restaurant'
                }
                if (from_admin.includes('delivery')) {
                    job_name = 'delivery'
                }
                if (from_admin.includes('journalist')) {
                    job_name = 'journalist'
                }
                return "/city/" + ch.prefix + "/" + job_name + "/" + ch.job + "/visitor/" + ch.id;
            }
            return '';
        },
        profile_link(obj) {
            return "/city/"+obj.prefix+"/"+obj.address
        }
    },
    router: Route,
    render: h => h(App),
});


