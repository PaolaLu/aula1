<template>
    <v-form ref="form" v-model="valid" @submit.prevent="submit">
      <v-card>
        <v-card-title>{{ editar ? 'Editar Aula' : 'Agregar Aula' }}</v-card-title>
        <v-card-text>
          <v-text-field
            v-model="aulaData.descripcion"
            label="Descripcion"
            :rules="descripcionRules"
            required
          ></v-text-field>
          <v-text-field
            v-model="aulaData.ubicacion"
            label="Ubicacion"
            :rules="ubicacionRules"
            required
          ></v-text-field>
          <v-text-field
            @keyup.enter="submit"
            v-model="aulaData.cant_pcs"
            label="Cant_pcs"
            :rules="cant_pcsRules"
            required
          ></v-text-field>
          <v-text-field
            @keyup.enter="submit"
            v-model="aulaData.cant_proyector"
            label="Cant_proyector"
            :rules="cant_proyectorRules"
            required
          ></v-text-field>
          <v-text-field 
            @keyup.enter="submit"
            v-model="aulaData.es_climatizada"
            label="Es_climatizada"
            :rules="es_climatizadaRules"
            required
          ></v-text-field>
          <v-text-field
            @keyup.enter="submit"
            v-model="aulaData.aforo"
            label="Aforo"
            :rules="aforoRules"
            required
          ></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" @click="submit" :disabled="!valid">
            Guardar
          </v-btn>
          <v-btn color="secondary" @click="cancelar">
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
  </template>
  
  <script>
  import custom_axios from '../plugins/axios.js';
  
  export default {
    props: {
      aula: {
        type: Object,
        default: () => ({ id: "", descripcion: "", ubicacion: "", cant_pcs: "", cant_proyector: "", es_climatizada: "", aforo: ""}),
      },
      editar: {
        type: Boolean,
        default: false,
      },
    },
    data() {
      return {
        valid: false,
        aulaData: {
          descripcion: "",
          ubicacion: "",
          cant_pcs: "",
          cant_proyector: "",
          es_climatizada: "",
          aforo: "",
        },
        descripcionRules: [
          v => !!v || 'La descripcion es obligatoria',
        ],
        ubicacionRules: [
          v => !!v || 'La ubicacion es obligatoria',
        ],
      };
    },
    watch: {
      aula: {
        handler(nuevoValor) {
          this.aulaData = { ...nuevoValor };
          if (!this.editar) {
            this.resetValidationForAbm();
          }
        },
        immediate: true,
        deep: true,
      },
    },
    methods: {
      submit() {
        if (this.editar) {
          this.editarAula();
        } else {
          this.guardarAula();
        }
      },
      guardarAula() {
        custom_axios
          .post("/apiv1/aula", this.aulaData)
          .then(response => {
            console.log(response);
            this.resetValidationForAbm();
            this.$emit("guardar");
            this.$router.push('/aulas'); 
          })
          .catch(error => {
            console.log(error);
          });
      },
      editarAula() {
        custom_axios
          .patch(`/apiv1/aula/${this.aula.id}`, this.aulaData)
          .then(response => {
            console.log(response);
            this.resetValidationForAbm();
            this.$emit("guardar");
          })
          .catch(error => {
            console.log(error);
          });
      },
      cancelar() {
        this.resetValidationForAbm();
        this.$emit("cancelar");
      },
      resetValidationForAbm() {
        if (this.$refs.form) {
          this.$refs.form.resetValidation();
        }
      },
    },
    created() {
      if (this.aula) {
        this.aulaData = { ...this.aula };
      }
    },
  };
  </script>
  
  <style scoped>
  </style>
  