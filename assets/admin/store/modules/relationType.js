import Requests from "../../services/requests";

export default {
    state: {
        items: []
    },
    mutations: {
        SET_RELATION_TYPES(state, relationTypes) {
            state.items = relationTypes
        },
    },
    actions: {
        async getRelationTypes({ commit }) {
            const response = await Requests.getDatas('/api/relation_types')
            console.log(response)
            commit('SET_RELATION_TYPES', response.data['hydra:member'])
            this.loading = false
        },
    },
    getters: {}
}
