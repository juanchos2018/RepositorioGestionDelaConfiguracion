<template>
    <div class="d-block">
        <b-form-group>
                <div class="input-group autocomplete d-block">
                    <div  class="el-select rounded-left border-info el-select--small" >
                         <div class="input-group">
                            <input type="search" 
                            id="NombreCliente" 
                            name="NombreCliente" 
                            autocomplete="off" 
                            class ="form-control"
                            v-model="TextoBuscar"
                            spellcheck="false"
                            @keydown="MoverLista"
                            @focus="Mostrar=true"
                            >  
                            <div v-if="Mostrar" class="autocomplete-items zindex-99">
                                <div v-for="item in ListaFiltrada" 
                                v-bind:key="item.idArticulo"
                                @click="Seleccionar(item.idArticulo)" 
                                >
                                <span v-html="item.Texto"></span>
                                </div>
                            </div>
                            <button @click="Borrar" class="btn bg-transparent" style="margin-left: -40px; z-index: 100;">
                            <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>              
                </div>
        </b-form-group>
     
    </div>
</template>


<script>
import axios from  'axios'
//import dataItem from './AutoComplete/Auticompleteitem' 
export default {
  //  components:["dataItem"],
    data(){
        return{
            ListaAutocomplete:[],
            ListaFiltrada:[],
            TextoBuscar:'',
            Mostrar:false,
        }
    },

    created(){
            this.ListaAutocomplete=[]
            this.ListaFiltrada=[]
            this.TextoBuscar=''
            this.Mostrar=false
    },
   
    mounted(){
        this.BuscarAutoCompletado("");  
    },

    methods:{
        Seleccionar(id){
            this.Mostrar=false
            var ArticuloSelecionado = this.ListaAutocomplete.filter(function(elem){
                if(elem.idArticulo == id) return elem;
            });
            this.TextoBuscar = ArticuloSelecionado[0].descripcion1
            this.$emit('Seleccionar',ArticuloSelecionado[0])
           // console.log(ArticuloSelecionado[0].idArticulo)
        },
        FiltrarLista(val){
            this.ListaFiltrada=[]
              for (var i = 0; i < this.ListaAutocomplete.length; i++) {
                // busqueda     
                var posicion = String(this.ListaAutocomplete[i].Texto.toUpperCase()).indexOf(val.toUpperCase())
                if(posicion>=0){
                
                   let TextoCoincidencia = this.ListaAutocomplete[i].Texto.substr(posicion, val.length)
                   let TextoMarcado =  this.ListaAutocomplete[i].Texto
                   let TextoFiltro = TextoMarcado.replace(TextoCoincidencia,'<strong>'+TextoCoincidencia+'</strong>')
                   //b.innerHTML += "<input type='hidden' value='" + arr[i].Texto + "'>";
                   this.ListaFiltrada.push({
                        Texto:TextoFiltro,
                        idArticulo :this.ListaAutocomplete[i].idArticulo ,
                        unidad:this.ListaAutocomplete[i].unidad,
                   });
                }else{
                    //this.ListaAutocomplete.splice(i, 1);
                }
            }
        },
        MoverLista(val){
            //console.log(val.code)
            var Buscar =this.TextoBuscar+val.key
            this.FiltrarLista(Buscar)
            /*
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (val.keyCode == 40) {
                currentFocus++;
                addActive(x);
            } else if (val.keyCode == 38) {
                currentFocus--;
                addActive(x);
            } else if (val.keyCode == 13) {
                e.preventDefault();
                if (currentFocus > -1) {
                    if (x) x[currentFocus].click();
                }
            }
            */
            
        },
        BuscarAutoCompletado(input){          
        
            axios({
                  method: 'post',
                  url: 'Articulo/GetAutoCompletado',
                  data: {
                      Buscar1:input,
                  }
              })
              .then(response => {
                   for (var i = 0; i <response.data.length; i++) {                    
                        this.ListaAutocomplete.push(
                            {
                                Texto:response.data[i].idArticulo+"-"+response.data[i].descripcion1,
                                idArticulo : response.data[i].idArticulo,
                                unidad:response.data[i].unidad,
                                descripcion1:response.data[i].descripcion1,
                            }
                        );             
                    }              
                 
              }).catch(function (error) {
                  console.log(error); 
              });
              
      },
     Borrar() {
       this.TextoBuscar=""
       this.$emit("Limpiar")
     },
    }
    
}
</script>


<style>
    .autocomplete {
        /*the container must be positioned relative:*/
        position: relative;
        display: inline-block;
    }
    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }
     .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

            .autocomplete-items div:hover {
                /*when hovering an item:*/
                background-color: #e9e9e9;
            }

    .autocomplete-active {
        /*when navigating through the items using the arrow keys:*/
        background-color: DodgerBlue !important;
        color: #ffffff;
    }
    .zindex-99{
        z-index: 99;
    }
    .zindex-100{
        z-index: 100;
    }


</style>