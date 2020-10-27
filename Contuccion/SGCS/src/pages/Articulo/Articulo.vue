<template>
    <div>

        <div>  
           <b-card class="mt-3" header=" Listado de Articulos"  
           
            header-text-variant="white"
            header-tag="header"
            header-bg-variant="primary" >
            

             <div  class="form-row">
                 
                 <b-form-group  id="input-group-3" label="Filtrar " label-for="input-1" class="col-md-4">
                <b-form-input
                id="input-1"               
                required
                 v-model="Buscar1"
                 class="p-2 px-4 btn-xs" 
                ></b-form-input>
                
                
            </b-form-group>
            
             <b-form-group  id="input-group-3" label="Filtrar " label-for="input-1" class="col-md-4">
                <b-form-input
                id="input-2"               
                required
                 v-model="Buscar2"
                 class="p-2 px-4 btn-xs" 
                ></b-form-input>
                
            </b-form-group>

            <b-form-group id="input-group-3" label="Filtrar " label-for="input-1" class="col-md-4">
                 <b-button   type="button" variant="primary"  @click="BuscarProducto" class="p-2 px-4 btn-xs" > Buscar</b-button>
                
            </b-form-group>
            </div>
                       
            <b-table 
            
            id="my-table"
            :items="ListaArticulos"         
            :per-page="TamanoPagina"            
            smal 
            :filter="filter">                               
               
            </b-table>
             <div>
    
            <b-pagination
                v-model="NumerosPaginas"
                :total-rows="TotalPaginas"
                :per-page="TamanoPagina"
                first-number
                v-on:input="cambiarPagina"
            ></b-pagination>
            </div>
             </b-card> 
        </div>
      <div>

</div>

   

    
 </div>
</template>
<script>

import axios from  'axios'

    export default{

        data(){
            
            return{

                NumerosPaginas:1,
                TotalPaginas:0,
                TamanoPagina:0,
                Buscar1:'',
                Buscar2:'',
                ListaArticulos:[],    
                search:'',   
                dialog: false,
                encabezado: ['Codigo', 'Descripcion', 'Unidad','Precio'],
                headers: [
                { text: 'Codigo', value: 'idArticulo1', sortable: false } ,             
                { text: 'Descripcion', value: 'descripcion1' },
                { text: 'Unidad', value: 'unidad' ,sortable:false},
                { text: 'Precio', value: 'precio' ,sortable:false},
              
                ],
        
                   editedIndex: -1, 
                    id:'',
                    nombre:'',
                    descripcion:'',
                    valida:0,
                    validamensaje:[],
                    adModal:false,
                    adAccion:0,
                    adNombre:'',
                    adId:'',
                    nameState: null,
                    show:null,
                    filter: null
                

            }
        },

        computed: {
            formTitle () {
            return this.editedIndex === -1 ? 'Nueva Categoria' : 'Actualizar Categoria'
            },
        },

        watch: {
            dialog (val) {
            val || this.close()
            },
        },

        created () {
         
            this.listar();

        },

        methods:{
            
        BuscarProducto(){

             let me=this;             
             axios.post('Articulo/GetLista', {Buscar1: me.Buscar1, Buscar2: me.Buscar2,Pagina:1,TPagina:50}).then(function(response){
             me.ListaArticulos=response.data.data;
             me.TotalPaginas=response.data.totalRegistros;
             me.TamanoPagina=response.data.tamanoPagina;
             me.NumerosPaginas=response.data.numeroPaginas;  


         }).catch(function(error){
             console.log(error);
         });         
         
        },

        listar(){

            let me=this;
             axios.post('Articulo/GetLista', {Buscar1: "", Buscar2:"",Pagina:1,TPagina:50}).then(function(response){
            me.ListaArticulos=response.data.data;
            me.TotalPaginas=response.data.totalRegistros;
             me.TamanoPagina=response.data.tamanoPagina;
             me.NumerosPaginas=response.data.numeroPaginas; 
             
             console.log(response);


         }).catch(function(error){
             console.log(error);
         });

        },
         cambiarPagina(){
          
          let me=this; 
               
            axios.post('Articulo/GetLista', {Buscar1: "", Buscar2:"",Pagina:me.NumerosPaginas,TPagina:50}).then(function(response){
             me.ListaArticulos=response.data.data;
             me.TotalPaginas=response.data.totalRegistros;
             me.TamanoPagina=response.data.tamanoPagina;                      

         }).catch(function(error){
             console.log(error);
         }); 

        },

        guardar(bvModalEvt){

             bvModalEvt.preventDefault()    
             this.handleSubmit()           
        }
        ,
         resetModal() {
        this.name = ''
        this.nameState = null
      },
      
        handleSubmit(){
            let me =this;
            axios.post('api/Categorias/Crear',{

                'nombre':me.nombre,
                'descripcion':me.descripcion

            }).then(function(response){

               console.log(response);
                 me.limpiar();

            }).catch(function(error){
                console.log(error);
            });
        }
        ,

        Activar(){

                let me =this;
                axios.put('api/Categorias/Activar/'+this.adId,{                    

                }).then(function(response){

                    me.adModal=false;
                    me.accion=0;
                    me.nombre="";
                    me.adId="";
                    me.listar();
                }).catch(function(error){
                    console.log(error);
                });
        },
         activarDesactivarMostrar(accion,item){

                this.adModal=true;
                this.adNombre=item.nombre;
                this.adId=item.idcategoria;

                if(accion==1){
                    this.adAccion=1;
                }
                else if(accion==2){
                   this.adAccion=2;
                }else{
                     this.adModal=false;
                }
        },
         Desactivar(){

             let me =this;
            axios.put('api/Categorias/Desactivar/'+this.adId,{                

            }).then(function(response){
                me.adModal=false;
                me.accion=0;
                me.nombre="";
                me.adId="";
                me.listar();
            }).catch(function(error){
                console.log(error);
            });
        },
        activarDesactivarCerrar(){
            this.adModal=false;

        }
       

    }

}
</script>

