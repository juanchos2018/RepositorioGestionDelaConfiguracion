<template>
    <div>
            <div>
         <b-button type="button"  class="m-1 p-2 px-4 btn-xs" variant="primary" @click="Nuevo"> 
            <i class="fa fa-plus-circle"></i> Nuevo Proyecto
          </b-button>
          <br>           
        </div>
    <div class="row">
         <div class="col-6" v-for="item in items" :key="item.key">  
            <b-card  class="border border-4 border-dark">
             <b-row no-gutters>
            <b-col md="2">
                <div class="UserAvatar__IconImage-hmym9w-1 jtNJTZ" >
                   <center> 
                       <img  src="../../assets/proyect.png" alt="Avatar"  class="avatar1">                  
                    </center>
                </div>     
            </b-col>
            <b-col md="8">
                 <b-card-body >                   
                <b-card-title>{{item.nombre_proyecto}}</b-card-title>                    
                <b-card-text>
                  {{item.fecha_inicio}}
                </b-card-text>                
                </b-card-body>                
            </b-col>
            </b-row>  
            <div style="float:right">
                <b-icon icon="people-fill" font-scale="2" shift-h="-2"></b-icon>                
                 <b-icon icon="grid3x3-gap-fill" class="float:right" @click="Detalle" font-scale="2" shift-h="2"></b-icon>
            </div>           
           </b-card>
         </div>
    </div> 
    </div>
</template>
<script>

import firebase from '@/firebase'
export default {
    
    data(){
        return{
              items:[],
        }
    },
    created(){
       this. Listar();
    },
    methods:{
        Nuevo(){
             this.$router.push('/app/proyectonuevo');
        },
        Detalle(){
             this.$router.push('/app/proyectodetalle');   
        },
        Listar(){
            firebase.database().ref('Proyectos').on('value', (data) => {   
              this.items=[];             
                  data.forEach((doc) => {
                    var item = doc.val()
                    item.key = doc.key  
                    this.items.push(item)
             });
         });
       },
    }
}
</script>

<style src="./proyecto.scss" lang="scss" scoped />
