<template>
<div class="offcanvas offcanvas-start fixed text-white bg-dark" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
            <ul class="navbar-nav">
                <li class="text-muted small px-3 mt-2">
                    CORE
                </li>
                <li class="my-2 mt-3">
                    <router-link :to="{ name: 'dashboard'}" style="text-decoration:none;">
                        <a class="navbar-brand px-4">
                            <span class="me-4">
                                <i class="fa-solid fa-gauge"></i>
                            </span>
                            <span>Dahsboard</span>
                        </a>
                    </router-link>
                </li>
                <li class="my-2 mt-3">
                    <router-link :to="{ name: 'products'}" style="text-decoration:none;">
                        <a class="navbar-brand px-4">
                            <span class="me-4">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </span>
                            <span>Products</span>
                        </a>
                    </router-link>
                </li>
                <li class="my-2 mt-3">
                    <router-link :to="{ name: 'customers'}" style="text-decoration:none;">
                        <a class="navbar-brand px-4">
                            <span class="me-3">
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <span>Customers</span>
                        </a>
                    </router-link>
                </li>
                <li class="my-2 mt-3">
                    <router-link :to="{ name: 'orders'}" style="text-decoration:none;">
                        <a class="navbar-brand px-4">
                            <span class="me-4">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </span>
                            <span>Orders</span>
                        </a>
                    </router-link>
                </li>
                <li class="my-2 mt-3">
                    <router-link :to="{ name: 'statistic'}" style="text-decoration:none;">
                        <a class="navbar-brand px-4">
                            <span class="me-3">
                                <i class="fa-solid fa-chart-line"></i>
                            </span>
                            <span>Statistic</span>
                        </a>
                    </router-link>
                </li>
                <li class="my-2 mt-4">
                    <router-link :to="{ name: 'contact'}" style="text-decoration:none;">
                        <a class="navbar-brand px-4">
                            <span class="me-3">
                                <i class="fa-solid fa-message"></i>
                            </span>
                            <span>Contact</span>
                        </a>
                    </router-link>
                </li>
                <li class="my-2 mt-3">
                    <router-link :to="{ name: 'profile'}" style="text-decoration:none;">
                        <a class="navbar-brand px-4">
                            <span class="me-3">
                                <i class="fa-solid fa-address-card"></i>
                            </span>
                            <span>Profile</span>
                        </a>
                    </router-link>
                </li>
            </ul>
        </nav>
    </div>
</div>
</template>

<script>
export default {
    name: 'SidebarComponent'
}
</script>

<style>
:root {
    --offcanvas-width: 260px;
    --topNavbarHeight: 60px;
}

#offcanvasExample {
    width: var(--offcanvas-width);
}

@media (min-width:992px) {
    body {
        overflow: auto !important;
    }

    main {
        margin-left: var(--offcanvas-width);
    }

    .offcanvas-backdrop::before {
        display: none;
    }

    #offcanvasExample {
        transform: none;
        visibility: visible !important;
        top: var(--topNavbarHeight);
        height: calc(100% - var(--topNavbarHeight));
    }
}
</style>
