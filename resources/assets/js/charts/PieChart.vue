<template>
    <canvas :id="label" width="800" height="600"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        props: ['data', 'labels', 'label', 'title', 'background', 'border'],

        mounted() {
            let ctx = document.getElementById(this.label);
            let myChart = new Chart(ctx, {
                type: "pie",
                data: {
                    labels: this.labels,
                    datasets: [
                        {
                            label: this.label,
                            data: this.data,
                            backgroundColor: [
                                this.background
                            ],
                            borderColor: [
                                this.border
                            ],
                            borderWidth: 2
                        }
                    ]
                }
            });
        }
    }
</script>