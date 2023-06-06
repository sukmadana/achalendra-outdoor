import axios from "axios";

export const state = () => ({
    attributes: [],
})

export const getters = {
    attributes: state => state.attributes
}

export const mutations = {
    GET_ATTRIBUTES(state, attributes){
        state.attributes = attributes
    }
}

export const actions = {
    async fetchAttributes({commit}){
        const {data} = await axios.get("/admin/attribute");

        commit('GET_ATTRIBUTES', data.data)
    }
}