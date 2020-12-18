<template>
    <div>
      <div>
        <b-card>
                  
              <div class="form-row">

                 <b-form-group    class="col-md-8">
                    <h5>Nombre Proyecto  :</h5>
                    <a-select      style="width: 100%"  v-model="idproyecto" >              
                    <a-select-option v-for="d in items" :key="d.value">
                            {{ d.text }}
                    </a-select-option>
                    </a-select>  
                 </b-form-group> 
                       <b-form-group    class="col-md-4">
                    <h5>Fecha  :</h5>
                    <b-form-input                       
                        type="date"
                        class="p-2 px-4 btn-xs" 
                        required         
                     >
                        </b-form-input>
                 </b-form-group> 
            </div>  
                 
        </b-card>
    <br>
    <br>
          <b-card>
          
                 <b-card-title>Datos Solicitud de Cambio</b-card-title>
                   <div class="form-row">    
                   <b-form-group    class="col-md-12">
                    <label class="control-label font-weight-bold text-info">Objetivo</label> 
                    <div class="el-select border-left rounded-left border-info el-select">               
                    <b-form-input
                        id="input-30" 
                        require
                        class="p-2 px-4 btn-xs"
                        >
                        </b-form-input>                  
                    </div>
                    </b-form-group>
                   </div>
                  <div class="form-row">       
                    <b-form-group  label="Descripcion"   class="col-md-12">
                    <b-form-textarea                                      
                                           
                        rows="3"
                        ></b-form-textarea>
                    </b-form-group>
                  </div>
            
                  <b-button type="button" variant="primary"  @click="Lista" class="p-2 px-4 btn-xs">
                            Crear Solicitud
                  </b-button>
           
          </b-card>
     </div>
    </div>
</template>

<script>
import axios from  'axios';
export default {
    
    data(){
        return{
            items:[],
            idproyecto:'',
        }
    },
    created () {
          this.ListarProyecto();  
    },
    methods: {
          ListarProyecto(){
            let me=this;           
            var previa=[];
            axios.get('Backphp/ProcesoProyecto.php/').then(response => {                    
                      previa = response.data;                      
                      previa.map(function(x){
                           me.items.push({text: x.nombre_proyecto,value:x.id_proyecto});
                       }); 
                  }).catch(function (error) {
                      console.log(error);
                  }) .finally(() => {
                     
            })
        },
        Lista(){
              this.$router.push('/app/solicitudlista');
        }
    }
}
</script>