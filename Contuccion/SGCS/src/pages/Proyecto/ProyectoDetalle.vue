<template>
  <div  class="bg-light">
    
  <!--  <step-progress-bar
      ref="stepProgressBarCompRef"
       v-bind:totalSteps="stepProgressBarParams.totalSteps"
      v-bind:initCurrentStep="stepProgressBarParams.currentStep"
      v-bind:stepTitles="stepProgressBarParams.stepTitles"    
    @click="ver"
    />-->
   <b-card>
     <div class="container">
          <b-progress :value="50" variant="info" striped :animated="animate" class="mt-2"></b-progress>
        <div class="row">
        <h5>Nombre Proyecto  :</h5>
     <h5>{{ nombreProyecto}}</h5>
      </div>  
      <div class="row">
        <h5>Fecha Inicio : </h5>
        <h5>{{ fecha_inicio}}</h5>
      </div>
      <div class="row"> 
        <h5>Fecha Termino : </h5>
        <h5>{{ fecha_termino}}</h5>
      </div> 
      <br>
      <div>   
        <b-row>
        <b-col>  <h5>4 Nuevo</h5></b-col>
        <b-col>  <h5>3 Progreso</h5></b-col>
        <b-col>  <h5>1 Finalizado</h5></b-col>
      </b-row>
      </div>
     </div>         
   </b-card>
   <br>
   <div>
     <b-card   
        header="Primary" 
        header-text-variant="white"
        header-bg-variant="primary"           
        header-tag="header" footer-tag="footer"> 
    <template #header>
        <h4 class="mb-0" style="color:#FFFFFF">Metodologia : {{metodologia}}</h4>
      </template>
    <a-steps :current="current" @change="onChange" :style="stepStyle"  type="navigation" >
      <a-step v-for="item in fases" :key="item.title" :title="item.title"  />
    </a-steps>
 
    <div >
    <!--  {{ steps[current].content  sub-title="00:00:05"  }}   <b-icon icon="caret-right"> </b-icon>   <div class="col-4" v-for="item in items" :key="item.key"> -->
       <b-table
        :items="elementosConfi"  
        sort-icon-left
        :fields="fields"
        responsive="sm"
        v-model="currentItems">
         <template v-slot:cell(nombre_elemento)="{ detailsShowing, item }">
            <b-button variant="outline-primary" style="margin-right:10px"  @click="toggleDetails(item)"> 
                <div v-if="detailsShowing">
                    <b-icon icon="chevron-down">  </b-icon>                 
                      </div>                            
                      <div v-else>
                        <b-icon icon="chevron-right">  </b-icon>  
                       </div>  
                  </b-button>
              <strong>{{item.nombre_elemento }}  </strong>  
          </template>
          <template  v-slot:row-details="">
            <a-list item-layout="horizontal" :data-source="listaversiones">                              
               <a-list-item slot="renderItem" slot-scope="item">
                  <a-card style="width: 100%">  
                    <div style="float:right">
                        <b-button @click="Tarea(item.id_version,item.miembroresponsableID)"> Tarea </b-button>
                    </div>
                   <div style="  display: flex;align-items: center;">
                     <b-icon icon="play-fill"></b-icon>  <h5 style="margin-left:5px">Version {{ item.version }}</h5>
                  </div>
                  </a-card>
                </a-list-item>            
              </a-list>                   
           </template>
           <template v-slot:cell(version)="data">
            <b-button type="button"  class="m-1 p-2 px-4 btn-xs float-right" @click="NuevaVersion(data.item.id_cronograma_elemento,data.item.nombre_elemento)" variant="primary" > 
            <i class="fa fa-plus-circle"></i> Agregar Version
          </b-button>
          </template>
      </b-table>
    <!-- <a-collapse accordion>
       v-for="item in elementosConfi" :key="item.key"
      <a-collapse-panel :header="item.nombre_elemento" @click="DatosElemento(item.nombre_elemento)">
        <div class="float-right">
           <b-button type="button"  class="m-1 p-2 px-4 btn-xs" @click="NuevaVersion" variant="primary" > 
            <i class="fa fa-plus-circle"></i> Agregar Version
          </b-button>
        </div>     
      </a-collapse-panel>  
     </a-collapse>-->
    </div>
   </b-card>
  </div>
        <b-modal  v-model="DialogoElementoVersion" @hide="CerrarModal"
            title="Agregar Version" hide-footer   body-class="myDiv">
              <form action="">
                <div class="form-row">                 
                        <b-form-group  label="Fase:"  class="col-md-12">
                        <b-input                  
                            aria-describedby="input-live-help input-live-feedback"
                            class="p-2 px-4 btn-xs " 
                            v-model="nombre_fase"               >
                        </b-input>
                      </b-form-group>                
                    </div>
                    <div class="form-row"> 
                        <b-form-group  label="Elmento de Configuración:"  class="col-md-12">
                        <b-input                  
                            aria-describedby="input-live-help input-live-feedback"
                            class="p-2 px-4 btn-xs "
                          v-model="nombre_elemento"   >
                        </b-input>
                      </b-form-group> 
                    </div>       
                    <div class="form-row"> 
                        <b-form-group  label="Numero de Version:"  class="col-md-12">
                        <b-input                  
                            aria-describedby="input-live-help input-live-feedback"
                            class="p-2 px-4 btn-xs "
                            v-model="version"
                          >
                        </b-input>
                      </b-form-group> 
                    </div>  
                      <div class="form-row"> 
                        <b-form-group  label="Fecha Inicio"  class="col-md-6">
                        <b-form-input                                          
                          type="date"
                          class="p-2 px-4 btn-xs" 
                          required          
                          v-model="fecha_inicio" ></b-form-input>
                        </b-form-group> 
                         <b-form-group  label="Fecha Fin"  class="col-md-6">
                          <b-form-input                       
                          type="date"
                          class="p-2 px-4 btn-xs" 
                          required          
                        v-model="fecha_termino"></b-form-input>
                        </b-form-group> 
                    </div> 

                    <div class="form-row">
                          <b-form-group   label="Responsble :" class="col-md-12">           
                                  <a-select  style="width: 100%"  v-model="id_miembro"  >              
                                  <a-select-option v-for="d in miembros" :key="d.value">
                                           {{ d.text }}
                                  </a-select-option>
                                  </a-select>   
                            </b-form-group>  
                    </div>
                  <hr>
                  <div class="float-right" >              
                    <b-button type="button"  @click="CerrarModal"  variant="light"  class="p-2 px-4 btn-xs">Cancelar</b-button>
                    <b-button type="button"   variant="primary"  class="p-2 px-4 btn-xs" @click="CrearVersion">
                       Crear Version
                      </b-button>
                  </div>
              </form>    
        </b-modal>    
        {{nombre_fase}}
  </div>
</template>

<script>
import Widget from '@/components/Widget/Widget';
import moment from 'moment'
import firebase from '@/firebase'
import StepProgressBar from './StepProgressBarComponent.vue'
import axios from  'axios';


export default {
  name:'proyecto-detalle',
  components: {  'step-progress-bar': StepProgressBar },
  props: ['items'],

  data() {
    return {
     animate: true,
     fases:[],
 
     datatoslista: [
          {
            title: 'VErsion  1',
          }
        ],
     stepProgressBarParams : {
        totalSteps: 10,
        currentStep: 1,
        stepTitles: ["Estado 1", "Estado 2", "Estado 3", "Estado 4", "Estado 5", "Estado", "Estado 7",, "Estado 8", "Estado 9", "Estado 10"]
      },
      listaversiones:[],
      currentItems: [],
      miembros:[],
      elementosConfi:[],
      fields: [{ label:"Elementos de Configuración ", key: 'nombre_elemento' },
                 { label:"", key: 'version', } ],
      step1: '',
      step2: '',
      cStep: 1,  
      itemotro:'',
      current: 0,
      steps: [
        {
          title: 'fase 1',
          content: 'First-content',
        },
        {
          title: 'fase 2',
          content: 'Second-content',
        },
        {
          title: 'fase 3',
          content: 'Last-content',
        },
      ],
      stepStyle: {
        marginBottom: '10px',
        boxShadow: '0px -1px 0 0 #e8e8e8 inset',
      },
      //variables
      nombre_fase:'',
      nombre_elemento:'',
      nombreProyecto:'',
      id_proyecto:'',
      id_miembro:'',
      idcronogramamalemento:'',
      fecha_inicio:'',
      fecha_termino:'',
      descripcion:'',
      estado:'',
      version:'',
      metodologia:'',
      DialogoElementoVersion:false,     
    };
  },
  created(){
    // this.stepProgressBarParams.currentStep =3
  },
  methods: {
    
       GetDatos(){
           var id = this.$route.params.id_proyecto
          if(id){         
            this.id_proyecto=id;
            this.MostarFaseMetodolgiaProyecto(id); 
            this.DatosProyecto(id); 
            this.ListaMiembros(id);
          }  
       },
       MostarFaseMetodolgiaProyecto(id){
          let me=this;
          axios.get('Backphp/ProcesoProyecto.php/?id_proyecto='+id).then(response => {              
                 me.fases = response.data;                                  
               }).catch(function (error) {
                      console.log(error);
              }) .finally(() => {
           })
       },
       ElentosFaseProyecto(id_proyecto,id_fase){
           let me=this;
          axios.get('Backphp/ProcesoProyecto.php/?parametro1='+id_proyecto+'&id_fase='+id_fase).then(response => {              
               me.elementosConfi = response.data;    
               console.log(response.data);                              
               }).catch(function (error) {
                      console.log(error);
              }) .finally(() => {
           })
       },
       onChange(current) {
      //   console.log('onChange:', current);
         this.current = current;
         var code =this.fases[current].id_fase;
         this.nombre_fase =this.fases[current].nombre_fase;
         this.ElentosFaseProyecto(this.id_proyecto,code);
      //   console.log( this.nombre_fase);
       },
       DatosProyecto(id){
         let me=this;
          axios.get('Backphp/ProcesoProyecto.php/?id_proyect='+id).then(response => {              
                // me.fases = response.data;
                 
                  me.nombreProyecto=response.data[0].nombre_proyecto;  
                  me.fecha_inicio=response.data[0].fecha_inicio;
                  me.fecha_termino=response.data[0].fecha_termino;
                  me.metodologia=response.data[0].nombre_metodologia;   
               //   me.ElementosProyecto(id);    

               }).catch(function (error) {
                      console.log(error);
              }) .finally(() => {
           })
       },
       ElementosProyecto(id_proyecto){
        //esyo ya no va we
           let me=this;
          axios.get('Backphp/ProcesoCronogramaElemento.php/?id_proyecto='+id_proyecto).then(response => {              
                  me.elementosConfi = response.data;
                //  console.log(response.data);
                          
               }).catch(function (error) {
                      console.log(error);
              }) .finally(() => {
           })
       },
       NuevaVersion(idcromograma,nombre){
        this.idcronogramamalemento=idcromograma;      
        this.nombre_elemento=nombre; 
        this.DialogoElementoVersion=true;
       },
       CrearVersion(){
         let elemntoconfiguracionID=this.idcronogramamalemento;
         let version=this.version;     
         let fecha_inicio=this.fecha_inicio; 
         let fecha_termino=this.fecha_termino;   
         let miembroresponsableID=this.id_miembro;     

        const obj={elemntoconfiguracionID,version,fecha_inicio,fecha_termino,miembroresponsableID};
        axios.post('Backphp/ProcesoVersion.php/',obj).then(response => {                       
              console.log(response);
              
              this.Confirmacion();             
           
          }).catch(function (error) {
              console.log(error);
          }) .finally(() => {
              
          })
       },
       DatosElemento(item){
        console.log(item);
       },
       toggleDetails(row) {
          if(row._showDetails){         
            this.$set(row, '_showDetails', false)
          }else{
            this.currentItems.forEach(item => {
            this.$set(item, '_showDetails', false)            
            })      
          //  console.log(row.id_cronograma_elemento);
            this.nombre_elemento=row.nombre_elemento;
           this.ListaVersiones(row.id_cronograma_elemento);              
            this.$nextTick(() => {
              this.$set(row, '_showDetails', true)                
            })
          }
       },
       ListaVersiones(id_elemento){
            let me=this;
              axios.get('Backphp/ProcesoVersion.php/?id_elemento='+id_elemento).then(response => {
                       me.listaversiones = response.data; 
                     //  console.log(response.data);                     
                  }).catch(function (error) {
                      console.log(error);
                  }) .finally(() => {
                     
            })
       },
       ListaMiembros(id){
         let me=this;
         var previa=[];
         axios.get('Backphp/ProcesoMiembro.php/?id_proyecto='+id).then(response => {  
                  previa=response.data;  
                  previa.map(function(x){
                  me.miembros.push({text: x.nombre,value:x.id});
                  })
                 }).catch(function (error) {
                       console.log(error);
              }) .finally(() => {
           })
       },
       Tarea(id_version,miembro_id){
         var element=this.nombre_elemento;
         var proyect=this.nombreProyecto;
         var fase=this.nombre_fase; 
         var id_proyect=this.id_proyecto;
         var datos=element+'-' +fase+'-'+ id_version+'-'+miembro_id+'-'+proyect+'-'+id_proyect;
       
         this.$router.push({name:"tarealemento" ,params:{datos} });         
       },
        Confirmacion(){
            this.$swal({
                position: 'top-end',
                icon: 'success',
                title: 'Registrado Version',
                text:'texto',
                showConfirmButton: false,
                timer: 3000
              })
       },
       CerrarModal(){
         this.DialogoElementoVersion=false;
       }

  },
   watch: {
    'stepProgressBarParams.currentStep': function(val) {
      this.$refs.stepProgressBarCompRef.changeCurrentStep(val);
    }
  },
  mounted() {
      this.GetDatos();
      this.$nextTick(function() {
            var me = this;
            $('#next').click(function() {
                if (me.stepProgressBarParams.currentStep > me.stepProgressBarParams.totalSteps) {
                  return;
                }
                me.stepProgressBarParams.currentStep += 1;
            });

            $('#back').click(function() {
              if (me.stepProgressBarParams.currentStep == 1) {
                return;
              }
              me.stepProgressBarParams.currentStep -= 1;
            });
       });
  }
};
</script>

<style scoped>
  ::v-deep .myDiv {
    background-color: 	#FFFFFF;
  }

</style>
