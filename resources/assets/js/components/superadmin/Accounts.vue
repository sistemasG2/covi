<template lang="html">
  <div>

    <!-- Title -->
    <v-layout class="grey--text mt-2 mb-2">
      <h1>Cuentas <span class="hidden-sm-and-down">de clientes</span></h1>
      <v-spacer></v-spacer>
      <v-btn class="ma-0" color="blue-grey" @click.prevent='showModal = !showModal'>
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

    <!-- Card View -->
    <section v-if="toggleViewOptions == 0 && items.length > 0">
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
    <section v-else-if="toggleViewOptions == 1 && items.length > 0">
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
                <v-btn class="ma-0" slot="activator" small flat icon>
                  <v-icon class="cyan--text text--lighten-3 subheading">fa-eye</v-icon>
                </v-btn>
                <span>Más detalles</span>
              </v-tooltip>
              <v-tooltip top>
                <v-btn class="ma-0" slot="activator" small flat icon>
                  <v-icon class="green--text text--lighten-3 subheading">fa-pencil</v-icon>
                </v-btn>
                <span>Editar</span>
              </v-tooltip>
              <v-tooltip top>
                <v-btn class="ma-0" slot="activator" small flat icon>
                  <v-icon class="red--text text--lighten-3 subheading">fa-trash-o</v-icon>
                </v-btn>
                <span>Eliminar</span>
              </v-tooltip>
            </td>
          </tr>
        </template>
      </v-data-table>
    </section>

    <section v-else class="pt-5 pb-5 full-height text-xs-center">
      <h1 class="grey--text display-2">No hay resultados...</h1>
      <p class="grey--text mt-4">
        No se han encontrado registros, por favor crea una cuenta nueva.
      </p>
    </section>

    <!-- MODALS -->
    <v-dialog
      v-model='showModal'
      max-width="600px"
      persistent
    >
      <v-card>
        <!-- Heading -->
        <v-layout class="pa-1 pl-3 align-center">
          <h3 class="subheading grey--text">Crear nueva cuenta</h3>
          <v-spacer></v-spacer>
          <v-btn color='grey' flat icon @click.prevent='showModal = !showModal'>
            <v-icon>close</v-icon>
          </v-btn>
        </v-layout>
        <v-divider></v-divider>
        <!-- FORM -->
        <v-form class="pa-3" @submit.stop='submit'>
          <v-container grid-list-md>
            <v-layout row wrap>
              <v-flex xs12 sm6>
                <!-- :error-messages="form.errors.get('name')" -->
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
        </v-form>
        <v-divider></v-divider>
        <v-layout class="pa-1 pr-3 pl-3">
          <v-btn color='grey' flat icon>
            <v-icon>refresh</v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn class="red--text text--lighten-3" flat>
            <v-icon class="subheading red--text text--lighten-3 mr-2">fa-close</v-icon>
            Cancelar
          </v-btn>
          <v-btn class="green--text text--lighten-3" flat @click.prevent="submit">
            <v-icon class="subheading green--text text--lighten-3 mr-2">fa-save</v-icon>
            Guardar
          </v-btn>
        </v-layout>
      </v-card>
    </v-dialog>

  </div>
</template>

<script>

import {Table} from '../../classes.js'
import {Form} from '../../form-handler.js'

const account = {
  id: 1,
  name: 'Condominio Santa Clara',
  type: 'Standard',
  key: 'sclara789456',
  company: 'Naret S.A.',
  notes: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco Eduardo laboris nisi ut aliquip ex ea commodo consequat.',
  image: 'http://propiedades.com.co/wp-content/uploads/2013/12/CONDOMINIO-SANTA-CLARA-logo-300-x-250-px-11.jpg'
}

export default {
  data() {
    return {
      accountTypes: [
        {text: 'Básico', value: 'basic'},
        {text: 'Normal', value: 'normal'},
        {text: 'Premium', value: 'premium'}
      ],
      //items: Array(15).fill(account),
      items: [],
      form: new Form({
        name: '',
        company: '',
        key: '',
        type: '',
        notes: '',
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
      showModal: false
    }
  },
  computed: {
    filteredItems() {
      if (this.search && this.toggleViewOptions == 0) {
        let result = [];

        for (var i = 0; i < this.items.length; i++) {
          let verified = false
          Object.keys(this.items[i]).some(value => {
            let content = this.items[i][value].toString().toLowerCase()
            if (content.includes(this.search.toLowerCase())) {
              verified = true
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
    submit() {
      this.form.submit('post', '/superadmin/cuentas')
    }
  }
}
</script>

<style lang="css">
</style>
