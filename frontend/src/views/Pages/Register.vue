<template>
<div>
    <NavbarComponent />
<div class="container mt-3">
    <div v-if="success" class="alert alert-success text-center">{{success}}</div>
    <div v-if="error" class="alert alert-warning text-center">{{error}}</div>
</div>
<h1 class="text-center text-dark mt-5">Register</h1>
<div class="container d-flex justify-content-center mt-2">
    <form class="border shadow p-4 rounded" style="width:490px;">
        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control" v-model="client.nom" placeholder="First name" aria-label="First name">
                <span class="error-feedback text-danger" v-if="v$.client.nom.$error">{{v$.client.nom.$errors[0].$message}}</span>
            </div>
            <div class="col">
                <input type="text" class="form-control" v-model="client.prenom" placeholder="Last name" aria-label="Last name">
                <span class="error-feedback text-danger" v-if="v$.client.prenom.$error">{{v$.client.prenom.$errors[0].$message}}</span>
            </div>
        </div>
        <div class="col mb-3">
            <input type="date" class="form-control" v-model="client.date_naissance" placeholder="Date of birth" aria-label="Date of birth">
        </div>
        <div class="col mb-3">
            <input type="email" class="form-control" v-model="client.email" placeholder="Email address" aria-label="Email address">
            <span class="error-feedback text-danger" v-if="v$.client.email.$error">{{v$.client.email.$errors[0].$message}}</span>
        </div>
        <div class="col mb-3">
            <input type="text" class="form-control" v-model="client.ville" placeholder="Ville" aria-label="Ville">
            <span class="error-feedback text-danger" v-if="v$.client.ville.$error">{{v$.client.ville.$errors[0].$message}}</span>
        </div>
        <div class="col mb-3">
            <input type="password" class="form-control" v-model="client.password" placeholder="Password" aria-label="Password">
            <span class="error-feedback text-danger" v-if="v$.client.password.$error">{{v$.client.password.$errors[0].$message}}</span>
        </div>
        <button type="submit" @click="register()" class="btn btn-dark mb-1 w-100">Register</button>
        <button type="button" @click="redirect({val:'Login'})" class="btn btn-outline-dark w-100">Login</button>
    </form>
</div>
</div>
</template>

<script>
import NavbarComponent from '@/components/Public/Layouts/Navbar.vue'
import {
    mapActions
} from 'vuex'
import axios from 'axios'
import useVuelidate from '@vuelidate/core'
import {
    required,
    email,
    minLength
} from '@vuelidate/validators'
export default {
    name: 'RegisterCom',
    components: {
        NavbarComponent,
    },
    data() {
        return {
            v$: useVuelidate(),
            client: {
                nom: "",
                prenom: "",
                date_naissance: "",
                email: "",
                ville: "",
                password: "",
            },
            success: "",
            error: ""
        }
    },
    validations() {
        return {
            client: {
                nom: {
                    required,
                    minLength: minLength(6)
                },
                prenom: {
                    required,
                    minLength: minLength(6)
                },
                email: {
                    required,
                    email
                },
                date_naissance: {
                    required,
                },
                ville: {
                    required,
                    minLength: minLength(4)
                },
                password: {
                    required,
                    minLength: minLength(10)
                }
            }
        }
    },
    mounted() {
        let client = localStorage.getItem("client_id");
        if (client) {
            this.redirect({
                val: 'home'
            });
        }

        let admin = localStorage.getItem('Admin')
        if (admin){
            localStorage.clear();
        }
    },
    methods: {
        ...mapActions(['redirect']),
        async register() {
            event.preventDefault()
            this.v$.$validate();
            if (!this.v$.$error) {
                var form = new FormData();
                form.append('nom', this.client.nom);
                form.append('prenom', this.client.prenom);
                form.append('date_naissance', this.client.date_naissance);
                form.append('email', this.client.email);
                form.append('ville', this.client.ville);
                form.append('password', this.client.password);
                let result = await axios({
                    method: "POST",
                    url: 'http://stop-and-shop.com/Register/sign_up',
                    data: form,
                    headers: {
                        "Content-Type": "multipart/form-data"
                    },
                })
                if (result.data.message == 'Create new account successfully') {
                    this.success = result.data.message;
                    // redirect to login page
                    this.redirect({
                        val: 'Login'
                    });

                } else {
                    this.error = result.data.error;
                }
            } else {
                console.log('error')
            }
        }
    }

}
</script>

<style scoped>
</style>
