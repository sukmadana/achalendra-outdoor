export const state = () => ({
    items: [],
    count: 0,
    total: 0
})

export const getters = {
    items : state => state.items,
    count : state => state.count,
    total : state => state.total
}

export const mutations = {
    SET_CART_ITEM (state, payload){
        let  inCart = state.items.find(p => p.data.id === payload.data.id)
        let cartTotal = 0

        if(!inCart) {
            state.items.push(payload)
            state.total = state.total + payload.data.total
        }else {
            state.items.map(item => {
                if (item.data.id === payload.data.id) {
                    item.data.qty = payload.data.qty
                    item.data.total = payload.data.total
                    cartTotal = cartTotal + payload.data.total
                }

            })
        }

        state.count = state.items.length


    },
    DELETE_ITEM(state, payload) {
        let item  = state.items.find(p => p.id === payload)
        let index = state.items.indexOf(item)
        state.items.splice(index, 1)
    },
    SET_COUNT (state, count){
        state.count = count
    },
    INCREASE_COUNT(state){
        state.count = state.count + 1
    },
    DECREASE_COUNT(state){
        state.count = state.count - 1
    },
    SUM_COUNT_VALUE(state, value){
        state.count = state.count + value
    },
    DELETE_ALL_ITEM(state){
        state.items = []
    }
}

export const actions = {
    setItemCart ({commit}, payload){
        commit('SET_CART_ITEM', payload)
    }
}
