<template>
    <div>
           
    <div class="row" id="listaproyectos">             
       <div class="col-2" v-for="item in items" :key="item.key"  >              
       <div class="sixteen columns">
        <div class="container" >
             <div style="position: relative;display: inline-block; text-align: center;">
            <img src="../../assets/fase1.png"  width="150px" alt=""  >          
             </div>
              <div style="position: absolute; top: 45%; left: 45%; ">
                <strong> <h5 style="color: #EFDDF6 ;">{{item.nombre}}</h5></strong>  
            
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
       alerta(){
        
           this.$refs.popover.$emit('open')
       }
    }
}
</script>


<style src="./fases.scss" lang="scss"  />