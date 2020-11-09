<template>
  <div >
 
  </div>
</template>

<script>
import Widget from '@/components/Widget/Widget';
import moment from 'moment'
import firebase from '@/firebase'
import Vue from 'vue'; 


//import StepTwo from './StepTwo.vue';


export default {
  name: 'Dashboard',
  components: {  },
  props: ['items'],

  data() {
    return {
      step1: '',
      step2: '',
      cStep: 1,
     
    
     registrationStep: 2,
        registrationStepper: [
          { icon: "folder", far: true, name: "Basic Information" },
          { icon: "pencil-alt", name: "Personal Data" },
          { icon: "image", far: true, name: "Terms and Conditions" },
          { icon: "check", name: "Finish" }
        ],
        options: {
          stepBtn: { color: "info", active: "amber", iconClass: "white-text" },
          nextBtn: { outline: "info", icon: "chevron-right" },
          prevBtn: { outline: "info", icon: "chevron-left" },
          submitBtn: { color: "amber", icon: "check" },
          lineColor: "amber"
        },


      steps: [
        {
          label: 'FAse 1',
          slot: 'page1',
        },
        {
          label: 'FAse 2',
          slot: 'page2',
        },
        {
          label: 'FAse 3',
          slot: 'page3',
        },
        {
          label: 'FAse 4',
          slot: 'page4',
          options: {
            nextDisabled: true,
          }
        }
      ],
     
    };
  },
  created(){
    
  },
  methods: {
    submit() {
        console.log('submitted');
      },
      completeStep(payload) {
               
      },
      isStepActive(payload) {
                
      },
       alert(payload) {
                alert('end')
      },
     
  },
   
    
  
};
</script>

