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
                    <b-dropdown-item  @click="EditarTarea">Editar</b-dropdown-item>
                    <b-dropdown-item >Opcion 2</b-dropdown-item>                           
                </b-dropdown>   
            <b-row no-gutters>
              <b-card-title> <h5>Nombre tarea </h5> </b-card-title>   
            <b-col md="12">
                <b-card-body>  
                <b-card-text>
            <h5>Proyecto</h5>
            <h5>Fase</h5>
            <h5>Elemnnto Configuracion</h5>
                </b-card-text>   
                </b-card-body>                  
                 <div  style="background-color: white; float:right;">                     
                      <b-badge variant="danger">12/12/12</b-badge>
                       <b-badge variant="danger">12/12/12</b-badge>
                   </div>           
            </b-col>
            </b-row>  
         </b-card>         
        </div>
        </div>  

                </b-tab>
                <b-tab title="Tareas Terminadas">
                    <p>I'm the second tab</p>
                </b-tab>             
            </b-tabs>
       
         <tarea-editar @CerrarModal="CerrarModal" :DialogoTareaEditar="DialogoTareaEditar"  ></tarea-editar>
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
              DialogoTareaEditar:false,
        }
    },
    created () {
        this.ListarTareas();
    },
    methods: {
         ListarTareas(){
             let me=this;
                  var elementos=[];
                  axios.get('Backphp/ProcesoUsuario.php/',).then(function(response){                      
                  me.tareas=response.data;   
                   
              }).catch(function(error){
                  console.log(error);
            });       
        },
        EditarTarea(){
            this.DialogoTareaEditar=true;
        },
        CerrarModal(){
             this.DialogoTareaEditar=false;
        }
    }
}
</script>