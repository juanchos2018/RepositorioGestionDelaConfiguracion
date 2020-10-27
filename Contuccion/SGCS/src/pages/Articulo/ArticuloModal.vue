<template>

<div>
     <b-modal       
       size="lg" 
       title="Buscar Articulo"
       ok-only no-stacking 
       header-bg-variant="white"       
       body-class="myDiv"
       :visible="visible"
       @hidden="CerrarModal1"
       @change="change1" >   
       <div class="form-row">
       <b-form-group  id="input-group-4"  label="Articulo"  class="col-md-6" >
          <b-form-input   id="input-19"   type="text"   v-model="Buscar1" required class="p-2 px-4 btn-xs">
          </b-form-input> 
        </b-form-group>

           <b-form-group label="Articulo:"  class="col-md-6">
                <b-form-input   id="input-20" class="p-2 px-4 btn-xs"  v-model="Buscar2" type="text"  required  >

           </b-form-input>
          </b-form-group>
       </div>
        
        <div class="form-row">  
           <b-form-group  class="col-md-2"> 
               <div class="">
                  <label class="control-label ">Buscar</label><br> 
                  <b-button type="button" variant="primary"  class="p-2 px-4 btn-xs"  @click="BuscarProducto" > Buscar</b-button>
                 </div>              
          </b-form-group>   
          
         <b-form-group class="col-md-2"   >
                 <label class="control-label ">Paginar</label><br>
              <b-form-select
                v-model="perPage"
                id="perPageSelect"
                size="sm"
                :options="pageOptions"
              ></b-form-select>
            </b-form-group>
             <b-form-group  class="col-md-4">
            <label class="control-label ">Paginas</label><br>
                <b-pagination
                v-model="currentPage"
                :total-rows="totalRows"
                :per-page="perPage"
                align="fill"
                size="sm"
                class="my-0"
                first-text="⏮"
                prev-text="⏪"
                next-text="⏩"
                last-text="⏭"
              ></b-pagination>
               </b-form-group>             


           
       </div>

       <div>
          <b-table 
            id="my-table"
            :items="ListaArticulos"
            :fields="fields"  
            :per-page="perPage"
            :current-page="currentPage"                       
            smal >                               
               
               <template v-slot:cell(cantidad)="data">
                   
                  <input type="number" style="width:80%" class="form-control"  min="1"    v-model.number="data.item.cantidad">
              </template>
           <template v-slot:cell(accion)="data">
                                     
                    <b-button size="sm" variant="primary" @click="AgregarTabla(data.item)" class="mr-1">
                        Agregar
                      </b-button>
                </template>
            </b-table>  
       </div>
      </b-modal>


</div>    
</template>

<script>
import axios from  'axios'

export default {
    name:'articulo-modal',    
    props: { item:    { default: null },
             visible: { type: Boolean,default:false }    
          },
    model: {
        prop: "visible",
        event: "change"
    },
     components: { },
     data(){
         return{
             Buscar1:'',
             Buscar2:'',
             cantidaFilas:0, 
             NumerosPaginas:1,
             TotalPaginas:0,
             TamanoPagina:0,
             ListaArticulos:[],
             perPage: 5,
             totalRows: 1,
             currentPage: 1,
             pageOptions: [5, 10, 15],
             datos:{
                IdAgencia:'',            
                IdTipoDocumento:'',
                Serie:'', 
                NumeroDocumento:'',
                Item:'',
                IdArticulo:'',
                IdAlmacen:'',            
                Descripcion: '', 
                Cantidad:1,       
                Unidad:'',            
                PrecioVenta:0,
                PrecioTotal:0,              
                contador:0,          
              },
             
              fields: [
                    { label: 'Codigo',     key: 'idArticulo'   },
                    { label: 'Descripcion',key: 'descripcion1' },
                    { label: 'unidad',     key: 'unidad'       },
                    { label: 'precio',     key: 'precio'       },
                    { label: 'cantidad',   key: 'cantidad'     },
                    { label: 'accion',     key: 'accion'       }
                ],
         }
     },
      created () {
                    
            
      },
     methods:{
        change1(visible) {
            this.$emit("change", visible);
        },
        CerrarModal1() {
            this.$emit("hide");
        },
       
      BuscarProducto(){
             let me=this;             
             axios.post('Articulo/GetLista', {Buscar1: me.Buscar1, Buscar2: me.Buscar2,Pagina:1,TPagina:50}).then(function(response){
             me.ListaArticulos=response.data.data;                  
             me.TotalPaginas=response.data.total;
             me.TamanoPagina=response.data.tPagina;
             me.NumerosPaginas=response.data.pagina;     
             me.totalRows = me.ListaArticulos.length             

         }).catch(function(error){
             console.log(error);
         });         
         
        },
        AgregarTabla(articulo){         
          var ArticuloSeleccionado = this.ListaArticulos.filter(function(elem){
            if(elem.IdArticulo==articulo.IdArticulo) return elem
          })
          this.datos.IdArticulo=articulo.idArticulo;
          this.datos.Descripcion=articulo.descripcion1; 
          this.datos.PrecioVenta=5;
          this.datos.Cantidad=articulo.cantidad;   
          this.$emit('Agrega-Tabla',  this.datos);
        }
     }     
    
}
</script>

<style scoped>
::v-deep .myDiv {
  background-color: #FFFFFF;
}
</style>