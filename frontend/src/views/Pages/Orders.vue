<template>
<div>
    <NavbarComponent />
    <FooterView />
</div>
</template>

<script>
import NavbarComponent from '../../components/Public/Layouts/Navbar.vue'
import FooterView from '@/components/Public/Layouts/Footer.vue'
export default {
name: 'OrdersView',
    components: {
        NavbarComponent,
        FooterView
    },
}
</script>

<style>

</style>