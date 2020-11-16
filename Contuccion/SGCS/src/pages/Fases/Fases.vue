<template>
    <div>   

<div >
<b-button type="button"  class="m-1 p-2 px-4 btn-xs" variant="primary" @click="DialogoFase=true"> 
            <i class="fa fa-plus-circle"></i> Nueva Fase
          </b-button>
</div> <br>
<center><h5>Metodologia </h5> <h5>{{nombremetodologia}}</h5>
</center>

    <wizard
      ref="wizard"      
      :steps="items"     
      @change="onChange"
      @click="click"
      :onNext="nextClicked" 
      :onBack="backClicked">
     
        <div slot="page1">
            <h4>Elemtos de Configuracion</h4>  
             <b-button variant="outline-primary" @click="DialogoElemento=true">Agregar</b-button>
             <b-table striped hover :items="detalle2"></b-table>   
        </div>       
    </wizard> 
          
    
  <fase-nueva @CerrarModal="CerrarModal" :DialogoFase="DialogoFase"  v-bind:idmetodologia="datos.id_metodologia" v-on:Listar-Fase="ListarFasePorMetodologia"></fase-nueva>
   
   <elemento-nuevo@CerrarModal="CerrarModal" :DialogoElemento="DialogoElemento"  v-bind:idmetodologia="datos.id_metodologia" ></elemento-nuevo>
   
   </div>

</template>

<script>
import axios from  'axios';
import firebase from '@/firebase'
import Wizard from './Wizard.vue';
import { VStepper } from 'vue-stepper-component'
import FaseNueva from './FaseNueva';
import ElementoNuevo from '@/pages/Elemento/ElementoNuevo';
export default {
     components: { Wizard,VStepper,FaseNueva,ElementoNuevo  },
     
    data(){
        return{
            items:[],
            nombremetodologia:'',
            child:'-MKgGmEB0AVCJ0TR_zeX',
            current: 0,
            pagina:'page1',
            lista:[ {id:'111',nombre:'pepe',apellido:'loco',slot:'page1',label:'meto 1'},
                    {id:'222',nombre:'pepe',apellido:'loco',slot:'page1',label:'meto 2'},
                    {id:'333',nombre:'andres',apellido:'loco',slot:'page1',label:'meto 3'},
                    {id:'444',nombre:'kiara',apellido:'loco',slot:'page1',label:'metro 4'},
                    {id:'555',nombre:'iara',apellido:'loco',slot:'page1',label:'meto 5'},
                    {id:'666',nombre:'iara',apellido:'loco',slot:'page1',label:'meto 6'}
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
             datos:{
                id_metodologia:"",
                nombre:""               
                 },
             DialogoFase:false,
             DialogoElemento:false,
        }
    },
    created(){
       // this.Listar();   

    },
    mounted(){
      this.GetDatos()
    },
    methods:{
        click(){
            alert("clikc");
        },
       onChange(current) {
        console.log('onChange:', current);
        this.current = current;
       },
       GetDatos(){
         var item = this.$route.params.item
          if(item){          
            var val = item.split("-")
            this.datos.id_metodologia = val[0]
            this.datos.nombre=val[1]   
            this.nombremetodologia=val[1];
            this.ListarFasePorMetodologia(val[0]);  
          }         
       },
       ListarFasePorMetodologia(id){
        let me=this;
         axios.get('Backphp/ProcesoFase.php/?metodologiaId='+id).then(response => {
                 //me.items.push({slot:'page1',label:response.data.nombre_fase});
                 me.items = response.data;
                 console.log(response.data);  
                 
                  me.detalle.map(function(x){
                  if(x.id==111){
                            me.detalle2.push({nombre:x.nombre});
                      }
                      
                }); 
               }).catch(function (error) {
                      console.log(error);
              }) .finally(() => {
           })
       },
        CerrarModal() {
           this.DialogoFase = false;             
       },
       
       alerta(){
        
           this.$refs.popover.$emit('open')
       },
        nextClicked(currentPage) {
          //siguiente
        console.log('next clicked', currentPage) 
       
        let me =this;
        var code =this.lista[currentPage].id;
        console.log(this.lista.length);
        console.log(code);
        me.detalle2=[];
            me.detalle.map(function(x){
               if(x.id==code){
                        me.detalle2.push({nombre:x.nombre});
                  }
                  
            });       
        return true; //return false if you want to prevent moving to next page
        },
        backClicked(currentPage) {
          //retroceder
           console.log('back clicded', currentPage) 
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
       
    }
}
</script>


<style src="./fases.scss" lang="scss"  />