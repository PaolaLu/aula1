<template>
    <div>
      <div>
        <v-btn color="primary" @click="navigateToAbmCarrera">Agregar Carrera</v-btn>
      </div>
  
      <v-data-table
        :headers="headers"
        :items="listadoCarreras"
        height="400"
        item-value="name"
      >
        <template v-slot:item.actions="{ item }">
          <v-icon @click="editarCarrera(item)" class="mr-2">mdi-pencil</v-icon>
          <v-icon @click="confirmarEliminarCarrera(item)" class="ml-2">mdi-delete</v-icon>
        </template>
      </v-data-table>
  
      <v-dialog v-model="mostrarAbmCarreras" max-width="500px" persistent>
        <AbmCarreras
          :carrera="carreraSeleccionada"
          :editar="editar"
          @guardar="guardarAbmCarrera"
          @cancelar="cancelarAbmCarrera"
        />
      </v-dialog>
  
      <v-dialog v-model="mostrarConfirmacion" max-width="500px">
        <v-card>
          <v-card-title class="headline">Confirmar Eliminación</v-card-title>
          <v-card-text>¿Está seguro de que desea eliminar esta carrera?</v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="green darken-1" text @click="mostrarConfirmacion = false">Cancelar</v-btn>
            <v-btn color="red darken-1" text @click="eliminarCarreraConfirmada">Eliminar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </template>
  
  <script>
  import custom_axios from '../plugins/axios.js';  
  import AbmCarrera from './AbmCarrera.vue';
  
  export default {
    components: {
      AbmCarrera,
    },
    data() {
      return {
        headers: [
          { text: 'Id', value: 'id' },
          { text: 'Nombre', value: 'nombre' },
          { text: 'Acciones', value: 'actions', sortable: false },
        ],
        listadoCarreras: [],
        mostrarAbmCarreras: false,
        mostrarConfirmacion: false,
        carreraSeleccionada: {},
        carreraAEliminar: null,
        editar: false,
      };
    },
    methods: {
      todasLasCarreras() {
        custom_axios
          .get('/apiv1/carrera')
          .then(response => {
            if (response.status === 200) {
              this.listadoCarreras = response.data;
            }
          })
          .catch(error => {
            console.log(error);
          });
      },
      navigateToAbmCarrera() {
        this.$router.push('/abmcarrera');
      },
      editarCarrera(item) {
        this.carreraSeleccionada = { ...item };
        this.editar = true;
        this.mostrarAbmCarreras = true;
      },
      confirmarEliminarCarrera(item) {
        this.carreraAEliminar = item;
        this.mostrarConfirmacion = true;
      },
      eliminarCarreraConfirmada() {
        custom_axios
          .delete(`/apiv1/carrera/${this.carreraAEliminar.id}`)
          .then(response => {
            if (response.status === 204) {
              this.todasLasCarreras();
              this.mostrarConfirmacion = false;
        
            }
          })
          .catch(error => {
            console.log(error);
          });
      },
      guardarAbmCarrera() {
        this.mostrarAbmCarreras = false;
        this.todasLasCarreras();
      },
      cancelarAbmCarrera() {
        this.mostrarAbmCarreras = false;
      },
    },
    mounted() {
      this.todasLasCarreras();
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
  