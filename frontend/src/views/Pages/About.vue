<template>
<div>
    <NavbarComponent />
<section class="text-dark p-5 p-lg-0 pt-lg-5 text-center text-sm-start">
    <div class="container">
        <div class="d-sm-flex align-items-center">
            <div>
                <h1 class="card-title display-3 mb-0">About us</h1>
                <p class="card-text lead my-4">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur perspiciatis, ea ut explicabo obcaecati quod quasi a dolore perferendis temporibus harum quis voluptates sunt nihil! Itaque obcaecati vel error maiores?
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur perspiciatis, ea ut explicabo obcaecati quod quasi a dolore perferendis temporibus harum quis voluptates sunt nihil! Itaque obcaecati vel error maiores?
                </p>
                <router-link :to="{ name: 'Contact'}" style="text-decoration:none;">
                    <button class="btn btn-outline-dark">Contact</button>
                </router-link>
            </div>
            <img src="../../assets/images/about-us.svg" class="img-fluid w-50 d-none d-sm-block imag mt-2" alt="about us">
            <!-- <img class="img-fluid w-50 d-none d-sm-block" src="img/showcase.svg" alt="" /> -->
        </div>
    </div>
</section>
</div>
</template>

<script>
import NavbarComponent from '@/components/Public/Layouts/Navbar.vue'
export default {
    name: 'AboutView',
    components:{
        NavbarComponent
    }
}
</script>

<style>
.container .imag {
    height: 350px;
}
</style>
