<template>
    <div id="statistic">
        <div class="row">
            <app-datepicker label="Дата начала" :date="dates.start" @change="changeStartDate"></app-datepicker>
            <app-datepicker label="Дата окончания" :date="dates.end" @change="changeEndDate"></app-datepicker>
            <canvas id="statistic-for-days"></canvas>
        </div>
        <transition enter-active-class="animated fadeIn"
                    leave-active-class="animated fadeOut"
                    mode="out-in"
                    appear
        >
            <app-loader v-if="loading"></app-loader>
        </transition>
    </div>
</template>

<script>
    import axios from 'axios';
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
                dates: this.defaultDate(),
                loading: false,
                statisticForDaysChart: null
            }
        },
        methods: {
            defaultDate() {
                let json = localStorage.getItem('default_date');
                if (json) return JSON.parse(json);
                return {
                    start: moment().startOf('month').format('YYYY-MM-DD'),
                    end: moment().format('YYYY-MM-DD'),
                };
            },
            saveDatesToStorage() {
                localStorage.setItem('default_date', JSON.stringify(this.dates));
            },
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
                this.saveDatesToStorage();
                this.loadMarks();
            },
            changeEndDate(date) {
                this.dates.end = date;
                this.saveDatesToStorage();
                this.loadMarks();
            },
            loadMarks() {
                this.loading = true;
                axios.get('api/marks/statistic', {
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + this.$store.getters.token
                    },
                    params: {
                        'start_date': this.dates.start,
                        'end_date': this.dates.end
                    }
                }).then(response => {
                    return response.data;
                }).then(json => {
                    if (json.success) {
                        this.marks = json.data.marks;
                        this.statisticForDaysChart.data = this.statisticForDaysData();
                        this.statisticForDaysChart.update();
                    } else {
                        throw new Error('Произошла ошибка: ' + json.message);
                    }
                }).catch(ex => {
                    M.toast({html: 'Произошла ошибка: ' + ex.message})
                }).finally(() => {
                    this.loading = false;
                });
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
