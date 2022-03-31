<template>
<div class="container mx-auto">
    <div class="register shadow">
    <h3>Register</h3>
    <form @submit="register">
        <div class="form-group">
            <label for="nameInp">Name:</label>
            <input id="nameInp" v-model="formdata.name" class="form-control" type="text" placeholder="Enter name"/>
            <span class="text-danger" v-if="error.name">{{error.name}}</span>
        </div>  
        <div class="form-group">
            <label for="emailInp">Email:</label>
            <input id="emailInp" v-model="formdata.email" class="form-control" type="text" placeholder="Enter Email"/>
            <span class="text-danger" v-if="error.email">{{error.email}}</span>
        </div> 
        <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" v-model="formdata.password" class="form-control" placeholder="Enter password" id="pwd">
        <span class="text-danger" v-if="error.password">{{error.password}}</span>
       </div>
        <div class="form-group">
       <label for="cpwd">Confirm Password:</label>
       <input type="password" v-model="confirmpassword" class="form-control"  placeholder="Enter confirm password" id="cpwd">
        <span class="text-danger" v-if="error.confirmpassword">{{error.confirmpassword}}</span>
      </div>
         <button type="submit" class="btn btn-success mr-5"><i class="fa fa-book"></i> Submit</button>
           <router-link to="/"><button class="btn btn-info"><i class="fa fa-home"></i> Home</button></router-link>

    </form>
    </div>
</div>
</template>

<script>
import axios from "axios";
export default {
    name:"RegisterPage",
    data(){
       return{
        formdata:{
            name:null,
            email:null,
            password:null
        },
        confirmpassword:null,
        error:{
            name:null,
            email:null,
            password:null,
            confirmpassword:null,
        },
        iserrorAlert:false,
       } 
    },
    methods:{
        register(e){
            this.error = [];
            e.preventDefault();
            if(!this.formdata.name){
                this.error.name = 'Name is required!';
            }
            if(!this.formdata.email){
                this.error.email = 'Email is required!';
            }
            if(!this.formdata.password){
                this.error.password = 'Password is required!';
            }
            if(!this.confirmpassword){
                this.error.confirmpassword = 'Confirm Password is required!';
            }
            else if(this.formdata.password !== this.confirmpassword){
                this.error.confirmpassword = 'Password & Confirm Password not match!';
            }
            else{
              try {
                const token = localStorage.getItem('TOKEN');
                if(token != undefined){
                    axios.defaults.headers.common = {'Authorization': `Bearer ${token}`}
                }
                axios.post(`${process.env.VUE_APP_BASE_URL}api/register`,this.formdata)
                .then((res)=>res.data)
                .then((data)=>{
                if(data.status){
                    alert('Restration Sucessful!');
                    this.$router.push({name:'login'});
                }else{
                    if(data.error.email){
                        this.error.email = data.error.email;
                    }
                    if(data.error.name){
                        this.error.name = data.error.name;
                    }
                }
                });
             } catch (error) {
                console.log(error);
                }
            }
        }
    }
}
</script>
<style>
.register{
    text-align:left;
    max-width: 600px;
    margin: 40px auto;
    padding: 40px;
}

.shadow{
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}
.error li{
  font-size: 0.8rem;
  margin: 0;
  list-style: initial;
}
button.close{
    margin:0;
    padding:0;
}
</style>