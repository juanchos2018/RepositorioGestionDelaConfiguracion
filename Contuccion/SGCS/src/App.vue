<template>

  <router-view />
</template>

<script>

import firebase from '@/firebase'
export default {
  name: 'App',
  created() {
    /*
    const currentPath = this.$router.history.current.path;
    if (window.localStorage.getItem('authenticated') === 'false') {
      this.$router.push('/login').catch(err => {    
            if (   err.name !== 'NavigationDuplicated' &&  !err.message.includes('Avoided redundant navigation to current location')) {             
                  console(err);
               }
             });
         }
    if (currentPath === '/' || currentPath === '/app') {
      this.$router.push('/app/inicio');
    }*/
  },
   beforeCreate: function () {
    if (!this.$session.exists()) {
        window.localStorage.setItem('authenticated', false);
        this.$router.push('/login');     
      }
  },
  methods:{
    //   firebase.auth().onAuthStateChanged(user =>  {
    //  if (user) { 
     //   console.log(user.displayName)       
     // } else {   
  //       console.log("no logueado")
  //    }
    // })
  }
};
</script>

<style src="./styles/theme.scss" lang="scss" />
