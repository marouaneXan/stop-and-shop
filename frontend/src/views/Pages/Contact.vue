<template>
<div>
    <NavbarComponent />
    <!--Message for send message-->
    <div v-if="alert.success" class="alert alert-success text-center">{{alert.success}}</div>
    <section class="text-light p-4 text-center text-sm-start">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <h5 class=" text-dark card-title text-center display-3">Contact us</h5>
                    <form class="p-4" id="contact" @click.prevent>
                        <div class="mb-3">
                            <input v-model="contact.email" type="email" class="form-control" required placeholder="Email address" aria-label="Email address">
                        </div>
                        <div class="mb-3">
                            <input type="text" v-model="contact.subject" class="form-control" placeholder="Subject" required aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <textarea type="text" v-model="contact.message" class="form-control" placeholder="Message" required aria-describedby="emailHelp"></textarea>
                        </div>
                        <button type="submit" @click="sendMessage()" class="btn btn-outline-dark w-100 active">Send</button>
                    </form>
                </div>
                <img src="../../assets/images/contact-us.svg" id="contact_us" class="img-fluid w-50 d-none d-sm-block" alt="..." width="379px">
            </div>
        </div>
    </section>
</div>
</template>

<script>
import axios from 'axios'
import NavbarComponent from '@/components/Public/Layouts/Navbar.vue'
import {
    mapActions
} from 'vuex'
export default {
    name: 'ContactView',
    data() {
        return {
            contact: {
                email: '',
                subject: '',
                message: ''
            },
            alert: {
                success: '',
            }
        }
    },
    components: {
        NavbarComponent
    },
    mounted() {
        let admin = localStorage.getItem('Admin')
        if (admin) {
            localStorage.clear();
        }
    },
    methods: {
        ...mapActions(['redirect']),
        async sendMessage() {
            let form = new FormData()
            form.append('email', this.contact.email)
            form.append('subject', this.contact.subject)
            form.append('message', this.contact.message)
            let res = await axios({
                method: "POST",
                url: 'http://stop-and-shop.com/contact/addContact',
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            if (res.data.message == 'Contact Added successfully') {
                this.alert.success = 'message sent successfully'
            }
        }
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
