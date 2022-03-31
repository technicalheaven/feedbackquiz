<template>
 <div class="container">
    <div class="login shadow w-50 mx-auto text-left">
    <h3 class="my-4">Feedback Quiz Login</h3>
    <div class="error" v-if='error.length' v-show='iserrorAlert'>
    <div class="alert alert-danger" role="alert">
  <button v-on:click="iserrorAlert=false" type="button" class="close w-auto" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    <ul>
    <li v-for="(e,index) in error" :key="index">{{e}}</li>
    </ul>
    </div>
    </div>
   <form @submit="loginData">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" v-model="formdata.email" placeholder="Enter email" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" v-model="formdata.password" placeholder="Enter password" id="pwd">
  </div>
  <div class="action_btns">
  <button type="submit" class="btn btn-primary mr-5"><i class="fa fa-lock"></i> Login</button>
  <router-link to="/"><button class="btn btn-success"><i class="fa fa-home"></i> Home</button></router-link>
  </div>
</form>
 </div>
 </div>
</template>

<script>
import axios from "axios";
export default {
  name: 'LoginPage',
  data(){
   return {
     formdata: {
      email:null,
      password:null,
    },
    error:[],
    iserrorAlert: false,
    
    }
  },
  beforeMount(){
    if(localStorage.getItem('USER_ID') != undefined){
      this.$router.push({ name: 'quiz' })
    }
  },
  methods:{
    async loginData(e){
      e.preventDefault();
      this.error = [];
      this.iserrorAlert = true;
      if(!this.formdata.email){
        this.error.push('Email is required!');
      }
      if(!this.formdata.password){
        this.error.push('Password is required!');
      }
      if(this.formdata.email && this.formdata.password){
      try {
      let res = await axios.post(`${process.env.VUE_APP_BASE_URL}api/login`,this.formdata);
      res = res.data; 
      if(res.success){
      localStorage.setItem('LOGIN_DATA',JSON.stringify(res.user));
      localStorage.setItem('TOKEN',res.token);
      localStorage.setItem('USER_ID',res.user.id);
      this.$router.push({ name: 'quiz' })
      }else{
         this.error.push('Incorrect Credentials!');
      }
      
    } catch (error) {
      this.error.push('Something went wrong!');
    }
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  padding: 0;
}

a {
  color: #42b983;
}
label{
  font-weight: bold;
}
.container{
    display: flex;
    align-items: center;
    height: 600px;
}

.shadow{
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}
.login{
  padding: 40px;
  border-radius: 5px;
}
.action_btns button{
    width: 200px;
    margin: 10px 0;
}
.error li{
  font-size: 16px;
  margin: 0;
}
</style>
