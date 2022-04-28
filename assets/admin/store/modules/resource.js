import Requests from "../../services/requests";

export default {
    state: {
        items: []
    },
    mutations: {
        SET_RESOURCES(state, resources) {
            state.items = resources
        },
    },
    actions: {
        async getResources({ commit }) {
            const response = await Requests.getDatas('/api/resources')
            commit('SET_RESOURCES', response.data['hydra:member'])
            this.loading = false
        },
    },
    getters: {}
}
