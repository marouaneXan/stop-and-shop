<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
        <div class="container">
            <router-link :to="{ name: 'home'}" style="text-decoration:none;">
                <a class="navbar-brand" id="logo-title">
                    stop <span class="text-secondary">AND</span> shop
                </a>
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link :to="{ name: 'home'}" style="text-decoration:none;">
                            <a class="nav-link">Home</a>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a href="/Products" class="nav-link">Products</a>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'About'}" style="text-decoration:none;">
                            <a class="nav-link">About</a>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'Contact'}" style="text-decoration:none;">
                            <a class="nav-link">Contact</a>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="client_id" :to="{ name: 'orders'}" style="text-decoration:none;">
                            <a class="nav-link">Orders</a>
                        </router-link>
                    </li>
                </ul>

                <div class="btn">
                    <router-link v-if="!client_id" :to="{ name: 'Login'}" style="text-decoration:none;">
                        <a class="btn btn-outline-dark ms-2">
                            <i class="fa fa-sign-in me-1" aria-hidden="true"></i>Login
                        </a>
                    </router-link>
                    <router-link v-if="!client_id" :to="{ name: 'Register'}" style="text-decoration:none;">
                        <a class="btn btn-outline-dark ms-2">
                            <i class="fa fa-user-plus me-1"></i>Register
                        </a>
                    </router-link>
                    <a v-if="client_id" @click="logout()" class="btn btn-outline-dark ms-2" style="text-decoration:none;">
                        <i class="fa-solid fa-right-from-bracket"></i>Logout
                    </a>
                    <router-link v-if="client_id" :to="{ name: 'cart'}" style="text-decoration:none;">
                        <button class="btn ms-2">
                            <i class="fa-solid fa-cart-shopping" style="font-size:20px;"></i>
                        </button>
                    </router-link>
                    
                </div>
            </div>
        </div>
    </nav>
</div>
</template>

<script>
import {
    mapActions
} from 'vuex';
export default {
    name: "NavbarComponent",
    data() {
        return {
            client_id: localStorage.getItem("client_id")
        }
    },
    methods: {
        ...mapActions(['redirect']),
        logout() {
            localStorage.clear();
            this.redirect({
                val: "Login"
            });
        }
    }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Beau+Rivage&family=Caveat&family=Ms+Madi&family=Updock&display=swap');

.image {
    width: 160px;
    height: 54px;
}

.navbar-nav a {
    font-size: 18px;
}

#logo-title {
    font-family: 'Beau Rivage', cursive;
    font-family: 'Caveat', cursive;
    font-size: 30px;
}
</style>
