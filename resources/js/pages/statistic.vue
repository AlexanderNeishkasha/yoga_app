<template>
    <div id="statistic">
        <div class="row">
            <app-datepicker label="Дата начала" :date="dates.start" @change="changeStartDate"></app-datepicker>
            <app-datepicker label="Дата окончания" :date="dates.end" @change="changeEndDate"></app-datepicker>
            <canvas id="statistic-for-days"></canvas>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';
    import moment from 'moment';
    import AppDatepicker from '../components/datepicker';
    import AppLoader from '../components/loader';

    export default {
        name: "statistic",
        components: {
            AppDatepicker,
            AppLoader
        },
        data() {
            return {
                marks: [],
                dates: {
                    start: moment().startOf('month').format('YYYY-MM-DD'),
                    end: moment().format('YYYY-MM-DD'),
                },
                loading: false,
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
            },
            changeStartDate(date) {
                this.dates.start = date;
                this.loadMarks();
            },
            changeEndDate(date) {
                this.dates.end = date;
                this.loadMarks();
            },
            loadMarks() {
                this.loading = true;
                let url = new URL('/api/marks/statistic', window.location.protocol + '//' + window.location.host);
                url.search = new URLSearchParams([['start_date', this.dates.start], ['end_date', this.dates.end]]);
                fetch(url, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    return response.json();
                }).then(json => {
                    if (json.success) {
                        this.marks = json.data.marks;
                    } else {
                        M.toast({html: 'Произошла ошибка: ' + json.message})
                    }
                }).catch(ex => {
                    M.toast({html: 'Произошла ошибка: ' + ex})
                }).finally(() => {
                    this.loading = false;
                });
            }
        },
        watch: {
            marks() {
                this.statisticForDaysChart.data = this.statisticForDaysData();
                this.statisticForDaysChart.update();
            }
        },
        beforeMount() {
            this.loadMarks();
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
