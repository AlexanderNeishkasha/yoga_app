<template>
    <div id="statistic">
        <div class="row">
            <app-datepicker label="Дата начала" :date="dates.start"></app-datepicker>
            <app-datepicker label="Дата окончания" :date="dates.end"></app-datepicker>
            <canvas id="statistic-for-days"></canvas>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';
    import moment from 'moment';
    import AppDatepicker from '../components/datepicker';

    export default {
        name: "statistic",
        components: {
            AppDatepicker
        },
        data() {
            return {
                marks: [
                    {
                        data: '2019-01-01',
                        morning: false,
                        evening: true
                    },
                    {
                        data: '2019-01-01',
                        morning: false,
                        evening: true
                    },
                    {
                        data: '2019-01-01',
                        morning: false,
                        evening: false
                    },
                    {
                        data: '2019-01-01',
                        morning: false,
                        evening: false
                    }
                ],
                dates: {
                    start: moment().startOf('month').format('YYYY-MM-DD'),
                    end: moment().format('YYYY-MM-DD'),
                },
                statisticForDaysChart: null
            }
        },
        methods: {
            statisticForDaysData() {
                return {
                    datasets: [{
                        data: [this.countDaysWithMarks(), this.countDaysWithoutMarks()],
                        backgroundColor: ['#2196f3', '#f44336']
                    }],
                    labels: ['Занимался', 'Не занимался']
                }
            },
            countDaysWithMarks() {
                return this.marks.filter(item => item.morning || item.evening).length;
            },
            countDaysWithoutMarks() {
                return this.marks.filter(item => !item.morning && !item.evening).length;
            }
        },
        watch: {
            marks() {
                this.statisticForDaysChart.data = this.statisticForDaysData();
                this.statisticForDaysChart.update();
            }
        },
        mounted() {
            let statisticForDaysCanvas = this.$el.querySelector('#statistic-for-days').getContext('2d');
            this.statisticForDaysChart = new Chart(statisticForDaysCanvas, {
                type: 'doughnut',
                data: this.statisticForDaysData()
            });
        }
    }
</script>

<style scoped>

</style>
