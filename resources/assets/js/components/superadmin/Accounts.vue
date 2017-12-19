<template lang="html">
  <div>

    <!-- Title -->
    <v-layout class="grey--text mt-2 mb-2">
      <h1>Cuentas <span class="hidden-sm-and-down">de clientes</span></h1>
      <v-spacer></v-spacer>
      <v-btn class="ma-0" color="blue-grey" @click="openModal('create')">
        nueva
      </v-btn>
    </v-layout>

    <v-divider class="mt-3 mb-3"></v-divider>

    <!-- Subtoolbar -->
    <v-layout>
      <v-btn-toggle class="elevation-0 transparent" v-model="toggleViewOptions" flat>
        <v-btn flat small>
          <v-icon class="subheading">fa-th-large</v-icon>
        </v-btn>
        <v-btn flat small>
          <v-icon class="subheading">fa-th-list</v-icon>
        </v-btn>
      </v-btn-toggle>
      <v-spacer></v-spacer>
      <v-text-field
        append-icon="search"
        class="ma-0 pa-0"
        color='cyan'
        name="searchbox"
        placeholder="Buscar..."
        v-model="search"
      ></v-text-field>
      </v-btn>
    </v-layout>

    <!-- IS LOADING -->
    <loading-screen v-if="isLoading"></loading-screen>

    <!-- Card View -->
    <section v-if="toggleViewOptions == 0 && items.length > 0 && !isLoading">
      <v-container v-if="filteredItems.length > 0" class="mt-3 grid-list-sm" fluid>
        <v-layout row wrap>
            <account-card v-for="item in filteredItems" :key="item.id" :item="item"></account-card>
        </v-layout>
      </v-container>
      <div v-else class="pt-5 pb-5 full-height text-xs-center">
        <h1 class="grey--text display-2">No hay resultados...</h1>
      </div>
    </section>

    <!-- LIst View -->
    <section v-else-if="toggleViewOptions == 1 && items.length > 0 && !isLoading">
      <v-data-table
        class="mt-3"
        :headers="table.headers"
        :items="items"
        :search="search"
        hide-actions
        item-key="name"
      >
        <template slot="items" slot-scope="props">
          <tr>
            <td>{{ props.item.id }}</td>
            <td>{{ props.item.name }}</td>
            <td>{{ props.item.key }}</td>
            <td>{{ props.item.company }}</td>
            <!-- Item Actions -->
            <td class="text-xs-right">
              <v-tooltip top>
                <v-btn class="ma-0" slot="activator" small flat icon @click="openItem(props.item)">
                  <v-icon class="cyan--text text--lighten-3 subheading">fa-eye</v-icon>
                </v-btn>
                <span>Más detalles</span>
              </v-tooltip>
              <v-tooltip top>
                <v-btn class="ma-0" slot="activator" small flat icon @click="openModal('edit', props.item)">
                  <v-icon class="green--text text--lighten-3 subheading">fa-pencil</v-icon>
                </v-btn>
                <span>Editar</span>
              </v-tooltip>
              <v-tooltip top>
                <v-btn class="ma-0" slot="activator" small flat icon @click="openModal('delete', props.item)">
                  <v-icon class="red--text text--lighten-3 subheading">fa-trash-o</v-icon>
                </v-btn>
                <span>Eliminar</span>
              </v-tooltip>
            </td>
          </tr>
        </template>
      </v-data-table>
    </section>

    <!-- No Results -->
    <section v-if="isLoading == false && items.length <= 0" class="pt-5 pb-5 full-height text-xs-center">
      <h1 class="grey--text display-2 pt-5">No hay resultados...</h1>
      <p class="grey--text mt-4">
        No se han encontrado registros, por favor crea una cuenta nueva.
      </p>
    </section>

    <!-- View Account -->
    <account-view :viewItem="viewItem"></account-view>

    <!-- MODALS -->
    <v-dialog
      v-model='modal.show'
      max-width="600px"
      persistent
    >
      <v-card v-if="modal.create == true || modal.edit == true">
        <!-- Heading -->
        <v-layout class="pa-1 pl-3 align-center">
          <h3 class="subheading grey--text">{{ modal.text }} cuenta</h3>
          <v-spacer></v-spacer>
          <v-btn color='grey' flat icon @click.prevent='modal.show = !modal.show'>
            <v-icon>close</v-icon>
          </v-btn>
        </v-layout>
        <v-divider></v-divider>
        <!-- FORM -->
        <form class="pa-3" @submit.stop='submit' @keydown="form.errors.clear($event.target.name)">
          <v-container grid-list-md>
            <v-layout row wrap>
              <v-flex xs12 sm6>
                <v-text-field
                  hint='Escribe el nombre de la cuenta.'
                  label='Nombre*'
                  name='name'
                  prepend-icon='fa-server'
                  v-model='form.name'
                  :counter='20'
                  :error-messages="form.errors.get('name')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6>
                <v-text-field
                  hint='Empresa a la que pertenece.'
                  label='Empresa*'
                  name='company'
                  prepend-icon='fa-institution'
                  v-model='form.company'
                  :counter='20'
                  :error-messages="form.errors.get('company')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6>
                <v-text-field
                  hint='Asocia una clave de cuenta.'
                  label='Clave*'
                  name='key'
                  prepend-icon='vpn_key'
                  v-model='form.key'
                  :counter='16'
                  :error-messages="form.errors.get('key')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6>
                <v-select
                  label='Tipo de cuenta*'
                  prepend-icon='fa-unsorted'
                  :items='accountTypes'
                  item-text='text'
                  item-value='value'
                  v-model="form.type"
                  :error-messages="form.errors.get('type')"
                ></v-select>
              </v-flex>
              <v-flex xs12>
                <v-text-field
                  hint='Agrega una nota asociada a la cuenta.'
                  label='Nota (opcional)'
                  multi-line
                  name='note'
                  prepend-icon='fa-sticky-note-o'
                  v-model='form.note'
                  :counter='255'
                  :error-messages="form.errors.get('note')"
                ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
        </form>
        <v-divider></v-divider>
        <v-layout class="pa-1 pr-3 pl-3">
          <v-btn v-if="modal.create" color='grey' flat icon @click="form.reset()">
            <v-icon>refresh</v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn class="red--text text--lighten-3" flat @click="form.reset(), modal.show = false">
            <v-icon class="subheading red--text text--lighten-3 mr-2">fa-close</v-icon>
            Cancelar
          </v-btn>
          <v-btn class="green--text text--lighten-3" flat @click.prevent="(modal.create) ? submit('create') : submit('edit')">
            <v-icon class="subheading green--text text--lighten-3 mr-2">fa-save</v-icon>
            Guardar
          </v-btn>
        </v-layout>
      </v-card>

      <v-card v-if="modal.delete == true">
        <!-- Heading -->
        <v-layout class="pa-1 pl-3 align-center">
          <h3 class="subheading grey--text">{{ modal.text }}</h3>
          <v-spacer></v-spacer>
          <v-btn color='grey' flat icon @click.prevent='modal.show = !modal.show'>
            <v-icon>close</v-icon>
          </v-btn>
        </v-layout>
        <v-divider></v-divider>
        <v-card-text>
          <span class="subheading error--text">AVISO IMPORTANTE:</span> Al eliminar una cuenta es probable que se pierda información importante relacionada a la misma, los usuarios pertenecientes a dicha cuenta no podrán tener acceso a la plataforma, además es probable que se presente una perdida de datos irreversible.
        </v-card-text>
        <v-divider></v-divider>
        <v-layout class="pa-1 pr-3 pl-3">
          <v-spacer></v-spacer>
          <v-btn class="red--text text--lighten-3" flat @click="form.reset(), modal.show = false">
            <v-icon class="subheading red--text text--lighten-3 mr-2">fa-close</v-icon>
            Cancelar
          </v-btn>
          <v-btn class="green--text text--lighten-3" flat @click.prevent="submit('delete')">
            <v-icon class="subheading green--text text--lighten-3 mr-2">fa-trash-o</v-icon>
            Estoy seguro, eliminar.
          </v-btn>
        </v-layout>
      </v-card>
    </v-dialog>

    <!-- SNACKBAR -->
    <v-snackbar v-model="form.snackbar.show" :color="form.snackbar.color" bottom>
      <v-icon class="mr-3 subheading">{{ form.snackbar.icon }}</v-icon>
      {{ form.snackbar.message }}
    </v-snackbar>


  </div>
</template>

<script>

import {Table} from '../../classes.js'
import {Form} from '../../form-handler.js'

export default {
  data() {
    return {
      accountTypes: [
        {text: 'Básico', value: 1},
        {text: 'Normal', value: 2},
        {text: 'Premium', value: 3}
      ],
      items: [],
      form: new Form({
        id: '',
        name: '',
        company: '',
        key: '',
        type: '',
        note: '',
      }),
      table: new Table([
          { text: 'Id', align: 'left', value: 'id' },
          { text: 'Nombre', align: 'left', value: 'name' },
          { text: 'Clave', align: 'left', value: 'key' },
          { text: 'Company', align: 'left', value: 'company' },
          { text: 'Acciones', value: 'actions', sortable: false }
      ]),
      toggleViewOptions: 0,
      search: '',
      modal: {
        create: false,
        delete: false,
        edit: false,
        show: false,
        text: '',
        view: false,
      },
      isLoading: true,
      viewItem: {
        item: {},
        show: false
      }
    }
  },
  computed: {
    filteredItems() {
      if (this.search && this.toggleViewOptions == 0) {
        let result = [];

        for (var i = 0; i < this.items.length; i++) {
          let verified = false
          Object.keys(this.items[i]).some(prop => {
            let item = this.items[i][prop]
            if (item) {
              let content = item.toString().toLowerCase()
              if (content.includes(this.search.toLowerCase())) {
                verified = true
              }
            }
          })
          if (verified == true) {
            result.push(this.items[i])
          }
        }

        return result
      }

      return this.items
    }
  },
  methods: {
    submit(action) {
      if (action == 'create') {
        this.form.submit('post', '/cuentas')
          .then(res => {
            this.modal.show = false
            this.loadItems()
          })
      }
      else if (action == 'delete') {
        this.form.submit('delete', '/cuentas/' + this.form.id)
          .then(res => {
            this.modal.show = false
            this.loadItems()
          })
      }
      else if (action == 'edit') {
        this.form.submit('put', '/cuentas/' + this.form.id)
          .then(res => {
            this.modal.show = false
            this.loadItems()
          })
      }
    },
    loadItems() {
      this.isLoading = true
      axios.get('/cuentas')
        .then(res => {
          this.items = res.data
          this.isLoading = false
        })
        .catch(err => {
          alert('Error al obtener datos del servidor.')
        })
    },
    openItem(item) {
      this.viewItem.item = item
      this.viewItem.show = true
    },
    closeItem() {
      this.viewItem.item = {}
      this.viewItem.show = false
    },
    openModal(str, item = null) {
      this.modal.create = false
      this.modal.delete = false
      this.modal.edit = false
      this.modal.view = false

      if (str == 'create') {
        this.modal.create = true
        this.modal.text = 'Crear cuenta'
      }
      if (str == 'delete') {
        this.modal.delete = true,
        this.modal.text = 'Eliminar cuenta de ' + item.name

        this.form.id = item.id
      }
      if (str == 'edit') {
        this.modal.edit = true,
        this.modal.text = 'Editar cuenta de ' + item.name

        this.form.id = item.id
        this.form.name = item.name
        this.form.company = item.company
        this.form.key = item.key
        this.form.type = item.type
        this.form.note = item.note
      }

      this.modal.show = true

    }
  },
  beforeMount() {
    this.loadItems()
  }
}
</script>

<style lang="css">
</style>
