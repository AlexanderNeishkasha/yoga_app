import VueRouter from 'vue-router';
import Vue from 'vue';
import AppMarks from './pages/marks';
import AppStatistic from './pages/statistic';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/marks',
            component: AppMarks,
            name: 'marks'
        },
        {
            path: '/statistic',
            component: AppStatistic,
            name: 'statistic',
        }
    ]
});

router.afterEach(to => {
    localStorage.route = to.name;
});

export default router;
