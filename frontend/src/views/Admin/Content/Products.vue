<template>
<div>
    <NavbarComponent />
<SidebarComponent />
<main class="mt-5 pt-3">
    <!--Message for add products-->
    <div v-if="Addproduct.success" class="alert alert-success text-center">{{Addproduct.success}} <i class="fa-solid fa-circle-check"></i></div>
    <div v-if="Addproduct.error" class="alert alert-warning text-center">{{Addproduct.error}}</div>

    <!--Message for delete products-->
    <div v-if="Deleteproduct.success" class="alert alert-success text-center">{{Deleteproduct.success}}</div>
    <div v-if="Deleteproduct.error" class="alert alert-danger text-center">{{Deleteproduct.error}}</div>

    <!--Message for update products-->
    <div v-if="Updateproduct.success" class="alert alert-success text-center">{{Updateproduct.success}} <i class="fa-solid fa-circle-check"></i></div>
    <div v-if="Updateproduct.error" class="alert alert-warning text-center">{{Updateproduct.error}}</div>

    <!--Message for add category-->
    <div v-if="Addcategory.success" class="alert alert-success text-center">{{Addcategory.success}} <i class="fa-solid fa-circle-check"></i></div>
    <div v-if="Addcategory.error" class="alert alert-warning text-center">{{Addcategory.error}}</div>

    <div class="col-md-12 fs-5 mt-3 mb-2" style="padding:0px 50px;">
        Name of Product
    </div>
    <div class="d-flex" id="form">
        <div class="mb-3" style="padding:0px 50px;">
            <input v-model="searchQuery" type="text" class="form-control" placeholder="Search" style="width:300px;">
        </div>
    </div>
    <div class="col mt-5" style="padding:0px 50px;">

        <!-- Model To add new product -->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addProduct">Add Product</button>
        <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-1">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" v-model="product.nom" class="form-control" id="name" required>
                                <label for="Description" class="form-label">Description</label>
                                <input type="text" v-model="product.description" class="form-control" id="Description" required>
                                <label for="Price" class="form-label">Price</label>
                                <input type="text" v-model="product.prix" class="form-control" id="Price" required>
                                <label for="formFile" class="form-label">Image</label>
                                <input type="file" multiple class="form-control" @change="previewFiles" id="formFile" enctype='multipart/form-data'>
                                <label class="form-label">Select Category</label>
                                <select class="form-select" v-model="product.id_category" aria-label="Default select example">
                                    <option disabled selected>Select Category</option>
                                    <option v-for="c in categories" :key="c.id_cat" :value="c.id_cat" required>{{c.nom_cat}}</option>
                                </select>
                                <label for="Quantity" class="form-label">Quantity</label>
                                <input type="number" v-model="product.quantite" class="form-control" id="Quantity" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="btn" @click="addProduct()" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Model To add new category -->
        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addCategory" style="margin-left:8px">Add Category</button>
        <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @click.prevent>
                            <div class="mb-1">
                                <label for="name" class="form-label">Name of Category</label>
                                <input v-model="category.nom_cat" type="text" class="form-control" id="name" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button @click="addCategory()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center align-items-center mt-3">
        <div class="col-md-6" id="card">
            <div class="card text-dark bg-light mb-3">
                <div class="card-header fw-bold">List of Products</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table v-if="products.length" class="table table-striped">
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
                                <tr v-for="p in resultQuery" :key="p.id_produit">
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
                                        <button @click="passingDataUpdate(p)" class="btn" data-bs-toggle="modal" data-bs-target="#updateProduct"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <!-- Model To update new product -->
                                        <div class="modal fade" id="updateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="mb-1">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input type="text" v-model="product.nom" class="form-control" id="name">
                                                                <label for="Description" class="form-label">Description</label>
                                                                <input type="text" v-model="product.description" class="form-control" id="Description">
                                                                <label for="Price" class="form-label">Price</label>
                                                                <input type="text" required v-model="product.prix" class="form-control" id="Price">
                                                                <label for="formFile" class="form-label">Image</label>
                                                                <input type="file" multiple class="form-control" @change="previewFiles" enctype='multipart/form-data'>
                                                                <label class="form-label">Select Category</label>
                                                                <select class="form-select" v-model="product.id_category" aria-label="Default select example">
                                                                    <option disabled selected>Select Category</option>
                                                                    <option v-for="c in categories" :key="c.id_cat" :value="c.id_cat">{{c.nom_cat}}</option>
                                                                </select>
                                                                <label for="Quantity" class="form-label">Quantity</label>
                                                                <input type="number" v-model="product.quantite" class="form-control" id="Quantity">
                                                            </div>
                                                            <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" @click="UpdateProduct()" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                                                    </div>
                                                        </form>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h1 v-else class="text-center">This is no Products yet</h1>
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
// import {
//     mapGetters,
//     mapActions
// } from 'vuex'
export default {
    name: 'ProductView',
    data() {
        return {
            products: [],
            categories: [],
            searchQuery: '',
            product: {
                id_produit: '',
                nom: '',
                description: '',
                prix: '',
                image:'',
                id_category: '',
                quantite: ''
            },
            category: {
                nom_cat: ''
            },
            Addproduct: {
                success: '',
                error: ''
            },
            Addcategory: {
                success: '',
                error: ''
            },
            Deleteproduct: {
                success: '',
                error: ''
            },
            Updateproduct: {
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
        this.fetchProducts()
        this.fetchCategories()
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
    computed: {
        // ...mapGetters(['products', 'categories'])
        resultQuery() {
            if (this.searchQuery) {
                return this.products.filter((item) => {
                    return this.searchQuery.toLowerCase().split(' ').every(v => item.nom.toLowerCase().includes(v))
                })
            } else {
                return this.products;
            }
        }
    },
    methods: {
        ...mapActions(['redirect']),
        // ...mapActions(['fetchProducts', 'fetchCategories']),
        getImgUrl(pet) {
            var images = require.context('../../../assets/uploads/', false)
            return images('./' + pet)
        },
        async fetchProducts() {
            let res = await axios("http://stop-and-shop.com/Product");
            this.products = res.data
        },
        async fetchCategories() {
            let res = await axios("http://stop-and-shop.com/Category");
            this.categories = res.data
        },
        async addProduct() {
            var form = new FormData();
            form.append('nom', this.product.nom);
            form.append('description', this.product.description);
            form.append('prix', this.product.prix);
            form.append('image', this.product.image);
            form.append('id_category', this.product.id_category);
            form.append('quantite', this.product.quantite);
            console.log(this.product.image);
            let res = await axios({
                method: "POST",
                url: 'http://stop-and-shop.com/Product/create',
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            if (res.data.message == "Product Added successfully") {
                this.fetchProducts()
                this.Addproduct.success = res.data.message;
            } else {
                this.fetchProducts()
                this.Addproduct.error = "Error on added new Product";
            }
        },
        //passing id for model
        passingDataDelete(p) {
            this.product.id_produit = p.id_produit;
        },
        //delete product
        async DeleteProduct() {
            let res = await axios.post("http://stop-and-shop.com/Product/DeleteProduct/" + this.product.id_produit);
            if (res.data.message == 'Product Deleted Successfully') {
                this.fetchProducts()
                this.Deleteproduct.success = "Product Deleted Successfully";
            } else {
                this.fetchProducts()
                this.Deleteproduct.error = "Error on Deleting Product";
            }
        },

        //passing data for model
        passingDataUpdate(p) {
            this.product.id_produit = p.id_produit;
            this.product.nom = p.nom;
            this.product.description = p.description;
            this.product.prix = p.prix;
            // this.product.image = p.image;
            this.product.id_category = p.id_category;
            this.product.quantite = p.quantite;
        },
        //delete product
        async UpdateProduct() {
            var form = new FormData();
            form.append('nom', this.product.nom);
            form.append('description', this.product.description);
            form.append('prix', this.product.prix);
            form.append('image', this.product.image);
            form.append('id_category', this.product.id_category);
            form.append('quantite', this.product.quantite);
            let res = await axios({
                method: "POST",
                url: 'http://stop-and-shop.com/Product/updateProduct/' + this.product.id_produit,
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            if (res.data.message == "Product Updated successfully") {
                this.fetchProducts()
                this.Updateproduct.success = res.data.message;
            } else {
                this.fetchProducts()
                this.Updateproduct.error = "Error on Updating new Product";
            }
        },
        //Add category
        async addCategory() {
            let form = new FormData()
            form.append('nom_cat', this.category.nom_cat)
            let res = await axios({
                method: 'POST',
                url: 'http://stop-and-shop.com/Category/create',
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            })
            if (res.data.message == "Category added successfully") {
                this.fetchCategories()
                this.Addcategory.success = res.data.message;
            } else {
                this.fetchCategories()
                this.Addcategory.error = "Error on adding new category";
            }
        },
        //get name of image
        previewFiles(event) {
            this.product.image = event.target.files[0];
        }
    },
}
</script>

<style>
#card {
    width: 90%;
}

.action_btn {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-evenly;
    height: 76px;
}

#form {
    width: 55%;
}

#image_produit {
    width: 60px;
    /* height: 36px; */
}
</style>
