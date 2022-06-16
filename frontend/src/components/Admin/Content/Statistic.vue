<template>
<div>
    <NavbarComponent />
    <SidebarComponent />

    <main class="p-3" id="chart">
        <h2>Statistics of website</h2>
        <div class="row">
            <div class="col-md-6" style="width:700px;">
                <div class="card">
                    <div class="card-header">
                        Chart
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</template>

<script>
import Chart from 'chart.js/auto';
import axios from 'axios'
import NavbarComponent from '@/components/Admin/Layouts/Navbar.vue'
import SidebarComponent from '@/components/Admin/Layouts/Sidebar.vue'
export default {
    name: "StatisticComponent",
    data() {
        return {
            statistic: [],
        }
    },
    components: {
        NavbarComponent,
        SidebarComponent
    },
    mounted() {
        this.getStatistic()
    },
    methods: {
        // get statistic 
        async getStatistic() {
            await axios.get('http://stop-and-shop.com/Admin').then((response) => {
                console.log(response.data);
                this.statistic = response.data;
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Products', 'Orders', 'Customers', 'Contacts'],
                        datasets: [{
                            label: '# Numbers',
                            data: [this.statistic['number_of_products'], this.statistic['number_of_orders'], this.statistic['number_of_clients'], this.statistic['number_of_clients']],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                myChart;
            })
        }
    }

}
</script>

<style>
#chart {
    margin-top: 80px;
}
</style>
