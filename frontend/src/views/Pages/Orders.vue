<template>
<div>
    <NavbarComponent />

    <section class="vh-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-10 col-lg-8 col-xl-6">
                    <div class="card card-stepper" style="border-radius: 16px;">
                        <div class="card-header p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-2"> Order ID <span class="fw-bold text-body">1222528743</span></p>
                                    <p class="text-muted mb-0"> Place On <span class="fw-bold text-body">12,March 2019</span> </p>
                                </div>
                                <div>
                                    <h6 class="mb-0"> <a href="#">View Details</a> </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex flex-row mb-4 pb-2">
                                <div class="flex-fill">
                                    <h5 class="bold">Headphones Bose 35 II</h5>
                                    <p class="text-muted"> Qt: 1 item</p>
                                    <h4 class="mb-3"> $ 299 <span class="small text-muted"> via (COD) </span></h4>
                                    <p class="text-muted">Tracking Status on: <span class="text-body">11:30pm, Today</span></p>
                                </div>
                                <div>
                                    <img class="align-self-center img-fluid" src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/6.webp" width="250">
                                </div>
                            </div>
                            <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                                <li class="step0 active" id="step1"><span style="margin-left: 22px; margin-top: 12px;">PLACED</span></li>
                                <li class="step0 active text-center" id="step2"><span>SHIPPED</span></li>
                                <li class="step0 text-muted text-end" id="step3"><span style="margin-right: 22px;">DELIVERED</span></li>
                            </ul>
                        </div>
                        <div class="card-footer p-4">
                            <div class="d-flex justify-content-between">
                                <h5 class="fw-normal mb-0"><a href="#!">Track</a></h5>
                                <div class="border-start h-100"></div>
                                <h5 class="fw-normal mb-0"><a href="#!">Cancel</a></h5>
                                <div class="border-start h-100"></div>
                                <h5 class="fw-normal mb-0"><a href="#!">Pre-pay</a></h5>
                                <div class="border-start h-100"></div>
                                <h5 class="fw-normal mb-0"><a href="#!" class="text-muted"><i class="fas fa-ellipsis-v"></i></a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
