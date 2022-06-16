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
export default {
    name: 'ProductDetails',
    components: {
        NavbarComponent,
        ProductComponent,
        FooterView
    }
}
</script>

<style>

</style>
