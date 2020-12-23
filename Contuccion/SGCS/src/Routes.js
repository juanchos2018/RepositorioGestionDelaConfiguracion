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
import SolicitudNueva from '@/pages/SolicitudCambio/SolicitudNueva';
import SolicitudLista from '@/pages/SolicitudCambio/SolicitudLista';
import Elemento from '@/pages/Elemento/Elemento';
import MiembroTareas from '@/pages/Miembro/MiembroTareas';
import TareaElemento from '@/pages/Tarea/TareaElemento';
import TareaElementoMiembro from '@/pages/Tarea/TareaElementoMiembro';
import TareaUsuario from '@/pages/Tarea/TareaUsuario';
import store from './store/index'

Vue.use(Router);

//export default new Router({
  
var router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta : {
        libre: true
      }
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
          meta :{
            libre: true  
          }         
        },        
        {
          path: 'usuario',
          name: 'usuario',
          component: Usuario,
          meta :{
            Administrador :true,          
          }
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
          meta :{
            Administrador :true,      
            Jefe:true     
          }
        },
        {
          path: 'fases/:item',
          name: 'fases',
          component: Fases,
          meta :{
            Administrador :true,    
            Jefe:true       
          }
        },
        {
          path: 'registro',
          name: 'registro',
          component: Registro,
        },
        
        
        {
          path: 'proyectomiembro:id_proyecto',
          name: 'proyectomiembro',
          component: ProyectoMiembros,
          meta :{
            Administrador :true,     
            Jefe:true      
          }
        },
        {
          path: 'proyectodetalle:id_proyecto',
          name: 'proyectodetalle',
          component: ProyectoDetalle,
          meta :{
            Administrador :true,   
            Jefe:true       
          }
        },
        {
          path: 'solicitud',
          name: 'solicitud',
          component: Solicitud,
        },
        {
          path: 'solicitudnueva',
          name: 'solicitudnueva',
          component: SolicitudNueva,
        },
        {
          path: 'solicitudlista',
          name: 'solicitudlista',
          component: SolicitudLista,
        },
        {
          path: 'elemento',
          name: 'elemento',
          component: Elemento,
          meta :{
            Administrador :true,    
            Jefe:true       
          }
        },
        {
          path: 'components/agregar',
          name: 'nuevo',
          component: ProyectoNuevo,
          meta :{
            Administrador :true,    
            Jefe:true       
          }
        },
        {
          path: 'components/listar',
          name: 'listar',
          component: Proyecto,
          meta :{
            Administrador :true,    
            Jefe:true       
          }
        },
        {
          path: 'components/tarealemento:datos',
          name: 'tarealemento',
          component: TareaElemento,
          meta :{
            Administrador :true,     
            Jefe:true      
          }
        },
        {
          path: 'tareausuario',
          name: 'tareausuario',
          component: TareaUsuario,
          meta :{
            Miembro :true,          
          }
        },
        {
          path: 'tareaselemento:id_responsable',
          name: 'tareaselemento',
          component: TareaElementoMiembro,
          meta :{
            Miembro :true,          
          }
        },
       
       
      ],
    },
  ],
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.libre)){
    next()
  } else if (store.state.tipousuario== 'Administrador'){
    if (to.matched.some(record => record.meta.Administrador)){
      next()
    }
  }else if (store.state.tipousuario== 'Jefe'){
    if (to.matched.some(record => record.meta.Jefe)){
      next()
    }
  }else if (store.state.tipousuario== 'Miembro'){
    if (to.matched.some(record => record.meta.Miembro)){
      next()
    }
  } else{
    next({
      name: 'Login'
    })
  }
})
export default router
