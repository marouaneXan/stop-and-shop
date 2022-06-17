<template>
<div>
    <NavbarComponent />
    <ProductComponent />
    <FooterView />
</div>
</template>

<script>
import NavbarComponent from '../../components/Public/Layouts/Navbar.vue'
import ProductComponent from '../../components/Public/Product.vue'
import FooterView from '@/components/Public/Layouts/Footer.vue'
import { mapActions } from 'vuex'
export default {
    name: 'ProductDetails',
    components: {
        NavbarComponent,
        ProductComponent,
        FooterView
    },
    mounted(){
        let admin = localStorage.getItem('Admin')
        if (admin){
            localStorage.clear();
            this.redirect({
                val: 'admin/dashboard'
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
