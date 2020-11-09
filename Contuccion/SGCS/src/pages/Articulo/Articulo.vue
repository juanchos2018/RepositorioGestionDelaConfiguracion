<template>
    <div>
     
  <div class="col-12 col-md-6 col-lg-3">
							<div class="card">

								<div class="card-header px-4 pt-4">
									<div class="card-actions float-right">
										<div class="dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
											</a>
                      

<!--
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Action</a>
												<a class="dropdown-item" href="#">Another action</a>
												<a class="dropdown-item" href="#">Something else here</a>
											</div>-->
										</div>
									</div>
									<h5 class="card-title mb-0">Landing page redesign</h5>
									<div class="badge bg-success my-2">Finished</div>
								</div>
								<div class="card-body px-4 pt-2">
									<p>Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque
										sed ipsum.</p>

									<img src="img/avatars/avatar-3.jpg" class="rounded-circle mr-1" alt="Avatar" width="28" height="28">
									<img src="img/avatars/avatar-2.jpg" class="rounded-circle mr-1" alt="Avatar" width="28" height="28">
									<img src="img/avatars/avatar.jpg" class="rounded-circle mr-1" alt="Avatar" width="28" height="28">
								</div>
								<ul class="list-group list-group-flush">
									<li class="list-group-item px-4 pb-4">
										<p class="mb-2 font-weight-bold">Progress <span class="float-right">100%</span></p>
										<div class="progress progress-sm">
											<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
											</div>
										</div>
									</li>
								</ul>
							</div>
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

