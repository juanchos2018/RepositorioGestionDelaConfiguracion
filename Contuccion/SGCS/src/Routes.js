import Vue from 'vue';
import Router from 'vue-router';

import Layout from '@/components/Layout/Layout';
import Login from '@/pages/Login/Login';

import ErrorPage from '@/pages/Error/Error';
// Main
import AnalyticsPage from '@/pages/Dashboard/Dashboard';


import Comprobante from '@/pages/Comprobante/Comprobante';
import ComprobanteLista from '@/pages/Comprobante/ComprobanteLista';
import Preventa from '@/pages/Preventa/Preventa';
import PreventaLista from '@/pages/Preventa/PreventaLista'
//Articulo
import Articulo from '@/pages/Articulo/Articulo';
import Cliente from '@/pages/Cliente/Cliente';
import Pacientes from '@/pages/Pacientes/Pacientes';
import PacienteChat from '@/pages/Pacientes/PacienteChat';
import Doctores from '@/pages/Doctores/Doctores';

import Publicaciones from '@/pages/Publicaciones/Publicaciones';

import Registro from '@/pages/Registro/Registro';

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login,
    },
    {
      path: '/error',
      name: 'Error',
      component: ErrorPage,
    },
    {
      path: '/app',
      name: 'Layout',
      component: Layout,
      children: [
        {
          path: 'inicio',
          name: 'AnalyticsPage',
          component: AnalyticsPage,
        },
        {
          path: 'publicaciones',
          name: 'publicaciones',
          component: Publicaciones,
        },
        {
          path: 'registro',
          name: 'registro',
          component: Registro,
        },
        {
          path: 'components/comprobanteslista',
          name: 'ComprobanteLista',
          component: ComprobanteLista,
        },
        // para preventa
        {
          path: 'components/preventas',
          name: 'Preventa',
          component: Preventa,
        },
        {
          path: 'components/preventalista',
          name: 'PreventaLista',
          component: PreventaLista,
        },
        {
          path: 'articulos',
          name: 'Articulo',
          component: Articulo,
        },
        {
          path: 'clientes',
          name: 'cliente',
          component: Cliente
        },
        //dentartDoctores
        {
          path: 'pacientes',
          name: 'pacientes',
          component: Pacientes
        },
        {//  path: 'components/comprobantesdetalle/:id',
          path: 'pacienteschat/:id_usuario',
          name: 'pacienteschat',
          component: PacienteChat
        },
        {
          path: 'doctores',
          name: 'doctores',
          component: Doctores
        },
      ],
    },
  ],
});
