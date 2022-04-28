<template>

  <v-card class="mt-1">
    <v-row class="mx-auto">
      <v-data-table
          dense
          :headers="headers"
          :items="resources"
          :search="search"
          sort-by="calories"
          class="elevation-1 mx-1"
          :expanded.sync="expanded"
          :single-expand="singleExpand"
          show-expand
      >
        <template v-slot:top>
          <v-toolbar
              flat
          >
            <v-toolbar-title>Valider les ressources</v-toolbar-title>
            <v-divider
                class="mx-4"
                inset
                vertical
            ></v-divider>
            <v-spacer></v-spacer>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                hide-details
            ></v-text-field>
            <v-spacer></v-spacer>
            <v-btn
                color="primary"
                dark
                class="mb-2"
                href="/admin/ressources/creer"
            >
              Nouvelle ressource
            </v-btn>
            <v-dialog v-model="dialogDelete" max-width="500px">
              <v-card>
                <v-card-title class="text-h5">Etes-vous sur de vouloir suprimer cette ressource ?</v-card-title>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="closeDelete">Annuler</v-btn>
                  <v-btn color="blue darken-1" text @click="deleteItemConfirm">Confirmer</v-btn>
                  <v-spacer></v-spacer>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>

        <template v-slot:item.name="props">
          <v-edit-dialog
              :return-value.sync="props.item.name"
              large
              persistent
              @save="save(props.item['@id'], {name: props.item.name})"
              @cancel="cancel"
              @open="open"
              @close="close"
          >
            {{ props.item.name }}
            <template v-slot:input>
              <v-text-field
                  v-model="props.item.name"
                  :rules="[max255chars]"
                  label="Edit"
                  single-line
                  counter
              ></v-text-field>
            </template>
          </v-edit-dialog>
        </template>

        <template v-slot:item.category.name="props">
          <v-edit-dialog
              :return-value.sync="props.item.category.name"
              large
              persistent
              @save="save(props.item['@id'], {category: props.item.category['@id']})"
              @cancel="cancel"
              @open="open"
              @close="close"
          >
            <v-chip
                color="#41AEFC"
                small
                dark
            >
              {{ props.item.category.name }}
            </v-chip>
            <template v-slot:input>
              <v-autocomplete
                  v-model="props.item.category"
                  :items="categories"
                  return-object
                  key="id"
                  id="@id"
                  item-text="name"
              >
              </v-autocomplete>
            </template>
          </v-edit-dialog>
        </template>


        <template v-slot:item.resourceType="props">
          <v-edit-dialog
              :return-value.sync="props.item.resourceType"
              large
              persistent
              @save="save(props.item['@id'], {resourceType: currentCategory})"
              @cancel="cancel"
              @open="open"
              @close="close"
          >
            <v-chip
                color="#FCD341"
                small
                dark
            >
              {{ props.item.resourceType }}
            </v-chip>
            <template v-slot:input>
              <v-autocomplete
                  v-model="props.item.resourceType"
                  @change="getCategory($event)"
                  :items="resourceTypes"
                  id="id"
                  item-text="text"
                  item-value="text"
              >
              </v-autocomplete>
            </template>
          </v-edit-dialog>
        </template>

        <template v-slot:item.relationType="props">
          <v-edit-dialog
              :return-value.sync="props.item.relationType.name"
              large
              @save="save(props.item['@id'], props.item)"
              @cancel="cancel"
              @open="open"
              @close="close"

          >
                      <v-chip
                          v-for="item in props.item.relationType"
                          :key="item['key']"
                          color="#FC6341"
                          class="mt-1"
                          small
                          dark
                      >
                        {{ item.name }}
                      </v-chip>
            <template v-slot:input>
              <v-autocomplete
                  v-model="props.item.relationType"
                  :items="relationTypes"
                  item-text="name"
                  item-value="@id"
                  key="id"
                  return-object
                  dense
                  chips
                  small-chips
                  multiple
                  solo
                  @change="read(props.item.relationType['@id'])"
              >{{ props.item.relationType.name }}</v-autocomplete>
            </template>
          </v-edit-dialog>
        </template>



        <template v-slot:item.actions="{ item }">
          <v-icon
              small
              class="mr-2"
              @click="editItem(item)"
          >
            mdi-pencil
          </v-icon>
          <v-icon
              small
              @click="deleteItem(item)"
          >
            mdi-delete
          </v-icon>
        </template>
        <template v-slot:expanded-item="{ headers, item }">

          <td :colspan="headers.length">
            <v-textarea
                v-model="item.content"
                solo
                name="input-7-4"
                class="mt-1"
                :value="item.content"
            >
            </v-textarea>
            <v-btn
                class="mb-1"
                elevation="2"
                @click="save(item['@id'], { content: item.content })"
            >enregistrer</v-btn>

          </td>
        </template>
      </v-data-table>
      <v-snackbar
          v-model="snack"
          :timeout="3000"
          :color="snackColor"
      >
        {{ snackText }}

        <template v-slot:action="{ attrs }">
          <v-btn
              v-bind="attrs"
              text
              @click="snack = false"
          >
            Close
          </v-btn>
        </template>
      </v-snackbar>
    </v-row>

  </v-card>
</template>

<script>
import {mapState} from "vuex";
import editDialogMixin from '@/mixins/editDialogMixin';

export default {
  name: "resources",
  mixins: [editDialogMixin],
  data: () => ({
    search: '',
    currentCategory: '',
    dialog: false,
    dialogDelete: false,
    expanded: [],
    singleExpand: true,
    snack: false,
    snackColor: '',
    snackText: '',
    content: '',
    max255chars: v => v.length <= 255 || 'Titre trop long',
    headers: [
      {text: 'Titre', align: 'start', sortable: false, value: 'name', class: 'white--text teal primary', width: '15%'},
      {text: 'Date de création', value: 'createdAt', align: 'center', class: 'white--text primary', width: '10%'},
      {text: 'Auteur', value: 'createdBy.username', align: 'center', class: 'white--text primary', width: '10%'},
      {text: 'Catégorie', value: 'category.name', align: 'center', class: 'white--text primary', width: '5%'},
      {text: 'Type de ressource', value: 'resourceType', align: 'center', class: 'white--text primary', width: '15%'},
      {text: 'Types de relation', value: 'relationType', align: 'center', class: 'white--text primary', sortable: false, width: '15%'},
      {text: 'Nombre de commentaires', value: 'comments.length', align: 'center', class: 'white--text primary', sortable: false, width: '5%'},
      {text: 'Statut', value: 'status', align: 'center', class: 'white--text teal primary', width: '10%'},
      {text: 'Actions', value: 'actions', align: 'center', class: 'white--text teal primary', sortable: false, width: '10%'},
    ],
    resourceTypes: [
      {id: 'GA', text: 'Jeu à réaliser / activité'},
      {id: 'AR', text: 'Article'},
      {id: 'CH', text: 'Carte défi'},
      {id: 'PC', text: 'Cours au format PDF'},
      {id: 'WO', text: 'Exercice / atelier'},
      {id: 'RS', text: 'Fiche de lecture'},
      {id: 'OG', text: 'Jeu en ligne'},
      {id: 'VI', text: 'Vidéo'},
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    },
    defaultItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    },
  }),

  computed: {
    ...mapState({
      resources: state => state.resource.items,
      categories: state => state.category.items,
      relationTypes: state => state.relationType.items,
    }),
    formTitle() {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
    },
  },

  watch: {
    dialog(val) {
      val || this.close()
    },
    dialogDelete(val) {
      val || this.closeDelete()
    },
  },

  created() {
    this.$store.dispatch('getResources')
    this.$store.dispatch('getCategories')
    this.$store.dispatch('getRelationTypes')
  },

  methods: {
    read(event) {
      console.log('read')
      console.log(event)
    },
    getCategory(event) {
      console.log(event)
      switch (event) {
        case 'Jeu à réaliser / activité':
          this.currentCategory = 'GA';
          console.log(this.currentCategory)
          break;
        case 'Article':
          this.currentCategory = 'AR';
          console.log(this.currentCategory)
          break;
        case 'Carte défi':
          this.currentCategory = 'CH';
          break;
        case 'Cours au format PDF':
          this.currentCategory = 'PC';
          break;
        case 'Exercice / atelier':
          this.currentCategory = 'WO';
          break;
        case 'Fiche de lecture':
          this.currentCategory = 'RS';
          break;
        case 'Jeu en ligne':
          this.currentCategory = 'OG';
          break;
        case 'Vidéo':
          this.currentCategory = 'VI';
          break;
      }
    },
    // save() {
    //   this.snack = true
    //   this.snackColor = 'success'
    //   this.snackText = 'Data saved'
    // },
    // cancel() {
    //   this.snack = true
    //   this.snackColor = 'error'
    //   this.snackText = 'Canceled'
    // },
    // open() {
    //   this.snack = true
    //   this.snackColor = 'info'
    //   this.snackText = 'Dialog opened'
    // },
    //
    // close() {
    //   this.dialog = false
    // },
    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialogDelete = true
    },

    deleteItemConfirm() {
      this.desserts.splice(this.editedIndex, 1)
      this.closeDelete()
    },

    closeDelete() {
      this.dialogDelete = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },
  },
}
</script>

<style scoped>

</style>
