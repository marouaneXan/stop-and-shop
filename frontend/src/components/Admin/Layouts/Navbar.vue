<template>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon"></span>
        </button>
        <router-link :to="{ name: 'dashboard'}" style="text-decoration:none;">
            <a class="navbar-brand me-auto " id="logo-title">
                stop <span class="text-secondary">AND</span> shop
            </a>
        </router-link>

        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="/admin/profile">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" @click="logout()">Log out</a></li>
            </ul>
        </div>
    </div>
</nav>
</template>

<script>
import {
    mapActions
} from 'vuex';
export default {
    name: 'NavbarComponent',
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

#logo-title {
    font-family: 'Beau Rivage', cursive;
    font-family: 'Caveat', cursive;
    font-size: 30px;
}
</style>
