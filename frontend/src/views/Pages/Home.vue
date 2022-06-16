<template>
<div>
    <NavbarComponent />
<div class="hero">
    <section class="bg-dark text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start">
        <div class="container">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title display-3 fw-bolder mb-0">NEW SEASON ARRIVALS</h5>
                    <p class="card-text lead my-4">
                        CHECK OUT ALL THE TRENDS
                    </p>
                     <router-link :to="{ name: 'Register'}" style="text-decoration:none;">
                        <a class="btn btn-secondary ms-2">
                            Shop Now
                        </a>
                    </router-link>
                </div>
                <img class="img-fluid w-50 d-none d-sm-block" src="../../assets/images/image.svg" alt="" />
            </div>
        </div>
    </section>
</div>
<ProductsComponent/>
<FooterView/>
</div>
</template>

<script>
import NavbarComponent from '@/components/Public/Layouts/Navbar.vue'
import FooterView from '@/components/Public/Layouts/Footer.vue'
import ProductsComponent from '@/components/Public/Products.vue'
import { mapActions } from 'vuex'
export default {
    name: 'HomeView',
    components: {
        NavbarComponent,
        ProductsComponent,
        FooterView
    },
    mounted(){
        // let admin = localStorage.getItem('Admin')
        // let client = localStorage.getItem('client_id')
        // if (admin){
        //     this.redirect({
        //         val: 'admin/dashboard'
        //     });
        // }
    },
    methods:{
        ...mapActions(['redirect'])
    }
}
</script>

<style>
.container .img-fluid {
    height: 536px;
}
</style>
