<template>
<div>
          <div class="form-row">             
          <b-form-group    class="col-md-3">                        
            <a-steps :current="current"   direction="vertical" @change="onChange" >
                 <a-step v-for="item in timeline" :key="item.id_timeline" :title="item.fecha" :sub-title="item.hora" :description="item.descripcion"  />              
                <a-popover slot="progressDot" slot-scope="{  prefixCls }">                 
                   <span :class="`${prefixCls}-icon-dot`" />
                </a-popover>             
            </a-steps>  
            </b-form-group>
             <b-form-group   class="col-md-9">  
               <div>
                <b-card>
                     <a-progress
                      :stroke-color="{
                            '0%': '#108ee9',
                            '100%': '#87d068',
                          }"
                          :percent="parseInt(porcentajeavance)"
                        />                 
                    <a-descriptions :title="descripcion">
                        <a-descriptions-item label="Nombre">
                          {{nombre_miembro}}
                        </a-descriptions-item>
                        <a-descriptions-item label="Fecha Inicio">
                          {{fecha_inicio}}
                        </a-descriptions-item>
                        <a-descriptions-item label="Fecha Termino">
                            {{fecha_termino}}
                        </a-descriptions-item>
                        <a-descriptions-item label="Estado">
                          {{estado}}
                        </a-descriptions-item>
                        <a-descriptions-item label="Url Evidencia">
                        <b-link href="urlevidencia">link</b-link>
                        </a-descriptions-item>
                      </a-descriptions>

                </b-card>
              </div>
            </b-form-group>    
        </div>  
        <hr>
        <div style="float:right">

           <b-button variant="danger"  class="p-2 px-4 btn-xs">Rechazar</b-button>
          <b-button variant="success"  class="p-2 px-4 btn-xs" style="margin-left:5px">Aprobar Tarea</b-button>
        </div>

  </div>
</template>

<script>

//DialogMetodologia
import moment from 'moment'
import firebase from '@/firebase'
import axios from  'axios';
export default {
    name: 'tarea-detalle',       
    data() {
        return {                
          
          nombre_miembro:'',
          fecha_inicio:'',
          fecha_termino:'',
          descripcion:'',
          porcentajeavance:null,
          urlevidencia:'',
          estado:'',   
          id_usuario:'',
          
          timeline:[],
          current: 0,
        }
    },
    watch: {
    
    },
    created () {
    
    },
    computed: {
     
    },
     mounted(){
      this.GetDatos()
    },
    methods: {
         GetDatos(){
         var item = this.$route.params.id_tarea
          if(item){     
              this.ListarTimliene(item);  
              this.BuscarTarea(item);
          }         
       },
         ListarTimliene(id_tarea){
           let me=this;
            axios.get('ApiWeb/Timeline.php/?id_tarea='+id_tarea).then(response => {              
                 me.timeline = response.data.data;    
                 console.log(response.data)            
               }).catch(function (error) {
                    console.log(error);
              }) .finally(() => {
           })
         },
        BuscarTarea(id_tarea1){
           let me=this;
            axios.get('ApiWeb/Tarea.php/?id_tarea1='+id_tarea1).then(response => {              
              //   me.timeline = response.data;    
                 console.log(response.data)     
                 me.nombre_miembro=response.data.nombre; 
                 me.fecha_inicio=response.data.fecha_inicio;
                 me.fecha_termino=response.data.fecha_termino   
                 me.descripcion=response.data.descripcion   
                 me.porcentajeavance=response.data.porcentajeavance         
                 me.urlevidencia=response.data.urlevidencia   
                 me.estado=response.data.estado   
               }).catch(function (error) {
                    console.log(error);
              }) .finally(() => {
           })
        } ,
        onChange(current) {
          console.log('onChange:', current);
          this.current = current;
        },
       CerrarModal(){              
              this.$emit('CerrarModal');
       },       
       Confirmacion(){
          this.$swal({
              position: 'top-end',
              icon: 'success',
              title: 'Registrado',
              text:'texto',
              showConfirmButton: false,
              timer: 3000
           })
       },
    }
};
</script>

<style scoped>
  ::v-deep .myDiv {
    background-color: 	#FFFFFF;
  }

</style>

<style src="./tarea.scss" lang="scss" scoped />
