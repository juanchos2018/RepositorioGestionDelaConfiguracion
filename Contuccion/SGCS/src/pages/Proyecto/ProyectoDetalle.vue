<template>
  <div  class="bg-light">

      <h4>Estado de Proyecto</h4>
    <step-progress-bar
      ref="stepProgressBarCompRef"
       v-bind:totalSteps="stepProgressBarParams.totalSteps"
      v-bind:initCurrentStep="stepProgressBarParams.currentStep"
      v-bind:stepTitles="stepProgressBarParams.stepTitles"    
    @click="ver"
    />
    
    
  </div>
</template>

<script>
import Widget from '@/components/Widget/Widget';
import moment from 'moment'
import firebase from '@/firebase'
import StepProgressBar from './StepProgressBarComponent.vue'


export default {
  name: 'Dashboard',
  components: {  'step-progress-bar': StepProgressBar },
  props: ['items'],

  data() {
    return {
     
     stepProgressBarParams : {
        totalSteps: 10,
        currentStep: 1,
        stepTitles: ["Estado 1", "Estado 2", "Estado 3", "Estado 4", "Estado 5", "Estado", "Estado 7",, "Estado 8", "Estado 9", "Estado 10"]
      }
       
    
    };
  },
  created(){
     this.stepProgressBarParams.currentStep =3
  },
  methods: {
     ver(){
         alert("ver")
     }
  },
   watch: {
    'stepProgressBarParams.currentStep': function(val) {
      this.$refs.stepProgressBarCompRef.changeCurrentStep(val);
    }
  },
    mounted() {
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

