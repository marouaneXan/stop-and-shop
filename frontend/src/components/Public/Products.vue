<template>
<div class="container my-5 py-5">
    <div class="row">
        <div class="col-12 mb-5">
            <h1 class="display-6 fw-bolder text-center">Our Latest Products</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="d-flex justify-content-center mb-5 pb-5" @click.prevent>
            <button v-for="c in categories" :key="c.id_cat" class="btn btn-outline-dark me-2">{{c.nom_cat}}</button>
        </div>
    </div>

    <!-- <div class="row">
        <div  class="col-md-3 mb-4">
            <div class="card h-100 text-center p-4"> -->
    <!-- <img :src="getImgUrl(p.image)" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title mb-0">zdvzv</h5>
                    <p class="card-text lead fw-bold">zeveagreae...</p>
                    <router-link :to="{ name: 'Product',params:{id_produit:p.id_produit}}" style="text-decoration:none;">
                        <a class="btn btn-outline-dark">Buy Now</a>
                    </router-link>
                </div> -->

    <!-- </div>
        </div>
    </div> -->
    <!--Message for added new  product in basket-->
    <div v-if="alert.success" class="alert alert-success text-center">{{alert.success}}</div>
    <div v-if="alert.error" class="alert alert-warning text-center">{{alert.error}}</div>
    <section class="section-products">
        <div class="container">
            <div class="row">
                <div v-for="p in products" :key="p.id_produit" class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-1" class="single-product">
                        <h1>{{p.id_produit}}</h1>
                        <div class="part-1">
                            <img :src="getImgUrl(p.image)" alt="">

                            <ul>
                                <li><a @click="AddProductToBasket(p.id_produit)"><i class="fas fa-shopping-cart"></i></a></li>
                                <!-- <li><a href="#"><i class="fas fa-heart"></i></a></li> -->
                                <li>
                                    <router-link :to="{ name: 'ProductDetails',params:{id_produit:p.id_produit}}"><i class="fas fa-expand"></i></router-link>
                                </li>
                            </ul>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">{{p.nom}}</h3>
                            <h4 class="product-price">{{p.prix}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>

<script>
import axios from 'axios'
import {
    mapGetters,
    mapActions
} from 'vuex'
export default {
    name: 'ProductsComponent',
    data() {
        return {
            basket: {
                id_pers: localStorage.getItem('client_id'),
                id_produit: ''
            },
            alert:{
                success:'',
                error:''
            }
        }
    },
    computed: {
        ...mapGetters(['products', 'categories'])
    },
    mounted() {
        this.fetchProducts()
        this.fetchCategories()
    },
    methods: {
        ...mapActions(['fetchProducts', 'fetchCategories']),
        getImgUrl(pet) {
            var images = require.context('../../assets/uploads/', false)
            return images('./' + pet)
        },
        async AddProductToBasket(p) {
            this.basket.id_produit = p;
            var form = new FormData();
            form.append('id_pers', this.basket.id_pers);
            form.append('id_produit', this.basket.id_produit);
            let res = await axios({
                method: "POST",
                url: 'http://stop-and-shop.com/Basket/create',
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            if (res.data.message == "Product Added successfully In Your Basket") {
                this.alert.success=res.data.message
            } else {
                this.alert.error=res.data.error
            }
        },
    }
}
</script>

<style>
.card-img-top {
    width: 100%;
    height: 100%;
}

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

body {
    font-family: "Poppins", sans-serif;
    color: #444444;
}

a,
a:hover {
    text-decoration: none;
    color: inherit;
}

.section-products {
    padding: 80px 0 54px;
}

.section-products .header {
    margin-bottom: 50px;
}

.section-products .header h3 {
    font-size: 1rem;
    color: #fe302f;
    font-weight: 500;
}

.section-products .header h2 {
    font-size: 2.2rem;
    font-weight: 400;
    color: #444444;
}

.section-products .single-product {
    margin-bottom: 26px;
}

.section-products .single-product .part-1 {
    position: relative;
    height: 290px;
    max-height: 290px;
    margin-bottom: 20px;
    overflow: hidden;
}

.section-products .single-product .part-1::before {
    position: absolute;
    content: "";
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    transition: all 0.3s;
}

.section-products .single-product:hover .part-1::before {
    transform: scale(1.2, 1.2) rotate(5deg);
}

/* .section-products #product-1 .part-1::before {
    background: url("https://i.ibb.co/L8Nrb7p/1.jpg") no-repeat center;
    background-size: cover;

transition: all 0.3s;
} */

.section-products .single-product .part-1 .discount,
.section-products .single-product .part-1 .new {
    position: absolute;
    top: 15px;
    left: 20px;
    color: #ffffff;
    background-color: #fe302f;
    padding: 2px 8px;
    text-transform: uppercase;
    font-size: 0.85rem;
}

.section-products .single-product .part-1 .new {
    left: 0;
    background-color: #444444;
}

.section-products .single-product .part-1 ul {
    position: absolute;
    bottom: -41px;
    left: 20px;
    margin: 0;
    padding: 0;
    list-style: none;
    opacity: 0;
    transition: bottom 0.5s, opacity 0.5s;
}

.section-products .single-product:hover .part-1 ul {
    bottom: 30px;
    opacity: 1;
}

.section-products .single-product .part-1 ul li {
    display: inline-block;
    margin-right: 4px;
}

.section-products .single-product .part-1 ul li a {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    background-color: #ffffff;
    color: #444444;
    text-align: center;
    box-shadow: 0 2px 20px rgb(50 50 50 / 10%);
    transition: color 0.2s;
}

.section-products .single-product .part-1 ul li a:hover {
    color: #fe302f;
}

.section-products .single-product .part-2 .product-title {
    font-size: 1rem;
}

.section-products .single-product .part-2 h4 {
    display: inline-block;
    font-size: 1rem;
}

.section-products .single-product .part-2 .product-old-price {
    position: relative;
    padding: 0 7px;
    margin-right: 2px;
    opacity: 0.6;
}

.section-products .single-product .part-2 .product-old-price::after {
    position: absolute;
    content: "";
    top: 50%;
    left: 0;
    width: 100%;
    height: 1px;
    background-color: #444444;
    transform: translateY(-50%);
}
</style>
