<template>
  <div>
        <div>
          <!-- Menu Opciones -->
        <b-nav pills>
           
              <b-button type="button"  class="m-1 p-2 px-4 btn-xs" variant="primary" v-on:click="EnlacePreventas" >
                <i class="fa fa-plus-circle"></i> Nuevo
              </b-button>
            
          <b-button type="button"  class="m-1 p-2 px-4 btn-xs"  variant="primary" > 
            <i class="glyphicon glyphicon-download-alt"> </i> Exportar</b-button>
        </b-nav>
        <!-- Fin Menu Opcionesv -->
      </div>
      <div>  
           <b-card class="mt-3" header="Listado de Preventa"             
            header-text-variant="white"
            header-tag="header"
            header-bg-variant="primary" >     
            
              <div class="form-row">
                    <b-form-group  label="Nombre Cliente :"  class="col-md-3">
                      <b-input
                      v-model="cliente"
                      class="p-2 px-4 btn-xs" 
                      aria-describedby="input-1-live-feedback"
                      ></b-input>
                  </b-form-group>
                  <b-form-group  label="Numero Documento:"  class="col-md-3">
                      <b-input
                     
                      class="p-2 px-4 btn-xs" 
                      aria-describedby="input-1-live-feedback"
                      ></b-input>
                  </b-form-group>
                  <b-form-group  label="-"  class="col-md-3">
                      <b-button variant="primary" @click="GetPreVenta" >Buscar</b-button>
                  </b-form-group>
          </div>
        
             <!-- Listado tabla Preventa -->
        
            <div class="table-responsive">
              <b-table hover :items="items" :fields="fields">
                    <template v-slot:cell(fechaDocumento)="data">
                        {{ data.item.fechaDocumento | moment("DD-MM-YYYY") }}
                    </template>
                     <template v-slot:cell(numeroDocumento)="data">
                        {{ data.item.idTipoDocumento+'-'+ data.item.serie+'-'+data.item.numeroDocumento }}
                    </template>
                     <template v-slot:cell(importeTotal)="data">
                       <div class="text-right"> {{ data.item.importeTotal | moneyfiltro }}</div>
                    </template>
                    <template v-slot:cell(isFacturado)="data">
                       <div class="text-right"> {{ data.item.isFacturado? "Si":"No" }}</div>
                    </template>
                    <template v-slot:cell(idCliente)="data">
                       <div class="text-right">
                          <b-button variant="primary"  class="m-1"
                              @click="IrComprobante(data.item.idAlmacen+'-'+data.item.idTipoDocumento+'-'+ data.item.serie+'-'+data.item.numeroDocumento)" size="sm">
                              Comprobante
                           </b-button>

                           <b-button variant="primary" 
                              @click="IrDetallePreVenta(data.item.idAlmacen+'-'+data.item.idTipoDocumento+'-'+ data.item.serie+'-'+data.item.numeroDocumento)" size="sm">
                              Editar
                           </b-button>
                             <b-button variant="success" size="sm"  v-on:click="data.toggleDetails"  > 
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
                                   <tr>
                                       <td>1</td>
                                       <td>a</td>
                                       <td>1</td>
                                       <td>100</td>                               
                                   </tr>
                                </tbody>
                               </table>
                           </b-card>
                         </template>
              </b-table>
            </div>
               <b-pagination
                v-model="Pagina"
                :total-rows="TotalRegistros"
                :per-page="TamanoPagina"
                first-number
              ></b-pagination>
            <!-- Fin tabla -->
             </b-card> 
        </div>
      <div>

</div>

<div>

  </div>
 </div>
</template>
<script>
import axios from 'axios'
import moment from 'moment'
export default {

     data() {
      return {
          // Buscar
          NumeroDocumento:'',
          cliente:'',
          Fecha1:'',
          TotalRegistros:0 ,
          TamanoPagina:50,
          Pagina:1,
          items:[],
          fields:[
                 { label:"Nombre de Cliente", key: 'nombreCliente', sortable: false },
                 { label:"Fecha Documento", key: 'fechaDocumento', sortable: false },
                 { label:"Numero Documento", key: 'numeroDocumento', sortable: false },
                 { label:"Importe Total", key: 'importeTotal', sortable: false },
                 { label:"Facturado", key: 'isFacturado', sortable: false },
                 { label:"Acciones", key: 'idCliente', sortable: false },
          ],
      }
     },
     computed:{
     
     },
     created (){
       this.GetPreVenta()
     },
      methods:{
        EnlacePreventas(){
          this.$router.push('/app/components/preventas');
        },
        IrComprobante(id){
          this.$router.push('/app/components/comprobantesdetalle/'+id);
        },        
        IrDetallePreVenta(id){
          this.$router.push('/app/components/preventadetalle/'+id);
        },
        GetPreVenta(){
            let me = this;
            //var url = this.Fecha1?"PreVenta/GetLista":"PreVenta/GetListaFecha"
            //alert(url+" "+this.Fecha1)
            axios({
                method: 'post',
                url: "PreVenta/GetLista",
                data: {
                    Buscar1:me.Buscar,
                    NumeroDocumento:me.NumeroDocumento,
                    
                    Pagina:1,
                    TamanoPagina:50
                }
            })
            .then(response => {
                //console.log(response.data.data);
                me.items = response.data.data;
                me.Pagina = response.data.pagina;
                me.TamanoPagina = response.data.tamanoPagina;
                me.TotalRegistros = response.data.totalRegistros;

            }).catch(function (error) {
                console.log(error);
            });
        },
      }
     
}
</script>