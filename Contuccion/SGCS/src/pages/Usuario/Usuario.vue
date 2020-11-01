<template>
    <div>
        <div>
            <b-button type="button"  class="m-1 p-2 px-4 btn-xs" variant="primary" @click="DialogUsuario=true"> 
                    <i class="fa fa-plus-circle"></i> Nuevo
                </b-button>
                <br>
                
        </div>

 <div >   
      <div class="row" id="listaproyectos">             
       <div class="col-4" v-for="item in items" :key="item.key">  
              
        <b-card no-body class="overflow-hidden" style="max-width: 340px;"  bg-variant="dark" text-variant="white" footer-tag="footer">
            <b-row no-gutters>
            <b-col md="3">
                <div class="UserAvatar__IconImage-hmym9w-1 jtNJTZ" >
                    <center> 
                    <b-img src="https://picsum.photos/600/300/?image=25" alt="Avatar" class="avatar1"> </b-img>  
                    </center>
                </div>     
            </b-col>
            <b-col md="6">
                <b-card-body >                   
                <b-card-title>{{item.nombre}}</b-card-title>                    
                <b-card-text>
                   {{item.rol}}
                </b-card-text>                
                </b-card-body>                
            </b-col>
            </b-row>            
                <template #footer>
                        <em> Datos </em>
                </template>
        </b-card>
              </div>
           </div>
    </div>

         <usuario-nuevo @CerrarModal="CerrarModal" :DialogUsuario="DialogUsuario"></usuario-nuevo>
    
    </div>
</template>

<script>

import firebase from '@/firebase'
import UsuarioNuevo from './UsuarioNuevo';

export default {
 components: {  UsuarioNuevo },

 data(){
     return{
          items:[],
          DialogUsuario:false,
              }
 },
 created(){
      this.Listar();   
    },
 methods:{
       CerrarModal() {
           this.DialogUsuario = false;             
       },
      Listar(){
            firebase.database().ref('Usuario').on('value', (data) => {   
              this.items=[];             
                  data.forEach((doc) => {
                    var item = doc.val()
                    item.key = doc.key  
                    this.items.push(item)
             });
         });
       },
  }

}
</script>

<style src="./stile.scss" lang="scss"  />
