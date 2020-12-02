<template>
  <b-modal  v-model="Show" @hide="CerrarModal"
  title="Editar Elemento" hide-footer   body-class="myDiv">
     <form action="">
       <div class="form-row">                 
               <b-form-group  label="Codigo Elemento:"  class="col-md-12">
               <b-input                  
                  aria-describedby="input-live-help input-live-feedback"
                  class="p-2 px-4 btn-xs "
                  disabled
                  v-model="id_elemento">
               </b-input>
             </b-form-group>                
          </div>
          <div class="form-row"> 
              <b-form-group  label="Nombre Elemento:"  class="col-md-12">
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
          <b-button type="button"  @click="ModificarElemento" variant="primary"  class="p-2 px-4 btn-xs">
              <beat-loader :loading="isLoading" :color="'#68d391'" :size="8" />
             <span v-show="!isLoading">Modificar</span>
            </b-button>
        </div>
     </form>    
  </b-modal>
</template>

<script>

import axios from  'axios';
export default {
    name: 'elemento-editar',
    props:{
      DialogoModificar: {       
        type: Boolean,
        required: true,
        default: false
      },id_elemento: [String, String]
      
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
      ModificarElemento(){         
          let id_elemento=this.id_elemento;
          let nombre=this.nombre;           
          const obj={id_elemento,nombre};
          axios.put('Backphp/ProcesoElemento.php/',obj).then(response => {                       
              console.log(response);
                this.ListarElemetos();
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
      CantidadMetodologia(){  
            firebase.database().ref('Metodologia').on('value', (data) => {   
              var  array=[];             
              data.forEach((doc) => {
                    var item = doc.val()
                    item.key = doc.key  
                    array.push(item)
             });
             this.contador=array.length+1;
         });
       }, 
       Confirmacion(){
          this.$swal({
              position: 'top-end',
              icon: 'success',
              title: 'Modificado',
              text:'se ha modificado con exito',
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

