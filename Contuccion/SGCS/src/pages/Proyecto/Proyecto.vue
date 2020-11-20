<template>
    <div>
       <div>
         <b-button type="button"  class="m-1 p-2 px-4 btn-xs" variant="primary" @click="Nuevo"> 
            <i class="fa fa-plus-circle"></i> Nuevo Proyecto
          </b-button>
          <br>           
        </div>

       <div class="row" >
        <div class="col-4" v-for="item in items" :key="item.key">
        <b-card  border-variant="primary" >
            <b-dropdown class="dropdown-icon"   variant="#FFFFF" style="float:right" right >            
                    <b-dropdown-item @click="Miembros">Miembros</b-dropdown-item>
                     <b-dropdown-item  @click="DialogMiembro=true">Agregar Miembro</b-dropdown-item>
                    <b-dropdown-item @click="Detalle(item.id_proyecto)">Detalle</b-dropdown-item>           
                </b-dropdown>             
            <b-card-title>{{item.nombre_proyecto}}</b-card-title>  
            <br>    
            <b-card-text>
                Fecha Inicio :  {{item.fecha_inicio}} <br>
                Fecha Termino:  {{item.fecha_termino}}<br>
                Estado:  <span class="badge badge-success">{{item.estado}}</span>  <br>
                Miembros :4
            </b-card-text>
            <b-card-text class="small text-muted">Ultima Actualizacion hace 3 min</b-card-text>
            </b-card>
            <br>
            </div>
        </div>
 <miembro-nuevo @CerrarModal="CerrarModal"  :DialogMiembro="DialogMiembro" > </miembro-nuevo>
  
    </div>
</template>
<script>

import axios from  'axios';
import firebase from '@/firebase'
import MiembroNuevo from '@/pages/Miembro/MiembroNuevo';
export default {
     components: { MiembroNuevo },
    data(){
        return{
              items:[],
              DialogMiembro:false,
        }
    },
    created(){
       this.ListarProyecto();
    },
    methods:{
        Nuevo(){
             this.$router.push('/app/proyectonuevo');
        },
        Detalle(id_proyecto){
                console.log(id_proyecto);
             this.$router.push({name:"proyectodetalle",params:{id_proyecto} });
           //this.$router.push('/app/proyectodetalle');   
        },
        Miembros(){
             this.$router.push('/app/proyectomiembro'); 
        },
        ListarProyecto(){
             let me=this;
              axios.get('Backphp/ProcesoProyecto.php/').then(response => {
                    
                      me.items = response.data;                      
                  }).catch(function (error) {
                      console.log(error);
                  }) .finally(() => {
                     
            })
        },
        Listar(){
            firebase.database().ref('Proyectos').on('value', (data) => {   
              this.items=[];             
                  data.forEach((doc) => {
                    var item = doc.val()
                    item.key = doc.key  
                    this.items.push(item)
             });
         });
       },
       CerrarModal() {
           this.DialogMiembro = false;    
                  
       },
    }
}
</script>

<style src="./proyecto.scss" lang="scss" scoped />
