<template>
    <div>
         <div style="width: 200px; float: right; ">
            <label for="">Buscar</label> 
            <b-form-input
                id="input-30" 
                require
                class="p-2 px-4 btn-xs"               
             >
          </b-form-input> 
         </div> <br>
        <div>
            <h5>Listado Solicitud de Cambio</h5>
          <br>
           <b-card>                  
             <b-table :items="items" :fields="fields"  stacked="sm">
                    <template v-slot:cell(acciones)="item">
                <b-button variant="primary"  class="p-2 px-4 btn-xs" @click="FrmCrearInforme(item.item.fecha,item.item.codigo, item.item.id_proyecto)">    <b-icon icon="layout-text-sidebar-reverse" ></b-icon> </b-button>
              </template>
             </b-table>                 
           </b-card>
        </div>
    </div>
</template>

<script>
import axios from  'axios';
export default {
    
    data(){
        return{
            items:[],
            fields: [
                    { label:"N°", key: 'numero', sortable: false },
                    { label:"Codigo", key: 'codigo', sortable: false },    
                    { label:"Proyecto", key: 'nombre_proyecto', sortable: false },
                    { label:"Solicitante", key: 'nombre', sortable: false },
                    { label:"Estado", key: 'estado', sortable: false },
                    { label:"Fecha", key: 'fecha', sortable: false },
                    { label:"Acciones", key: 'acciones', sortable: false },
                ],
        }
    },
    created () {
        this.ListarSolicitudes();
    },
    methods: {
           ListarSolicitudes(){
              let me=this;
              axios.get('ApiWeb/SolicitudCambio.php/').then(response => {                    
                      me.items = response.data.data;                      
                  }).catch(function (error) {
                      console.log(error);
                }) .finally(() => {                     
            })
          },
          FrmCrearInforme(fecha,codigo,id_proyecto){
                console.log(id_proyecto);                
                var datos=fecha+'|'+codigo+'|'+id_proyecto;
                this.$router.push({name:"informecambio", params:{datos}});
          },
    }
}
</script>