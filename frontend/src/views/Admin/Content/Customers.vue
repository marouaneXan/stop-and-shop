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
    <div class="d-flex" id="form" style="">
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
                        <form @submit="addProduct()">
                            <div class="mb-1">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" v-model="product.nom" class="form-control" id="name" required>
                                <label for="Description" class="form-label">Description</label>
                                <input type="text" v-model="product.description" class="form-control" id="Description" required>
                                <label for="Price" class="form-label">Price</label>
                                <input type="text" v-model="product.prix" class="form-control" id="Price" required>
                                <!-- <label for="formFile" class="form-label">Image</label> -->
                                <!-- <input type="file" ref="ProductImage" multiple class="form-control" @change="previewFiles" id="formFile" enctype='multipart/form-data'> -->
                                <select class="form-select" v-model="product.id_category" aria-label="Default select example">
                                    <option disabled selected>Select Category</option>
                                    <option v-for="c in categories" :key="c.id_cat" :value="c.id_cat" required>{{c.nom_cat}}</option>
                                </select>
                                <label for="Quantity" class="form-label">Quantity</label>
                                <input type="number" v-model="product.quantite" class="form-control" id="Quantity" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" @click="addProduct()" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
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
    <div  class="row d-flex justify-content-center align-items-center mt-3">
        <div class="col-md-6" id="card">
            <div class="card text-dark bg-light mb-3">
                <div class="card-header fw-bold">List of Products</div>
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
                                                        <form @click.prevent>
                                                            <div class="mb-1">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input type="text" v-model="product.nom" class="form-control" id="name">
                                                                <label for="Description" class="form-label">Description</label>
                                                                <input type="text" v-model="product.description" class="form-control" id="Description">
                                                                <label for="Price" class="form-label">Price</label>
                                                                <input type="text" v-model="product.prix" class="form-control" id="Price">
                                                                <!-- <label for="formFile" class="form-label">Image</label> -->
                                                                <!-- <input type="file" ref="ProductImage" multiple class="form-control" @change="previewFiles" id="formFile" enctype='multipart/form-data'> -->
                                                                <!-- <label class="form-label">Select Category</label> -->
                                                                <select class="form-select" v-model="product.id_category" aria-label="Default select example">
                                                                    <option disabled selected>Select Category</option>
                                                                    <option v-for="c in categories" :key="c.id_cat" :value="c.id_cat">{{c.nom_cat}}</option>
                                                                </select>
                                                                <label for="Quantity" class="form-label">Quantity</label>
                                                                <input type="number" v-model="product.quantite" class="form-control" id="Quantity">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" @click="UpdateProduct()" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
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
export default {
name:"CustomersView"
}
</script>

<style>

</style>