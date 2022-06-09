<template>
<NavbarComponent />
<SidebarComponent />
<main class="mt-5 pt-3">
    <!--Message for delete products-->
    <div v-if="Deleteproduct.success" class="alert alert-danger text-center">{{Deleteproduct.success}}</div>
    <div v-if="Deleteproduct.error" class="alert alert-warning text-center">{{Deleteproduct.error}}</div>

    <div class="col-md-12 fs-5 mt-3 mb-2" style="padding:0px 50px;">
        Name of Customer
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
                <div class="card-header fw-bold">List of Customers</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="p in resultQuery" :key="p.id_customer">
                                    <td>#</td>
                                    <td>{{p.nom}}</td>
                                    <td>{{p.description}}</td>
                                    <td>{{p.prix}}$</td>
                                    <td><img id="image_produit" :src="getImgUrl(p.image)" alt="..."></td>
                                    <td>{{p.nom_cat}}</td>
                                    <td>{{p.quantite}}</td>
                                    <td class="action_btn">
                                        <button class="btn" @click="passingDataDelete(p)" data-bs-toggle="modal" data-bs-target="#delete"><i class="fa-solid fa-trash-can" style="color:red;"></i></button>
                                        <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are You Sure You want To Delete This Product
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" @click="DeleteProduct()" class="btn btn-danger" data-bs-dismiss="modal">Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</template>

<script>
import axios from 'axios'
import NavbarComponent from '@/components/Admin/Layouts/Navbar.vue'
import SidebarComponent from '@/components/Admin/Layouts/Sidebar.vue'
export default {
    name: "CustomersView",
    data() {
        return {
            customers: [],
            searchQuery:'',
            customer: {
                id:''
            },
            Deletecustomer: {
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
        this.fetchCustomers()
    },
    computed: {
        resultQuery() {
            if (this.searchQuery) {
                return this.customers.filter((customer) => {
                    return this.searchQuery.toLowerCase().split(' ').every(v => customer.nom.toLowerCase().includes(v))
                })
            } else {
                return this.customers;
            }
        }
    },
    methods:{
      async fetchCustomers() {
            let res = await axios("http://stop-and-shop.com/Product");
            this.customers = res.data
        },
    },
    //passing id for model
        passingDataDelete(p) {
            this.customer.id_pers = p.id_produit;
        },
        //delete customer
        async DeleteCustomer() {
            let res = await axios.post("http://stop-and-shop.com/Product/DeleteCustomer/" + this.product.id_produit);
            if (res.data.message == 'Product Deleted Successfully') {
                this.fetchProducts()
                this.Deleteproduct.success = "Product Deleted Successfully";
            } else {
                this.fetchProducts()
                this.Deleteproduct.error = "Error on updating Product";
            }
        },
}
</script>

<style>

</style>
