<style scoped>

</style>

<template>
    <div id="marks">
        <transition enter-active-class="animated fadeIn"
                    leave-active-class="animated fadeOut"
                    mode="out-in"
                    appear
        >
            <form v-if="!loading">
                <div class="row">
                    <app-datepicker :date="this.marks.date" @change="changeDate" label="Выбери дату"></app-datepicker>
                    <app-mark-button :time="'morning'" :status="this.marks.morning"
                                     @change="changeMorning"></app-mark-button>
                    <app-mark-button :time="'evening'" :status="this.marks.evening"
                                     @change="changeEvening"></app-mark-button>
                </div>
            </form>
            <app-loader v-else></app-loader>
        </transition>
    </div>
</template>

<script>
    import moment from 'moment';
    import AppDatepicker from '../components/datepicker';
    import AppMarkButton from '../components/mark_button';
    import AppLoader from '../components/loader';

    export default {
        name: "marks",
        components: {
            AppDatepicker,
            AppMarkButton,
            AppLoader
        },
        data() {
            return {
                marks: {
                    date: moment().format('YYYY-MM-DD'),
                    morning: false,
                    evening: false,
                },
                loading: true
            }
        },
        methods: {
            changeMorning() {
                this.marks.morning = !this.marks.morning;
                this.saveMark();
            },
            changeEvening() {
                this.marks.evening = !this.marks.evening;
                this.saveMark();
            },
            changeDate(date) {
                this.marks.date = date;
                this.loadMarks();
            },
            loadMarks() {
                this.loading = true;
                let url = new URL('/api/marks/get', window.location.protocol + '//' + window.location.host);
                url.search = new URLSearchParams([['date', this.marks.date]]);
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
            },
            saveMark() {
                fetch('/api/marks/update', {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(this.marks)
                }).then(response => {
                    return response.json();
                }).then(json => {
                    if (!json.success) {
                        M.toast({html: 'Произошла ошибка: ' + json.message})
                    }
                }).catch(ex => {
                    M.toast({html: 'Произошла ошибка: ' + ex});
                });
            }
        },
        beforeMount() {
            this.loadMarks();
        }
    }
</script>
