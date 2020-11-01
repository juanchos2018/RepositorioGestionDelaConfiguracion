<template>
    <div>
    <div class="row" id="listaproyectos">             
       <div class="col-2" v-for="item in items" :key="item.key">  
            
       <div class="sixteen columns">
        <div class="container">
             
           <img src="../../assets/fase1.png" style="position: relative;" width="150px" alt="">
           <div class="text">
          <h5 style="position: absolute;">{{item.nombre}}</h5>
       </div>
         
        </div>
        </div>
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
            child:'-MKgGmEB0AVCJ0TR_zeX'
        }
    },
    created(){
        this.Listar();   
    },
    methods:{
         Listar(){
            firebase.database().ref('Fases/'+this.child).on('value', (data) => {   
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


<style src="./fases.scss" lang="scss"  />