<template>
    <div>   

    <vue-good-wizard
      ref="wizard"
      :steps="lista"
      :onNext="nextClicked" 
      @click="nextClicked"

      :onBack="backClicked">
        <div slot="page1">
            <h4>Elemtos de Configuracion</h4>  
             <b-button variant="outline-primary">Agregar</b-button>
             <b-table striped hover :items="detalle2"></b-table>   

        </div>

        <!--
        <div slot="page2">
            <h4>contenido 2</h4>
        </div>
        <div slot="page3">
            <h4>Comtendio 3</h4>
        </div>
        <div slot="page4">
            <h4>contenido 4</h4>
        </div>-->

    </vue-good-wizard>
       {{items}}
    
  
   </div>

</template>

<script>
import firebase from '@/firebase'
import Wizard from './Wizard.vue';
import { VStepper } from 'vue-stepper-component'
export default {
     components: { Wizard,VStepper  },
    data(){
        return{
            items:[],
            child:'-MKgGmEB0AVCJ0TR_zeX',
           // steps: 3, step: undefined,
            pagina:'page1',


            lista:[ {id:'111',nombre:'pepe',apellido:'loco',slot:'page1',label:'meto 1'},
                    {id:'222',nombre:'pepe',apellido:'loco',slot:'page1',label:'meto 2'},
                    {id:'333',nombre:'andres',apellido:'loco',slot:'page1',label:'meto 3'},
                    {id:'444',nombre:'kiara',apellido:'loco',slot:'page1',label:'metro 4'},
                    {id:'555',nombre:'iara',apellido:'loco',slot:'page1',label:'meto 5'}
              ],
            detalle:[{id:'111',nombre:'pepe',apellido:'loco'},
                    {id:'111',nombre:'pepe',apellido:'loco'},
                    {id:'222',nombre:'andres',apellido:'loco'},
                    {id:'222',nombre:'kiara',apellido:'loco'},
                    {id:'333',nombre:'iara',apellido:'loco'},
                    {id:'444',nombre:'iara',apellido:'loco'},
                    {id:'444',nombre:'iara',apellido:'loco'},
                    {id:'555',nombre:'iara',apellido:'loco'}
              ],
             detalle2:[],
        }
    },
    created(){
        this.Listar();   
    },
    methods:{
        click(){
            alert("clikc");
        },
         Listar(){
            firebase.database().ref('Fases/').on('value', (data) => {   
              this.items=[];             
                  data.forEach((doc) => {
                    var item = doc.val()
                    item.key = doc.key  
                    this.items.push(item)
             });
         });
       },
       alerta(){
        
           this.$refs.popover.$emit('open')
       },
        nextClicked(currentPage) {
        console.log('next clicked', currentPage) 
        console.log(this.lista[currentPage].id);
        let me =this;
        var code =this.lista[currentPage].id;
        me.detalle2=[];
            me.detalle.map(function(x){
               if(x.id==code){
                        me.detalle2.push({nombre:x.nombre});
                  }
                  
                 }); 
       // alert(currentPage); 0,1,2
        return true; //return false if you want to prevent moving to next page
        },
        backClicked(currentPage) {

           console.log(this.lista[currentPage].id);
             let me =this;
        var code =this.lista[currentPage].id;
  me.detalle2=[];
            me.detalle.map(function(x){
               if(x.id==code){
                        me.detalle2.push({nombre:x.nombre});
                  }
                  
                 }); 
        return true; //return false if you want to prevent moving to previous page
        },
        enableSave() {
        this.steps[3].options.nextDisabled = false;
        },
        go() {
        this.$refs.wizard.goTo(this.cStep++);
        },
        nada(){
           
        }
    }
}
</script>


<style src="./fases.scss" lang="scss"  />