<template>
    <canvas :width="width" :height="height" ref="chart"></canvas>
</template>

<script>
    import { Chart, registerables } from 'chart.js';
    Chart.register(...registerables);
    
    export default {
        props:['width', 'height', 'label', 'labels', 'colors', 'data'],
        data() {
            return {

            }
        },
        methods: {
            createChart(){
                const ctx = this.$refs.chart;
                const data = {
                    labels: this.labels,
                    datasets: [{
                        label: this.label,
                        data: this.data,
                        backgroundColor: this.colors,
                        borderColor: "rgba(0,0,0,0)",
                        hoverOffset: 8
                    }]
                };
                const config = {
                    type: 'doughnut',
                    data: data,
                };
                const chart = new Chart(ctx, config);
            }
        },
        mounted() {
            this.createChart()
        },
    }
</script>
