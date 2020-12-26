<template>
  <b-modal  v-model="Show" @hide="CerrarModal"
  title="Editar Metodologia" hide-footer   body-class="myDiv">
     <form action="">
       <div class="form-row">   
          </div>
          <div class="form-row"> 
              <b-form-group  label="Nombre Metodologia:"  class="col-md-12">
               <b-input                  
                  aria-describedby="input-live-help input-live-feedback"
                  class="p-2 px-4 btn-xs "
                 v-model="nombre">
               </b-input>
             </b-form-group> 
          </div>        
         <hr>
        <div class="float-right" >              
          <b-button type="button"  @click="CerrarModal"  variant="light"  class="p-2 px-4 btn-xs">Cancelar</b-button>
          <b-button type="button"  @click="ModificarMetodologia" variant="primary"  class="p-2 px-4 btn-xs">
              <beat-loader :loading="isLoading" :color="'#68d391'" :size="8" />
             <span v-show="!isLoading">Guardar Cambios</span>
           </b-button>
        </div>
     </form>    
  </b-modal>
</template>
<script>

import axios from  'axios';
export default {
    name: 'metodologia-editar',
    props:{
      DialogoModificar: {       
        type: Boolean,
        required: true,
        default: false
      },id_metodologia: [String, String]
      
    },
    data() {
        return {
          contador:0,
          CodeMetodologia:'M',
          codigo:'',
          nombre:'',            
          isLoading:false,          
          Show:this.DialogoModificar,          
        }
    },
    watch: {
      DialogoModificar(){
        this.Show = this.DialogoModificar
      }
    },
    created () {    

    },
    computed: {
     
    },
    methods: {
      ModificarMetodologia(){         
          let id_metodologia=this.id_metodologia;
          let nombre=this.nombre;           
          const obj={id_metodologia,nombre};
          axios.put('ApiWeb/Metodologia.php/',obj).then(response => { 
               this.ListarMetodologia();
               this.Confirmacion();
          }).catch(function (error) {
              console.log(error);
          }) .finally(() => {              
         })
      },
      ListarElemetos(){
        this.$emit('ListarElemento-Emit');
      },
      ListarMetodologia(){
          this.$emit('Listar-Emit');
      },
      CerrarModal(){              
              this.$emit('CerrarModal');
      },     
      Confirmacion(){
          this.$swal({
              position: 'top-end',
              icon: 'success',
              title: 'Modificado',
              text:'texto',
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

