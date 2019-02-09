import VueRouter from 'vue-router';
import Vue from 'vue';
import AppMarks from './components/pages/marks';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/marks',
            component: AppMarks,
            name: 'marks'
        }
    ]
});
