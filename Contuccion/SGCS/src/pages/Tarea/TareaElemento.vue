<template>
    <div>
        <div>
          <b-card>
            <div class="container">            
                <div class="row">
                <h5>{{nombre_elemento}}</h5>         
            </div>  
            <div class="row">
                <h5>Fase: </h5>
                <h5> {{nombre_fase}}</h5>
            </div>
            <div class="row"> 
                <h5>Proyecto : </h5>
                <h5> {{nombre_proyecto}}</h5>
            </div> 
            <br>            
          </div>         
        </b-card>
        </div>
        <div>
         <br>
        <b-card no-body>
          <b-tabs
                active-nav-item-class="font-weight-bold text-uppercase text-danger"
                active-tab-class="font-weight-bold text-success"
                content-class="mt-3" >
                <b-tab title="Tareas" active>
                    <div class="float-right">
                        <b-button @click="AbrirModal"> Agregar Tarea </b-button>
                    </div>
               <div class="row" >             
                    <div class="col-4" v-for="item in tareasversion" :key="item.key">                
                        <b-card no-body class="overflow-hidden"  footer-tag="footer">
                            <b-row no-gutters>
                            <b-col md="3">
                                <div class="UserAvatar__IconImage-hmym9w-1 jtNJTZ" >
                                    <center> 
                                    <img src="../../assets/tarea.png" alt="Avatar" class="avatar1"/> 
                                    </center>
                                </div>     
                            </b-col>
                            <b-col md="8">
                                <b-card-body >                   
                                <b-card-title> <h5> {{item.descripcion}}</h5> </b-card-title>                    
                                <b-card-text>
                                texto
                                </b-card-text>                
                                </b-card-body>                
                            </b-col>
                            </b-row>            
                                <template #footer  footer-class="myDiv">
                                    <div  style="background-color: white; float:right;">
                                    <b-button variant="success" v-b-tooltip.hover title="Editar" > <b-icon icon="pencil-square" animation="fade" font-scale="1" ></b-icon> </b-button>
                                   
                                    </div>                                          
                                </template>
                        </b-card>
                        <br>
                    </div>
                    </div>
                                
                </b-tab>
                <b-tab title="Second">
                    <p>I'm the second tab</p>
                </b-tab>             
            </b-tabs>
          </b-card>  
       </div>
       <!--Modal -->
        <tarea-nueva @CerrarModal="CerrarModal" :DialogoTarea="DialogoTarea" v-bind:miembros="miembros"  v-bind:id_version="id_version" ></tarea-nueva>
   
    </div>
</template>

<script>
import axios from  'axios';
import TareaNueva from './TareaNueva';
export default {
    name: 'tarea-elemento',
    components: {TareaNueva  },
    data(){
      return{
          nombre_proyecto:'',
          nombre_fase:'',
          nombre_elemento:'',
          id_elemento:'',
          id_miembro:'',
          id_version:'',
          miembros:[],
          tareasversion:[],
          DialogoTarea:false,
      }
    },
    created () {

    },
    mounted(){
            this.DatosId();    
    },
    methods: {
            DatosId(){
                var dato = this.$route.params.datos
                // var datos=element+'-' +fase+'-'+ id_version+'-'+miembro_id;
                if(dato){
                    this.editable = true
                    var val = dato.split("-")
                    this.nombre_elemento= val[0]
                    this.nombre_fase=val[1]
                    this.id_version=val[2]
                    this.id_miembro=val[3]
                    this.nombre_proyecto=val[4]
                    this.ListaMiembros(val[5]);
                    this.ListarTareasVersion(val[2]);

                
                }
            },
            ListaMiembros(id){
                    let me=this;
                    var previa=[];
                    axios.get('Backphp/ProcesoMiembro.php/?id_proyecto='+id).then(response => {  
                            previa=response.data;  
                            console.log(response.data)
                            previa.map(function(x){
                            me.miembros.push({text: x.nombre,value:x.id});
                            })
                            }).catch(function (error) {
                                console.log(error);
                        }) .finally(() => {
                    })       
            },
            ListarTareasVersion(id){
                    let me=this;
                   
                    axios.get('Backphp/ProcesoTarea.php/?id_tarea='+id).then(response => {  
                            me.tareasversion=response.data;  
                           // console.log(response.data)
                            
                            }).catch(function (error) {
                                console.log(error);
                        }) .finally(() => {
                    }) 
            },
            AbrirModal(){
                this.DialogoTarea=true
            },
            CerrarModal(){
                this.DialogoTarea=false
            }
    }
}
</script>
<style src="./tarea.scss" lang="scss" scoped  />
