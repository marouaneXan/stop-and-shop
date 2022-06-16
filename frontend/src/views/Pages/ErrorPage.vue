<template>
<div class="row">
    <div class="col-md-12 d-flex flex-column justify-content-center align-items-center vh-100">
        <h1 id="title">404</h1>
        <h4 id="sub-title">Page not found</h4>
        <p id="text">Oops! The page you are looking for does not exist. It might have been moved or deleted.</p>
        <a id="link-home" v-if="id_pers" href="/home" class="btn btn-dark">Back To Home</a>
        <a id="link-dashboard" v-if="id_admin" href="/admin/dashboard" class="btn btn-dark">Back To Dashboard</a>
    </div>
</div>
</template>

<script>
export default {
    name: 'ErrorView',
    data(){
      return{
        id_pers:localStorage.getItem('client_id'),
        id_admin:localStorage.getItem('Admin')
      }
    }
}
</script>

<style>
.row {
    margin: 0;
}

#link-home {
    /* background-color: #182C61; */
    border: 0px;
    text-decoration: none;
    padding: 10px;

}
#link-dashboard {
    /* background-color: #182C61; */
    border: 0px;
    text-decoration: none;
    padding: 10px;

}

#link-home:hover {
    text-decoration: none;
    background-color: #0c2461;
}
#link-dashboard:hover {
    text-decoration: none;
    background-color: #0c2461;
}


#title {
    font-size: 180px;
}

#sub-title {
    padding-bottom: 20px;

}

#text {
    text-align: center;

}
</style>
