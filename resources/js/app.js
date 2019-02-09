require('./bootstrap');
window.Vue = require('vue');
import router from './router';
import AppTemplate from './components/template/template';
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
const app = new Vue({
    el: '#app',
    render: h => h(AppTemplate),
    router
});
