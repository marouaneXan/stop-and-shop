import {createStore} from "vuex";
import router from "../router/index"
import axios from "axios";
const state={
    products:[],
    categories:[]
};
const getters={
    categories: (state) => state.categories,
};
const mutations={
    setCategories: (state, categories) => (state.categories = categories),
    redirect(){
        console.log('hello')
    }
};
const actions={
    redirect({commit},payload){
        commit('redirect',payload.val);
        router.push({name:payload.val});
    },
    //get all categories of products
    async fetchCategories({ commit }) {
        let res = await axios("http://stop-and-shop.com/Category");
        commit("setCategories", res.data);
    },
};
const modules={};
export default createStore({
    state,
    getters,
    mutations,
    actions,
    modules,
});