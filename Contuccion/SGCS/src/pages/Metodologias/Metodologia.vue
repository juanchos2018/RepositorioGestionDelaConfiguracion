<template>

    <div>
      
       <div class="navigation-filter float-right" style="margin-top:20px">
           <a href="#" @click="Grilla" class="cambia" ><i class="fa fa-th-list"></i></a>
          <a href="#"   @click="Card" class="cambia"  ><i class="fa fa-th"></i></a>
      </div>
       <b-button type="button"  class="m-1 p-2 px-4 btn-xs"   style="margin-top:20px" variant="primary" @click="DialogMetodologia=true"> 
            <i class="fa fa-plus-circle"></i> Nueva Metodologia
         </b-button>         
         <div style="width: 200px;float; float: right; display: inline-block;">
            <label for="">Buscar</label> 
            <b-form-input
                id="input-30" 
                require
                class="p-2 px-4 btn-xs"               
              v-model="search"  >
          </b-form-input> 
         </div>   
      <div>
         <br>
         <br>
     <div class="inner-content">    
        <div v-if="Vergrilla">
             <b-table :items="filteredList" :fields="fields"  stacked="sm">   
              <template v-slot:cell(accion)="item">
                <b-button variant="primary" @click="Detalle(item.item.id+'-'+item.item.nombre)" >Ver</b-button>
              </template>
            </b-table>
       </div>
      <div v-if="VerCard">   
           <div class="row" >             
              <div class="col-3" v-for="item in filteredList" :key="item.key"  >               
               <b-card text-variant="primary"   border-variant="primary"   header-bg-variant="primary"  header-text-variant="white" header="Metodologia" class="text-center">
               
                <img class="img-fluid" src="../../assets/logometo.png" width="140px" alt="Card image cap">
                <div class="card-body">               
                  <h4 class="card-title">{{item.nombre}}</h4>   
                   <b-button type="button"  size="lg" class="m-1 p-2 px-4 btn-xs" @click="Detalle(item.id+'-'+item.nombre)" variant="primary"> 
                   Ver
                 </b-button>
                   <b-button type="button"  size="lg" class="m-1 p-2 px-4 btn-xs" v-b-tooltip.hover title="Editar" @click="AbrirModalEditar(item.id)" variant="primary"> 
                 <b-icon icon="pencil-square" animation="fade" font-scale="1" ></b-icon>
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
      <metodologia-editar @CerrarModal="CerrarModal" :DialogoModificar="DialogoModificar" v-bind:id_metodologia="id_metodologia" v-on:Listar-Emit="ListarMetodologia"></metodologia-editar>
    
 </div>
</template>

<script>

import axios from  'axios';
import firebase from '@/firebase'
import MetodologiaNueva from './MetodologiaNueva';
import MetodologiaEditar from './MetodologiaEditar';
export default {
    components: {
             MetodologiaNueva,MetodologiaEditar},
    data(){
        return{
          id_metodologia:'',
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
          DialogoModificar:false,
          search: '',
      }
    }, 
    created(){
  //  this.ListaTodo();
    //  this.Listar(); 
    this.ListarMetodologia();  
    
    },
   computed: {
      filteredList() {
        return this.items.filter(post => {
          return post.nombre.toLowerCase().includes(this.search.toLowerCase())
        })
      }
    },
    methods:{
     updateGender: function(event){
          this.nombre = event.target.value
        },
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
           this.DialogoModificar = false;                     
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
       AbrirModalEditar(id){
         this.id_metodologia=id;
         this.DialogoModificar=true;         
       }
    }

}
</script>
