<template>
  <header>
 <nav v-if="isloggedIn">
    <router-link to="/">Home</router-link>
 </nav>
 <div v-if="isloggedIn">
  <span class="user text-capitalize">Hi, {{user}}</span>
  <button class="btn btn-danger logoutbtn" @click="logout">Logout</button>
 </div>
 </header>
</template>

<script>

export default {
  name: 'HeaderComponent',
  data(){
    return {
      user: null,
      isloggedIn:null,
    }
  },
  mounted(){
    const userData = localStorage.getItem('LOGIN_DATA') != undefined 
? JSON.parse(localStorage.getItem('LOGIN_DATA')):null;
this.user = userData != null ? userData.name : "";
    if(
       localStorage.getItem('TOKEN') == undefined
      || localStorage.getItem('LOGIN_DATA') == undefined){
        this.isloggedIn = false
      }else{
        this.isloggedIn = true
      } 
  },
 methods:{
    logout(){
      if(confirm('Are you sure')){
      localStorage.clear();
      this.isloggedIn = false
      this.$router.push({ name: 'login' });
      }
    }
  }
  }
</script>
<style>
header{
    display: flex;
    justify-content: space-between;
    padding: 0 40px;
}
.logoutbtn{
    width: 120px;
    margin: 10px;
}
</style>