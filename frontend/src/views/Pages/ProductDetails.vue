<template>
  <NavbarComponent/>
  <ProductComponent/>
  <FooterView/>
</template>

<script>
import NavbarComponent from '@/components/Pages/layouts/Navbar.vue'
import ProductComponent from '@/components/Pages/Product.vue'
import FooterView from '@/components/Public/Layouts/Footer.vue'
export default {
    name:'PrductDetail',
    components:{
        NavbarComponent,
        ProductComponent,
        FooterView
    }
}
</script>

<style>

</style>