import Vue from 'vue';
import Vuex from 'vuex';

import layout from './layout';

Vue.use(Vuex);

export default new Vuex.Store({


  ///state: {
  //  user: {
  //    loggedIn: false,
  ///    data: null,
  //    nombreUsuario:'',
  //  }
 // },
  state: {
    token: null,
    usuario: null,
    nombreUsuario:'',
    idUsuario:'',
    id_tipo:'',
    tipousuario:''
  },
  getters: {
    user(state){
      return state.user
    },
    Datos(){
      return state.nombreUsuario
    }
  },
  mutations: {
    SET_LOGGED_IN(state, value) {
      state.user.loggedIn = value;
    },
    SET_USER(state, data) {
      state.user.data = data;
    },

    setUsuario(state,nombre){
      state.nombreUsuario=nombre
    },
    settipo(state,id_tipo){
      state.id_tipo=id_tipo
    },
    settipoUsuario(state,tipousuario){
      state.tipousuario=tipousuario
    },
  },

  actions: {
    fetchUser({ commit }, user) {
      commit("SET_LOGGED_IN", user !== null);
      if (user) {
        console.log(user)
        commit("SET_USER", {
          displayName: user.displayName,
          email: user.email
        });
      } else {
        commit("SET_USER", null);
      }
    },

    guardarDatos({commit},nombre){
      commit("setUsuario",nombre)  
    
      localStorage.setItem("nombre", nombre)
    
    },
    guardarTipo({commit},id_tipo){   
      commit("settipo",id_tipo)
    
      localStorage.setItem("idtipo", id_tipo)
    },
    guardarTipoUsuario({commit},tiposusuario){   
      commit("settipoUsuario",tiposusuario)      
      localStorage.setItem("tipousuario", tiposusuario)
    },

    guardarToken({commit},token){
      commit("setToken", token)
      commit("setUsuario", decode(token))
      localStorage.setItem("token", token)

     // dispatch('attempt',token)
    },
  },

  modules: {
    layout,
  },
});
