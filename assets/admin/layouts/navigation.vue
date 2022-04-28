<template>
  <v-app style="background-color: lightgray">
    <v-row>
      <v-col class="col-2">
        <v-card height="100%" style="z-index: 0">
          <v-navigation-drawer
              absolute
              permanent
              left
              color="primary"
          >
            <v-list dense>
              <v-list-item
                  v-for="item in items"
                  :key="item.title"
                  :href="item.to"
              >
                <v-list-item-icon>
                  <v-icon color="white">{{ item.icon }}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                  <v-list-item-title class="white--text">{{ item.title }}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
            <!--        <v-list dense>-->
            <!--        <v-list-item-->
            <!--            to="/ressources/create"-->
            <!--            @click="createResource"-->
            <!--        >-->
            <!--          <v-list-item-icon>-->
            <!--            <v-icon>mdi-account</v-icon>-->
            <!--          </v-list-item-icon>-->

            <!--          <v-list-item-content>-->
            <!--            <v-list-item-title class="white&#45;&#45;text">{{ item.title }}</v-list-item-title>-->
            <!--          </v-list-item-content>-->
            <!--        </v-list-item>-->
            <!--      </v-list>-->
          </v-navigation-drawer>
        </v-card>
      </v-col>
      <v-col class="col-10">
        <v-main class="ma-0" fluid>
          <!--      <v-container class=" ma-0" fluid>-->
          <v-container fluid>
            <router-view>
            </router-view>
          </v-container>

          <!--      </v-container>-->
        </v-main>
      </v-col>
    </v-row>

  </v-app>
</template>

<script>
export default {
  name: "navigation",
  data () {
    return {
      items: [
        { title: 'Statistiques', to: '/app/accueil', icon: 'mdi-home-city', action: '' },
        { title: 'Créer une ressource', to: '/ressources/create', icon: 'mdi-account', action: 'createResource' },
        { title: 'Gérer les ressources', to: '/app/liste-ressources', icon: 'mdi-account', action: '' },
        { title: 'Comptes utilisateurs', to: '/app/liste-utilisateurs', icon: 'mdi-account-group-outline', action: '' },
      ],
    }
  },
  methods: {
    createResource() {
      console.log('ici')
      this.$router.go(0)
    }
  }
}
</script>

<style scoped>

</style>
