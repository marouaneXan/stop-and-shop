<template>
<div>
    <NavbarComponent />
<SidebarComponent />
<section class=" mt-2 pt-3">
    <!--Message for delete products-->
    <!-- <div v-if="UpdatedataAdmin.success" class="alert alert-success text-center">{{UpdatedataAdmin.success}}</div>
    <div v-if="UpdatedataAdmin.error" class="alert alert-warning text-center">{{UpdatedataAdmin.error}}</div> -->
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col col-lg-6 mb-4 mb-lg-0">
                <h1>Profile Admin</h1>
                <div class="card mb-3" style="border-radius: .5rem;width: 600px;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img src="@/assets/images/imgMe.jpeg" id="pic" alt="Avatar" class="img-fluid my-5" style="width:90px;height:90px;" />
                            <h5>{{AdminInfos.nom}} {{AdminInfos.prenom}}</h5>
                            <p>Web Designer</p>
                            <i @click="passingDataUpdate(AdminInfos)" class="far fa-edit mb-5" data-bs-toggle="modal" data-bs-target="#updateProduct" style="cursor:pointer"></i>

                        </div>

                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Information</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted">{{AdminInfos.email}}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Birthday</h6>
                                        <p class="text-muted">{{AdminInfos.date_naissance}}</p>
                                    </div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Country</h6>
                                        <p class="text-muted">{{AdminInfos.ville}}</p>
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

    <!-- Model To update informations of admin -->
    <div class="modal fade" id="updateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Your personnel informations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @click.prevent>
                        <div class="mb-1">
                            <label for="name" class="form-label">First name</label>
                            <input type="text" v-model="info.nom" class="form-control" required>
                            <label for="name" class="form-label">Last name</label>
                            <input type="text" v-model="info.prenom" class="form-control" required>
                            <label for="name" class="form-label">Birthday</label>
                            <input type="date" v-model="info.date_naissance" class="form-control" required>
                            <label for="name" class="form-label">Country</label>
                            <input type="text" v-model="info.ville" class="form-control" required>
                            <label for="name" class="form-label">Email</label>
                            <input type="text" v-model="info.email" class="form-control" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" @click="UpdateDataAdmin()" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</template>

<script>
import axios from 'axios'
import NavbarComponent from '@/components/Admin/Layouts/Navbar.vue'
import SidebarComponent from '@/components/Admin/Layouts/Sidebar.vue'
export default {
    name: "ProfileView",
    data() {
        return {
            AdminInfos: [],
            info: {
                id_pers: '',
                nom: '',
                prenom: '',
                date_naissance: '',
                ville: '',
                email: '',
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
            let res = await axios("http://stop-and-shop.com/Admin/DataAdmin");
            this.AdminInfos = res.data
        },
        //passing data for model
        passingDataUpdate(a) {
            this.info.id_pers = a.id_pers;
            this.info.nom = a.nom;
            console.log(this.info.nom)
            this.info.prenom = a.prenom;
            this.info.date_naissance = a.date_naissance;
            this.info.ville = a.ville;
            this.info.email = a.email;
        },
        //delete product
        async UpdateDataAdmin() {
            var form = new FormData();
            form.append('nom', this.info.nom);
            form.append('prenom', this.info.prenom);
            form.append('date_naissance', this.info.date_naissance);
            form.append('ville', this.info.ville);
            form.append('email', this.info.email);
            let res = await axios({
                method: "POST",
                url: 'http://stop-and-shop.com/Admin/updateAdminProfile',
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            if (res.data.message == "Your informations Updated successfully") {
                this.fetchDataAdmin()
                this.UpdatedataAdmin.success = res.data.message;
            } else {
                this.fetchDataAdmin()
                this.UpdatedataAdmin.error = "Error on Updating Status";
            }
        },
    },
}
</script>

<style>
.gradient-custom {
    background-color: rgb(4, 3, 16);
}
#pic{
    border-radius: 50%;
}
</style>
