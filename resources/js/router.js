import VueRouter from 'vue-router';
import Vue from 'vue';
import AppMarks from './pages/marks';
import AppStatistic from './pages/statistic';

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
            path: '/*',
            component: AppMarks
        }
    ]
});

router.afterEach(to => {
    localStorage.route = to.name ? to.name : 'marks';
});

export default router;
