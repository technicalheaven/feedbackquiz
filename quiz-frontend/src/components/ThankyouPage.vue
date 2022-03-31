<template>
<Header/>
<div class="container thankyou">
<div class="wrapper">
<h3>Thank you for giving valuable feedback</h3>
<h2 class="font-weight-bold text-uppercase">{{feedbackInfo.name}} {{feedbackInfo.emoji}} </h2>
</div>
</div>
</template>

<script>
import Header from './HeaderComponent.vue'
export default {
    name:"ThankyouPage",
    data(){
        return {
            feedback: localStorage.getItem('FEEDBACK'),
            emoji:null,
            feedbackInfo:{},
        }
    },
    mounted(){
        const feedback_emoji_array = [
            {name:"Good",emoji:"🤩"},
            {name:"Fair",emoji:"🤗"},
            {name:"Neutral",emoji:"🙂"},
            {name:"Bad",emoji:"😒"},
        ];
        this.feedbackInfo = feedback_emoji_array.find((el)=>{
            return el.name == this.feedback
        });
        console.log(this.feedbackInfo);
    },
    components:{
        Header
    }
}
</script>
<style>
.thankyou{
    display:flex;
    justify-content:center;
    align-items:center;
    height: 300px;
    overflow:hidden;
}
</style>