import Vue from 'vue'
import Vuex from 'vuex'
import category from '@/store/modules/category';
import comment from "@/store/modules/comment";
import favorite from '@/store/modules/favorite';
import progress from '@/store/modules/progress';
import relationType from '@/store/modules/relationType';
import resource from '@/store/modules/resource';
import user from '@/store/modules/user';

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        category: category,
        comment: comment,
        favorite: favorite,
        progress: progress,
        relationType: relationType,
        resource: resource,
        user: user,
    }
})
