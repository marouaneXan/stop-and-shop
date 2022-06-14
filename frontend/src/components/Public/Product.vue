<template>
<!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" :src="require(`../../assets/uploads/${product.image}`)" alt="Card image cap" id="product-detail">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{product.nom}}</h1>
                            <p class="h3 py-2">${{product.prix}}</p>

                            <h6>Description:</h6>
                            <p>{{product.description}}</p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Product Category :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>{{product.nom_cat}}</strong></p>
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
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                    </div>
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">Add To Cart</button>
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
    {{product}}
</template>

<script>
import axios from "axios";
export default {
    name: 'ProductComponent',
    data() {
        return {
            id_produit: '',
            product: [],
        }
    },
    async mounted() {
        this.id_produit = this.$route.params.id_produit;
        let res = await axios.get('http://stop-and-shop.com/Product/read_single_product/' + this.id_produit);
        if (res.status == 200) {
            this.product = res.data;
            console.log(res.data);
        }
    },
    methods:{
        // getImgUrl(pet) {
        //     var images = require.context('../../assets/uploads/', false)
        //     return images('./' + pet)
        // }
    }
}
</script>

<style>

</style>
