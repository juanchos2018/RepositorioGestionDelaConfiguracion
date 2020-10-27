<template>
    <div>
   <div class="form-row">
          <b-form-group    class="col-md-6">
               <label class="control-label font-weight-bold text-info">Descripcion </label> 
               <b-form-textarea
                  id="textarea"
                  v-model="descripcion"
                  placeholder="Enter something..."
                  rows="3"
                  max-rows="6"
                ></b-form-textarea>
            </b-form-group>                       
          
   </div>

   <div class="form-row" >
     
          <b-form-group  class="col-md-6">
              <label class="control-label font-weight-bold text-info">Imagen </label> <br>
              <input type="file" id="files" ref="files" multiple v-on:change="handleFileUploads"/>
                      <div id="preview">
                        <img v-if="url" :src="url"  width="200"/>
                      </div>  
          </b-form-group>

              <b-overlay :show="show"  no-wrap>      
             </b-overlay>

  
   </div> 
    <b-button variant="primary" :disabled="show"   @click="upload">Subir</b-button>     
 
    </div>
</template>

<script>

import axios from  'axios';
export default {
    data()
    {
        return{
              
               descripcion:'',
               IdEmpresa:'Abcd123456',
               NombreEmpresa:'EmpresaTaxi',
               img_empresa:'https://firebasestorage.googleapis.com/v0/b/fir-app-cf755.appspot.com/o/NuevoProducto%2Fimgjuancho.jpg?alt=media&token=b48c6e91-3f3e-4f13-81cc-87d1e6e1908a',
               files: [],
               url: null,
               show: false
        }
    },
    created()
    {

    },
    methods:{
          onFileChange(e) {
              const file = e.target.files[0];
              this.url = URL.createObjectURL(file);
            },
            handleFileUploads(e){
                 this.files = this.$refs.files.files;

                const file = e.target.files[0];
                 this.url = URL.createObjectURL(file);
            },
            
            upload(){
                    this.show = true;
                    let data = new FormData();                
                    for( var i = 0; i < this.files.length; i++ ){
                            let file = this.files[i];
                            data.append('files[' + i + ']', file);
                    }
                    data.append('nombre_usuario', this.NombreEmpresa)
                    data.append('descripcion_noticia',this.descripcion)
                    data.append('image_empresa',this.img_empresa)
                    let config = {
                      header : {
                      'Content-Type' : 'multipart/form-data'
                      }
                    }
                    axios.post('Publicar/SubirPublicacion', data, config).then(response => {
                         console.log(response);
                         this.show = false;
                    }) .catch(function(error){
                        console.log(error)
                         this.show = false;
                        console.log('Error!');
                     });
                },
         SubirArchivos(){              
       
            let formData = new FormData();

            for( var i = 0; i < this.files.length; i++ ){
            let file = this.files[i];
            formData.append('files[' + i + ']', file);
            }
          //  formData.append('descripcion_noticia', this.Noticias.descripcion_noticia);

            axios.post( 'Usuario/SubirArchivos',this.Noticias,
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            ).then(function(response){
            console.log('Correcto!');
            console.log(response);
            })
            .catch(function(error){
                console.log(error)
            console.log('Error!');
            });
        }
           
    }
}
</script>
