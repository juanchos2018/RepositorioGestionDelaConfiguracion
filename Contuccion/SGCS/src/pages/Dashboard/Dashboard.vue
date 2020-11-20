<template>
 <div>
   
    <div class="steps-action">
      
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
{{stages}}
{{blocks}}
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
      
          ]
   
     
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
