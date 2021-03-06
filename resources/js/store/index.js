import Vue from 'vue';
import Vuex from 'vuex';
import worlds from './modules/worlds';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        worlds,
    },
});
