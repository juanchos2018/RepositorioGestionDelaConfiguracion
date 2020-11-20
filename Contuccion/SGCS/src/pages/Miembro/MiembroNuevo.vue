<template>
  <b-modal id="modal-cliente" v-model="Show" @hide="CerrarModal"
  title="Nuevo Miembro" hide-footer   body-class="myDiv">

     <form action="">
          <div class="form-row">                 
          <b-form-group  label="Usuario:"  class="col-md-12">
               <a-select     v-model="id_usuario" >              
                 <a-select-option v-for="d in usuarios" :key="d.value">
                  {{ d.text }}
              </a-select-option>
               </a-select>             
             </b-form-group>                
          </div>
          <div class="form-row"> 
              <b-form-group  label=" Roles:"  class="col-md-12">
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
          <b-button type="button"   variant="primary"  class="p-2 px-4 btn-xs">
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
      },
      
    },
    data() {
        return {
          contador:0,
          CodeMetodologia:'M',
          codigo:'',
          nombre:'',            
          isLoading:false,          
          Show:this.DialogMiembro,
          usu:{
            codigo_usuario:'5',
            nombre_usuario:'melisa loca',
            contra_usuario:'123',
            estado_usuario:'1'
          },
          usuarios:[],
          roles:[],
          id_rol:'',
          id_usuario:''
        }
    },
    watch: {
      DialogMiembro(){
        this.Show = this.DialogMiembro
      }
    },
    created () {
    //    this.CantidadMetodologia();
      //  this.codigo=this.CodeMetodologia+""+ this.contador;
          this.ListarUsuario();
          this.ListarRoles();
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

