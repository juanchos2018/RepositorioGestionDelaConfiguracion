<template>
  <b-modal id="modal-cliente" v-model="Show" @hide="CerrarModal"
  title="Nuevo Usuario" hide-footer   body-class="myDiv " >

     <form action="">
       <div class="form-row">   
             <b-form-group id="input-group-3" label="Codigo Usuario:" label-for="NroDocumento" class="col-md-8">
               <b-input                  
                  aria-describedby="input-live-help input-live-feedback"
                  class="p-2 px-4 btn-xs "
              v-model="codigo"  >
               </b-input>
             </b-form-group>     
              <b-form-group id="input-group-3" label="Nombre Nombre:" label-for="NroDocumento" class="col-md-8">
              
               <b-input                  
                  aria-describedby="input-live-help input-live-feedback"
                  class="p-2 px-4 btn-xs "
                 v-model="nombre">
               </b-input>
             </b-form-group>   
              <b-form-group id="input-group-3" label="Rol:" label-for="NroDocumento" class="col-md-8">
              
               <b-input                  
                  aria-describedby="input-live-help input-live-feedback"
                  class="p-2 px-4 btn-xs "
                 v-model="rol">
               </b-input>
             </b-form-group> 
          </div>
        
         <hr>
        <div class="float-right" >              
          <b-button type="button"  @click="CerrarModal"  variant="light"  class="p-2 px-4 btn-xs">Cancelar</b-button>
          <b-button type="button"  @click="Guardar" variant="primary"  class="p-2 px-4 btn-xs">
              <beat-loader :loading="isLoading" :color="'#68d391'" :size="8" />
             <span v-show="!isLoading">Guardar</span>
            </b-button>
        </div>
     </form>
  </b-modal>
</template>

<script>
import firebase from '@/firebase'
//DialogMetodologia
export default {
    name: 'usuario-nuevo',
    props:{
      DialogUsuario: {
        type: Boolean,
        required: true,
        default: false
      },
      
    },
    data() {
        return {
          codigo:'',
          nombre:'',
          rol:'',            
          isLoading:false,          
          Show:this.DialogUsuario,

        }
    },
    watch: {
      DialogUsuario(){
        this.Show = this.DialogUsuario
      }
    },
     created () {
        
    },
    computed: {
     
    },
    methods: {
        Guardar(){
         
              let newData = firebase.database().ref('Usuario/').push();
              newData.set({                 
                  codigo: this.codigo,
                  nombre: this.nombre,
                  rol:this.rol,
                  fecha: Date(),
                  //key:key
              });
            
             },
     
         makeToast(msg,color) {
            this.toastCount++
            this.$bvToast.toast(msg, {
              title: 'Mensaje Cliente',
              variant:color,
              autoHideDelay: 3000,
              appendToast: false
            })
          },
                    
          CerrarModal(){
              //this.DialogCliente=false
              //this.Show
              this.$emit('CerrarModal');
          }
    }
};
</script>
<style scoped>
  ::v-deep .myDiv {
    background-color: 	#FFFFFF;
  }

</style>

