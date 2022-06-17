<template>
<div>
    <NavbarComponent />
    <SidebarComponent />
    <main>
        <div class="container-fluid mt-2 pt-3">
            <div class="row">
                <div class="col-md-12 fs-3 mt-5">
                    Dahsboard
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Products</h5>
                                    <i class="fa-solid fa-bag-shopping mb-3 fs-4"></i>
                                </div>
                                <p class="card-text m">{{statistic['number_of_products']}}</p>
                            </div>
                            <router-link :to="{ name: 'products'}" style="text-decoration:none;">
                                <div class="card-header text-light text-center">View detail <i class="fa-solid fa-angles-right"></i></div>
                            </router-link>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Customers</h5>
                                    <i class="fa-solid fa-users mb-3 fs-4"></i>
                                </div>
                                <p class="card-text m">{{statistic['number_of_clients']}}</p>
                            </div>
                            <router-link :to="{ name: 'customers'}" style="text-decoration:none;">
                                <div class="card-header text-light text-center">View detail <i class="fa-solid fa-angles-right"></i></div>
                            </router-link>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-secondary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Orders</h5>
                                    <i class="fa-solid fa-dollar-sign mb-3 fs-4"></i>
                                </div>
                                <p class="card-text m">{{statistic['number_of_orders']}}</p>
                            </div>
                            <router-link :to="{ name: 'orders'}" style="text-decoration:none;">
                                <div class="card-header text-light text-center">View detail <i class="fa-solid fa-angles-right"></i></div>
                            </router-link>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Contact</h5>
                                    <i class="fa-solid fa-message mb-3 fs-4"></i>
                                </div>
                                <p class="card-text m">{{statistic['number_of_contacts']}}</p>
                            </div>
                            <router-link :to="{ name: 'contact'}" style="text-decoration:none;">
                                <div class="card-header text-light text-center">View detail <i class="fa-solid fa-angles-right"></i></div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <StatisticComponent/>
</div>
</template>

<script>
import NavbarComponent from '@/components/Admin/Layouts/Navbar.vue'
import SidebarComponent from '@/components/Admin/Layouts/Sidebar.vue'
import StatisticComponent from '@/components/Admin/Content/Statistic.vue'
import axios from "axios";
import { mapActions } from 'vuex';
export default {
    name: 'DashboardView',
    components: {
        NavbarComponent,
        SidebarComponent,
        StatisticComponent
    },
    data() {
        return {
            statistic: [],
        }
    },
    async mounted() {
        // get statistic 
        let statistic = await axios.get('http://stop-and-shop.com/Admin');
        this.statistic = statistic.data;

        //Redirect user to home page
        let client = localStorage.getItem('client_id')
        // let admin = localStorage.getItem('Admin')
        if (client){
            this.redirect({
                val: 'home'
            });
        }
        if (!client){
            this.redirect({
                val: 'home'
            });
        }
    },
    methods:{
        ...mapActions(['redirect'])
    }
}
</script>

<style>

</style>
