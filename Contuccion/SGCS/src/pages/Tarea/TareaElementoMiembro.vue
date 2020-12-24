<template>
    <div>
        <h5>Mis Tareas</h5>
        <b-tabs
                active-nav-item-class="font-weight-bold text-uppercase text-danger"
                active-tab-class="font-weight-bold text-success"
                content-class="mt-3" >
                <b-tab title="Tareas por terminar" active>             
       <div   class="row" > 
        <!--  {{ steps[current].content  sub-title="00:00:05"  }}-->
        <div class="col-4" v-for="item in tareas" :key="item.key" style="margin-top:10px">  
            <b-card class="overflow-hidden"  footer-tag="footer" >
                <b-dropdown class="dropdown-icon"   variant="#FFFFF" style="float:right" right >            
                    <b-dropdown-item  @click="EditarTarea(item.id_tarea,item.descripcion,item.porcentajeavance)">Editar</b-dropdown-item>
                    <b-dropdown-item >Opcion 2</b-dropdown-item>                           
                </b-dropdown>   
            <b-row no-gutters>
              <b-card-title> <h5>{{item.descripcion}}</h5> </b-card-title>   
            <b-col md="12">
                <b-card-body>  
                <b-card-text>
               <h5>{{item.estado}}</h5>    
                   <a-progress :percent="parseInt(item.porcentajeavance)" /> 
               </b-card-text>   
                </b-card-body>                  
                 <div  style="background-color: white; float:right;">                     
                      <b-badge variant="danger">{{item.fecha_inicio}}</b-badge>
                       <b-badge variant="danger">{{item.fecha_termino}}</b-badge>
                  </div>           
            </b-col>
            </b-row>  
         </b-card>         
        </div>
        </div>  
            </b-tab>
                <b-tab title="Tareas Terminadas">
                    <p>Tareas Terminadas </p>
                </b-tab>             
            </b-tabs>       
         <tarea-editar @CerrarModal="CerrarModal" :DialogoTareaEditar="DialogoTareaEditar" v-bind:id_tarea="id_tarea"  v-bind:id_responsable="id_responsable" v-bind:descripcion="descripcion"  v-bind:porcentaje="porcentaje"   @update-number="update" v-on:ListarTareas-Emit="ListarTareas"></tarea-editar>
    </div>
</template>

<script>
import axios from  'axios';
import TareaEditar from './TareaEditar';
export default {
    name: 'tarea-usuario',
     components: {TareaEditar  },
    data(){
        return{
              tareas:[],
              tareasterminadas:[],
              DialogoTareaEditar:false,
              idtipousuario:'',
              id_tarea:'',
              descripcion:'',
              porcentaje:null,
              id_responsable:'',
             
        }
    },
    created () {
      //  this.ListarTareas();
    },
    mounted() {
         this.GetDatos() 
    },
    methods: {
        update(num){
            console.log(num)
        },
      GetDatos(){
           var id = this.$route.params.id_responsable
             if(id){        
                 this.id_responsable=id;
                 this.ListarTareas(id);                  
             }      
       },
       ListarTareas(id){
             let me=this;         
             var elementos=[];
             axios.get('Backphp/ApiWeb/Miembro.php/?miembroresponsableID='+id,).then(function(response){                      
                  me.tareas=response.data;                      
              }).catch(function(error){
                  console.log(error);
           });       
        },
        EditarTarea(idtarea,descripcion,porcentaje){
            this.id_tarea=idtarea;
            this.descripcion=descripcion;
            this.porcentaje=parseInt(porcentaje);
            console.log(porcentaje)
            this.DialogoTareaEditar=true;
        },
        CerrarModal(){
             this.DialogoTareaEditar=false;
        }
    }
}
</script>