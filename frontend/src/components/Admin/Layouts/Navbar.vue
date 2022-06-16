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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
</template>

<script>
import { mapActions } from 'vuex';
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
