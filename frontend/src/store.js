import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        company: {},
        user: {}
    },
    getters: {
        company: state => {
            return state.company;
        },
        user: state => {
            return state.user;
        }
    },
    mutations: {
       SET_COMPANY(state, company) {
           state.company = company;
       },

       SET_USER(state, user) {
           state.user = user;
       }
    },
    actions: {
        setCompany(context, company) {
            context.commit('SET_COMPANY', company)
        },
        setUser(context, user) {
            context.commit('SET_USER', user)
        }
    }
});
