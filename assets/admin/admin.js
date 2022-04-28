import Vue from 'vue';
import {Axios} from "axios";
import vuetify from '@/plugins/vuetify';
import router from "@/router/index";
import {store} from '@/store';
import home from "@/pages/home";
import navigation from '@/layouts/navigation';

new Vue({
    el: '#app',
    vuetify,
    Axios,
    store,
    router,
    components: {
        navigation,
    },
    template: "<navigation/>",
}).$mount('#app')
