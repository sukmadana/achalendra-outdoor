import axios from 'axios'

// state
export const state = () => ({
  categories: [],
  isLoaded: false
})

export const getters = {
    categories: state => state.categories,
    isLoaded: state => state.categories !== null
}

export const mutations = {
  GET_CATEGORIES(state, categories){
    state.categories = categories
  }
}

export const actions = {
  async fetchCategories({commit}){
    const {data} = await axios.get('/admin/product-category')

    commit('GET_CATEGORIES', data.data)
  }
}