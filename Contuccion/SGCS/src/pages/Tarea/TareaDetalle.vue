<template>
  <b-modal v-model="Show" @hide="CerrarModal"
  title="Tarea" hide-footer   body-class="myDiv">
     <form action="">
          <div class="form-row">                 
          <b-form-group  label="Tarea:"  class="col-md-12">
                        
            </b-form-group>                
          </div>
          <div class="form-row"> 
              <b-form-group  label=" Roles:"  class="col-md-12">
           
             </b-form-group> 
          </div> 
        
         <hr>
        <div class="float-right" >              
          <b-button type="button"  @click="CerrarModal"  variant="light"  class="p-2 px-4 btn-xs">Cancelar</b-button>
          <b-button type="button"   variant="primary"  class="p-2 px-4 btn-xs" >
              <beat-loader :loading="isLoading" :color="'#68d391'" :size="8" />
             <span v-show="!isLoading">Guardar</span>
            </b-button>
        </div>
     </form>    
  </b-modal>
</template>

<script>

//DialogMetodologia
import axios from  'axios';
export default {
    name: 'tarea-detalle',
    props:{
      DialogoDetalleTarea: {       
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
          Show:this.DialogoDetalleTarea,         
          usuarios:[],
          roles:[],
          id_rol:'',
          id_usuario:'',
         
        }
    },
    watch: {
      DialogoDetalleTarea(){
        this.Show = this.DialogoDetalleTarea
      }
    },
    created () {
    //    this.CantidadMetodologia();
      //  this.codigo=this.CodeMetodologia+""+ this.contador;
         // this.ListarUsuario();
        //  this.ListarRoles();
    },
    computed: {
     
    },
    methods: {
      RegistrarMiembro(){         
          let usuario_miembroid=this.id_usuario;     
          let rolId=this.id_rol;     
          let proyectoId=this.id_proyecto;   

          const obj={usuario_miembroid:usuario_miembroid,rolId:rolId,proyectoId:proyectoId};
           axios.post('Backphp/ProcesoMiembro.php/',obj).then(response => {                       
              console.log(response);
               this.Confirmacion();
            //  this.ListarMetodologia();            
          }).catch(function (error) {
              console.log(error);
          }) .finally(() => {
              
          })
      },
      ListarMetodologia(){
          this.$emit('Listar-Emit');
      },   
      ListarUsuario(){
             let me=this;
                  var elementos=[];
                  axios.get('Backphp/ProcesoUsuario.php/',).then(function(response){                      
                  elementos=response.data;   
                  console.log(response.data)
                  elementos.map(function(x){
                        me.usuarios.push({text: x.nombre,value:x.id_usuario});
                 });  
              }).catch(function(error){
                  console.log(error);
           });       
       },  
       ListarRoles(){
             let me=this;
                  var elementos=[];
                  axios.get('Backphp/ProcesoRol.php/',).then(function(response){                      
                  elementos=response.data;   
                  elementos.map(function(x){
                        me.roles.push({text: x.nombre,value:x.id_rol});
                 });  
              }).catch(function(error){
                  console.log(error);
           });       
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

