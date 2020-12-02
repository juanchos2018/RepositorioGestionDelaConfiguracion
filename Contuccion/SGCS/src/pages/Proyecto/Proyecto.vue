<template>
    <div>
       <div>
       <!--  <b-button type="button"  class="m-1 p-2 px-4 btn-xs" variant="primary" @click="Nuevo"> 
            <i class="fa fa-plus-circle"></i> Nuevo Proyecto
          </b-button> -->
          <div style="width: 200px;  display: inline-block;">
            <label for="">Buscar</label> 
            <b-form-input
                id="input-30" 
                require
                class="p-2 px-4 btn-xs"               
              v-model="search"  >
          </b-form-input> 
         </div> 
          <br>    
          <br>       
        </div>
       <div class="row" >
          
        <div class="col-4" v-for="item in items" :key="item.key">
        <b-card  border-variant="primary" >
            <b-dropdown class="dropdown-icon strong"   variant="#FFFFF" style="float:right;font-weight: 400" right >            
                     <b-dropdown-item @click="AbrirDialogo(item.id_proyecto)">Nuevo Miembro</b-dropdown-item>
                    <b-dropdown-item @click="Miembros(item.id_proyecto)">Miembros</b-dropdown-item>
                   
                    <b-dropdown-item @click="Detalle(item.id_proyecto)">Detalle</b-dropdown-item>           
                </b-dropdown>             
            <b-card-title>{{item.nombre_proyecto}}</b-card-title>  
            <br>    
            <b-card-text>
                Fecha Inicio :  {{item.fecha_inicio}} <br>
                Fecha Termino:  {{item.fecha_termino}}<br>
                Estado:  <span class="badge badge-success">{{item.estado}}</span>  <br>
               
            </b-card-text>
            <br>
            <br>
          <!--   <b-card-text class="small text-muted">Ultima Actualizacion hace 3 min</b-card-text>-->
            </b-card>
            <br>
            </div>
        </div>
        <miembro-nuevo @CerrarModal="CerrarModal"   v-bind:id_proyecto="id_proyecto" :DialogMiembro="DialogMiembro" > </miembro-nuevo>
  
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
              id_proyecto:'',
              pepep:'asdadsasd',
              search: '',
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
            // console.log(id_proyecto);
             this.$router.push({name:"proyectodetalle",params:{id_proyecto} });
           //this.$router.push('/app/proyectodetalle');   
        },
        Miembros(id_proyecto){
            // this.$router.push('/app/proyectomiembro'); 
             this.$router.push({name:"proyectomiembro",params:{id_proyecto} });
        },
        AbrirDialogo(id){
             this.DialogMiembro=true,
             this.id_proyecto=id;

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
