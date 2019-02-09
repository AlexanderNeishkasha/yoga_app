import './bootstrap';
import Vue from 'vue';
import router from './router';
import AppTemplate from './template/template';
import store from './store';

const app = new Vue({
    el: '#app',
    render: h => h(AppTemplate),
    router,
    store,
    beforeCreate() {
        router.push({name: 'marks'});
    }
});
