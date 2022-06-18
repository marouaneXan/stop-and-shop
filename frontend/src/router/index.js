import { createWebHistory,createRouter } from "vue-router";
//Route of user page
import Home from '../views/Pages/Home.vue'
import Login from '../views/Pages/Login.vue'
import Register from '../views/Pages/Register.vue'
import Contact from '../views/Pages/Contact.vue'
import About from '../views/Pages/About.vue'
import ProductDetails from '../views/Pages/ProductDetails.vue'
import Products from '../components/Public/Products.vue'
import ErrorPage from '../views/Pages/ErrorPage.vue'
import Cart from '../views/Pages/Cart.vue'
import OrdersClient from '../views/Pages/Orders.vue'

//Route of admin page
import dashboard from '../views/Admin/Content/Dashboard.vue'
import products from '../views/Admin/Content/Products.vue'
import customers from '../views/Admin/Content/Customers.vue'
import orders from '../views/Admin/Content/Orders.vue'
import contact from '../views/Admin/Content/Contact.vue'
import statistic from '../components/Admin/Content/Statistic.vue'
import profile from '../views/Admin/Content/Profile.vue'

const routes=[
    //Route of user page
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/products',
        name: 'Products',
        component: Products
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/contact-us',
        name: 'Contact',
        component: Contact
    },
    {
        path: '/about-us',
        name: 'About',
        component: About
    },
    {
        path: '/Orders',
        name: 'Orders',
        component: OrdersClient
    },
    {
        path: '/:catchAll(.*)',
        name: 'ErrorPage',
        component: ErrorPage
    },
    {
        path: '/cart',
        name: 'cart',
        component: Cart
    },
    {
        path: '/product/:id_produit',
        name: 'ProductDetails',
        component: ProductDetails
    },


    //Route of admin page
    {
        path: '/admin/dashboard',
        name: 'dashboard',
        component: dashboard
    },
    {
        path: '/admin/products',
        name: 'products',
        component: products
    },
    {
        path: '/admin/customers',
        name: 'customers',
        component: customers
    },
    {
        path: '/admin/orders',
        name: 'orders',
        component: orders
    },
    {
        path: '/admin/contact',
        name: 'contact',
        component: contact
    },
    {
        path: '/admin/statistic',
        name: 'statistic',
        component: statistic
    },
    {
        path: '/admin/profile',
        name: 'profile',
        component: profile
    },
]


const router=createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});
export default router