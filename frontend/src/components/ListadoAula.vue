<template>
    <div>
      <div>
        <v-btn color="primary" @click="navigateToAbmAula">Agregar Aula</v-btn>
      </div>
  
      <v-data-table
        :headers="headers"
        :items="listadoAula"
        height="400"
        item-value="name"
      >
        <template v-slot:item.actions="{ item }">
          <v-icon @click="editarAula(item)" class="mr-2">mdi-pencil</v-icon>
          <v-icon @click="confirmarEliminarAula(item)" class="ml-2">mdi-delete</v-icon>
        </template>
      </v-data-table>
  
      <v-dialog v-model="mostrarAbmAula" max-width="500px" persistent>
        <AbmAula
          :aula="aulaSeleccionada"
          :editar="editar"
          @guardar="guardarAbmAula"
          @cancelar="cancelarAbmAula"
        />
      </v-dialog>
  
      <v-dialog v-model="mostrarConfirmacion" max-width="500px">
        <v-card>
          <v-card-title class="headline">Confirmar Eliminación</v-card-title>
          <v-card-text>¿Está seguro de que desea eliminar el aula?</v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="green darken-1" text @click="mostrarConfirmacion = false">Cancelar</v-btn>
            <v-btn color="red darken-1" text @click="eliminarAulaConfirmada">Eliminar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </template>
  
  <script>
  import custom_axios from '../plugins/axios.js';  
  import AbmAula from './AbmAula.vue';

  export default {
    components: {
        AbmAula,
    },
    data() {
      return {
        headers: [
          { text: 'Id', value: 'id' },
          { text: 'Descripcion', value: 'descripcion' },
          { text: 'Ubicacion', value: 'ubicacion' },
          { text: 'Cant_proyectores', value: 'cant_proyector' },
          { text: 'Es_climatizada', value: 'es_climatizada' },
          { text: 'Aforo', value: 'aforo' },
          { text: 'Acciones', value: 'actions', sortable: false },
        ],
        listadoAula: [],
        mostrarAbmAula: false,
        mostrarConfirmacion: false,
        aulaSeleccionada: {},
        aulaEliminar: null,
        editar: false,
      };
    },
    methods: {
      todasLasAula() {
        custom_axios
          .get('/apiv1/aula')
          .then(response => {
            if (response.status === 200) {
              this.listadoAula = response.data;
            }
          })
          .catch(error => {
            console.log(error);
          });
      },
      navigateToAbmAula() {
        this.$router.push('/abmaula');
      },
      editarAula(item) {
        this.aulaSeleccionada = { ...item };
        this.editar = true;
        this.mostrarAbmAula = true;
      },
      confirmarEliminarAula(item) {
        this.aulaAEliminar = item;
        this.mostrarConfirmacion = true;
      },
      eliminarAulaConfirmada() {
        custom_axios
          .delete(`/apiv1/aula/${this.aulaAEliminar.id}`)
          .then(response => {
            if (response.status === 204) {
              this.todasLasAula();
              this.mostrarConfirmacion = false;
             // this.$router.push('/aulas');
            }
          })
          .catch(error => {
            console.log(error);
          });
      },
      guardarAbmAula() {
        this.mostrarAbmAula = false;
        this.todasLasAula();
      },
      cancelarAbmAula() {
        this.mostrarAbmAula = false;
      },
    },
    mounted() {
      this.todasLasAula();
    },
  };
  </script>
  
  <style scoped>
  .mr-2 {
    margin-right: 8px;
  }
  .ml-2 {
    margin-left: 8px;
  }
  </style>