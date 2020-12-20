<template>
  <b-modal  v-model="Show" @hide="CerrarModal"
      title="Editar Tarea" hide-footer   body-class="myDiv">
     <form action="">
       <div class="form-row">                 
               <b-form-group  label="Nombre Tarea:"  class="col-md-12">
               <b-input                  
                  aria-describedby="input-live-help input-live-feedback"
                  class="p-2 px-4 btn-xs "
                 v-model="nombre_tarea">
               </b-input>
             </b-form-group>                
          </div>         

            <div class="form-row">                 
               <b-form-group  label="Porcentaje Avance:"  class="col-md-12">            
                  <b-form-input type="range" min="0" max="100" v-model="rango"></b-form-input>
                {{rango}}            
             </b-form-group>                
          </div>
          <div class="form-row"> 
               <b-form-group  label="Url Evidencia"  class="col-md-12">
                        <b-form-input 
                          class="p-2 px-4 btn-xs" 
                          required          
                          v-model="urlevidencia" >
                        </b-form-input>
                   </b-form-group>                 
          </div>            
         <hr>
        <div class="float-right" >              
          <b-button type="button"  @click="CerrarModal"  variant="light"  class="p-2 px-4 btn-xs">Cancelar</b-button>
          <b-button type="button"   variant="primary"  class="p-2 px-4 btn-xs">
              <beat-loader :loading="isLoading" :color="'#68d391'" :size="8" />
             <span v-show="!isLoading"> Registra Avance</span>
            </b-button>
        </div>
     </form>    
  </b-modal>
</template>

<script>

import axios from  'axios';
export default {
    name: 'tarea-editar',  
    props:{
      DialogoTareaEditar: {       
        type: Boolean,
        required: true,
        default: false
      }
      
    },
    data() {
        return {
          contador:0,
          CodeMetodologia:'M',
          codigo:'',
          nombre:'',            
          isLoading:false,          
          Show:this.DialogoTareaEditar,
          id_miembro:'',
          nombre_tarea:'',
          fecha_inicio:'',
          fecha_termino:'',
          miembroreponsableID:'',
          urlevidencia:'',
          rango:'',
         // miembros:[],
          
        }
    },
    watch: {
      DialogoTareaEditar(){
        this.Show = this.DialogoTareaEditar
      }
    },
    created () {    
         
    },
    computed: {
     
    },
    methods: {
            RegistrarTarea(){         
                let verionID=this.id_version;
                let miembroresponsableID=this.id_miembro;    
                let fecha_inicio=this.fecha_inicio;
                let fecha_termino=this.fecha_termino;  
                let descripcion=this.nombre_tarea;
                let porcentajeavance="0";   
                let urlevidencia="nulo";     
                let estado="Nuevo"; 

                const obj={verionID,miembroresponsableID,fecha_inicio,fecha_termino,descripcion,porcentajeavance,urlevidencia,estado};
            //    console.log(obj)
                 axios.post('Backphp/ProcesoTarea.php/',obj).then(response => {                       
                    console.log(response);
                   // this.ListarElemetos();
                    this.Confirmacion();                    
                
                }).catch(function (error) {
                    console.log(error);
                }) .finally(() => {
                    
                })
            },
            ListarElemetos(){
                this.$emit('ListarElemento-Emit');
            },
            
            CerrarModal(){              
                 this.$emit('CerrarModal');
            },
            Confirmacion(){
                this.$swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registrado',
                    text:'se ha registrado con exito',
                    showConfirmButton: false,
                    timer: 3000
                })
            },
    }
};
</script>
<style scoped>
  ::v-deep .myDiv {
    background-color: 	#FFFFFF;
  }

</style>

