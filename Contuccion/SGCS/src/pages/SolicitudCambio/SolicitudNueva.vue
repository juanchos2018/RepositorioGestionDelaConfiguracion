<template>
    <div>
      <div>
        <b-card>                  
              <div class="form-row">
                 <b-form-group    class="col-md-8">
                    <h5>Nombre Proyecto  :</h5>
                    <a-select      style="width: 100%"  @change="handleChange"  v-model="id_proyecto"  >              
                    <a-select-option v-for="d in items" :key="d.value">
                            {{ d.text }}
                    </a-select-option>
                    </a-select>  
                 </b-form-group> 
                       <b-form-group    class="col-md-4">
                    <h5>Fecha  :</h5>
                    <b-form-input                       
                        type="date"
                        class="p-2 px-4 btn-xs" 
                        required         
                        v-model="fecha"   >
                        </b-form-input>
                 </b-form-group> 
            </div>                   
        </b-card>
    <br>
    <br>
          <b-card>          
                 <b-card-title>Datos Solicitud de Cambio</b-card-title>
                   <div class="form-row">    
                   <b-form-group    class="col-md-12">
                    <label class="control-label font-weight-bold text-info">Objetivo</label> 
                    <div class="el-select border-left rounded-left border-info el-select">               
                    <b-form-input
                        id="input-30" 
                        require
                        class="p-2 px-4 btn-xs"
                        v-model="objetivo"  >
                        </b-form-input>                  
                    </div>
                    </b-form-group>
                   </div>
                  <div class="form-row">       
                    <b-form-group  label="Descripcion"   class="col-md-12">
                    <b-form-textarea                                      
                        v-model="descripcion"                   
                        rows="3"
                        ></b-form-textarea>
                    </b-form-group>
                  </div>            
                  <b-button type="button" variant="primary"  @click="CrearSolicitudCambio" class="p-2 px-4 btn-xs">
                            Crear Solicitud
                  </b-button>           
          </b-card>
     </div>
    </div>
</template>

<script>
import axios from  'axios';
export default {
    
    data(){
        return{
            items:[],
        
            id_proyecto:'',
            fecha:'',
            objetivo:'',
            descripcion:'',
            estado:'',
            respuesta:'',
            usuario_miembroid:'',
            id_usuario:'',
            condidgo:'',

        }
    },

    created () {
          this.ListarProyecto();  
    },
     mounted() {
    
      if(localStorage.idtipo) this.id_usuario = localStorage.id_usuario;
     
    },
    methods: {
          ListarProyecto(){
            let me=this;           
            var previa=[];
            axios.get('ApiWeb/Proyecto.php/').then(response => {                    
                      previa = response.data;                      
                      previa.map(function(x){
                           me.items.push({text: x.nombre_proyecto,value:x.id_proyecto});
                       }); 
                  }).catch(function (error) {
                      console.log(error);
                }) .finally(() => {
                     
            })
        },
        CrearSolicitudCambio(){
          let id_proyecto=this.id_proyecto;  
          let miembrojefeId=this.usuario_miembroid;
          let miembrosolicitanteId=this.usuario_miembroid;
          let fecha=this.fecha;
          let objetivo=this.objetivo;
          let descripcion=this.descripcion;
          let respuesta="";
          let estado="1";
          const obj={id_proyecto,miembrojefeId,miembrosolicitanteId,fecha,objetivo,descripcion,respuesta,estado};
          axios.post('ApiWeb/SolicitudCambio.php/',obj).then(response => {                       
                 console.log(response);               
                  this. Confirmacion();
                   }).catch(function (error) {
                      console.log(error);
                }) .finally(() => {                     
              })
        },
        ObtenerIdMiembro(proyectoId){
                 axios.get('ApiWeb/Usuario.php/?proyectoId='+proyectoId+"&usuario_miembroid="+this.id_usuario).then(response => {                       
                 console.log(response.data);                             
                 this.usuario_miembroid=response.data.id;
                }).catch(function (error) {
                      console.log(error);
                }) .finally(() => {                     
              })
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
        handleChange(value){
            var idpro=value;
            this.ObtenerIdMiembro(idpro);
        },
        ObtenerCantidadSolicitud(){

        },
        Lista(){
              this.$router.push('/app/solicitudlista');
        }
    }
}
</script>