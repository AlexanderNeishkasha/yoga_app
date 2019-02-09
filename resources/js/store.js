import Vuex from 'vuex';
import Vue from 'vue';
import marks from './store/marks';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        marks
    }
});
