import VueRouter from 'vue-router';
import Vue from 'vue';
import store from './store';
import AppMarks from './pages/marks';
import AppStatistic from './pages/statistic';
import AppAuth from './pages/auth';

Vue.use(VueRouter);

function onlyForAuth(to, from, next) {
    if (store.getters.checkLogin) {
        next();
    } else {
        next({name: 'auth'});
    }
}

function onlyForGuests(to, from, next) {
    if (!store.getters.checkLogin) {
        next();
    } else {
        next({name: 'marks'});
    }
}

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: AppMarks,
            name: 'marks',
            beforeEnter: onlyForAuth
        },
        {
            path: '/statistic',
            component: AppStatistic,
            name: 'statistic',
            beforeEnter: onlyForAuth
        },
        {
            path: '/logout',
            name: 'logout',
            beforeEnter(to, from, next) {
                store.dispatch('logout');
                next({name: 'auth'});
            }
        },
        {
            path: '/auth',
            component: AppAuth,
            name: 'auth',
            beforeEnter: onlyForGuests
        },
        {
            path: '/*',
            component: AppMarks,
            beforeEnter: onlyForAuth
        }
    ]
});

router.afterEach(to => {
    localStorage.route = to.name ? to.name : 'marks';
});

export default router;
