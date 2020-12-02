<template>
  <b-modal id="modal-fase" v-model="Show" @hide="CerrarModal"
  title="Nueva Fase" hide-footer  body-class="myDiv" >
     <form action="">
       <div class="form-row">                 
              <b-form-group id="input-group-3" label="Nombre Fase:" class="col-md-12">
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
          <b-button type="button"  @click="RegistrarFase" variant="primary"  class="p-2 px-4 btn-xs">
              <beat-loader :loading="isLoading" :color="'#68d391'" :size="8" />
             <span v-show="!isLoading">Crear Fase</span>
            </b-button>
        </div>
     </form>
  </b-modal>
</template>

<script>
import firebase from '@/firebase'
//DialogMetodologia

import axios from  'axios';
export default {
    name: 'fase-nueva',
 
    props:{
      DialogoFase: {       
        type: Boolean,
        required: true,
        default: false
      }, idmetodologia: [String, String],
            
    },
    data() {
        return {
          contador:0,
          CodeMetodologia:'M',
          codigo:'',
          nombre:'',            
          isLoading:false,          
          Show:this.DialogoFase,
          }
    },
    watch: {
      DialogoFase(){
        this.Show = this.DialogoFase
      }
    },
    created () {
    //    this.CantidadMetodologia();
      //  this.codigo=this.CodeMetodologia+""+ this.contador;

    },
    computed: {
     
    },
    methods: {
      RegistrarFase(){         
          let nombre_fase=this.nombre;      
          let metodologiaid=this.idmetodologia;    
          const obj={nombre_fase,metodologiaid};
           axios.post('Backphp/ProcesoFase.php/',obj).then(response => {                       
           console.log(response);
           this.Confirmacion();
           this.ListarMetodologia(this.idmetodologia)
          // this.ListarMetodologia();
            //  if(response.status=="200"){             
               

              //}
          }).catch(function (error) {
              console.log(error);
          }) .finally(() => {
              
          })
      },     
      ListarFaseDeMetodologia(){

      },
      ListarMetodologia(idmeto){
          this.$emit('Listar-Fase',idmeto);
      },
      Registrar(){
          let codigo="123";
          let nombre="juanchos";
          let contra="123123123123";
          let estado="1";
          const obj={codigo,nombre,contra,estado};
           axios.post('Backphp/',obj).then(response => {
                       
                     console.log(response);
                  }).catch(function (error) {
                      console.log(error);
                  }) .finally(() => {
                     
                  })
      },
       Guardar(){         
              let newData = firebase.database().ref('Metodologia/').push();
              newData.set({                 
                  codigo: this.codigo,
                  nombre: this.nombre,
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

