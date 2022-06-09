<template>
<NavbarComponent />
<section class="text-light p-4 text-center text-sm-start">
    <div class="container mt-4">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <h5 class=" text-dark card-title text-center display-3">Contact us</h5>
                <form class="p-4" id="contact" @click.prevent>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email address" aria-label="Email address">
                        <!-- <span class="error-feedback text-danger" v-if="v$.email.$error">{{v$.email.$errors[0].$message}}</span> -->
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Subject"  required aria-describedby="emailHelp">
                        <!-- <span class="error-feedback text-danger" v-if="v$.uniqId.$error">{{v$.uniqId.$errors[0].$message}}</span> -->
                    </div>
                    <div class="mb-3">
                        <textarea type="text" class="form-control" placeholder="Message" required aria-describedby="emailHelp"></textarea>
                        <!-- <span class="error-feedback text-danger" v-if="v$.uniqId.$error">{{v$.uniqId.$errors[0].$message}}</span> -->
                    </div>
                    <!-- <span class="error-feedback text-danger">{{error_login}}</span> -->
                    <!-- <button type="button" @click="redirect({ val : 'SignUp'})" class="btn btn-outline-dark mb-1 w-100">Register</button> -->
                    <button type="submit" class="btn btn-outline-dark w-100 active">Send</button>
                </form>
            </div>
            <img src="../../assets/images/contact-us.svg" id="contact_us" class="img-fluid w-50 d-none d-sm-block" alt="..." width="379px">
        </div>
    </div>
</section>
</template>

<script>
import NavbarComponent from '@/components/Public/Layouts/Navbar.vue'
export default {
    name: 'ContactView',
    components:{
        NavbarComponent
    }
}
</script>

<style>
#contact_us {
    width: 832px;
    height: 386px;
}
/* #contact{
    width: 420px;
} */
</style>
