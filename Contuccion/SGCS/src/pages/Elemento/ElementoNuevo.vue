<template>
  <b-modal  v-model="Show" @hide="CerrarModal"
  title="Nuevo Elemento" hide-footer   body-class="myDiv">

     <form action="">
       <div class="form-row">   
              
               <b-form-group  label="Codigo Elemento:"  class="col-md-12">
               <b-input                  
                  aria-describedby="input-live-help input-live-feedback"
                  class="p-2 px-4 btn-xs "
                 v-model="codigo">
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
          <b-button type="button"  @click="RegistrarElemento" variant="primary"  class="p-2 px-4 btn-xs">
              <beat-loader :loading="isLoading" :color="'#68d391'" :size="8" />
             <span v-show="!isLoading">Registrar</span>
            </b-button>
        </div>
     </form>
    
  </b-modal>
</template>

<script>

import axios from  'axios';
export default {
    name: 'elemento-nuevo',
    props:{
      DialogoElemento: {       
        type: Boolean,
        required: true,
        default: false
      },
      
    },
    data() {
        return {
          contador:0,
          CodeMetodologia:'M',
          codigo:'',
          nombre:'',            
          isLoading:false,          
          Show:this.DialogoElemento,
          
        }
    },
    watch: {
      DialogoElemento(){
        this.Show = this.DialogoElemento
      }
    },
    created () {    

    },
    computed: {
     
    },
    methods: {
      RegistrarElemento(){         
          let nombre=this.nombre;
          let codigo_elemento=this.codigo;           
          const obj={codigo_elemento,nombre};
          axios.post('Backphp/ProcesoElemento.php/',obj).then(response => {                       
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
              title: 'Registrado',
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

