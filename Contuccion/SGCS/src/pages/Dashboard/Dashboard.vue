<template>
 <div>
    <div class="row">
     <div class="col-5" v-for="item in agrupados" :key="item.key">    
       <Widget class="h-100 mb-6"  title="<h5> <span class='fw-semi-bold'> </span></h5>"  close collapse customHeader>
        <h5>{{item.nombre_proyecto}}</h5>
        <VueApexCharts width="350"  type="donut" :options="chartOptions"  :series="agrupados[item.index].series"  @dataPointSelection="dataPointSelectionHandler" @click="Detalle(item.id_proyecto,item.index)" ></VueApexCharts>
        <b-button type="button"  style="float:right" variant="primary" @click="DetalleGrafico(item.id_proyecto)"  class="p-2 px-4 btn-xs">
                        Detalle
                 <b-icon icon="forward"></b-icon>
         </b-button> 
       </Widget>      
       </div>  
    </div>   
    <b-modal v-model="DialogoDetalle" hide-backdrop content-class="shadow" title="BootstrapVue">
      <div>
         <b-table :items="listaTareas" :fields="fields"  stacked="sm">   
              <template v-slot:cell(accion)="item">
                <b-button variant="primary" >cerrar</b-button>
              </template>
         </b-table>
      </div>
    </b-modal>

 

    <div class="steps-action">
      

    </div>
  </div>
</template>

<script>
import Widget from '@/components/Widget/Widget';
import moment from 'moment'
import firebase from '@/firebase'
import Vue from 'vue'; 
import schedulerLite from "./schedulerLite";
import polyfill from "@/assets/polyfill.js"
import axios from  'axios';

import Chart from 'chart.js';

import Graficos from './Graficos';
import VueApexCharts from 'vue-apexcharts'
export default {
  name: 'Dashboard',
  components: {  sc: schedulerLite,Graficos,Widget,VueApexCharts },
  props: ['items'],

  data() {
    return {
         DialogoDetalle:false,       
        indexproyecto:'',
        agrupados:[],
        ArrayOptions:[],
        listaTareas:[],
        fields: [
                    { label:"codigo", key: 'id_elemento', sortable: false },
                    { label:"Nombre", key: 'nombre', sortable: false },    
                    { label:"Acciones", key: 'accion', sortable: false },
                    ],
       chartOptions: { labels: ["Nuevo", "Proceso", "Terminado"] },
       proyectos:[],       
        metodologias:[],
        fases:[],
        plantilla:[],         
       
        };
      },
      created(){ 

         this.ListarListaTareas();
         this.ListaDeProyectos();
      },     
       methods: {
          ListarListaTareas(){
                      let me=this;                     
                        axios.get('ApiWeb/Consulta.php/').then(response => {   
                           me.ArrayOptions=response.data.data; 
                           }).catch(function (error) {
                                console.log(error);
                           }) .finally(() => {                              
                   })
           },
           ListaDeProyectos(){
                  let me=this;                 
                  axios.get('ApiWeb/Proyecto.php/').then(response => {                              
                        me.agrupados = response.data;  
                      //  console.log(response.data);
                        for(var i=0;i< me.ArrayOptions.length ;i++){
                            for  (var e=0;e< me.agrupados.length ;e++){
                                if(me.ArrayOptions[i].id_proyecto==me.agrupados[e].id_proyecto){   
                                      me.agrupados[e].series.push(parseInt(me.ArrayOptions[i].cantidad))
                                    
                                   } 
                               }                    
                           }  
                        }).catch(function (error) {
                            console.log(error);
                      }) .finally(() => {
                          
                 })
           },
           Detalle(id_proyecto,index)
            {  
              //  console.log(id_proyecto);
                this.indexproyecto=index;
                console.log("index :",index)
                this.DialogoDetalle=true;
            },
            datos(indexgrafico){

               var a =  this.agrupados[this.indexproyecto].charOptions.labels[indexgrafico];
               console.log("index proyecto :", this.indexproyecto)
               console.log(a)
            },
           dataPointSelectionHandler(e, chartContext, config) {
              //ide de nos e q
              //  console.log("index pro",index)
             // console.log(config);
             // var a =  this.agrupados[indexproyecto].charOptions.labels[config.dataPointIndex];              
              console.log("index grafico",config.dataPointIndex)
          
              setTimeout(() => {
              //      this.datos(config.dataPointIndex);
                }, 2);
                              
            },          
           DetalleDialogo(){            
             this.DialogoDetalle=true;
            },
           DetalleGrafico(id_proyecto){
               this.$router.push({name:"detallegrafico",params:{id_proyecto} });
              console.log(id_proyecto)
           },          
                
        
  },
   
    
  
};
</script>
<style lang="scss">
@import 'node_modules/vue-kanban/src/assets/kanban.scss';
</style>
<style>

.steps-content {
  margin-top: 16px;
  border: 1px dashed #e9e9e9;
  border-radius: 6px;
  background-color: #fafafa;
  min-height: 200px;
  text-align: center;
  padding-top: 80px;
}

.steps-action {
  margin-top: 24px;
}


.sample {
  width: 10px;
  height: 10px;
  margin: 5px;
  border: 1px solid black;
}

.cant-res {
  background-color: #999 !important;
}

.reserved {
  background-color: #8f8981 !important;
}
 .cambia {
        color: #999 ;
        line-height: 40px;
        margin-left: 10px;
        font-size: 1.5em;
        width: 40px;
        height: 40px;
        display: inline-block;
        text-align: center;
        transition: all 0.3s ease;
       }
</style>
