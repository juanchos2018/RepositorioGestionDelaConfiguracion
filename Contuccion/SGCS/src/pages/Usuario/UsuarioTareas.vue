<template>
  <div >
    <h5>Tareas de usuario</h5>
  <br>
      <div class="timeline-wrapper"> 
        <ul class="StepProgress"> 
      <li  v-for="schedule in schedules" :key="schedule.key"  class="StepProgress-item"  >
        <div class="bold time"> {{schedule.start}}   </div> 
        <b-card class="mb-2"  style="max-width: 20rem; margin-left:55px">  
        <div style="margin: 0 0 0 30px;" class="bold">{{schedule.title}}</div>
        <div style="margin: 0 0 0 30px">{{schedule.description}}</div>
         </b-card>
      </li>
    </ul>
   </div>
  </div>
</template>

<script>
import Widget from '@/components/Widget/Widget';
import moment from 'moment'
import firebase from '@/firebase'

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}
var today=formatDate(Date.now())

export default {
  name: 'usuario-tarea',
  components: {
    Widget,  
  },
  props: ['items'],

  data() {
    return {
     
        d : new Date(),
        valor:'',
        moment: moment,
        now: new Date().getTime(),
        schedules:[],
        range:{
           // start: `${this.addZero(this.d.getHours())}:${this.addZero(this.d.getMinutes())}`,
            //end: `${this.addZero(this.d.getHours())}:${vm.addZero(this.d.getMinutes())}`
        },
        description: '',
        title:'',
        t: '1em',
    
    };
  },
  created(){
      this.Listar();
  },
  methods: {
      addZero(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    },
     addSchedule(){
      var vm = this 
      var obj={};
      var  fecha=moment.date;
      console.log(fecha);
        obj.start=today;
       
        obj.description=vm.description;
        obj.title = vm.title
        vm.schedules.push(Object.assign({}, obj))
    },
    Listar(){
         var vm = this
            firebase.database().ref('Tareas').on('value', (data) => {   
              this.items=[];             
                  data.forEach((doc) => {
                    var item = doc.val()
                    item.key = doc.key  
                    this.schedules.push(item)
                  //  vm.schedules.push(Object.assign({}, obj))
             });
         });
       },  
    
  }
};
</script>

<style src="./stile.scss" lang="scss" scoped />
