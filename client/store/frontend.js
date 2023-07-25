import axios from 'axios';

export const state = () => ({
    products : [],
    categories: [],
    singleProduct: null
})

export const getters = {
    products: state => state.products,
    categories: state => state.categories,
    singleProduct : state => state.singleProduct
}

export const mutations =  {
    FETCH_PRODUCT_SUCCESS (state, products){
        state.products = products
    },
    FETCH_PRODUCT_FAILURE (state){
        state.products = []
    },
    FETCH_PRODUCT_CATEGORY_SUCCESS(state, categories){
        state.categories = categories
    },
    FETCH_PRODUCT_CATEGORY_FAILURE(state){
        state.categories = []
    },
    SET_SINGLE_PRODUCT(state, payload){
        state.singleProduct = payload
    },
    CLEAR_SINGLE_PRODUCT(state){
        state.singleProduct = null
    }
}

export const actions = {
    async fetchProducts ({commit}){
        try {
            const {data} = await axios.get('/data-product')

            commit('FETCH_PRODUCT_SUCCESS', data.data)
        } catch (e) {
            commit('FETCH_PRODUCT_FAILURE')
        }
    },
    async fetchProductCategory ({commit}){
        try {
            const {data} = await axios.get('/data-product-category')
            commit('FETCH_PRODUCT_CATEGORY_SUCCESS', data.data)
        } catch (e) {
            commit('FETCH_PRODUCT_CATEGORY_FAILURE')
        }
    },
    async fetchAllProduct({commit}){
        try {
            const {data} = await axios.get('/data-all-product')

            commit('FETCH_PRODUCT_SUCCESS', data.data)
        } catch (e) {
            commit('FETCH_PRODUCT_FAILURE')
        }
    },
    async setSingleProduct({commit}, slug){
        try {
            const {data} = await axios.get(`/single-product/${slug.slug}`)
            console.log(data);

            commit('SET_SINGLE_PRODUCT', data.data)
        } catch (e) {
            commit('CLEAR_SINGLE_PRODUCT')
        }
    },
}
