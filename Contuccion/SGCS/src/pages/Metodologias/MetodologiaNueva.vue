<template>
  <b-modal id="modal-cliente" v-model="Show" @hide="CerrarModal"
  title="Nuevo Metodologia" hide-footer  >

     <form action="">
       <div class="form-row">   
              
              <b-form-group id="input-group-3" label="Nombre Metodlogia:" label-for="NroDocumento" class="col-md-8">
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
          <b-button type="button"  @click="RegistrarMetodologia" variant="primary"  class="p-2 px-4 btn-xs">
              <beat-loader :loading="isLoading" :color="'#68d391'" :size="8" />
             <span v-show="!isLoading">Guardar</span>
            </b-button>
        </div>
     </form>
     {{contador}}
  </b-modal>
</template>

<script>
import firebase from '@/firebase'
//DialogMetodologia

import axios from  'axios';
export default {
    name: 'metodologia-nueva',
    props:{
      DialogMetodologia: {       
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
          Show:this.DialogCliente,
          usu:{
            codigo_usuario:'5',
            nombre_usuario:'melisa loca',
            contra_usuario:'123',
            estado_usuario:'1'
          }
        }
    },
    watch: {
      DialogMetodologia(){
        this.Show = this.DialogMetodologia
      }
    },
    created () {
    //    this.CantidadMetodologia();
      //  this.codigo=this.CodeMetodologia+""+ this.contador;

    },
    computed: {
     
    },
    methods: {
      RegistrarMetodologia(){         
          let nombre=this.nombre;         
          const obj={nombre};
           axios.post('Backphp/ProcesoMetodologia.php/',obj).then(response => {                       
              console.log(response);
               this.Confirmacion();
              this.ListarMetodologia();
            //  if(response.status=="200"){
               
               

              //}
          }).catch(function (error) {
              console.log(error);
          }) .finally(() => {
              
          })
      },
      ListarMetodologia(){
          this.$emit('Listar-Emit');
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
         Guardar2(){
            let me = this;
             axios.post('insertar_usuario.php?', this.usu,{ headers: {
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Methods": "GET, POST, PATCH, PUT, DELETE, OPTIONS",
                "Access-Control-Allow-Headers": "Origin, Content-Type, X-Auth-Token"
              }}).then(response => {
                       
                     console.log(response);
                  }).catch(function (error) {
                      console.log(error);
                  }) .finally(() => {
                     
                  })
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

