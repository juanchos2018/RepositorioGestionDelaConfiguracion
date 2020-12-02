<template>
    <div>
      <h5>Nuevo Proyecto</h5>
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
<!--
             <b-form-group  label="codigo:"  class="col-md-6">
               <b-form-input
                id="input-30" 
                require
                class="p-2 px-4 btn-xs"
                v-model="codigo"  >
                </b-form-input>               
            </b-form-group>-->
       <b-form-group  label="Fecha Inicio"   class="col-md-6">
        <b-form-input
          id="input-7"
          type="date"
          class="p-2 px-4 btn-xs" 
          required          
         v-model="fecha_inicio" ></b-form-input>
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
        <b-form-group  label="Fecha Finalizacion"   class="col-md-6">
        <b-form-input
          id="input-7"
          type="date"
          class="p-2 px-4 btn-xs" 
          required          
        v-model="fecha_fin"></b-form-input>
      </b-form-group>
    </div>

     <h5>Datos de la Metodologia</h5><br>
    <div class="form-row">    
       <b-form-group   label="Metodologia :" class="col-md-6">           
          <a-select  style="width: 100%"   @change="handleChange"  v-model="metodologiaId" >              
         <a-select-option v-for="d in metodologias" :key="d.value">
                  {{ d.text }}
          </a-select-option>
        </a-select>   
       </b-form-group>       
    </div>
  
    <div class="form-row">
      <div class="col-md-12">
        <!--
        <a-steps :current="current" @change="onChange" :style="stepStyle"  type="navigation" >
          <a-step v-for="item in fases" :key="item.title" :title="item.title"  />
        </a-steps>
          <div>   
             <b-form-checkbox size="sm">Small</b-form-checkbox> 
             <b-table striped hover :items="plantillaelemento" :fields="fields" >
              <template  v-slot:cell(acciones)="row">
                <b-form-checkbox
                  v-model="row.item.check"
                  @input="onPreviewClick($event, row.index, row.item.nombre)"
                ></b-form-checkbox>
              </template>
            </b-table>
            </div>  -->    
             <b-card no-body>
      <b-tabs card  justified   active-nav-item-class="font-weight-bold text-uppercase text-success">        
        <b-tab v-for="item in fases" :key="item.title" :title="item.title" v-model="tabIndex" active>
       <h5>Elementos de configuracion</h5>
           <b-table striped hover :items="fases[item.index].tabla" :fields="fields2"  >
              <template  v-slot:cell(acciones)="row">
                <b-form-checkbox                 
                  @input="onPreviewClick(row.index,row.item.id,row.item.NombreElemento)"
                ></b-form-checkbox>
              </template>
            </b-table>
        </b-tab>      
      
        <template #empty>
          <div class="text-center text-muted">
           Lista   Vacia                                                                                                                                                                                            
          </div>
        </template>
      </b-tabs>
    </b-card>  
      </div>      
    </div>
      
     <b-button type="button"  @click="RegistrarMeotodoloiga" variant="primary"  class="p-2 px-4 btn-xs">
             Crear Proyecto
      </b-button>
    
    {{seleccionados}}
    </div>
</template>
<script>
import axios from  'axios';
import firebase from '@/firebase'
export default {
    
    data(){
        return{
           tabIndex: 0,
           nombre_proyecto:'',
           codigo:'',
           descripcion:'',
           fecha_inicio:'',
           fecha_fin:'',
           metodologia:'',
           metodologiaId:'',
           metodologias:[],
           plantillaelemento:[],
           TodasPlantillas:[],
           fases:[],
        
          selected: [],
          elementos:{nombre:''},
          step1: '',
          step2: '',
          cStep: 1,  
          current: 0, 
          seleccionados:[],
          stepStyle: {
          marginBottom: '20px',
          boxShadow: '0px -1px 0 0 #e8e8e8 inset',
           },
          fields: [
                  { label:"Acciones", key: 'acciones', sortable: false },
                   { label:"Id", key: 'id_elemento', sortable: false },
                   { label:"Nombre Elemento", key: 'nombre', sortable: false }, 
                    { label:"elegir", key: 'elegir', sortable: false } 
                  
             ],
            fields2: [
                  { label:"Acciones", key: 'acciones', sortable: false },
                   { label:"Id", key: 'id', sortable: false },
                   { label:"Nombre Elemento", key: 'NombreElemento', sortable: false }, 
                 
                  
             ],
        tabs: [],
        tablas:{

             },
        tabCounter: 0,
        }
    },
   
    created(){
      this.ListarMetodologias();
      this.ListarTodasPlantillas();
     
    },
    methods:{
       VER(){
      console.log("Click");
    },
       newTab() {
        this.tabs.push(this.tabCounter++)
        },
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
          handleChange(value) {
            console.log(`selected ${value}`);
              this.MostarFaseMetodolgia(value);
          },
          ListarMetodologias(){
              let me=this;
                  var tipoDcumento=[];
                  axios.get('Backphp/ProcesoMetodologia.php/',).then(function(response){                      
                  tipoDcumento=response.data;    
                //  console.log(response.data);              
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
          MostarFaseMetodolgia(id){
              let me=this;
                axios.get('Backphp/ProcesoMetodologia.php/?id_meto='+id).then(response => {              
                    me.fases = response.data;                   
                        for(var i=0;i< me.fases.length ;i++){
                          for  (var e=0;e< me.TodasPlantillas.length ;e++){
                              if(me.fases[i].id_fase==me.TodasPlantillas[e].id_fase){   
                                  me.fases[i].tabla.push({ NombreElemento:me.TodasPlantillas[e].nombre,id:me.TodasPlantillas[e].id_elemento})
                              } 
                          }                    
                        }  

                      }).catch(function (error) {
                          console.log("ERrro");
                          console.log(error);
                  }) .finally(() => {
              })
          },
           onChange(current) {
              console.log('onChange:', current);
              this.current = current;
              var code =this.fases[current].id_fase;
             // this.MostarFaseMetodolgiaProyecto(code);
              console.log("id fase= "+code);
              this.ListarElemtosFase(code);
          },
          ListarElemtosFase(id_fase){
              let me=this;
              axios.get('Backphp/ProcesoPlantilla.php/?id_fase='+id_fase).then(response => {                 
                    me.plantillaelemento = response.data;     
                       /// console.log(response.data);           
                  }).catch(function (error) {
                          console.log(error);
                  }) .finally(() => {
              })
          }, 
          ListarTodasPlantillas(){
                  let me=this;                 
                  axios.get('Backphp/ProcesoPlantilla.php/',).then(function(response){                      
                  me.TodasPlantillas=response.data;    
                // console.log(response.data);  
              }).catch(function(error){
                  console.log(error);
              });
          },
           onPreviewClick(data, id, nombre) {
               console.log(id);   
          //  this.seleccionados.push({id:id,nombre:item});
         //   if( this.seleccionados.length==0){
         //   this.seleccionados.push({id:id,nombre:item});
         //   }
         //   else{
                var existe=null;
                this.seleccionados.forEach(item=>{                   
                   if  (item.id==id || item.nombre==nombre){                                      
                        existe=true;                      
                      }else{
                        existe=false;    
                      }
                 })  

              //    for(var i =0;i<this.seleccionados.length;i++){
                   //   if  (this.seleccionados[i].id==id){
                                      
                     //   existe=true;
                      
                    //  }else{
                     //   existe=false;
                                            

                  //    }
                 // }
                if(existe==true){
                //  this.seleccionados.splice(data, 1);
                //  this.seleccionados.splice(this.seleccionados.indexOf(data), 1);
                  this.Quitar(data);
                  
                }else{
                 // this.seleccionados.push({id:id,nombre:item});
                  this.agregar(id,nombre);
               
                }
               // existe=null;
                console.log(existe);  
        
            },
            agregar(id,item){
                  this.seleccionados.push({id:id,nombre:item});
            },
            Quitar(data){
               this.seleccionados.splice(this.seleccionados.indexOf(data), 1);
               // console.log("Biorrar")
               // console.log(item)
              //  this.seleccionados.splice(data, 1);
            }
    }
}
</script>