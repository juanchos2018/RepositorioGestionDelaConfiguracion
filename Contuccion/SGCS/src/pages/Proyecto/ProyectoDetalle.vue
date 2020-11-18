<template>
  <div  class="bg-light">

      <h4>Estado de Proyecto</h4>
  <!--  <step-progress-bar
      ref="stepProgressBarCompRef"
       v-bind:totalSteps="stepProgressBarParams.totalSteps"
      v-bind:initCurrentStep="stepProgressBarParams.currentStep"
      v-bind:stepTitles="stepProgressBarParams.stepTitles"    
    @click="ver"
    />-->
   <div>
     <b-card   
        header="Primary" 
        header-text-variant="white"
        header-bg-variant="primary"           
        header-tag="header" footer-tag="footer"> 
    <template #header>
        <h6 class="mb-0" style="color:#FFFFFF">Header Slot</h6>
      </template>
    <a-steps :current="current" @change="onChange" :style="stepStyle"  type="navigation" >
      <a-step v-for="item in fases" :key="item.title" :title="item.title"  />
    </a-steps>
    <div class="steps-content">
    <!--  {{ steps[current].content  sub-title="00:00:05"  }}-->
    <b-button>click</b-button>
    </div>
    <div class="steps-action">
      
    </div>
      </b-card>
  </div>
    
  </div>
</template>

<script>
import Widget from '@/components/Widget/Widget';
import moment from 'moment'
import firebase from '@/firebase'
import StepProgressBar from './StepProgressBarComponent.vue'
import axios from  'axios';

export default {
  name: 'Dashboard',
  components: {  'step-progress-bar': StepProgressBar },
  props: ['items'],

  data() {
    return {
     fases:[],
     stepProgressBarParams : {
        totalSteps: 10,
        currentStep: 1,
        stepTitles: ["Estado 1", "Estado 2", "Estado 3", "Estado 4", "Estado 5", "Estado", "Estado 7",, "Estado 8", "Estado 9", "Estado 10"]
      },
      step1: '',
      step2: '',
      cStep: 1,  
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
        marginBottom: '60px',
        boxShadow: '0px -1px 0 0 #e8e8e8 inset',
      },     
    };
  },
  created(){
    // this.stepProgressBarParams.currentStep =3
  },
  methods: {
     ver(){
         alert("ver")
       },
       GetDatos(){
           var id = this.$route.params.id_proyecto
          if(id){         
            this.MostarFaseMetodolgiaProyecto(id);  
          }  
       },
       MostarFaseMetodolgiaProyecto(id){
          let me=this;
          axios.get('Backphp/ProcesoProyecto.php/?id_proyecto='+id).then(response => {
              
                 me.fases = response.data;
                 console.log(response.data);  
                  
               }).catch(function (error) {
                      console.log(error);
              }) .finally(() => {
           })
       },
       onChange(current) {
        console.log('onChange:', current);
        this.current = current;
         var code =this.fases[current].id_fase;
         console.log(code);
      },

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

