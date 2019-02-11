import './bootstrap';
import Vue from 'vue';
import router from './router';
import AppTemplate from './template/template';

const app = new Vue({
    el: '#app',
    render: h => h(AppTemplate),
    router,
    beforeCreate() {
        router.push({name: localStorage.route || 'marks'});
    }
});
