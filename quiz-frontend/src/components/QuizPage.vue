<template>
<Header/>
<div class="container quiz">
<div class="quiz-container" id="quiz">
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
    <div class="quiz-header">
      <h2 id="question">How do you find our service?</h2>
      <ul>
        <li v-for="option in service_options" :key="option.id">
          <input type="radio" name="ans" v-model="this.formdata.option_id" v-bind:value="option.id" :id="'a' + option.id" class="answer">
          <label :for="'a' + option.id">{{option.name}}</label>
        </li>
      </ul>
    </div>

    <button  type="button" @click="saveFeedback">Submit</button>

  </div>
</div>
</template>
<script>
import axios from "axios";
import Header from './HeaderComponent.vue'
export default {
  name: 'QuizPage',
  components:{
    Header
  },
  data(){
    return {
        service_options: [],
        error:[],
        iserrorAlert: true,
        formdata:{
          user_id:null,
          option_id:null,
        }
    }
  },
  methods:{
    checkFeedback(){
  try {
      this.formdata.user_id = JSON.parse(localStorage.getItem('USER_ID'));
      const token = localStorage.getItem('TOKEN');
      if(token != undefined){
          axios.defaults.headers.common = {'Authorization': `Bearer ${token}`}
      }
      axios.post(`${process.env.VUE_APP_BASE_URL}api/user_feedback`,{user_id:this.formdata.user_id})
      .then((res)=>res.data)
      .then((data)=>{
      if(data.status){
        localStorage.setItem('FEEDBACK',data.data.name);
        this.$router.push({name: 'thankyou'});
      }
      });
  } catch (error) {
      console.log(error);
    }
    },
    saveFeedback(){
      this.error = [];
      if(this.formdata.option_id == null){
        this.error.push('Please choose feedback!');
      }
      if(this.error.length){
         this.iserrorAlert = true;
      }else{
      try {
      const token = localStorage.getItem('TOKEN');
      this.formdata.user_id = JSON.parse(localStorage.getItem('USER_ID'));
      if(token != undefined){
          axios.defaults.headers.common = {'Authorization': `Bearer ${token}`}
      }
      axios.post(`${process.env.VUE_APP_BASE_URL}api/save_feedback/`,this.formdata)
      .then((res)=>res.data)
      .then(()=>{
      this.checkFeedback()
      });
  } catch (error) {
      console.log(error);
    }
      }
    }
  },
  beforeMount(){
  this.checkFeedback()
  },
  mounted(){
       try {
      const token = localStorage.getItem('TOKEN');
      if(token != undefined){
          axios.defaults.headers.common = {'Authorization': `Bearer ${token}`}
      }
      axios.get(`${process.env.VUE_APP_BASE_URL}api/service_options`)
      .then((res)=>res.data)
      .then((data)=>{
      console.log(data);
      if(data.status){
          this.service_options = data.options;
      }
      });
  } catch (error) {
      console.log(error);
    }
}
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');

*{
  box-sizing: border-box;
}
.quiz.container{
    height:450px;
    display:flex;
    justify-content: space-around;
    align-items: center;
    text-align: left;
}
.quiz-container{
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px 2px rgba(100, 100, 100, 0.1);
  width: 600px;
  overflow: hidden;
}
.quiz-header{
  padding: 4rem;
}


ul{
  list-style-type: none;
  padding: 0;
}
ul li{
  font-size: 1.2rem;
  margin: 1rem 0;
}
ul li label{
  cursor: pointer;
  padding-left: 5px;
}
.quiz button{
  background-color: #03cae4;
  color: #fff;
  border: none;
  display: block;
  width: 100%;
  cursor: pointer;
  font-size: 1.1rem;
  font-family: inherit;
  padding: 1.3rem;
}
button:hover{
  background-color: #04adc4;
}
button:focus{
  outline: none;
  background-color: #44b927;
}
button.close{
      padding: 8px;
    background: none;
    color: black;
}
</style>