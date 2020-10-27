<template>
   <div>
  <b-card>
    <div> 
    <h4>Comprobante</h4>
    <hr>   
       
        <div class="form-row">
         <b-form-group  label="Tipo de Venta :"  class="col-md-4">
                <b-form-select
                id="input-TipoVenta"
                name="input-TipoVenta"    
                value-field="idFormaVenta"
                text-field="descripcion"
                :options="TipoVenta"   
                 v-model="Comprobante.IdFormaVenta" 
                 @change="CambiarTipoVenta"
                ></b-form-select>
            </b-form-group>

             <b-form-group  label="Almacen:"  class="col-md-2">
                <b-form-select
                id="input-2"
                name="input-2" 
                required
                class="p-2 px-4 btn-xs" 
                 value-field="idAlmacen"
                text-field="descripcion"          
                :options="Almacen"
                ></b-form-select>
               
            </b-form-group>

            <b-form-group    class="col-md-2">
               <label class="control-label font-weight-bold text-info">Tipo Comprobante</label> 
               <div class="el-select border-left rounded-left border-info el-select">               
                <b-form-select
                id="input-1"
                name="input-1"  
                class="p-2 px-4 btn-xs ui dropdown"
                v-model="Comprobante.IdTipoDocumento"
                :options="tipoComprobantes"
                @change="GetSerie" 
               
               >
                 </b-form-select>
                  
                 </div>
            </b-form-group>        

        <b-form-group     label="Serie"    class="col-md-2" >
          <b-form-input
               id="input-3"
               name="input-3"
               v-model="Comprobante.Serie"
               type="text"
               required               
               class="p-2 px-4 btn-xs"               
               autocomplete="off"
              >

          </b-form-input>
            
        </b-form-group>
          <b-form-group    label="Numero"   class="col-md-2" >
          <b-form-input
           id="input-4"
           name="input-4"
           v-model="Comprobante.NumeroDocumento"
           type="text"
           class="p-2 px-4 btn-xs"
           autocomplete="off"
          :disabled='ActivarCampoNumero'>
          </b-form-input>

          <b-form-checkbox
                    id="checkbox-1"            
                    name="checkbox-1"
                    value="accepted"                 
                  v-model="campoNumero" >
                    Editar
                </b-form-checkbox>
            
        </b-form-group>
    </div>
     <div class="form-row">
        <b-form-group      class="col-md-6  el-input__inner" label-for="input-6" >
          <label class="control-label font-weight-bold text-info">Cliente</label> 
          <a href="#" class="text-center"    >   [+ Agregar]</a>       
            <auto-completado >             </auto-completado>  
      </b-form-group>
        <b-form-group  label="Direccion" class="col-md-6">                                        
              <b-form-input
                id="input-30"                

                require
                class="p-2 px-4 btn-xs"  >
                </b-form-input>
                
            </b-form-group>
       </div>
   <div class="form-row">    
    <b-form-group  label="Moneda"   class="col-md-2 ">     
        <b-form-select
          id="input-5" 
          name="input-5"  
          value-field="idCodigo"
          text-field="moneda"          
         :options="TipoMoneda"
          v-model="Comprobante.IdMoneda"
          ></b-form-select>
       
      
        
      </b-form-group>

       <b-form-group  label="Fecha Emision"   class="col-md-2">
        <b-form-input
          id="input-7"
          type="date"
          v-model="Comprobante.FechaDocumento"
          class="p-2 px-4 btn-xs" 
          required          
        ></b-form-input>

      </b-form-group>

    <b-form-group  label="Tipo Cambio"   class="col-md-2 ">     
      
        <b-form-input
          id="input-8"
          v-model="Comprobante.TipoCambio"
          required     
          class="p-2 px-4 btn-xs"  
        ></b-form-input>
           
      </b-form-group>
    </div>  
      <hr>
        <div>           
            <a href="#" class="text-center font-weight-bold text-info" v-b-tooltip.hover title="Busqueda Avanzada" @click="AbrirModalArticulo" >   [+ Buscar]</a>
        
             <articulo-buscar     ></articulo-buscar>
            <b-button   type="button" style="margin-left:5px" variant="success"  class="p-2 px-4 btn-xs"    alt="Right" >Registrar</b-button>      
                       
        </div>     
      </div>
    </b-card>        
      <articulo-modal v-model="modalArticulo"  v-on:Agrega-Tabla="RecibeArray">  </articulo-modal>
    <b-card class="mt-3" header="Detalle">
        
          <pre class="m-0"> {{Comprobante }} </pre>
          <br>
          comprobante
       
        
        <button> Ra,ma juancho</button>
        </b-card>
  </div>
</template>

<script>
import axios from  'axios'
import AutoCompletado from '@/pages/Cliente/ClienteAutoComplete'
import ArticuloBuscar from '@/pages/Articulo/ArticuloBuscar' 
import ArticuloModal from '@/pages/Articulo/ArticuloModal';  
export default {
     components: {AutoCompletado,ArticuloBuscar,ArticuloModal},
    data(){
      return{
          //variables
          campoNumero:false,
          modalCliente:false,
          modalArticulo:false,  
          //arrays
          tipoComprobantes:[],   
          TipoMoneda:[],
          TipoVenta:[],
          detalle:[],
          Almacen:[],
          Series:[],   

          Comprobante: {
          IdAgencia:'TA01',
          IdTipoDocumento: '',
          Serie:'',           
          NumeroDocumento:'######',
          IdAlmacen:'',
          NumeroPedido:'2', 
          FechaDocumento:new Date().toISOString().substr(0, 10),
          FechaVencimiento:'',
          IdVendedor:'',
          IdCaja:'1',
          IdCliente:'',          
          NombreCliente: '', 
          Direccion:'Los sauces 2 etapa mz H lote 3',
          RUC:'',         
          IdFormaVenta:'',
          IdMoneda:'',  
          TipoCambio: 1,
          ImporteTotal:1,
          ImporteIGV:0,
          igv:0,
          Saldo:1,
          ImporteDescuento:1, 
          Destino:'',
          DetalleComprobantes:[]
         },
               
      }
    },
     created () {
          
               this.GetTipoDocumento();             
               this.GetFormaVenta() 
               this.GetIGV()   
               this.Getmoneda()
               this.GetAlmacenes()
            //  this.GetComprobante()
        },
     computed: {
       subTotal(){
                return this.detalle.reduce((total,item)=>{
                    return total+item.Cantidad*item.PrecioVenta
           },0)
        },
       ActivarCampoNumero: function(){
        return !this.campoNumero;
      }
    },
    methods:{

      
       RecibeArray(product){
           this.Comprobante.DetalleComprobantes.push(JSON.parse(JSON.stringify(product)));

          // this. ReCalcular1()     
        },
       GetIGV(){
         axios({
            method: 'post',
            url: 'IGV/GetFactor',
            data: {}
            })
            .then(response => {
                this.Comprobante.igv = response.data.factor*100
                this.DescIGV = response.data.descripcion
                //console.log(response.data)
            })
       },
       GetSerie(Tipo){
       
            axios({
                method: 'post',
                url: 'Numeracion/GetSerie',
                data: {IdTipoDocumento:Tipo}
            })
            .then(response => {
                this.Series = response.data;
               // console.log(response.data);
                this.Comprobante.Serie=this.Series[0].serie
              //    this.GetNumero(Tipo,this.Series[0].serie)
               // if(this.Series.length==1){
                 //   this.Comprobante.Serie=this.Series[0].serie
                //}
            })
       },
       Getmoneda(){
            axios({
                method: 'post',
                url: 'TipoMoneda/GetLista',
                data: {}
            })
            .then(response => {
                this.TipoMoneda = response.data
            })
        },
       GetNumero(Tipo,Serie){
        axios({
                method: 'post',
                url: 'Numeracion/GetNumero',
                data: {IdTipoDocumento:Tipo,Serie:Serie}
            })
            .then(response => {
               // this.Series = response.data;
              this.Comprobante.NumeroDocumento=response.data.numeroActual+1;
            //    console.log(response.data);
              
            })
    },
       GetTipoDocumento(){
           let me=this;
             var tipoDcumento=[];
             axios.post('TipoDocumento',).then(function(response){                      
             tipoDcumento=response.data;
             tipoDcumento.map(function(x){
                   me.tipoComprobantes.push({text: x.tipoDocumento,value:x.idTipoDocumento});
               });             
             me.Comprobante.IdTipoDocumento=tipoDcumento[0].idTipoDocumento
            me.GetSerie(tipoDcumento[0].idTipoDocumento)

         }).catch(function(error){
             console.log(error);
         });
      },
       GetFormaVenta(){
            axios({
                method: 'post',
                url: 'FormaVenta/GetLista',
                data: {}
            })
            .then(response => {
              
                this.TipoVenta = response.data
                if(this.TipoVenta.length>=1){
                    this.Comprobante.IdFormaVenta=this.TipoVenta[0].idFormaVenta
                }
                
            })
        },
       GetAlmacenes(){
            axios({
                method: 'post',
                url: 'Almacen/GetLista',
                data: {}
            })
            .then(response => {
                this.Almacen = response.data;
                //console.log(response.data)
                if(this.Almacen.length==1){
                    this.Comprobante.idAlmacen=this.Almacen[0].idAlmacen
                }
            })
       },
       CambiarTipoVenta(val){
        var valObj = this.TipoVenta.filter(function(elem){
            if(elem.IdFormaVenta == val) return elem;
        });
        var date = new Date();
        date.setDate(date.getDate() + parseInt(valObj[0].diasVencidos))
        this.Comprobante.FechaVencimiento= moment(date).format("YYYY-MM-DD")
      //  console.log( this.Comprobante.FechaVencimiento)
      }, 
       CerrarModalCliente() {
            this.modalCliente = false          
       }, 
       AbrirModalArticulo() {      
          this.modalArticulo = true;
      },
   }
}
</script>