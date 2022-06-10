<template>
<NavbarComponent />
<SidebarComponent />
<section class=" mt-2 pt-3">
    <!--Message for delete products-->
    <div v-if="Updateorder.success" class="alert alert-success text-center">{{Updateorder.success}}</div>
    <div v-if="Updateorder.error" class="alert alert-warning text-center">{{Updateorder.error}}</div>
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col col-lg-6 mb-4 mb-lg-0">
                <h1>Profile Admin</h1>
                <div class="card mb-3" style="border-radius: .5rem;width: 600px;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" alt="Avatar" class="img-fluid my-5" style="width:90px;height:90px;" />
                            <h5>Marie Horwitz</h5>
                            <p>Web Designer</p>
                            <i class="far fa-edit mb-5"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Information</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted">info@example.com</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Phone</h6>
                                        <p class="text-muted">123 456 789</p>
                                    </div>
                                </div>
                                <h6>Projects</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Recent</h6>
                                        <p class="text-muted">Lorem ipsum</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Most Viewed</h6>
                                        <p class="text-muted">Dolor sit amet</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                    <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                    <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>
import axios from 'axios'
import NavbarComponent from '@/components/Admin/Layouts/Navbar.vue'
import SidebarComponent from '@/components/Admin/Layouts/Sidebar.vue'
export default {
    name: "ProfileView",
    ata() {
        return {
            AdminInfos: [],
            order: {
                id_pers: '',
                nom_pers: ''
            },
            UpdatedataAdmin: {
                success: '',
                error: ''
            }
        }
    },
    components: {
        NavbarComponent,
        SidebarComponent
    },
    mounted() {
        this.fetchDataAdmin()
    },
    methods: {
        async fetchDataAdmin() {
            let res = await axios("http://stop-and-shop.com/Order");
            this.orders = res.data
        },
        //passing data for model
        passingDataUpdate(a) {
            this.order.id_order = a.id_order;
            this.order.nom_pers = a.nom_pers;
            this.order.status = a.status;
        },
        //delete product
        async UpdateOrder() {
            var form = new FormData();
            form.append('status', this.order.status);
            form.append('status', this.order.status);
            form.append('status', this.order.status);
            form.append('status', this.order.status);
            form.append('status', this.order.status);
            form.append('status', this.order.status);
            let res = await axios({
                method: "POST",
                url: 'http://stop-and-shop.com/Order/updateStatusOrder/' + this.order.id_order,
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            if (res.data.message == "Status Updated successfully") {
                this.fetchDataAdmin()
                this.Updateorder.success = res.data.message;
            } else {
                this.fetchDataAdmin()
                this.Updateorder.error = "Error on Updating Status";
            }
        },
    },
}
</script>

<style>
.gradient-custom {
    background-color: rgb(4, 3, 16);
}
</style>
