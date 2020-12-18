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
                <b-button variant="primary"  class="p-2 px-4 btn-xs" >    <b-icon icon="layout-text-sidebar-reverse" ></b-icon> </b-button>
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
            items:[ { N: 1, codigo: 'SC-123', nombre_proyecto: 'Proyecto Nuevo', nombre_jefe: 'Juan carlos',estado:'Pendiente',fecha:'15-11-2020' }],
            fields: [
                    { label:"M°", key: 'N', sortable: false },
                    { label:"Codigo", key: 'codigo', sortable: false },    
                    { label:"Proyecto", key: 'nombre_proyecto', sortable: false },
                    { label:"Solicitante", key: 'nombre_jefe', sortable: false },
                    { label:"Estado", key: 'estado', sortable: false },
                    { label:"Fecha", key: 'fecha', sortable: false },
                    { label:"Acciones", key: 'acciones', sortable: false },
                ],
        }
    },
    created () {

    },
    methods: {
            ListarSolicitudes(){

            }
    }
}
</script>