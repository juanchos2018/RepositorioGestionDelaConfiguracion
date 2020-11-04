<template>
    <div>
        <div class="form-row">
          <b-form-group    class="col-md-6">
               <label class="control-label font-weight-bold text-info">Nombre Proyecto</label> 
               <div class="el-select border-left rounded-left border-info el-select">               
             <b-form-input
                id="input-30" 
                require
                class="p-2 px-4 btn-xs"
                v-model="nombre_proyecto"  >
                </b-form-input>                  
             </div>
            </b-form-group>
             <b-form-group  label="Decripcion:"  class="col-md-6">
               <b-form-input
                id="input-30" 
                require
                class="p-2 px-4 btn-xs"
                v-model="descripcion"  >
                </b-form-input>               
            </b-form-group>
    </div>
     <div class="form-row">       
        <b-form-group  label="Fecha Inicio"   class="col-md-6">
        <b-form-input
          id="input-7"
          type="date"
          class="p-2 px-4 btn-xs" 
          required          
         v-model="fecha_inicio" ></b-form-input>
      </b-form-group>
        <b-form-group  label="Fecha Fin"   class="col-md-6">
        <b-form-input
          id="input-7"
          type="date"
          class="p-2 px-4 btn-xs" 
          required          
        v-model="fecha_fin"></b-form-input>
      </b-form-group>
    </div>
     <h5>Datos de la Metodologia</h5><br>
   <div class="form-row">    
      
        <b-form-group    class="col-md-6">
               <label class="control-label font-weight-bold text-info">Metodologia</label> 
               <div class="el-select border-left rounded-left border-info el-select">               
                <b-form-select
                id="input-1"
                name="input-1"  
                class="p-2 px-4 btn-xs ui dropdown"  
               >
                 </b-form-select>                  
                 </div>
         </b-form-group>


    </div>

  <div class="form-row">  
        <b-form-group  class="col-md-12">
         <b-card no-body>
            <b-tabs content-class="mt-6" active-nav-item-class="font-weight-bold text-uppercase text-success">
                <b-tab title="Inicio" active><p>I'm the first tab</p></b-tab>
                <b-tab title="Elaboracion"><p>I'm the second tab</p></b-tab>
                <b-tab title="Construcion" ><p>I'm a disabled tab!</p></b-tab>
                <b-tab title="Transicion" ><p>I'm a disabled tab!</p></b-tab>
            </b-tabs>
         </b-card>
       </b-form-group>
    </div> 
     <b-button type="button"  @click="Guardar" variant="primary"  class="p-2 px-4 btn-xs">
             REgistrar
      </b-button>

    </div>
</template>
<script>

import firebase from '@/firebase'
export default {
    
    data(){
        return{
           nombre_proyecto:'',
           descripcion:'',
           fecha_inicio:'',
           fecha_fin:'',
           metodologia:'' 
        }
    },
    created(){

    },
    methods:{
            Guardar(){         
              let newData = firebase.database().ref('Proyectos/').push();
              newData.set({                 
                  nombre_proyecto: this.nombre_proyecto,
                  descripcion: this.descripcion,
                  fecha_inicio:this.fecha_inicio,
                  fecha_fin: this.fecha_fin,
                  metodologia:'Rup'
                
                  //key:key
              });
            
          },
    }
}
</script>