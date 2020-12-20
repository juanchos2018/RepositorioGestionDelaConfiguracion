<template>
     <div>
     
         <div class="navigation-filter float-right" style="margin-top:20px">
           <a href="#" @click="Grilla" class="cambia" ><i class="fa fa-th-list"></i></a>
          <a href="#"   @click="Card" class="cambia"  ><i class="fa fa-th"></i></a>
        </div>
         <b-button type="button"  class="m-1 p-2 px-4 btn-xs" variant="primary" @click="DialogoElemento=true"> 
            <i class="fa fa-plus-circle"></i> Nuevo
          </b-button>

           <div style="width: 200px;float; float: right; display: inline-block;">
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
        
    <div >   
      <br>
        <div v-if="Vergrilla">
             <b-table :items="filteredList" :fields="fields"  stacked="sm">   
              <template v-slot:cell(accion)="item">
                <b-button variant="primary" @click="Detalle(item.item.id+'-'+item.item.nombre)" >Ver</b-button>
              </template>
            </b-table>
       </div>
      <div v-if="VerCard">   
      <div class="row" >             
       <div class="col-4" v-for="item in filteredList" :key="item.key">                
        <b-card no-body class="overflow-hidden"  footer-tag="footer">
            <b-row no-gutters>
            <b-col md="3">
                <div class="UserAvatar__IconImage-hmym9w-1 jtNJTZ" >
                    <center> 
                    <img src="../../assets/elemento.png" alt="Avatar" class="avatar1"/> 
                    </center>
                </div>     
            </b-col>
            <b-col md="8">
                <b-card-body >                   
                <b-card-title> <h5> {{item.nombre}}</h5> </b-card-title>                    
                <b-card-text>
                texto
                </b-card-text>                
                </b-card-body>                
            </b-col>
            </b-row>            
                <template #footer  footer-class="myDiv">
                     <div  style="background-color: white; float:right;">
                       <b-button variant="success" v-b-tooltip.hover title="Editar" > <b-icon icon="pencil-square" animation="fade" font-scale="1" @click="AbrirModalEditar(item.id_elemento)"></b-icon> </b-button>
                      <b-button variant="danger" style="margin-left:2px"  @click="MensajeEliminar" v-b-tooltip.hover title="Eliminar"> <b-icon icon="trash" animation="fade" font-scale="1"></b-icon> </b-button>
                     </div>                                          
                </template>
         </b-card>
         <br>
       </div>
      </div>
     </div>
    </div>
    
   <elemento-nuevo @CerrarModal="CerrarModal" :DialogoElemento="DialogoElemento"  v-on:ListarElemento-Emit="ListarElemento"></elemento-nuevo>
   <elemento-editar @CerrarModal="CerrarModal" :DialogoModificar="DialogoModificar" v-bind:id_elemento="id_elemento"  v-on:ListarElemento-Emit="ListarElemento"></elemento-editar>
   
    </div>
</template>

<script>

import ElementoNuevo from './ElementoNuevo';
import ElementoEditar from './ElementoEditar';

import axios from  'axios';
export default {
     components: {ElementoNuevo,ElementoEditar  },
        data(){
            return{
                   DialogoElemento:false,
                   DialogoModificar:false,
                   items:[],
                   id_elemento:'',  
                   search: '',
                   Vergrilla:false,
                   VerCard:true,
                   fields: [
                    { label:"codigo", key: 'id_elemento', sortable: false },
                    { label:"Nombre", key: 'nombre', sortable: false },    
                    { label:"Acciones", key: 'accion', sortable: false },
                ],
            }
        },
        created(){
            this. ListarElemento();
        },
        methods:{
               CerrarModal() {
                    this.DialogoElemento = false;
                    this.DialogoModificar = false;           
               },
               AbrirModalEditar(id){
                     this.id_elemento=id;   
                     this.DialogoModificar = true;         
               },
               ListarElemento(){
                    let me=this;
                    axios.get('Backphp/ProcesoElemento.php/').then(response => {   
                        console.log(response.data);                         
                      me.items = response.data;                      
                  }).catch(function (error) {
                      console.log(error);
                  }) .finally(() => {
                     
                   })
                },
                MensajeEliminar(){
                    this.$swal.fire({
                        title: 'Elminar ?',
                        text: "Ya no podras revertir!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Eliminar!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                        this.$swal.fire(
                            'Eliminado!',
                            'Has Eliminado.',
                            'success'
                        )
                        }
                    })
                },
                Grilla(){
                        this.Vergrilla=true;
                        this.VerCard=false;
                 },
                Card(){
                        this.Vergrilla=false;
                        this.VerCard=true;
                 },  
          },
         computed: {
            filteredList() {
                return this.items.filter(post => {
                return post.nombre.toLowerCase().includes(this.search.toLowerCase())
               })
      }
    },
}
</script>
<style src="./elemento.scss" lang="scss" scoped  />
