<template>
<NavbarComponent />
<SidebarComponent />
<main v-if="orders.length" class="mt-5 pt-3">
    <!--Message for delete products-->
    <div v-if="Updateorder.success" class="alert alert-success text-center">{{Updateorder.success}}</div>
    <div v-if="Updateorder.error" class="alert alert-warning text-center">{{Updateorder.error}}</div>

    <div class="col-md-12 fs-5 mt-3 mb-2" style="padding:0px 50px;">
        Name of customer
    </div>
    <div class="d-flex" id="form">
        <div class="mb-3" style="padding:0px 50px;">
            <input v-model="searchQuery" type="text" class="form-control" placeholder="Search" style="width:300px;">
        </div>
    </div>
    <div class="col mt-5" style="padding:0px 50px;">
    </div>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6" id="card">
            <div class="card text-dark bg-light mb-3">
                <div class="card-header fw-bold">List of Orders</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">First name</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Name product</th>
                                    <th scope="col">Price product</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price total</th>
                                    <th scope="col">Command Quantite</th>
                                    <th scope="col">Done at</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="o in resultQuery" :key="o.id_order">
                                    <td>#</td>
                                    <td>{{o.nom_pers}}</td>
                                    <td>{{o.ville}}</td>
                                    <td>{{o.email}}</td>
                                    <td>{{o.nom}}</td>
                                    <td>{{o.prix}}</td>
                                    <td><img id="image_produit" :src="getImgUrl(o.image)" alt="..."></td>
                                    <td>{{o.nom_cat}}</td>
                                    <td>{{o.price_total}}</td>
                                    <td>{{o.qtte}}</td>
                                    <td>{{o.done_at}}</td>
                                    <td>
                                        <span v-if="o.status=='In progress...'" class="badge bg-warning">In progress...</span>
                                        <span v-if="o.status=='Delivery'" class="badge bg-info">Delivery</span>
                                        <span v-if="o.status=='Confirmed'" class="badge bg-success">Confirmed</span>
                                    </td>
                                    <td class="action_btn">
                                        <button @click="passingDataUpdate(o)" class="btn" data-bs-toggle="modal" data-bs-target="#updateProduct"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <!-- Model To update new product -->
                                        <div class="modal fade" id="updateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form @click.prevent>
                                                            <div class="mb-1">
                                                                <!-- <label for="name" class="form-label">Status</label>
                                                                <input type="text" v-model="order.status" class="form-control" id="name"> -->
                                                                <select v-model="order.status" class="form-select" aria-label="Default select example">
                                                                    <option disabled selected>Select Status</option>
                                                                    <option value="In progress...">In progress...</option>
                                                                    <option value="Delivery">Delivery</option>
                                                                    <option value="Confirmed">Confirmed</option>
                                                                </select>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" @click="UpdateOrder()" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
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
<main v-else class="mt-5 d-flex justify-content-center align-content-center">
    <lord-icon  src="https://cdn.lordicon.com/slkvcfos.json" trigger="loop" style="width:250px;height:250px">
    </lord-icon>
</main>
<!-- {{orders}} -->
</template>

<script>
import axios from 'axios'
import NavbarComponent from '@/components/Admin/Layouts/Navbar.vue'
import SidebarComponent from '@/components/Admin/Layouts/Sidebar.vue'
export default {
    name: "OerdersView",
    data() {
        return {
            orders: [],
            searchQuery: '',
            order: {
                id_pers: '',
                status: '',
                nom_pers: ''
            },
            Updateorder: {
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
        this.fetchOrders()
    },
    computed: {
        resultQuery() {
            if (this.searchQuery) {
                return this.orders.filter((order) => {
                    return this.searchQuery.toLowerCase().split(' ').every(v => order.nom_pers.toLowerCase().includes(v))
                })
            } else {
                return this.orders;
            }
        }
    },
    methods: {
        getImgUrl(pet) {
            var images = require.context('../../../assets/uploads/', false)
            return images('./' + pet)
        },
        async fetchOrders() {
            let res = await axios("http://stop-and-shop.com/Order");
            this.orders = res.data
        },
        //passing data for model
        passingDataUpdate(o) {
            this.order.id_order = o.id_order;
            // this.order.nom_pers = o.nom_pers;
            this.order.status = o.status;
        },
        //delete product
        async UpdateOrder() {
            var form = new FormData();
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
                this.fetchOrders()
                this.Updateorder.success = res.data.message;
            } else {
                this.fetchOrders()
                this.Updateorder.error = "Error on Updating Status";
            }
        },
    },

}
</script>

<style>
#image_produit {
    width: 60px;
    /* height: 36px; */
}
</style>
