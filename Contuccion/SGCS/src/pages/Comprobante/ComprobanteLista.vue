<template>

 <div>
        <div>
          <!-- Menu Opciones -->
        <b-nav pills>           
              <b-button type="button"  class="m-1 p-2 px-4 btn-xs" variant="primary"  v-on:click="EnlaceComprobantes" >
                <i class="fa fa-plus-circle"></i> Nuevo
              </b-button>            
          <b-button type="button"  class="m-1 p-2 px-4 btn-xs"  variant="primary" > 
            <i class="glyphicon glyphicon-download-alt"> </i> Exportar</b-button>
        </b-nav>
        <!-- Fin Menu Opcionesv -->
      </div>

      <div>  
           <b-card class="mt-3" header="Listado de Comprobante"             
            header-text-variant="white"
            header-tag="header"
            header-bg-variant="primary" >     
            
            <b-form inline v-on:submit.prevent="GetComprobante">
              <label class="mr-sm-2" for="inline-form-custom-select-pref">Filtro </label>
              <b-form-input v-model="Serie" class="m-2" placeholder="Serie"></b-form-input>
              <b-form-input v-model="NumeroDocumento" class="m-2" placeholder="Numero de Preventa"></b-form-input>
              <b-button variant="primary" v-on:click="GetComprobante">Buscar</b-button>
            </b-form>
        
             <!-- Listado tabla Preventa -->
        
            <div class="table-responsive">

              <b-table hover :items="items" :fields="fields">
                    <template v-slot:cell(fechaDocumento)="data">
                        {{ frontEndDateFormat(data.item.fechaDocumento) }}
                    </template>
                     <template v-slot:cell(numeroDocumento)="data">
                        {{ data.item.idTipoDocumento+'-'+ data.item.serie+'-'+data.item.numeroDocumento }}
                    </template>
                     <template v-slot:cell(importeTotal)="data">
                       <div class="text-right"> {{ data.item.importeTotal | moneyfiltro }}</div>
                    </template>
                    
                    <template v-slot:cell(idCliente)="data">
                       <div class="text-right">
                         <b-button variant="primary" size="sm">Editar</b-button>
                         <b-button variant="success" size="sm"  v-on:click="data.toggleDetails"  @click="Detalle(data.item.numeroDocumento,data.item.serie,data.item.idTipoDocumento)"> 
                              {{ data.detailsShowing ? '▲': '▼' }} 
                        </b-button>
                       </div>                      
                    </template>
                     <template  v-slot:row-details="data">
                        <b-card >                          
                          <table class="table">
                                <thead>                                  
                                    <tr> 
                                        <th>id</th>
                                        <th>Articulo</th>
                                        <th>Cantidad</th>
                                         <th>PrecioVenta</th>
                                    </tr>
                                  
                                </thead>
                                <tbody>
                                   <tr v-for="(value, key) in ListaDetalle" :key="key">
                                  <td>{{value.idArticulo}}</td>
                                  <td>{{value.descripcion}}</td>
                                  <td>{{value.cantidad}}</td>
                                  <td>{{value.precioVenta}}</td>
                               
                              </tr>
                                </tbody>
                            </table>
                        </b-card>
                 </template>
              </b-table>
              
            </div>
            
             </b-card> 
      </div>
    
 </div>

</template>

<script>

import axios from  'axios'
import moment from 'moment'
export default {
    
    data() {
      return {
          // Buscar
          NumeroDocumento:'',
          Serie:'',
          TotalRegistros:0 ,
          TamanoPagina:50,
          Pagina:1,
          items:[],
          ListaDetalle:[],
          fields:[
                 { label:"Nombre de Cliente", key: 'nombreCliente', sortable: false },
                 { label:"Fecha Documento", key: 'fechaDocumento', sortable: false },
                 { label:"Numero Documento", key: 'numeroDocumento', sortable: false },
                 { label:"Importe Total", key: 'importeTotal', sortable: false },
                 { label:"Estado", key: 'estado', sortable: false },
                 { label:"Acciones", key: 'idCliente', sortable: false },
          ],
      }
     },
     computed:{
     
     },
     created (){
     //  this.GetComprobante()
     },
      methods:{
        EnlaceComprobantes(){
          this.$router.push('/app/components/comprobantes');
        },
        GetComprobante(){
            let me = this;
            axios({
                method: 'post',
                url: 'Comprobante/GetLista',
                data: {
                    Buscar1:'',
                    Pagina:1,
                    TamanoPagina:50
                }
            })
            .then(response => {                
                me.items = response.data;
              
            }).catch(function (error) {
                console.log(error);
            });
        },
        frontEndDateFormat: function(date) {
        		return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
        	},
         Detalle(numero,serie,iddoc){
        
            let me = this;

            axios({
                method: 'post',
                url: 'Comprobante/GetDetalle',
                data: {
                    NumeroDocumento:numero,
                    Serie:serie,
                    IdTipoDocumento:iddoc
                }
            })
            .then(response => {                
                me.ListaDetalle = response.data.detalleComprobantes;   
            //    console.log(response.data)           
            }).catch(function (error) {
                console.log(error);
            });     
         } 
      }
     
}

</script>