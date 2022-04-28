import Vue from "vue";
import VueRouter from "vue-router";
import Home from '@/pages/home';
import Resources from '@/pages/resources';

const routes = [
    {path: '/app/accueil', component: Home, name: 'home'},
    {path: '/app/liste-ressources', component: Resources, name: 'resources',},
    // {path: '/app/B2b/ateliers', component: WorkshopPage, name: 'workshopPage', meta: {requiresAuth: true}},
    // {path: '/app/B2b/magasins', component: Shop, name: 'shop', meta: {requiresAuth: true}},
    // {path: '/app/B2b/contrats', component: ContractPage, name: 'contractPage', meta: {requiresAuth: true}},
    // {path: '/public/coach/proposal/:token', component: CoachProposal, name: 'coachProposal'},
]


const router = new VueRouter({
    mode: "history",
    base: '/',
    routes // short for `routes: routes`
})

// router.beforeEach((to, from, next) => {
//     const loggedIn = localStorage.getItem('token')
//     console.log(to.path)
//
//     if (to.matched.some(record => record.meta.requiresAuth) && !loggedIn) {
//         console.log('bla')
//     } else if (loggedIn && to.path === '/admin/connexion') {
//         return next('/admin')
//     }
//     next()
// })

Vue.use(VueRouter);

export default router;
