<template>
<div>
    <NavbarComponent />
<div class="container mt-1 p-3" style="display:flex;flex-direction:column;justify-content:center;align-items:center;">
    <div v-if="success" class="alert alert-sucess">{{success}}</div>
    <h1 class="text-center text-dark">Login</h1>
    <form class="border shadow p-4 mt-4 rounded" @click.prevent style="width:395px;">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input v-model="client.email" type="email" class="form-control" aria-label="Email address">
            <span class="error-feedback text-danger" v-if="v$.client.email.$error">{{v$.client.email.$errors[0].$message}}</span>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password</label>
            <input v-model="client.password" type="password" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp">
            <span class="error-feedback text-danger" v-if="v$.client.password.$error">{{v$.client.password.$errors[0].$message}}</span>
        </div>
        <span class="error-feedback text-danger">{{error_login}}</span>
        <button type="button" @click="redirect({ val : 'Register'})" class="btn btn-outline-dark mb-1 w-100">Register</button>
        <button type="submit" @click="login()" class="btn btn-outline-dark w-100 active">Login</button>
    </form>
</div>
</div>
</template>

<script>
import NavbarComponent from '@/components/Public/Layouts/Navbar.vue'
import {
    mapActions
} from "vuex";
import {
    required,
    email,
} from '@vuelidate/validators'
import axios from "axios";
import useVuelidate from '@vuelidate/core';
export default {
    name: "LoginView",
    components: {
        NavbarComponent
    },
    validations() {
        return {
            client: {
                email: {
                    required,
                    email
                },
                password: {
                    required,
                }
            }
        }
    },
    data() {
        return {
            v$: useVuelidate(),
            client: {
                email: "",
                password: "",
            },
            error_login: "",
            success: ""
        }
    },
    mounted() {
        let client = localStorage.getItem("client_id");
        if (client) {
            this.redirect({
                val: 'home'
            });
        }
    },
    methods: {
        ...mapActions(['redirect']),
        async login() {
            this.v$.$validate();
            if (!this.v$.$error) {
                var form = new FormData();
                form.append('email', this.client.email);
                form.append('password', this.client.password);
                let result = await axios({
                    method: "POST",
                    url: 'http://stop-and-shop.com/Register/login',
                    data: form,
                    headers: {
                        "Content-Type": "multipart/form-data"
                    },
                })
                if (result.data.message == "Login success" && result.data.user_info.role == 0) {
                    this.success = result.data.message;
                    let object = {};
                    form.forEach((value, key) => object[key] = value);
                    localStorage.setItem("client_id", JSON.stringify(result.data.user_info.id_pers));
                    this.redirect({
                        val: 'home'
                    })
                } else if (result.data.message == "Login success" && result.data.user_info.role == 1) {
                    let object = {};
                    form.forEach((value, key) => object[key] = value);
                    localStorage.setItem("Admin", JSON.stringify(result.data.user_info.id_pers));
                    this.redirect({
                        val: 'dashboard'
                    })
                } else {
                    this.error_login = "Client not found"
                }
            } else {
                console.log("error");
            }
        }
    }
}
</script>

<style>
</style>
