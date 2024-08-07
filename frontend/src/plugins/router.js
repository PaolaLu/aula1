import Vue from 'vue';
import Router from 'vue-router';

import AulasHome from '../components/AulasHome.vue';
import ListadoCarrera from '../components/ListadoCarrera.vue';
import AbmCarrera from '../components/AbmCarrera.vue';
import ListadoProfesor from '../components/ListadoProfesor.vue';
import AbmProfesor from '../components/AbmProfesor.vue';
import AbmAula from '../components/AbmAula.vue';
import ListadoAula from '../components/ListadoAula.vue';
import AbmReservaAula from '../components/AbmReservaAula.vue';
import ListadoReservaAula from '../components/ListadoReservaAula.vue';
import AbmHorarioMateria from '../components/AbmHorarioMateria.vue';
import ListadoHorarioMateria from '../components/ListadoHorarioMateria.vue';
import AbmMateria from '../components/AbmMateria.vue';
import ListadoMateria from '../components/ListadoMateria.vue';

Vue.use(Router);

const routes = [
  { path: '/', name: 'AulasHome', component: AulasHome },
  { path: '/carreras', name: 'ListadoCarrera', component: ListadoCarrera },
  { path: '/abmcarrera', name: 'AbmCarrera', component: AbmCarrera },
  { path: '/profesores', name: 'ListadoProfesor', component: ListadoProfesor },
  { path: '/abmprofesor', name: 'AbmProfesor', component: AbmProfesor },
  { path: '/abmaula', name: 'AbmAula', component: AbmAula },
  { path: '/aulas', name: 'ListadoAula', component: ListadoAula },
  { path: '/abmreservaaula', name: 'AbmReservaAula', component: AbmReservaAula },
  { path: '/reservaaula', name: 'ListadoReservaAula', component: ListadoReservaAula },
  { path: '/abmhorariomateria', name: 'AbmHorarioMateria', component: AbmHorarioMateria },
  { path: '/horariomateria', name: 'ListadoHorarioMateria', component: ListadoHorarioMateria },
  { path: '/abmmateria', name: 'AbmMateria', component: AbmMateria },
  { path: '/materia', name: 'ListadoMateria', component: ListadoMateria },

];

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

export default router;
