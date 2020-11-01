<template>
    
    <div>
        <p>subir</p>

        <input type="file" @change="previwImage" accept="image/*">
        <br>
        <p>progre:s {{uploadValue.toFixed()+"%"}}

            <progress :value="uploadValue" max="100"></progress>
        </p>
        <br>
        <img class="preview"  alt="" :src="picture">

        <br>
        <button @click="onUpload">subir</button>
    </div>
</template>

<script>
//para subir al storage
import firebase from 'firebase';
export default {
    name:'subir',
    data(){
        return{
            imageData:null,
            picture:null,
            uploadValue:0
        }
    },
    methods:{

        previwImage(evenet){
            this.uploadValue=0;
            this.picture=null;
            this.imageData=evenet.target.files[0];
        },
        onUpload(){
            this.picture=null;
            const storageRef=firebase.storage().ref(`${this.imageData.name}`).put(this.imageData);
            storageRef.on('state_changed',snapshot=>{
                this.uploadValue=(snapshot.bytesTransferred/snapshot.totalBytes)*100;

            },error=>{
                console.log(error.message)},
            ()=>{this.uploadValue=100;
             storageRef.snapshot.ref.getDownloadURL().then((url)=>{
            this.picture=url;
            console.log(url)
            })
            }
           );
        }
    }
    
}
</script>