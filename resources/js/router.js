import VueRouter from 'vue-router';
import Vue from 'vue';
import AppMarks from './pages/marks';
import AppStatistic from './pages/statistic';
import AppAuth from './pages/auth';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: AppMarks,
            name: 'marks'
        },
        {
            path: '/statistic',
            component: AppStatistic,
            name: 'statistic',
        },
        {
            path: '/auth',
            component: AppAuth,
            name: 'auth',
        },
        {
            path: '/*',
            component: AppMarks
        }
    ]
});

router.afterEach(to => {
    localStorage.route = to.name ? to.name : 'marks';
});

export default router;
