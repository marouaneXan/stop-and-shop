<template>
  <NavbarComponent/>
  <div class="container py-5">
      <div class="row py-5">
          <ProductComponent/>
      </div>
  </div>
</template>

<script>
import NavbarComponent from '@/components/Pages/layouts/Navbar.vue'
import ProductComponent from '@/components/Pages/Product.vue'
export default {
    name:'PrductDetail',
    components:{
        NavbarCom,
        ProductCom
    }
}
</script>

<style>

</style>