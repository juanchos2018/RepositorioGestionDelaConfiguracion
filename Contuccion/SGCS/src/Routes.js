import Vue from 'vue';
import Router from 'vue-router';
import Layout from '@/components/Layout/Layout';
import Login from '@/pages/Login/Login';
import ErrorPage from '@/pages/Error/Error';
// Main
import AnalyticsPage from '@/pages/Dashboard/Dashboard';

import Usuario from '@/pages/Usuario/Usuario';
import UsuarioTareas from '@/pages/Usuario/UsuarioTareas';

import Metodologia from '@/pages/Metodologias/Metodologia';
import Registro from '@/pages/Registro/Registro';
import Fases from '@/pages/Fases/Fases';
import Proyecto from '@/pages/Proyecto/Proyecto';
import ProyectoNuevo from '@/pages/Proyecto/ProyectoNuevo';
import ProyectoDetalle from '@/pages/Proyecto/ProyectoDetalle';
import ProyectoMiembros from '@/pages/Proyecto/ProyectoMiembros';

import Solicitud from '@/pages/Solicitud/SolicitudCambio';
import Elemento from '@/pages/Elemento/Elemento';
import MiembroTareas from '@/pages/Miembro/MiembroTareas';

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
          meta: {
            requiresAuth: true
          },
        },
        
        {
          path: 'usuario',
          name: 'usuario',
          component: Usuario,
        },
        {
          path: 'miembrotareas:id_proyecto',
          name: 'miembrotareas',
          component: MiembroTareas,
        },
        {
          path: 'usuariotareas:id_proyecto',
          name: 'usuariotareas',
          component: UsuarioTareas,
        },
        {
          path: 'metodologia',
          name: 'metodologias',
          component: Metodologia,
        },
        {
          path: 'fases/:item',
          name: 'fases',
          component: Fases,
        },
        {
          path: 'registro',
          name: 'registro',
          component: Registro,
        },
        {
          path: 'proyecto',
          name: 'proyecto',
          component: Proyecto,
        },
        {
          path: 'proyectonuevo',
          name: 'proyectonuevo',
          component: ProyectoNuevo,
        },
        {
          path: 'proyectomiembro:id_proyecto',
          name: 'proyectomiembro',
          component: ProyectoMiembros,
        },
        {
          path: 'proyectodetalle:id_proyecto',
          name: 'proyectodetalle',
          component: ProyectoDetalle,
        },

        {
          path: 'solicitud',
          name: 'solicitud',
          component: Solicitud,
        },
        {
          path: 'elemento',
          name: 'elemento',
          component: Elemento,
        },
        {
          path: 'components/agregar',
          name: 'nuevo',
          component: ProyectoNuevo,
        },
        {
          path: 'components/listar',
          name: 'listar',
          component: Proyecto,
        },
       
      ],
    },
  ],
});
