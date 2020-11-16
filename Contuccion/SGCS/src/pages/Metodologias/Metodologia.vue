<template>

    <div>
       <div class="navigation-filter float-right">
          <a href="#"  class="cambia" @click="Grilla"><i class="fa fa-th-list"></i></a>
          <a href="#"  class="cambia" @click="Card" ><i class="fa fa-th"></i></a>
      </div>
 
       <b-button type="button"  class="m-1 p-2 px-4 btn-xs" variant="primary" @click="DialogMetodologia=true"> 
            <i class="fa fa-plus-circle"></i> Nuevo
         </b-button>        
      <div>
     <div class="inner-content">    
        <div v-if="Vergrilla">
             <b-table :items="items" :fields="fields"  stacked="sm">   
              <template v-slot:cell(accion)="item">
                <b-button variant="primary" @click="Detalle(item.item.id+'-'+item.item.nombre)" >Ver</b-button>
              </template>
            </b-table>
        </div>

      <div v-if="VerCard">   
           <div class="row" id="listaproyectos">             
              <div class="col-3" v-for="item in items" :key="item.key">             
               
               <b-card text-variant="primary"   border-variant="primary"   header-bg-variant="primary"  header-text-variant="white" header="Metodoligia" class="text-center">
               
                <img class="img-fluid" src="../../assets/logometo.png" width="140px" alt="Card image cap">
                <div class="card-body">               
                  <h4 class="card-title">{{item.nombre}}</h4>   
                   <b-button type="button"  size="lg" class="m-1 p-2 px-4 btn-xs" @click="Detalle(item.id+'-'+item.nombre)" variant="primary"> 
                  Ver
                </b-button>
                </div>
                </b-card>     
                <br>         
              </div>           
          </div>
       </div>
        </div>
     </div>
      <metodologia-nueva @CerrarModal="CerrarModal" :DialogMetodologia="DialogMetodologia" v-on:Listar-Emit="ListarMetodologia"></metodologia-nueva>
    
 </div>
</template>

<script>

import axios from  'axios';
import firebase from '@/firebase'
import MetodologiaNueva from './MetodologiaNueva';
export default {
    components: {
             MetodologiaNueva
        },
    data(){
        return{
          codigo:'',
          nombre:'',
          roomid: '222',
          Vergrilla:false,
          VerCard:true,
          roomname: 'mchat',
          nickname: 'juancho',
          items:[],
          data: { type:'', nickname:'', message:'' },
          chats: [],
          errors: [],          
          fields: [
                    { label:"codigo", key: 'id', sortable: false },
                    { label:"Nombre", key: 'nombre', sortable: false },    
                    { label:"Acciones", key: 'accion', sortable: false },
                ],
          offStatus: false,
          DialogMetodologia:false,
      }
    }, 
    created(){
  //  this.ListaTodo();
    //  this.Listar(); 
    this.ListarMetodologia();  
    
    },
    methods:{

      Guardar(){
            //  var key =firebase.getKey();
           let newData = firebase.database().ref('Metodologia/').push();
           newData.set({                 
               codigo: this.codigo,
               nombre: this.nombre,
               fecha: Date(),                  
           });
         },
       Detalle(item){
         // this.$router.push('/app/fases');
           this.$router.push({name:"fases",params:{item} });
       }, 
       CerrarModal() {
           this.DialogMetodologia = false;             
       },
      ListarMetodologia(){
        let me=this;
         axios.get('Backphp/ProcesoMetodologia.php/').then(response => {
                  me.items = response.data;
                  //    console.log(response.data);
                }).catch(function (error) {
                      console.log(error);
              }) .finally(() => {
           })
       },
    
       Listar(){  
            firebase.database().ref('Metodologia').on('value', (data) => {   
              this.items=[];             
                  data.forEach((doc) => {
                    var item = doc.val()
                    item.key = doc.key  
                    this.items.push(item)
             });
         });
       },    
       Grilla(){
         this.Vergrilla=true;
         this.VerCard=false;
       },
       Card(){
        this.Vergrilla=false;
         this.VerCard=true;
       },  
       onSubmit (evt) {
              evt.preventDefault()
              let newData = firebase.database().ref('chatrooms/'+this.roomid+'/chats').push();
              newData.set({
                  type: 'newmsg',
                  user: this.nickname,
                  message: this.data.message,
                  sendDate: Date()
              });
              this.data.message = '';
          },
    }

}
</script>
