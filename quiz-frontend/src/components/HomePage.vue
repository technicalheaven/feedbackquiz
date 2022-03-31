<template>
<div class="container home">
<h3 class="text-center text-uppercase">Service Feedback Quiz</h3>
<nav>
<div><router-link to="/login"><button class="btn btn-primary"><i class="fa fa-lock"></i> Login</button></router-link></div>
<div><router-link to="/register"><button class="btn btn-success"><i class="fa fa-book"></i> Register</button></router-link></div>
<div><router-link to="/report"><button class="btn btn-success"><i class="fa fa-eye"></i> Report</button></router-link></div>
</nav>
</div>
</template>

<script>
export default {
    name: "HomePage"
}
</script>
<style>
button{
    width: 200px;
    margin: 10px 0;
}
.home.container{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-wrap: wrap;
}
</style>