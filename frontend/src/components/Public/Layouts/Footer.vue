<template>
<!-- Start Footer -->
<footer class="bg-dark">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h2>
                    <router-link :to="{ name: 'home'}" style="text-decoration:none;">
                        <a class="navbar-brand" id="logo-title">
                           <p class="text-white d-inline">stop</p> <span class="text-secondary">AND</span> <p class="text-white d-inline">shop</p> 
                        </a>
                    </router-link>
                </h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        23rue almakdissi najah el amir
                    </li>
                    <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <span class="text-decoration-none">0603860541</span>
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <span class="text-decoration-none">marouanezahaoui835@gmail.com</span>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Products</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li v-for="c in categories" :key="c.id_cat"><a class="text-decoration-none text-white" href="#">{{c.nom_cat}}</a></li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none text-white" href="/">Home</a></li>
                    <li><a class="text-decoration-none text-white" href="/about-us">About Us</a></li>
                    <li><a class="text-decoration-none text-white" href="/products">Shop Locations</a></li>
                    <li><a class="text-decoration-none text-white" href="/contact-us">Contact</a></li>
                </ul>
            </div>

        </div>

        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-light text-center">
                        Copyright &copy; 2021 Stop-and-Shop
                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
</template>

<script>
import {
    mapGetters,
    mapActions
} from 'vuex'
export default {
    name: 'FooterView',
    computed: {
        ...mapGetters(['categories'])
    },
    mounted() {
        this.fetchCategories()
    },
    methods: {
        ...mapActions(['fetchProducts', 'fetchCategories']),
    }
}
</script>

<style>

</style>
