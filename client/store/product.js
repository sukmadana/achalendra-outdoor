import axios from "axios";

export const state = () => ({
    products: [],
})

export const getters = {
    products: state => state.products
}

export const mutations = {
    GET_PRODUCT(state, products){
        state.products = products
    }
}

export const actions = {
    async fetchProducts({commit}){
        const {data} = await axios.get("/admin/product");

        commit('GET_PRODUCT', data.data)
    }
}
