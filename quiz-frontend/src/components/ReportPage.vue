<template>
<Header/>
<div class="container report">
<div class="wrapper">
<h3>Feedback Quiz Report</h3>
<div>Total Feedbacks : <strong>{{totalFeedbacks}}</strong></div>
<ul>
<li v-for="i in feedbacks" :key="i.id">{{i.emoji}} {{i.name}} : {{i.count}} - Percentage : {{i.percentage}}%</li>
</ul>
</div>
</div>
<div><router-link to="/"><button class="btn btn-primary"><i class="fa fa-home"></i> Home</button></router-link></div>

</template>
<script>
import axios from "axios";
import Header from './HeaderComponent.vue'
export default {
    name:"ReportPage",
    data(){
        return {
            totalFeedbacks:null,
            feedbacks:[]
        }
    },
    mounted(){

  try {
       const feedback_emoji_array = [
            {name:"Good",emoji:"🤩"},
            {name:"Fair",emoji:"🤗"},
            {name:"Neutral",emoji:"🙂"},
            {name:"Bad",emoji:"😒"},
        ];
      axios.get(`${process.env.VUE_APP_BASE_URL}api/feedback_report`)
      .then((res)=>res.data)
      .then((data)=>{
      if(data.status){
          this.totalFeedbacks = data.total;
          this.feedbacks = data.data;
          this.feedbacks.map((item)=>{
          let temp = feedback_emoji_array.find((i)=>{
                 return item.name == i.name;
             });
           item['percentage'] = Math.round(item.count*100/this.totalFeedbacks); 
           item['emoji'] = temp.emoji; 
           return item;
          });
      }
    //   console.log(this.feedbacks);
      });
  } catch (error) {
      console.log(error);
    }
  
    },
    components:{
        Header
    }
}
</script>
<style>
.report{
    display:flex;
    justify-content:center;
    align-items:center;
    height: 300px;
    overflow:hidden;
}
</style>