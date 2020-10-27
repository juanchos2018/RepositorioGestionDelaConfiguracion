<template>
<div>
  <b-card v-if="isLoading" >
    <div style="height:100%; text-align:center">
         
    </div>
  </b-card>
  <b-card v-else>
<div> 
<h4>Pre - Venta</h4>
<div> {{PreVenta}}</div>
<hr>
        <div class="form-row">
              <b-form-group  label="Tipo de Venta :"  class="col-md-3">
                <b-form-select
                id="input-TipoVenta"
                name="input-TipoVenta"    
                value-field="idFormaVenta"
                text-field="descripcion"          
                :options="TipoVenta"
                v-model="PreVenta.IdFormaVenta"
                @change="CambiarTipoVenta"
                class="p-2 px-4 btn-xs" 
                aria-describedby="input-1-live-feedback"
                ></b-form-select>
            </b-form-group>
             <b-form-group  label="Almacen:"  class="col-md-3">
                <b-form-select
                id="input-2"
                name="input-2"    
                value-field="idAlmacen"
                text-field="descripcion"          
                :options="Almacen"
                v-model="PreVenta.idAlmacen"
                class="p-2 px-4 btn-xs" 
                aria-describedby="input-1-live-feedback"
                ></b-form-select>
            </b-form-group>
            <b-form-group   label="Tipo Documento" class="col-md-2">
               <div class="el-select border-left rounded-left border-info el-select">               
                <b-form-select
                  id="idTipoDocumento"
                  value-field="idTipoDocumento"
                  text-field="tipoDocumento"  
                  
                  :options="TipoDocumento"   
                  class="p-2 px-4 btn-xs"
                >
               </b-form-select>
              </div>
            </b-form-group>
        <b-form-group  label="Serie" class="col-md-2" >
          <b-form-select
               id="Serie"
               name="Serie"
               value-field="serie"
               text-field="serie" 
               v-model="PreVenta.Serie"
               :options="Series"
               class="p-2 px-4 btn-xs"
               aria-describedby="input-1-live-feedback" >
          </b-form-select>
        </b-form-group>

         <b-form-group label="Numero" class="col-md-2" >
          <b-form-input
           id="input-4"
           name="input-4"
           v-model="PreVenta.NumeroDocumento"
           disabled
           type="text"
           class="p-2 px-4 btn-xs"
           autocomplete="false"
           >
          </b-form-input >
        </b-form-group>
    
     
    </div>
      <div class="form-row">
        <b-form-group class="col-md-6 el-input__inner" label-for="input-6" >
          <label class="control-label font-weight-bold text-info">Cliente</label> 
          <a href="#" class="text-center" @click="DialogCliente=true">  [+ Agregar]</a>
          <div  class="el-select  rounded-left border-info el-select--small" >
      
            <auto-completado @Seleccionar="ObtenerCliente"
              
             >
             </auto-completado>

          </div>
      </b-form-group>

          <b-form-group  label="Direccion"   class="col-md-6 ">     
        <b-form-input
          id="TxtDireccion"
          v-model="PreVenta.Direccion"
          class="p-2 px-4 btn-xs"  
        ></b-form-input>
       </b-form-group>

      <b-form-group  label="Vendedor:"  class="col-md-6">
          <b-form-select
          id="CmbVendedor"
          name="CmbVendedor"    
          value-field="idVendedor"
          text-field="nombre"          
          :options="Vendedor"
          v-model="PreVenta.IdVendedor"
          class="p-2 px-4 btn-xs" 
          aria-describedby="input-1-live-feedback"
          ></b-form-select>
      </b-form-group>
     <b-form-group  label="Fecha Emision"   class="col-md-2">
        <b-form-input
          id="input-7"
          type="date"
          v-model="PreVenta.FechaDocumento"
          class="p-2 px-4 btn-xs" 
          required          
        ></b-form-input>
      </b-form-group>

    <b-form-group  label="Tipo Cambio"   class="col-md-2 ">     
        <b-form-input
          id="input-8"
          v-model.number="PreVenta.TipoCambio"
          required
          class="p-2 px-4 btn-xs"  
        ></b-form-input>
       </b-form-group>
       <b-form-group  label="Moneda"   class="col-md-2 ">     
        <b-form-select
          id="cmdmoneda"
          value-field="idCodigo"
          text-field="moneda"          
          :options="TipoMoneda"
          v-model="PreVenta.IdMoneda"
          class="p-2 px-4 btn-xs" 
          aria-describedby="input-1-live-feedback"
          ></b-form-select>
       </b-form-group>
      </div>
      <articulo-buscar @AgregarArticulo="AgregarDetalle"
                   
    ></articulo-buscar>

  <hr>
  <b-card class="mt-3" header="Detalle"  header-text-variant="white"
            header-tag="header"
            header-bg-variant="primary">
            <b-table :items="PreVenta.DetallePreVenta"  :fields="fields" stacked="sm">
               <template v-slot:cell(IdArticulo)="data">
                  {{parseInt(data.item.IdArticulo)}}
              </template>
               <template v-slot:cell(Cantidad)="data">
                 <input type="number" v-model.number="data.item.Cantidad" @change="ReCalcular"  min="1"  style="width:80px" class="form-control" > 
              </template>
              <template v-slot:cell(PrecioUnitario)="data">
                 <input type="number" v-model.number="data.item.PrecioUnitario" @change="ReCalcular"  min="1"  style="width:80px" class="form-control" >
              </template>
               <template v-slot:cell(ImporteMN)="data">
                {{data.item.ImporteMN }} 
              </template>
              <template v-slot:cell(estado)="data">
                <b-button variant="primary" @click="QuitarArticulo(data.index,data.item)">X</b-button>
              </template>
            </b-table>

            <div class="text-right block border p-2">
               <table width="100%" style="table table-bordered">
                   <tr>
                    <td>IGV</td>
                    <td><strong>{{PreVenta.ImporteIGV | moneyfiltro}}</strong></td>
                  </tr>
                  <tr>
                    <td>Sub Total</td>
                    <td><strong>{{PreVenta.ImporteTotal-PreVenta.ImporteIGV  | moneyfiltro}}</strong></td>
                  </tr>
                  <tr>
                    <td>Importe Total</td>
                    <td><strong>{{PreVenta.ImporteTotal | moneyfiltro}}</strong></td>
                  </tr>
              </table>
            </div>  
  </b-card>
      <div class="float-right">
        <br>
            <b-button v-show="PreVenta.DetallePreVenta.length>0" right type="button" style="margin-left:5px" variant="success"  class="p-2 px-4 btn-xs"  @click="SetPreVenta"  alt="Right" >Registrar</b-button>      
        </div>
   </div>
    </b-card>
       <!-- Nuevo de Cliente -->
    <cliente-nuevo @CerrarModal="CerrarModal" :DialogCliente="DialogCliente"></cliente-nuevo>
    <!-- Buscar Productos -->
     <articulo-modal  @Agrega-Tabla="AgregarDetalle" v-model="DialogProducto">  </articulo-modal>
    

  </div>


</template>


<script>

import axios from  'axios'
import AutoCompletado from '@/pages/Cliente/ClienteAutoComplete'
import ArticuloBuscar from '@/pages/Articulo/ArticuloBuscar' 
import ClienteNuevo from '@/pages/Cliente/ClienteNuevo';
import ArticuloModal from '@/pages/Articulo/ArticuloModal';  


// obtener fecha actual
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}
var today=formatDate(Date.now())
///
export default {
     components: {AutoCompletado,ArticuloBuscar,ClienteNuevo,ArticuloModal},
     data() {
      return {
        isLoading:true,
        // MODAL 
        DialogProducto:false,
        DialogCliente:false,
        DialigProducto:false,
        //
        editable :false,
        // Autocomplete
        ListaAutocomplete:[],
        
        NombreCliente:"",
        fieldsCliente: { value: 'idNombre' },
        //
        TipoDocumento:[],
        Establecimientos:[],
        Series:[],
        Agencia:[],
        Almacen:[],
        Vendedor:[],
        TipoVenta:[],
        TipoMoneda:[],
        DescIGV:"",
        Buscar1:"",
        cantidaFilas:0,
        FactorIGV :1,
        moneda:{
          idMoneda:'',
          compra:0,
          venta:0,
        },
          PreVenta: {
            idagencia:'', 
            Serie:'', 
            NumeroDocumento:'', 
            Direccion:"",
            FechaDocumento:today, 
            FechaVencimiento:"", 
            IdVendedor:'', 
            IdCliente:'', 
            NombreCliente:'', 
            RUC:'', 
            idAlmacen:'', 
            TipoCambio:0, 
            ImporteTotal:0, 
            ImporteIGV:0, 
            idTipoDocumento:'PV', 
            Estado:'V', 
            UsuarioCrea:'', 
            fechacrea:today, 
            igv:0, 
            IsFacturado:false,
            IdFormaVenta:'',
            IdMoneda : "MN",
            DetallePreVenta:[],
          
        },
        filasTabla:{
            IdArticulo:'',
            Descripcion: '', 
            Cantidad:1,       
            Unidad:'UND',            
            PrecioVenta:0,
            PrecioTotal:0,              
            contador:0,
          },
          // tabla detalle
           fields: [
                { key: 'IdArticulo', label: 'Id' },
                { key: 'Descripcion', label: 'Descripción' },
                { key: 'Unidad', label: 'Unidad' },
                { key: 'Cantidad', label: 'Cant.' },
                { key: 'PrecioUnitario', label: 'Precio Unitario' },
                { key: 'ImporteMN', label: 'Precio Total' },
                { key: 'estado', label: 'Acciones' },
           ],

      }
    },
    computed: {

    },
    watch: {

      NombreCliente: function () {
        if(this.NombreCliente){
          //var found = this.ListaAutocomplete.find(e => e.idNombre=this.NombreCliente);
            //console.log(this.NombreCliente)
            var id = this.NombreCliente.split("-")
            this.PreVenta.IdCliente = id[0]
            this.PreVenta.NombreCliente = id[1]
            var Cliente = this.ListaAutocomplete.filter(function(elem){
                if(elem.idCliente == id[0]) return elem;
            });
            this.PreVenta.ruc = Cliente[0].RUC
            this.PreVenta.Direccion = Cliente[0].direccion
        }else{
          this.PreVenta.IdCliente = ""
          this.PreVenta.NombreCliente = ""
          this.PreVenta.RUC = ""
          this.PreVenta.Direccion=""
        }
        
      }
    },
    created () {
    
     

    },
    mounted(){
       
    },
    methods: {
      CargarDatos(){
        var id = this.$route.params.id
        if(id){
         this.editable = true
         var val = id.split("-")
         var almacen = val[0]
         var IdTipoDocumento=val[1]
         var Serie=val[2]
         var NumeroDocumento=val[3]
          axios({
              method: 'post',
              url: 'PreVenta/GetDetalle',
              data: {
                IdAlmacen:almacen,
                idTipoDocumento:IdTipoDocumento,
                NumeroDocumento:NumeroDocumento,
                Serie:Serie,
              }
          })
          .then(response => {
                
                this.PreVenta.idagencia=response.data.idagencia
                this.PreVenta.Serie=response.data.serie
                this.PreVenta.NumeroDocumento=response.data.numeroDocumento
                this.PreVenta.Direccion=response.data.direccion
                this.PreVenta.IdVendedor=response.data.idVendedor
                 this.PreVenta.IdCliente=response.data.idCliente 
                 this.PreVenta.NombreCliente=response.data.nombreCliente
                this.PreVenta.RUC=response.data.ruc
                this.PreVenta.idAlmacen=response.data.idAlmacen
                this.PreVenta.IdMoneda=response.data.idMoneda
                this.PreVenta.TipoCambio=response.data.tipoCambio
                this.PreVenta.ImporteTotal=response.data.importeTotal
                this.PreVenta.ImporteIGV=response.data.importeIGV
                this.PreVenta.idTipoDocumento=response.data.idTipoDocumento, 
                this.PreVenta.Estado=response.data.estado
                this.PreVenta.UsuarioCrea=response.data.UsuarioCrea
           
                this.PreVenta.igv=response.data.igv
                this.PreVenta.IsFacturado=response.data.isFacturado
                this.PreVenta.IdFormaVenta=response.data.idFormaVenta
              // Cargar detalle
                response.data.detallePreVenta.forEach(elem => {
                this.PreVenta.DetallePreVenta.push({
                  IdArticulo:elem.idArticulo, 
                  Descripcion:elem.descripcion, 
                  Cantidad:elem.cantidad,
                  PrecioUnitario:elem.importeMN/elem.cantidad, 
                  ImporteMN:elem.importeMN, 
                  Unidad:elem.unidad,  
                })
              });
              // Fechas
                this.PreVenta.FechaDocumento=moment(response.data.fechaDocumento).format('YYYY-MM-DD')
                this.PreVenta.FechaVencimiento=moment(response.data.fechaVencimiento).format('YYYY-MM-DD')
                this.PreVenta.fechacrea=moment(response.data.fechacrea).format('YYYY-MM-DD')
              
          })
        }
      },
      ObtenerCliente(val){
        this.PreVenta.IdCliente=val.idCliente
        this.PreVenta.NombreCliente = val.nombre
        this.PreVenta.RUC = val.ruc
        this.PreVenta.Direccion = val.Direccion
      },
      limpiar(){
        console.log("123456")
      },
      CambiarTipoVenta(val){
        var valObj = this.TipoVenta.filter(function(elem){
            if(elem.idFormaVenta == val) return elem;
        });
        var date = new Date();
        date.setDate(date.getDate() + parseInt(valObj[0].diasVencidos))
        this.PreVenta.FechaVencimiento= formatDate(date)
        //console.log(val)
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
        GetFormaVenta(){
            axios({
                method: 'post',
                url: 'FormaVenta/GetLista',
                data: {}
            })
            .then(response => {
                this.TipoVenta = response.data
                if(this.TipoVenta.length>=1){
                    this.PreVenta.IdFormaVenta=this.TipoVenta[0].idFormaVenta
                }
                //console.log(response.data)
            })
        },
       GetCambio(){
            axios({
                method: 'post',
                url: 'CambioMoneda/GetCambioDia',
                data: {
                  fechaCambio2:today,
                }
            })
            .then(response => {
                this.moneda.compra = response.data.compra
                this.moneda.venta = response.data.venta
                this.moneda.idMoneda = response.data.idMoneda
                this.PreVenta.TipoCambio = response.data.compra
                //console.log(response.data)
            })
        },
       QuitarArticulo(item,data){
        if(this.editable){
          alert(data)
          /*
           axios({
                method: 'post',
                url: 'DetallePreVenta/DelDetalle',
                data: {
                    IdAlmacen=item.idAlmacen,
                    IdTipoDocumento=item.idTipoDocumento,
                    NumeroDocumento=item.NumeroDocumento,
                    IdArticulo=item.IdArticulo,
                    Serie=item.Serie,
                    Item=
                }
            })
            .then(response => {
                this.TipoVenta = response.data
                if(this.TipoVenta.length>=1){
                    this.PreVenta.IdFormaVenta=this.TipoVenta[0].idFormaVenta
                }
                //console.log(response.data)
           })
           */
        }
        this.PreVenta.DetallePreVenta.splice(item, 1);
        this.ReCalcular()
      },
       CerrarModal() {
            this.DialogCliente = false
            this.BuscarAutoCompletado()
            //$bvModal.hide('modal-cliente');
            //console.log("Cerro");
       },
       AgregarDetalle(datos){
         // this.$set(this.PreVenta, 'DetallePreVenta', datos)
          datos.item= this.PreVenta.DetallePreVenta.length+1
          //datos.Descripcion = ""+datos.item
          
          this.PreVenta.DetallePreVenta.push(
            {
                IdArticulo:datos.IdArticulo,
                Descripcion: datos.Descripcion,
                Cantidad: datos.Cantidad,
                PrecioUnitario: datos.PrecioUnitario,
                ImporteMN: datos.PrecioTotal,
                Unidad: datos.Unidad,
            })
          this.ReCalcular()
       },
       ReCalcular(){
          var suma=0
          this.PreVenta.DetallePreVenta.forEach(element => {
            element.ImporteMN=element.Cantidad* element.PrecioUnitario
            suma = suma + element.ImporteMN
          });
          this.PreVenta.ImporteTotal = suma
          this.PreVenta.ImporteIGV=suma*this.PreVenta.igv
       },
       TxtCliente(value){
         if(value.text.length>=3){
           this.BuscarAutoCompletado(value.text)
         }
         
         //console.log(value)
       },
         GetIGV(){
            axios({
                method: 'post',
                url: 'IGV/GetFactor',
                data: {}
            })
            .then(response => {
                this.PreVenta.igv = response.data.factor
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
                //console.log(response.data)
                if(this.Series.length==1){
                    this.PreVenta.Serie=this.Series[0].serie
                }
            })
       },
       GetVendedores(){
            axios({
                method: 'post',
                url: 'Vendedor/GetLista',
                data: {}
            })
            .then(response => {
                this.Vendedor = response.data;
               //console.log(response.data)
                if(this.Almacen.length==1){
                    this.PreVenta.IdVendedor=this.Vendedor[0].idVendedor
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
                    this.PreVenta.idAlmacen=this.Almacen[0].idAlmacen
                }
            })
       },
       
      GetTipoDocumento(){
            axios({
                method: 'post',
                url: 'TipoDocumento/GetTipoPreventa',
                data: {}
            })
            .then(response => {
                this.TipoDocumento = response.data
                //console.log(response.data)
            })
      },
      GetAgencia(){
            axios({
                method: 'post',
                url: 'Agencia/GetLista',
                data: {}
            })
            .then(response => {
                this.Agencia = response.data
                
                if(this.Agencia.length==1){
                    this.PreVenta.idagencia=this.Agencia[0].idAgencia
                }
                //console.log(response.data)
            })
      },
      search(input) {
        if (input.length < 1) { return [] }
         
      },
      BuscarAutoCompletado(input){
        
            axios({
                  method: 'post',
                  url: 'Cliente/GetAutoComplete',
                  data: {
                      Buscar1:input,
                  }
              })
              .then(response => {
                  this.ListaAutocomplete = response.data
                
              }).catch(function (error) {
                  console.log(error); 
              });
           
          //}
      },
      SetPreVenta(){
        //if(this.Validar()){
               axios({
                  method: 'post',
                  url: 'PreVenta/SetPreventa',
                  data: this.PreVenta,
              })
              .then(response => {
                this.makeToast("warning",response.data.estado)
                 //console(response.data)
                
              });
        //}
      },
      Validar(){
        var Estado = true
        if(this.PreVenta.idAlmacen){
          Estado = false

        }
        return Estado
      },
      
      makeToast(variant = null,titulo) {
            this.$bvToast.toast('Pre-Venta Registrado', {
              title: titulo,
              variant: variant,
              solid: true
          })
        }
    }
  }

 
</script>

<style scoped>
  ::v-deep .myDiv {
    background-color: 	#FFFFFF;
  }
</style>