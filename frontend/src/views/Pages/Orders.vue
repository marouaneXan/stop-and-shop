<template>
<div>
    <NavbarComponent />

    <section v-if="orders.length" class="gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div v-for="o in orders" :key="o.id_order" class="col-md-10 col-lg-8 col-xl-6">
                    <div class="card card-stepper" style="border-radius: 16px;">
                        <div class="card-header p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-2"> Order ID <span class="fw-bold text-body">{{o.id_order}}</span></p>
                                    <p class="text-muted mb-0"> Place On <span class="fw-bold text-body">{{o.done_at}}</span> </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex flex-row mb-4 pb-2">
                                <div class="flex-fill">
                                    <h5 class="bold">{{o.ville}}</h5>
                                    <p class="text-muted"> Qt: {{o.qtte}} item</p>
                                    <h4 class="mb-3"> $ {{o.prix}} <span class="small text-muted"> via (COD) </span></h4>
                                    <p class="text-muted">Tracking Status on: <span class="text-body">{{o.status}}</span></p>
                                </div>
                                <div>
                                    <img id="order-image" class="align-self-center img-fluid" :src="require(`../../assets/uploads/${o.image}`)" width="250">
                                </div>
                            </div>
                            <div class="progress">
                                <div class="text-center" :class="(o.status=='In progress...' || o.status=='Delivery' || o.status=='Confirmed') ? 'progress-bar bg-success':''" style="width: 50%">
                                    In progress...
                                </div>
                                <div class="text-center" :class="(o.status=='Delivery'  || o.status=='Confirmed') ? 'progress-bar bg-success':''" style="width: 50%">
                                    Delivery
                                </div>
                                <div class="text-center" :class="(o.status=='Confirmed'  ) ? 'progress-bar bg-success':''" style="width: 50%">
                                    Confirmed<p v-if="o.status=='Confirmed'">Confirmed 100%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <FooterView />
</div>
</template>

<script>
import NavbarComponent from '../../components/Public/Layouts/Navbar.vue'
import FooterView from '@/components/Public/Layouts/Footer.vue'
import axios from 'axios'
export default {
    name: 'OrdersView',
    data() {
        return {
            orders: [],
            order: {
                id_pers: localStorage.getItem('client_id'),
            },
        }
    },
    components: {
        NavbarComponent,
        FooterView
    },
    async mounted() {
        this.fetchOrders()
        //Redirect user to home page
        let client = localStorage.getItem('client_id')
        if (!client) {
            this.redirect({
                val: 'home'
            });
        }
    },
    methods: {
        async fetchOrders() {
            let res = await axios('http://stop-and-shop.com/Order/readOrdersByIdClient/' + this.order.id_pers)
            this.orders = res.data
            console.log(this.orders);
        },
    }
}
</script>

<style>
#progressbar-1 {
    color: #455A64;
}

#progressbar-1 li {
    list-style-type: none;
    font-size: 13px;
    width: 33.33%;
    float: left;
    position: relative;
}

#progressbar-1 #step1:before {
    content: "1";
    color: #fff;
    width: 29px;
    margin-left: 22px;
    padding-left: 11px;
}

#progressbar-1 #step2:before {
    content: "2";
    color: #fff;
    width: 29px;
}

#progressbar-1 #step3:before {
    content: "3";
    color: #fff;
    width: 29px;
    margin-right: 22px;
    text-align: center;
}

#progressbar-1 li:before {
    line-height: 29px;
    display: block;
    font-size: 12px;
    background: #455A64;
    border-radius: 50%;
    margin: auto;
}

#progressbar-1 li:after {
    content: '';
    width: 121%;
    height: 2px;
    background: #455A64;
    position: absolute;
    left: 0%;
    right: 0%;
    top: 15px;
    z-index: -1;
}

#order-image {
    height: 150px;
}

#progressbar-1 li:nth-child(2):after {
    left: 50%
}

#progressbar-1 li:nth-child(1):after {
    left: 25%;
    width: 121%
}

#progressbar-1 li:nth-child(3):after {
    left: 25%;
    width: 50%;
}

.card-stepper {
    z-index: 0
}
</style>
