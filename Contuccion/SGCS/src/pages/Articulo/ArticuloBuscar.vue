<template>
    <div class="form-row" >
            <b-form-group class="col-md-6 " label="Articulos" >
                <b-input-group class="d-block">
                  <auto-completado @Seleccionar='ActualizarListaPrecios' @Limpiar="limpiar" ></auto-completado>
                </b-input-group>
            </b-form-group>
            <b-form-group class=" col-md-3" label="Tipo Precio">
                  <b-form-select 
                    @change="ActualzaPrecio" 
                    v-model="TipoPrecio" 
                    :options="ListaPrecios" 
                    value-field="importe" text-field="descripcion">
                  </b-form-select>
            </b-form-group>  
                <b-form-group class=" col-md-3 " label="Precio">
                <b-input-group prepend="S/." >
                    <b-form-input   
                    id="input-18"   
                    v-model="preciove"
                    type="number"         
                    required   >
                </b-form-input>
              </b-input-group>
            </b-form-group>  

            <b-form-group class="mr-2 col-md-2" label="Cantidad">
              <b-input-group :prepend="unidad"  >
                    <b-form-input   
                    id="input-17"   
                    v-model.number="cantidad"
                    min="1"
                    type="number"
                    required   >
                </b-form-input>
              </b-input-group>
            </b-form-group> 
              <b-form-group  class="col-md-2" label="Agregar Artículo">         
                <b-button type="button" :disabled="BotonEstado"  variant="primary"  class="p-2 btn-block btn-xs"   @click="EnviarTable" >Agregar</b-button> 
            </b-form-group  >
        

      </div>

</template>

<script>
import axios from  'axios'
//import Vue from 'vue'
import AutoCompletado from '@/pages/Articulo/AutoCompletado'



export default {
    components: {AutoCompletado},
    name:'modal-producto',   
    props: { item:    { default: null },
             visible: { type: Boolean,default:false }    
        },
    model: {
        prop: "visible",
        event: "change"
    },
    data(){
        return{
         detailsVisible1: false,
         ActivarCombo: false,
         preciove:0,
         unidad:"UND",
         idarticulo:'',
         descripcion:'',
         TipoPrecio:'',
         cantidad:1,
         ListaArticulos:{},  
         dataitem: [],
         ListaPrecios:[],
         datos:{
            IdArticulo:'',
            item:0,
            Descripcion: '', 
            Unidad:'', 
            Cantidad:1,       
            PrecioTotal:0, 
            PrecioUnitario:0,  
            estado:0           
          },
        }
    },
    computed: {
      BotonEstado(){
        if(!this.preciove){
          return true
        }
        return false
      }
    },
     created () {
         this.listarProductos();

    },
    methods:{
      ActualzaPrecio(value){
          //console.log(value)
          this.preciove = value
      },
      ActualizarListaPrecios(value)
      {
          var me = this
          this.ListaArticulos=value
          axios.post('Articulo/GetPreciosId', {IdArticulo:value.idArticulo})
               .then(function(response){
                  me.ListaPrecios=(response.data)
                  let valor=Math.max(
                      ...response.data.map(h => parseFloat(h.importe))
                  );
                  //console.log(valor)
                  me.preciove=0
                  me.TipoPrecio=valor
                  me.ActualzaPrecio(valor)
          });
         
      },
      EnviarTable(){        
        this.datos.Cantidad=this.cantidad;
        this.datos.PrecioUnitario=parseFloat(this.preciove);
        this.datos.PrecioTotal = parseFloat(this.preciove)*parseFloat(this.cantidad);
        let valor= this.idarticulo;
        this.datos.Descripcion = this.ListaArticulos.descripcion1;
        this.datos.IdArticulo = this.ListaArticulos.idArticulo;
        this.datos.Unidad=this.ListaArticulos.unidad;
        this.$emit('AgregarArticulo',  this.datos);
       },
      limpiar(){
        this.preciove=0;
        this.descripcion='';
        this.cantidad=0;
        this.preciove = ''
      },
      listarProductos(){
          let me=this;
          
          axios.post('Articulo/GetAutoCompletado', {Buscar1: "", Buscar2:""})
            .then(function(response){
                //console.log(response)
                me.dataitem=response.data
          }).catch(function(error){
              console(error);
          });
      },

    }
    

}

</script>

<style scoped>
.btn .glyphicon {
    top: 0px;
}
#txtIdArticulo{
   font-size: 12px !important;
}
.v-input{
  font-size: 12px !important;
  border-radius: 2px !important; 
}
.v-input__slot {
  box-shadow: none !important;
}
.v-select__slot{
   font-size: 12px !important;
}
</style>
