import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'

Vue.use(Vuetify)

const opts = {
    theme: {
        themes: {
            light: {
                primary: '03989E',
                secondary: '#64b5f6',
                accent: '#78002e',
                error: '#d50000',
            },
        }
    }
}

export default new Vuetify(opts)
