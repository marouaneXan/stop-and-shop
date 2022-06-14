<template>
<!-- <section class="" style="background-color: #eee;">
    <div class="container  py-5">
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                    <div>
                        <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                    </div>
                </div>
                <div v-for="b in basketProducts" :key="b.id_basket" class="card rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img src="../../assets/uploads/image1.png" id="image" class="img-fluid rounded-3" alt="Cotton T-shirt">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <p class="lead fw-normal mb-2">{{b.nom}}</p>
                                <p><span class="text-muted">Category: </span>{{b.nom_cat}}</p>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input id="form1" min="0" name="quantity" value="2" type="number" class="form-control form-control-sm" />
                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                <h5 class="mb-0">${{b.prix}}</h5>
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- <section v-if="basketProducts.length" class=" h-custom" style="background-color: #eee;">
    <div class="container py-5 ">
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-7">
                                <h5 class="mb-3"><a href="#!" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                <hr>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <p class="mb-1">Shopping cart</p>
                                        <p class="mb-0">You have {{this.basketProducts.length}} items in your cart</p>
                                    </div>
                                </div>

                                <div v-for="b in basketProducts" :key="b.id_basket" class="card mb-3">
                                    <div class="card-body">
                                        <div class=" d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div>
                                                    <img :src="getImgUrl(b.image)" class="img-fluid rounded-3" alt="Shopping item" id="image">
                                                </div>
                                                <div class="ms-3">
                                                    <h5>{{b.nom}}</h5>
                                                    <span class="small mb-0">{{b.nom_cat}}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <div style="width: 50px;">
                                                    <h5 class="fw-normal mb-0">{{b.qtte}}</h5>
                                                </div>
                                                <div style="width: 80px;">
                                                    <h5 class="mb-0">${{b.prix*b.qtte}}</h5>
                                                </div>
                                                <a style="color: #cecece;cursor: pointer;" @click="passingDataUpdate(b)" class="btn" data-bs-toggle="modal" data-bs-target="#updateProduct"><i class="fa-solid fa-pen-to-square"></i></a>

                                                <div class="modal fade" id="updateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update Quantite</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form @click.prevent>
                                                                    <div class="mb-1">
                                                                        <label for="name" class="form-label">Quantite</label>
                                                                        <input type="number" v-model="basketProduct.qtte" class="form-control" id="Quantity">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" @click="UpdateQuantite()" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
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
                            <div class="col-lg-5">

                                <div class="card bg-dark text-white rounded-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h5 class="mb-0">Card details</h5>
                                        </div>

                                        <p class="small mb-2">Card type</p>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-visa fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-amex fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                                        <form class="mt-4">
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="typeName">Cardholder's Name</label>
                                                <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="Cardholder's Name" />
                                            </div>

                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="typeText">Card Number</label>
                                                <input type="text" id="typeText" class="form-control form-control-lg" siez="17" placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <label class="form-label" for="typeExp">Expiration</label>
                                                        <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YYYY" size="7" minlength="7" maxlength="7" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <label class="form-label" for="typeText">Cvv</label>
                                                        <input type="password" id="typeText" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4">
                                            <h2 class="mb-2">Total Price</h2>
                                            <h3 class="mb-2">${{totalPrice}}</h3>
                                        </div>

                                        <button type="button" class="btn btn-info btn-block btn-lg">
                                            <div class="d-flex justify-content-between">
                                                <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                            </div>
                                        </button>

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
<div v-else class="py-6 py-lg-12" style="margin-top:120px;">
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center">
                <lord-icon src="https://cdn.lordicon.com/slkvcfos.json" trigger="loop" style="width:250px;height:250px">
                </lord-icon>
                <h2>Your shopping cart is empty</h2>
                <p class="mb-4">
                    Return to the store to add items for your delivery slot. Before proceed to checkout you must add some products to your shopping cart. You will find a lot of interesting products on our shop page.
                </p>
                <a href="/products" class="btn btn-dark">Explore Products</a>
            </div>
        </div>
    </div>
</div> -->
<section  v-if="basketProducts.length" class="h-100" style="background-color: #eee;">
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
                                <img :src="require(`../../assets/uploads/${b.image}`)" class="img-fluid rounded-3" alt="Cotton T-shirt">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <p class="lead fw-normal mb-2">{{b.nom}}</p>
                                <p><span class="text-muted">Category: {{b.nom_cat}}</span></p>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                <p><span class="text-muted">Quantite: {{b.qtte}}</span></p>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                <h5 class="mb-0">${{b.prix}}</h5>
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                <a style="color: #cecece;cursor: pointer;" @click="passingDataUpdate(b)" class="btn" data-bs-toggle="modal" data-bs-target="#updateProduct"><i class="fa-solid fa-pen-to-square"></i></a>

                                                <div class="modal fade" id="updateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update Quantite</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form @click.prevent>
                                                                    <div class="mb-1">
                                                                        <label for="name" class="form-label">Quantite</label>
                                                                        <input type="number" v-model="basketProduct.qtte" class="form-control" id="Quantity">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" @click="UpdateQuantite()" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
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

                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<div v-else class="py-6 py-lg-12" style="margin-top:120px;">
    <div class="container">
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
</template>

<script>
import axios from 'axios'
export default {
    name: 'CartView',
    data() {
        return {
            basketProducts: [],
            basketProduct: {
                id_pers: localStorage.getItem('client_id'),
                id_basket: '',
                qtte: ''
            },
            numberProductInBasket: '',
            totalPrice: ''
        }
    },
    computed: {},
    mounted() {
        this.DisplayAllProductsInBasket()
    },
    async created() {
        let res = await axios('http://stop-and-shop.com/Basket/index/46')
        this.numberProductInBasket = res.data
    },
    methods: {
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
        passingDataUpdate(b) {
            this.basketProduct.id_basket = b.id_basket;
            this.basketProduct.qtte = b.qtte;
        },
        //delete product
        async UpdateQuantite() {
            var form = new FormData();
            form.append('qtte', this.basketProduct.qtte);
            let res = await axios({
                method: "POST",
                url: 'http://stop-and-shop.com/Basket/updateQteOfProduct/' + this.basketProduct.id_basket,
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            if (res.data.message == "Product Updated successfully") {
                this.DisplayAllProductsInBasket()
            } else {
                this.DisplayAllProductsInBasket()
            }
        },
    }

}
</script>

<style>
.container .img-fluid {
    height: 100px;
    width: 100%;
}
</style>
