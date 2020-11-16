<template>
 <div>
    <a-steps :current="current" @change="onChange" :style="stepStyle"  type="navigation" >
      <a-step v-for="item in steps" :key="item.title" :title="item.title"  sub-title="00:00:05"/>
    </a-steps>
    <div class="steps-content">
      {{ steps[current].content }}
    </div>
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



export default {
  name: 'Dashboard',
  components: {  sc: schedulerLite },
  props: ['items'],

  data() {
    return {
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
    
  },
  methods: {
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
     
  },
   
    
  
};
</script>
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
