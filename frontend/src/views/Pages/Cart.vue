<template>
<div>
    <NavbarComponent />
    <section v-if="basketProducts.length" class="h-100">
        <div v-if="alert.success" class="alert alert-success text-center">{{alert.success}}</div>
        <div v-if="alert.error" class="alert alert-danger text-center">{{alert.error}}</div>
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                        <p class="mb-0">You have {{this.basketProducts.length}} items in your cart</p>

                    </div>

                    <div v-for="b in basketProducts" :key="b.id_basket" class="card rounded-3 mb-4">
                        <div class="card-body p-4">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <img :src="require(`../../assets/uploads/${b.image}`)" class="img-fluid rounded-3" id="imageCart" alt="Cotton T-shirt">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <p class="lead fw-normal mb-2">{{b.nom}}</p>
                                    <p><span class="text-muted">Category: {{b.nom_cat}}</span></p>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <p><span class="text-muted">Quantite: {{b.qtte}}</span></p>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h5 class="mb-0">${{b.prix * b.qtte}}</h5>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1" id="actions">
                                    <a style="color: #cecece;cursor: pointer;" @click="passingDataPayment(b)" class="btn" data-bs-toggle="modal" data-bs-target="#buy"><i class="fa-solid fa-credit-card"></i></a>
                                    <div class="modal fade" id="buy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form @click.prevent>
                                                        <div class="mb-1">
                                                            <label for="payment" class="form-label">Enter your card number</label>
                                                            <input type="number" class="form-control" id="payment">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" @click="Payment()" class="btn btn-primary" data-bs-dismiss="modal">Pay</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a @click="passingDataDelete(b)" style="color: #cecece;cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete"><i class="fas fa-trash-alt"></i></a>
                                    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are You Sure You want To Delete This Product From Basket
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" @click="DeleteProductFromBasket()" class="btn btn-danger" data-bs-dismiss="modal">Yes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <div v-else class="py-6 py-lg-12" style="margin-top:60px;">
        <div class="container mb-5">
            <div class="row">
                <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center">
                    <lord-icon src="https://cdn.lordicon.com/slkvcfos.json" trigger="loop" style="width:250px;height:250px">
                    </lord-icon>
                    <h2>Your shopping cart is empty</h2>
                    <p class="mb-4">
                        Return to the store to add items for your delivery slot. Before proceed to checkout you must add some products to your shopping cart. You will find a lot of interesting products on our shop page.
                    </p>
                    <a href="/Products" class="btn btn-dark">Explore Products</a>
                </div>
            </div>
        </div>
    </div>
    <FooterView />
</div>
</template>

<script>
import NavbarComponent from '@/components/Public/Layouts/Navbar.vue'
import FooterView from '@/components/Public/Layouts/Footer.vue'
import axios from 'axios'
import {
    mapActions
} from 'vuex'
export default {
    name: 'CartView',
    components: {
        NavbarComponent,
        FooterView,
    },
    data() {
        return {
            basketProducts: [],
            basketProduct: {
                id_pers: localStorage.getItem('client_id'),
                id_basket: '',
                id_produit: '',
                qtte: ''
            },
            numberProductInBasket: '',
            totalPrice: '',
            alert: {
                success: '',
                error: ''
            }

        }
    },
    computed: {},
    mounted() {
        this.DisplayAllProductsInBasket()

        //Redirect user to login page
        let client = localStorage.getItem('client_id')
        if (!client) {
            this.redirect({
                val: 'Login'
            });
        }
    },
    async created() {
        let res = await axios('http://stop-and-shop.com/Basket/index/'+ this.basketProduct.id_pers)
        this.numberProductInBasket = res.data
    },
    methods: {
        ...mapActions(['redirect']),
        getImgUrl(pet) {
            var images = require.context('../../assets/uploads/', false)
            return images('./' + pet)
        },
        async DisplayAllProductsInBasket() {
            let res = await axios('http://stop-and-shop.com/Basket/readBasketProductById/' + this.basketProduct.id_pers)
            this.basketProducts = res.data
            // console.log(this.basketProducts)
            if (this.basketProducts.length) {
                let sum = 0
                this.basketProducts.forEach(item => {
                    sum += (item.prix * item.qtte)
                })
                this.totalPrice = sum
            }
        },

        //passing id for model
        passingDataDelete(p) {
            this.basketProduct.id_basket = p.id_basket;
        },
        //delete product from basket
        async DeleteProductFromBasket() {
            let res = await axios.post("http://stop-and-shop.com/Basket/DeleteProductFromBasket/" + this.basketProduct.id_basket);
            if (res.data.message == 'Product Deleted Successfully') {
                this.numberProductInBasket
                this.DisplayAllProductsInBasket()
            } else {
                this.DisplayAllProductsInBasket()
            }
        },

        //passing data for model
        passingDataPayment(b) {
            this.basketProduct.id_basket = b.id_basket;
            this.basketProduct.id_produit = b.id_produit;
            this.basketProduct.qtte = b.qtte;
        },
        //Payment
        async Payment() {
            var form = new FormData();
            form.append('id_pers', this.basketProduct.id_pers);
            form.append('id_produit', this.basketProduct.id_produit);
            console.log(this.basketProduct.id_pers);
            form.append('qtte', this.basketProduct.qtte);
            let res = await axios({
                method: "POST",
                url: 'http://stop-and-shop.com/order/InsertOrderAfterPayment/' + this.basketProduct.id_basket,
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            if (res.data.message == "Payement successfully") {
                this.DisplayAllProductsInBasket()
                this.alert.success = res.data.message
            } else {
                this.DisplayAllProductsInBasket()
                this.alert.error = res.data.error
            }
        },
    }

}
</script>

<style>
#imageCart {
    height: 150px;
    width: 100%;
    object-fit: contain;
}

#actions {
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
