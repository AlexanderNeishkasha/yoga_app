import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        token: null
    },
    getters: {
        user(state) {
            return state.user;
        },
        token(state) {
            return state.token;
        },
        checkLogin(state) {
            return !!state.user && !!state.token;
        }
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setToken(state, token) {
            state.token = token;
        }
    },
    actions: {
        setUser(context, user) {
            localStorage.user = JSON.stringify(user);
            context.commit('setUser', user);
        },
        setToken(context, token) {
            localStorage.token = token;
            context.commit('setToken', token);
        },
        logout(context) {
            axios.post('api/logout', {
                headers: {'Authorization': 'Bearer' + context.getters.token}
            });
            localStorage.removeItem('user');
            context.commit('setUser', false);
            localStorage.removeItem('token');
            context.commit('setToken', false);
        }
    }
});
