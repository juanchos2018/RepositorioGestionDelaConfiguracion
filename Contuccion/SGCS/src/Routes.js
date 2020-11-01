import Vue from 'vue';
import Router from 'vue-router';

import Layout from '@/components/Layout/Layout';
import Login from '@/pages/Login/Login';

import ErrorPage from '@/pages/Error/Error';
// Main
import AnalyticsPage from '@/pages/Dashboard/Dashboard';


import ComprobanteLista from '@/pages/Comprobante/ComprobanteLista';

//Articulo
import Articulo from '@/pages/Articulo/Articulo';
import Cliente from '@/pages/Cliente/Cliente';
import Pacientes from '@/pages/Pacientes/Pacientes';
import PacienteChat from '@/pages/Pacientes/PacienteChat';
import Usuario from '@/pages/Usuario/Usuario';

import Publicaciones from '@/pages/Publicaciones/Publicaciones';
import Metodologia from '@/pages/Metodologias/Metodologia';
import Registro from '@/pages/Registro/Registro';
import Fases from '@/pages/Fases/Fases';

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
          path: 'usuario',
          name: 'usuario',
          component: Usuario,
        },
        {
          path: 'metodologia',
          name: 'metodologias',
          component: Metodologia,
        },
        {
          path: 'fases',
          name: 'fases',
          component: Fases,
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
       
      ],
    },
  ],
});
