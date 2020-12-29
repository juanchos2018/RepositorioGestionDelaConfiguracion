<template>
  <b-modal id="modal-cliente" v-model="Show" @hide="CerrarModal"
  title="Nuevo Miembro" hide-footer   body-class="myDiv">

     <form action="">
          <div class="form-row">                 
          <b-form-group  label="Miembro:"  class="col-md-12">              
               <a-select     v-model="id_usuario" >              
                 <a-select-option v-for="d in usuarios" :key="d.value">
                  {{ d.text }}
              </a-select-option>
               </a-select>             
             </b-form-group>                
          </div>
          <div class="form-row"> 
              <b-form-group  label=" Rol:"  class="col-md-12">
             <a-select    v-model="id_rol" >              
                 <a-select-option v-for="d in roles" :key="d.value">
                {{ d.text }}
              </a-select-option>
               </a-select>  
             </b-form-group> 
          </div> 
        
         <hr>
        <div class="float-right" >              
          <b-button type="button"  @click="CerrarModal"  variant="light"  class="p-2 px-4 btn-xs">Cancelar</b-button>
          <b-button type="button"   variant="primary"  class="p-2 px-4 btn-xs" @click="RegistrarMiembro">
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
    name: 'miembro-nuevo',
    props:{
      DialogMiembro: {       
        type: Boolean,
        required: true,
        default: false
      }, id_proyecto: [String, String],
      
    },
    data() {
        return {
          contador:0,
          CodeMetodologia:'M',
          codigo:'',
          nombre:'',            
          isLoading:false,          
          Show:this.DialogMiembro,         
          usuarios:[],
          roles:[],
          id_rol:'',
          id_usuario:'',
         
        }
    },
    watch: {
      DialogMiembro(){
        this.Show = this.DialogMiembro
      }
    },
    created() {    
          this.ListarUsuario();
          this.ListarRoles();
    },
    computed: {
     
    },
    methods: {
      RegistrarMiembro(){         
          let usuario_miembroid=this.id_usuario;     
          let rolId=this.id_rol;     
          let proyectoId=this.id_proyecto;   
          const obj={usuario_miembroid:usuario_miembroid,rolId:rolId,proyectoId:proyectoId};
           axios.post('ApiWeb/Miembro.php/',obj).then(response => {                       
              console.log(response);
               this.Confirmacion();                     
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
                  axios.get('ApiWeb/Usuario.php/').then(function(response){                      
                  elementos=response.data.data;   
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
                  axios.get('ApiWeb/Rol.php/',).then(function(response){                      
                  elementos=response.data.data;   
                  elementos.map(function(x){
                        me.roles.push({text: x.nombre,value:x.id_rol});
                 });  
              }).catch(function(error){
                  console.log(error);
           });       
       },         
       CerrarModal(){              
              this.$emit('CerrarModal');
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

