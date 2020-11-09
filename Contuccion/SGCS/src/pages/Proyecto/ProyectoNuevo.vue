<template>
    <div>
        <div class="form-row">
          <b-form-group    class="col-md-6">
               <label class="control-label font-weight-bold text-info">Nombre Proyecto</label> 
               <div class="el-select border-left rounded-left border-info el-select">               
             <b-form-input
                id="input-30" 
                require
                class="p-2 px-4 btn-xs"
                v-model="nombre_proyecto"
                :state="nombre_proyecto.length >= 10"  >
                </b-form-input>                  
             </div>
            </b-form-group>
             <b-form-group  label="codigo:"  class="col-md-6">
               <b-form-input
                id="input-30" 
                require
                class="p-2 px-4 btn-xs"
                v-model="codigo"  >
                </b-form-input>               
            </b-form-group>
    </div>
     <div class="form-row">       
        <b-form-group  label="Fecha Inicio"   class="col-md-6">
        <b-form-input
          id="input-7"
          type="date"
          class="p-2 px-4 btn-xs" 
          required          
         v-model="fecha_inicio" ></b-form-input>
      </b-form-group>
        <b-form-group  label="Fecha Fin"   class="col-md-6">
        <b-form-input
          id="input-7"
          type="date"
          class="p-2 px-4 btn-xs" 
          required          
        v-model="fecha_fin"></b-form-input>
      </b-form-group>
    </div>
  <div class="form-row">
     <b-form-group  label="descripcion"   class="col-md-6">
  <b-form-textarea
      id="textarea-state"
      v-model="descripcion"
      :state="descripcion.length >= 10"
      placeholder="Enter at least 10 characters"
      rows="3"
    ></b-form-textarea>
     </b-form-group>
  </div>

     <h5>Datos de la Metodologia</h5><br>
    <div class="form-row">    
     
   <b-form-group  class="col-md-6">
               <label class="control-label font-weight-bold text-info">Metodologia</label> 
               <div class="el-select border-left rounded-left border-info el-select">               
                <b-form-select
                id="input-1"
                name="input-1"
                v-model="metodologiaId"  
                class="p-2 px-4 btn-xs ui dropdown" 
                :options="metodologias" 
               >
                 </b-form-select>                  
                 </div>
         </b-form-group>
    </div>
    <!--
  <div class="form-row">  
        <b-form-group  class="col-md-12">
         <b-card no-body>
            <b-tabs content-class="mt-6" active-nav-item-class="font-weight-bold text-uppercase text-success">
                <b-tab title="Inicio" active><p>I'm the first tab</p></b-tab>
                <b-tab title="Elaboracion"><p>I'm the second tab</p></b-tab>
                <b-tab title="Construcion" ><p>I'm a disabled tab!</p></b-tab>
                <b-tab title="Transicion" ><p>I'm a disabled tab!</p></b-tab>
            </b-tabs>
         </b-card>
       </b-form-group>
    </div> -->
     <b-button type="button"  @click="RegistrarMeotodoloiga" variant="primary"  class="p-2 px-4 btn-xs">
             REgistrar
      </b-button>

    </div>
</template>
<script>
import axios from  'axios';
import firebase from '@/firebase'
export default {
    
    data(){
        return{
           nombre_proyecto:'',
           codigo:'',
           descripcion:'',
           fecha_inicio:'',
           fecha_fin:'',
           metodologia:'',
           metodologiaId:'',
           metodologias:[] 
        }
    },
    created(){
      this.ListarMetodologias();
    },
    methods:{
          RegistrarMeotodoloiga(){
          
          let codigo=this.codigo;
          let nombre=this.nombre_proyecto;
          let fechaini=this.fecha_inicio;
          let fechater=this.fecha_fin;
          let descripcion=this.descripcion;
          let estado="activo";
          let metodologia=this.metodologiaId;  
          const obj={codigo,nombre,fechaini,fechater,descripcion,estado,metodologia};
           axios.post('Backphp/ProcesoProyecto.php/',obj).then(response => {
                       
                  console.log(response);
                  this. Confirmacion();
                }).catch(function (error) {
                      console.log(error);
                }) .finally(() => {
                     
              })

          },
          ListarMetodologias(){
              let me=this;
                  var tipoDcumento=[];
                  axios.get('Backphp/ProcesoMetodologia.php/',).then(function(response){                      
                  tipoDcumento=response.data;    
                  console.log(response.data);              
                  tipoDcumento.map(function(x){
                        me.metodologias.push({text: x.nombre,value:x.id});
                 });  
              }).catch(function(error){
                  console.log(error);
              });
            },
          Guardar(){         
              let newData = firebase.database().ref('Proyectos/').push();
              newData.set({                 
                  nombre_proyecto: this.nombre_proyecto,
                  descripcion: this.descripcion,
                  fecha_inicio:this.fecha_inicio,
                  fecha_fin: this.fecha_fin,
                  metodologia:'Rup'
                
                  //key:key
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
}
</script>