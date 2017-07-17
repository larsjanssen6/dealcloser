<template>
    <canvas :id="label" :width="width" :height="height"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        props: ['data', 'labels', 'label', 'money', 'background', 'border', 'width', 'height'],

        mounted() {
            let ctx = document.getElementById(this.label);
            let myChart = new Chart(ctx, {
                type: "line",
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
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(label, index, labels) {
                                    return '€' + label;
                                }
                            }
                        }]
                    }
                }
            });
        }
    }
</script>