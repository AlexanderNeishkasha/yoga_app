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
    import axios from 'axios';
    import {toast} from 'materialize-css';
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
                axios.get('api/marks/get', {
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + this.$store.getters.token
                    },
                    params: {
                        date: this.marks.date
                    }
                }).then(response => {
                    return response.data;
                }).then(json => {
                    if (json.success) {
                        this.marks = json.data.marks;
                    } else {
                        throw new Error(json.message);
                    }
                }).catch(ex => {
                    toast({html: 'Произошла ошибка: ' + ex.message})
                }).finally(() => {
                    this.loading = false;
                });
            },
            saveMark() {
                axios.post('api/marks/update', {...this.marks}, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + this.$store.getters.token
                    }
                }).then(response => {
                    return response.data;
                }).then(json => {
                    if (!json.success) throw new Error(json.message);
                    if (json.notify) toast({html: json.notify});
                }).catch(ex => {
                    toast({html: 'Произошла ошибка: ' + ex.message});
                });
            }
        },
        beforeMount() {
            this.loadMarks();
        }
    }
</script>
