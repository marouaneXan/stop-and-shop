<template>
<div class="col-md-6">
    <img src="{product.image}" alt="" height="400px" width="400px">
</div>
<div class="col-md-6">
    <h4 class="text-uppercase text-blacl-50">{{product.nom_cat}}</h4>
    <h1 class="display-5">{{product.nom}}</h1>
    <!-- <p class="lead">
          <i class="fa fa-star"></i>
      </p> -->
    <h3 class="display-6 fw-bold my-4">{{product.prix}}$</h3>
    <p class="lead">
        {{product.description}}
    </p>
    <button class="btn btn-outline-dark me-2">Add to Cart</button>
    <button class="btn btn-outline-dark me-2">Go to Cart</button>
</div>
</template>

<script>
// import axios from "axios";
export default {
    name: 'ProductComponent',
    // data() {
    //     return {
    //         id_produit: '',
    //         product: [],
    //     }
    // },
    // async mounted() {
    //     this.id_produit = this.$route.params.id_produit;
    //     let res = await axios.get('http://e-commmerce.com/Product/read_single_product/' + this.id_produit);
    //     if (res.status == 200) {
    //         this.product = res.data;
    //         console.log(res.data);
    //     }
    // },
}
</script>

<style>

</style>
