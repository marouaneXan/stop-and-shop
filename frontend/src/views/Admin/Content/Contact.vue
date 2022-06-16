<template>
<div>
    <NavbarComponent />
<SidebarComponent />
<main class="mt-5 pt-3">
    <!--Message for delete contact-->
    <div v-if="Deletecontact.success" class="alert alert-success text-center">{{Deletecontact.success}}</div>
    <div v-if="Deletecontact.error" class="alert alert-warning text-center">{{Deletecontact.error}}</div>

    <div class="col-md-12 fs-5 mt-3 mb-2" style="padding:0px 50px;">
        Name of Contact
    </div>
    <div class="d-flex" id="form">
        <div class="mb-3" style="padding:0px 50px;">
            <input v-model="searchQuery" type="text" class="form-control" placeholder="Search" style="width:300px;">
        </div>
    </div>
    <div class="col mt-5" style="padding:0px 50px;">
    </div>
    <div class="row d-flex justify-content-center align-items-center mt-3">
        <div class="col-md-6" id="card">
            <div class="card text-dark bg-light mb-3">
                <div class="card-header fw-bold">List of Contact</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table v-if="contacts.length" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Message</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="c in resultQuery" :key="c.id">
                                    <td>#</td>
                                    <td>{{c.email}}</td>
                                    <td>{{c.subject}}</td>
                                    <td>{{c.message}}</td>
                                    <td class="action_btn">
                                        <button class="btn" @click="passingDataDelete(c)" data-bs-toggle="modal" data-bs-target="#delete"><i class="fa-solid fa-trash-can" style="color:red;"></i></button>
                                        <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Contact</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are You Sure You want To Delete This Contact
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" @click="DeleteContact()" class="btn btn-danger" data-bs-dismiss="modal">Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h1 v-else class="text-center">This is no contacts yet</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
</template>

<script>
import axios from 'axios'
import NavbarComponent from '@/components/Admin/Layouts/Navbar.vue'
import SidebarComponent from '@/components/Admin/Layouts/Sidebar.vue'
import { mapActions } from 'vuex';
export default {
    name: "CustomersView",
    data() {
        return {
            contacts: [],
            searchQuery:'',
            contact: {
                id:''
            },
            Deletecontact: {
                success: '',
                error: ''
            },
        }
    },
    components: {
        NavbarComponent,
        SidebarComponent
    },
    mounted() {
        this.fetchContact()
        //Redirect user to home page
        let client = localStorage.getItem('client_id')
        if (client){
            this.redirect({
                val: 'home'
            });
        }
    },
    computed: {
        resultQuery() {
            if (this.searchQuery) {
                return this.contacts.filter((contact) => {
                    return this.searchQuery.toLowerCase().split(' ').every(v => contact.email.toLowerCase().includes(v))
                })
            } else {
                return this.contacts;
            }
        }
    },
    methods:{
        ...mapActions(['redirect']),
      async fetchContact() {
            let res = await axios("http://stop-and-shop.com/Contact");
            this.contacts = res.data
        },
        //passing id for model
        passingDataDelete(c) {
            this.contact.id = c.id;
        },
        //delete customer
        async DeleteContact() {
            let res = await axios.post("http://stop-and-shop.com/Contact/DeleteContact/" + this.contact.id);
            if (res.data.message == 'Contact Deleted Successfully') {
                this.fetchContact()
                this.Deletecontact.success = "Contact Deleted Successfully";
            } else {
                this.fetchContact()
                this.Deletecontact.error = "Error on deleting contact";
            }
        },
    },
    
        
}
</script>

<style>

</style>
