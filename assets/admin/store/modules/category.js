import Requests from "../../services/requests";

export default {
    state: {
        items: []
    },
    mutations: {
        SET_CATEGORIES(state, categories) {
            state.items = categories
        },
    },
    actions: {
        async getCategories({ commit }) {
            const response = await Requests.getDatas('/api/categories')
            commit('SET_CATEGORIES', response.data['hydra:member'])
            this.loading = false
        },
    },
    getters: {}
}
