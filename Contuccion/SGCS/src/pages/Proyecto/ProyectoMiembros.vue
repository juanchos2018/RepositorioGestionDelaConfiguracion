<template>
    <div>
      <div>
        <!--
         <b-button type="button"  class="m-1 p-2 px-4 btn-xs" variant="primary" > 
            <i class="fa fa-plus-circle"></i> Nuevo Miembro
          </b-button>-->
          <br>           
        </div>
    <div >   
      <h4>Miembros</h4>
      <div class="row" >             
       <div class="col-4" v-for="item in items" :key="item.key">  
              
        <b-card no-body class="overflow-hidden" style="max-width: 340px;"  bg-variant="secondary" text-variant="white" footer-tag="footer">
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
                <b-card-title > {{item.nombre}}</b-card-title>                    
                <b-card-text>
                   {{item.nombre_rol}}
                </b-card-text>                
                </b-card-body>                
            </b-col>
            </b-row>            
                <template #footer>
                     <div style="float:right">
                       <b-button variant="success" @click="Tareas(item.proyectoId+'-'+item.usuario_miembroid)" > <b-icon icon="list-task" animation="fade" font-scale="1"></b-icon> </b-button>

                       <b-button variant="success" style="margin-left:5px" v-b-tooltip.hover title="Editar" @click="AbrirDialogo" >    <b-icon icon="pencil-square" animation="fade" font-scale="1" ></b-icon>   </b-button>
                     </div>                     
                </template>
         </b-card>
         <br>
       </div>
      </div>
    </div>  
      <editar-rol @CerrarModal="CerrarModal"    :DialogoModificar="DialogoModificar" > </editar-rol>
   
    </div>
</template>

<script>

import firebase from '@/firebase'

import axios from  'axios';
import EditarRol from '@/pages/Miembro/EditarRol';

export default {
    components: { EditarRol  },

    data(){
        return{
              items:[],
              DialogUsuario:false,
              DialogoModificar:false,

             }
      },
      created(){
          // this.Listar();   
          },
      mounted(){
       //     this.GetDatos()
          },
      methods:{

          GetDatos(){
            var item = this.$route.params.id_proyecto
              if(item){        
                  this.ListarMiembrosProyecto(item);  
                 // alert(item);
              }   else{
               // alert("nada")
              }      
          },
          AbrirDialogo(){
            this.DialogoModificar=true;  
          },
          ListarMiembrosProyecto(id){
              let me=this;
              axios.get('Backphp/ProcesoMiembro.php/?id_proyecto='+id).then(response => {              
                      me.items = response.data;                                     
                      console.log(response.data);
                    }).catch(function (error) {
                            console.log(error);
                    }) .finally(() => {
                })
            },
            CerrarModal() {
                this.DialogUsuario = false;
                this.DialogoModificar=false;             
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
            ListarMetodologias(){

            },
            Tareas(id_proyecto){
              //  this.$router.push('/app/usuariotareas');
                this.$router.push({name:"miembrotareas",params:{id_proyecto} });
            }
    }

}
</script>
<style src="./proyecto.scss" lang="scss" scoped />
