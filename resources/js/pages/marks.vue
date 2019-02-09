<style scoped>

</style>

<template>
    <div id="marks">
        <form v-if="!loading">
            <div class="row">
                <app-datepicker :date="this.marks.date" @change="changeDate"></app-datepicker>
                <app-mark-button :time="'morning'" :status="this.marks.morning"
                                 @change="changeMorning"></app-mark-button>
                <app-mark-button :time="'evening'" :status="this.marks.evening"
                                 @change="changeEvening"></app-mark-button>
            </div>
        </form>
        <app-loader v-else></app-loader>
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
                    date: new Date(),
                    morning: false,
                    evening: false,
                },
                loading: true
            }
        },
        methods: {
            changeMorning() {
                this.marks.morning = !this.marks.morning;
            },
            changeEvening() {
                this.marks.evening = !this.marks.evening;
            },
            changeDate(date) {
                this.marks.date = date;
            },
            loadMarks() {
                this.loading = true;
                let url = new URL('api/marks/get', window.location.protocol + '//' + window.location.host);
                url.search = new URLSearchParams([['date', moment(this.marks.date).format('YYYY-MM-DD')]]);
                fetch(url, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(function(response) {
                    return response.json();
                }).then(function(json) {
                    if (json.success) {
                        json.data.marks.date = moment(json.data.marks.date, 'YYYY-MM-DD').toDate();
                        this.marks = json.data.marks;
                    } else {
                        M.toast({html: 'Произошла ошибка: ' + json.message})
                    }
                }.bind(this)).catch(function(ex) {
                    M.toast({html: 'Произошла ошибка: ' + ex})
                }).finally(function() {
                    this.loading = false;
                }.bind(this));
            },
        },
        beforeMount() {
            this.loadMarks();
        }
    }
</script>
