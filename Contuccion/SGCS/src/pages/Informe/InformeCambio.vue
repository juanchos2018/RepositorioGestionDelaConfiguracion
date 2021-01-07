<template>
    <div>
           <h5>Datos Informe de Cambio</h5>
        <div class="form-row">
         
              <b-form-group  label="Fecha "   class="col-md-3">
                <b-form-input
                          
                class="p-2 px-4 btn-xs" 
                required 
                v-model="fecha"         
                ></b-form-input>
                </b-form-group>
                    <b-form-group  label="Solicitud Asociada "   class="col-md-3">
                <b-form-input
                 v-model="codigo"            
                class="p-2 px-4 btn-xs" 
                required          
                ></b-form-input>
                </b-form-group>
                    <b-form-group  label="Costo Economico "   class="col-md-3">
                <b-form-input
                          
                class="p-2 px-4 btn-xs" 
                required          
                ></b-form-input>
                </b-form-group>
                    <b-form-group  label="Tiempo Estimado "   class="col-md-3">
                <b-form-input
                           
                class="p-2 px-4 btn-xs" 
                required          
                ></b-form-input>
                </b-form-group>
        </div>  
         <div class="form-row">
                <b-form-group  label="descripcion"   class="col-md-6">
                    <b-form-textarea
                        placeholder="Enter at least 10 characters"
                        rows="3"
                        ></b-form-textarea>
                    </b-form-group>
                        <b-form-group  label="Inpacto del Problema"   class="col-md-6">
                    <b-form-textarea
                        placeholder="Enter at least 10 characters"
                        rows="3"
                        ></b-form-textarea>
                    </b-form-group>
             </div>
                <h5>Detalle de Informe</h5>
             <div class="form-row">
           
              <b-form-group  label="Fases "   class="col-md-3">
                 <a-select  style="width: 100%"   @change="handleChange"   v-model="id_fase" >              
                    <a-select-option v-for="d in fasesproyecto" :key="d.value">
                            {{ d.text }}
                    </a-select-option>
                  </a-select>                
                </b-form-group>
                    <b-form-group  label="ESC "   class="col-md-3">
                       <a-select  style="width: 100%"  @change="change"  v-model="cro_ecs_Id" >              
                     <a-select-option v-for="d in elementosConfi" :key="d.value">
                            {{ d.text }}
                      </a-select-option>
                   </a-select>
                </b-form-group>
                <b-form-group  label="Tiempo "   class="col-md-3">
                    <b-form-input
                    v-model="tiempo"            
                    class="p-2 px-4 btn-xs" 
                    required          
                    ></b-form-input>
                </b-form-group>
                    <b-form-group  label="Costo "   class="col-md-3">
                <b-form-input
                    v-model="costo"           
                    class="p-2 px-4 btn-xs" 
                    required          
                ></b-form-input>
                </b-form-group>
                <b-form-group  label="Descripcion    "   class="col-md-12">
               <b-form-textarea
                        placeholder="Enter at least 10 characters"
                        rows="3"
                        ></b-form-textarea>
                </b-form-group>
                    <b-button type="button"  variant="primary"  @click="AgregarDetalle" class="p-2 px-4 btn-xs">
                        Agregar
                    </b-button>      
                    <br>          
               </div> 
               <br>
                 <div class="form-row">
                      <b-form-group   class="col-md-12">
                             <b-card>                  
                                <b-table :items="detalle" :fields="fields"  stacked="sm">
                                    <template v-slot:cell(acciones)="item">
                                    <b-button variant="primary"  class="p-2 px-4 btn-xs" >    <b-icon icon="layout-text-sidebar-reverse" ></b-icon> </b-button>
                                </template>
                                </b-table>                 
                            </b-card>
                        </b-form-group>
                     </div>
                   <b-button type="button"  variant="primary"  class="p-2 px-4 btn-xs">
                        Guardar Informe
                    </b-button> 

    </div>
</template>
<script>
import axios from  'axios';

export default {
    name: 'informe-cambio',
    data(){
        return{
            items:[],
            fields: [
                    { label:"N°", key: 'numero', sortable: false },
                    { label:"ESC", key: 'ecs', sortable: false },    
                    { label:"Tiempo", key: 'tiempo', sortable: false },
                    { label:"Costo", key: 'costo', sortable: false },                    
                    { label:"Acciones", key: 'acciones', sortable: false },
                   ],
            costo:'',       
            fecha:'',
            codigo:'',  
            tiempo:'',     
            id_proyecto:'', 
            id_fase:'',
            cro_ecs_Id:'',
            fasesproyecto:[],
            elementosConfi:[],
            nombre_elemento:'',
            detalle:[],     
        }
    },
    created() {

    },
    mounted() {
         this.GetDatos();    
    },
    methods: {
         GetDatos(){
           var datos = this.$route.params.datos
          if(datos){
            var dato=datos.split("|");
            this.fecha=dato[0];
            this.codigo=dato[1];
            this.id_proyecto=dato[2];
            this.MostarFaseMetodolgiaProyecto(dato[2]); 
           
          }  
       },     
       MostarFaseMetodolgiaProyecto(id){
          let me=this;
          var previa=[];
          axios.get('ApiWeb/Proyecto.php/?id_proyecto='+id).then(response => {              
                  previa=response.data;  
                    previa.map(function(x){
                        me.fasesproyecto.push({text: x.nombre_fase,value:x.id_fase});
                   })   
               }).catch(function (error) {
                      console.log(error);  
              }) .finally(() => {
           })
       },
       ElentosFaseProyecto(id_fase){
            let me=this;
            var previa=[];
            axios.get('ApiWeb/Proyecto.php/?parametro1='+me.id_proyecto+'&id_fase='+id_fase).then(response => {              
                  
                    previa=response.data;                    
                    previa.map(function(x){
                        me.elementosConfi.push({text: x.nombre_elemento,value:x.id_cronograma_elemento});
                   })
               }).catch(function (error) {
                      console.log(error);
              }) .finally(() => {
           })
       },
       change(e){
     //    console.log(this.id_elemento.nombre_elemento);
      //  var key = event.target.value; // example: 1
        this.nombre_elemento = event.target.textContent; // example: One
            
       console.log('name ',this.nombre_elemento );
         
     },
     AgregarDetalle1(){
         
     },
     AgregarDetalle(){
         // this.$set(this.PreVenta, 'DetallePreVenta', datos)      
          var nu=this.detalle.length+1
          this.detalle.push(
            {   numero:nu,
                ecs:this.nombre_elemento,
                cronogrameletoid: this.cro_ecs_Id,
                tiempo: this.tiempo,
                costo:this.costo,
            })      
          
       },
       handleChange(value){
           this.elementosConfi=[];
           this.ElentosFaseProyecto(value);
       }
    },
}
</script>