<template>
 <div>
    <div class="row">
     <div class="col-5" v-for="item in agrupados" :key="item.key">    
       <Widget class="h-100 mb-6"  title="<h5> <span class='fw-semi-bold'>Proyecto </span></h5>"  close collapse customHeader>
        <h5>{{item.nombre_proyecto}}</h5>
        <VueApexCharts width="350"  type="donut" :options="chartOptions"  :series="agrupados[item.index].series"  @dataPointSelection="dataPointSelectionHandler" @click="Detalle(item.id_proyecto)" ></VueApexCharts>
   
       </Widget>
      
       </div>  
    </div>

<!--

  agrupados[item.index].charOptions
      <b-row>
        <b-col lg="4" sm="6" xs="12">
        <Widget class="h-100 mb-4"  title="<h5> <span class='fw-semi-bold'>Preventas de Vendedores</span></h5>"  close collapse customHeader>
         <canvas id="myChart" width="200" height="200" ></canvas>
      </Widget>
        </b-col>
      </b-row>-->


   <!--
   <a-tree
     draggable
    :tree-data="metodologias"   
    @select="onSelect"
    @check="onCheck"
  
  >
    <span slot="title0010" style="color: #1890ff">sss</span>
  </a-tree>
  -->
 
  <br>

    <div class="steps-action">
      <!--
<kanban-board :stages="stages" :blocks="blocks"></kanban-board>

 <kanban-board :stages="stages" :blocks="blocks" @update-block="updateBlock">
      <div v-for="stage in statuses" :slot="stage" :key="stage">
        <h2>
          {{ stage }}
          <a>+</a>
        </h2>
      </div>
      <div v-for="item in blocks" :slot="item.id" :key="item.id">
        <div>
          <strong>id:</strong> {{ item.id }}
        </div>
        <div>
          {{ item.title }}
        </div>
      </div>
      <div v-for="stage in stages" :key="stage" :slot="`footer-${stage}`">
          <a href="" @click.prevent="() => addBlock(stage)">+ Add new block</a>
      </div>
    </kanban-board> 
    <b-button @click="Agregar">agregar</b-button>
     <b-button @click="Agregar2">agregar 2</b-button>
    
      {{latitulosbels}}
      {{latitulosbels2}}
      <br>
      <hr>
      <p>Fases</p>
      {{puntos}}

      {{puntos2}}-->   

<br>

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
      step1: '',
      step2: '',
       cStep: 1,  
       current: 0,
        gData:'',
        treeData:'',
       agrupados:[],
       ArrayOptions:[],
       chartOptions: { labels: ["Nuevo", "Proceso", "Terminado"] },
        proyectos:[],
      expandedKeys: ['0-0', '0-0-0', '0-0-0-0'],
  
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
        marginBottom: '60px',
        boxShadow: '0px -1px 0 0 #e8e8e8 inset',
      },
       stages: ['NuevaTarea', 'En-Progreso', 'Termino' ],
       blocks: [
            {
                id: 1,
                status: 'NuevaTarea',
                title: 'Welcome'
            },
            {
                id: 2,
                status: 'NuevaTarea',
                title: 'to'
            },
            {
                id: 3,
                status: 'En-Progreso',
                title: 'the'
            },
            {
                id: 4,
                status: 'En-Progreso',
                title: 'danger'
            },
            {
                id: 5,
                status: 'En-Progreso',
                title: 'zone'
            },
      
       ],

      metodologias:[],
      fases:[],
      plantilla:[],

      datostre: [
            {
              title: 'Inicio 1',
              key: '0-0',
              children: [
                  {
                    title: 'informe 1',
                    key: '0-0-0',       
                    children: [
                      { title: 'elemnto 1', key: '0-0-0-0'},
                      { title: 'elemento 2', key: '0-0-0-1' },
                    ],
                  },
                  {
                    title: 'Informe 2',
                    key: '0-0-1',
                    children: [ { title: 'elemnto 3', key: '0-0-0-2'}],
                  },
                ],
            },
            {
            title:'Elaboracion',
            key:'0-1',
            children: [
                    {
                      title: 'informe 3',
                      key: '0-0-2',       
                      children: [
                        { title: 'elemento 4', key: '0-0-0-3'},
                        { title: 'elemento 5', key: '0-0-0-4' },
                      ],
                    },
                    {
                      title: 'Informe 4',
                      key: '0-0-3',
                      children: [
                        { title: 'elemento 6', key: '0-0-0-5' }],
                    },
                  ],
            },
           
          
          ],
          
           latitulosbels:['titilo 1','titulo 2','titulo 3'],
           latitulosbels2:[],
           puntos:[12,16,20],
           puntos2: [],
        };
      },
      created(){ 

     this.ListarListaTareas();
     this.ListaDeProyectos();
      },
      mounted(){
          /*
              let me =this;              
              var ctx = document.getElementById('myChart');              
              var myChart = new Chart(ctx, {
              type: 'doughnut',
                data: {
                  labels: me.latitulosbels2,
                  datasets: [{
                      label: 'Proyectos',
                      data: me.puntos2,
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(255, 206, 86, 0.2)'
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 206, 86, 1)'               
                      ],
                    
                  }]
              },
              options: {              
                onClick: (e) => {                  
                    var activePoints = myChart.getElementsAtEvent(e);   
                      console.log( myChart.data);
                      if (activePoints[0]) {
                        var chartData = activePoints[0]['_chart'].config.data;
                        var idx = activePoints[0]['_index'];
                        var label = chartData.labels[idx];
                        var value = chartData.datasets[0].data[idx];
                        var url =  label + "&value=" + value;
                        console.log(url);
                        alert(url);
                      }
                  }
                
                }
              });
*/

            },
       methods: {
          ListarListaTareas(){
                      let me=this;                     
                        axios.get('ApiWeb/Consulta.php/').then(response => {   
                           me.ArrayOptions=response.data.data;                       
                            //console.log(response.data)      
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
      
          
           ListarPrueba(){
                       let me=this;
                       let result = []
                       let result2 = []
                       let result3 = []
                        axios.get('Backphp/ProcesoPrueba.php/').then(response => {   
                          me.ArrayOptions=response.data.data;                       
                            console.log(response.data)      
                           }).catch(function (error) {
                                console.log(error);
                           }) .finally(() => {
                              
                 })
            },          
           ListaAgrupada(){
                      let me=this;
                      var id="1";
                        axios.get('Backphp/ProcesoPrueba.php/?id='+id).then(response => {                              
                           me.agrupados = response.data;  
                           console.log(response.data);
                           for(var i=0;i< me.ArrayOptions.length ;i++){
                                for  (var e=0;e< me.agrupados.length ;e++){
                                      if(me.ArrayOptions[i].id_proyecto==me.agrupados[e].id_proyecto){   
                                         me.agrupados[e].series.push(parseInt(me.ArrayOptions[i].cantidad))
                                      //   me.agrupados[e].labels.push(me.ArrayOptions[i].estado_tarea)
                                        // me.chartOptions.labels.push([me.ArrayOptions[i].estado_tarea]);
                                      
                                      } 
                                  }                    
                             }   
                             
                             
                            }).catch(function (error) {
                                console.log(error);
                            }) .finally(() => {
                              
                     })
            },  
            dataPointSelectionHandler(e, chartContext, config) {
           
                console.log(config.dataPointIndex)
               
            },
            Detalle(id_proyecto)
            {  
                console.log(id_proyecto);
            },
          next() {
            this.current++;
          },
          prev() {
            this.current--;
          },
        onChange(current) {
            console.log('onChange:', current);
            this.current = current;
          },

          onDragEnter(info) {
            console.log(info);
            // expandedKeys 需要受控时设置
            // this.expandedKeys = info.expandedKeys
          },
          onSelect(selectedKeys, info) {
            console.log('selected', selectedKeys, info);
            var a =info.node.title;
            console.log(a);
          },
          onCheck(checkedKeys, info) {
            console.log('onCheck', checkedKeys, info);
          },
         
         ListarMetodologia(){
              let me=this;
              axios.get('Backphp/ProcesoMetodologia.php/').then(response => {
                        me.metodologias = response.data;
                     
                      }).catch(function (error) {
                            console.log(error);
                    }) .finally(() => {
                })
            },
           ListarPlantilla(){
              let me=this;
              axios.get('Backphp/ProcesoPlantilla.php/').then(response => {
                        me.plantilla = response.data;
                       
                          console.log(response.data);
                          //  me.ListarFases();
                      }).catch(function (error) {
                            console.log(error);
                    }) .finally(() => {
                })
            },
            Agregar2(){
                          let me=this;

                        //  me.fases[0].children.push({title:'osdofgdfgsd',key:'00001'});    
                         //  me.metodologias[0].children[0].push({title:'osdofgdfgsd',key:'00001'});  
                         
                             for(var i=0;i< me.fases.length ;i++){
                                for(var j=0;j< me.plantilla.length;j++){
                                            if  (me.fases[i].id_fase==me.plantilla[j].id_fase){
                                                me.fases[i].children.push({title:me.plantilla[j].title})
                                          }
                                              //
                                  }
             
          }

            },
            Agregar()
            {  let me=this;
            
            var pos=0;
              /*  me.metodologias.forEach(item => {
                        if(item.id==16){
                            pos=item
                            console.log(pos);
                              me.metodologias[0].children.push({ title:'tituloss'},{ title:'tituloss 2'})
                        }  

                 });
                 */
                 for(var i=0;i< me.metodologias.length ;i++){
                   for  (var e=0;e< me.fases.length ;e++){
                      if(me.metodologias[i].id==me.fases[e].metodologiaId){   
                          me.metodologias[i].children.push({ title:me.fases[e].title,key:me.fases[e].id_fase})

                         
                      } 
                   }                    
                 }

          
          //   for(var i=0;i< me.fases.length ;i++){
          //        me.fases[1].children.push({ title:'tituloss'},{ title:'tituloss 2'})
         //   }
             
             // me.metodologias.forEach(element=>{
              //       //     element.children[0].push({ title:'tituloss'})
             //})

           
           //     me.metodologias.children.push({ title:'tituloss'});
            } ,      
            ListarFases(){
              let me=this;
              axios.get('Backphp/ProcesoFase.php/').then(response => {
                       me.fases = response.data;
                        //me.metodologias.forEach(element => {
                       //   me.fases.forEach(e=>{
                           //  element.children.push({ title:e.title})
                                  // // if(element.id==e.metodologiaId){
                                  
                                 //  me.metodologias.forEach(element1=>{
                                  //        element1.children.push({ title:e.title})
                                 // })
                             // }
                         /// });
                         // console.log(element.id);
                        // me.metodologias.forEach(item=>{
                         //     if(element.metodologiaId==item.id){
                         //         me.metodologias.children.push({ title:'tituloss'});
                           //   }
                     //    // })
                     //  });  
                      }).catch(function (error) {
                            console.log(error);
                    }) .finally(() => {
                })
            },
          ListarFasePorMetodologia(id){       
              let me=this;
              axios.get('Backphp/ProcesoFase.php/?metodologiaId='+id).then(response => {              
                      me.fases = response.data;
                     // me.ListarElemtosFase(me.items[0].id_fase);                       
                
                    }).catch(function (error) {
                            console.log(error);
                    }) .finally(() => {
                })
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
