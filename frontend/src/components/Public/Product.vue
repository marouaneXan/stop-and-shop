<template>
<!-- Open Content -->

    <section v-if="product.length" class="bg-light">
    <!--Message for added new  product in basket-->
    <div v-if="alert.success" class="alert alert-success text-center">{{alert.success}}</div>
    <div v-if="alert.error" class="alert alert-warning text-center">{{alert.error}}</div>
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" :src="require(`../../assets/uploads/${product[0].image}`)"  alt="Card image cap" id="product-detail">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{product[0].nom}}</h1>
                            <p class="h3 py-2">${{product[0].prix}}</p>

                            <h6>Description:</h6>
                            <p>{{product[0].description}}</p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Product Category :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>{{product[0].nom_cat}}</strong></p>
                                </li>
                            </ul>

                            <form>
                                <input type="hidden" name="product-title" value="Activewear">
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Quantity
                                                <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control form-control-sm" />
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button v-if="basket.id_pers" type="button" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                        <a v-else href="/Register" class="btn btn-success btn-lg">Buy</a>
                                    </div>
                                    <div class="col d-grid">
                                        <button v-if="basket.id_pers" type="button" @click="AddProductToBasket(product[0].id_produit)" class="btn btn-success btn-lg" name="submit">Add To Cart</button>
                                        <a v-else href="/Register"  class="btn btn-success btn-lg">Add To Cart</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->
</template>

<script>
import axios from "axios";
export default {
    name: 'ProductComponent',
    data() {
        return {
            id_produit: '',
            product: [],
             basket: {
                id_pers: localStorage.getItem('client_id'),
                id_produit: ''
            },
            alert: {
                success: '',
                error: ''
            }
        }
    },
    async mounted() {
        this.id_produit = this.$route.params.id_produit;
        let res = await axios.get('http://stop-and-shop.com/Product/read_single_product/' + this.id_produit);
        if (res.status == 200) {
            this.product.push( res.data) 
            console.log(res.data);
        }
    },
    methods:{
        // getImgUrl(pet) {
        //     var images = require.context('../../assets/uploads/', false)
        //     return images('./' + pet)
        // }
         async AddProductToBasket(p) {
            this.basket.id_produit = p;
            var form = new FormData();
            form.append('id_pers', this.basket.id_pers);
            form.append('id_produit', this.basket.id_produit);
            let res = await axios({
                method: "POST",
                url: 'http://stop-and-shop.com/Basket/create',
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            if (res.data.message == "Product Added successfully In Your Basket") {
                this.alert.success = res.data.message
            } else {
                this.alert.error = res.data.error
            }
        },
    }
}
</script>

<style>
#product-detail {
    height: 408px;
    width: auto;
}
</style>
