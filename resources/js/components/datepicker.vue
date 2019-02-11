<template>
    <div class="input-field col s12">
        <input type="text" name="date" id="date" class="datepicker">
        <label for="date">{{ label }}</label>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        name: "datepicker",
        props: ['date', 'label'],
        methods: {
            changeDate() {
                this.$emit('change', this.dateForMarks());
            },
            dateForMarks() {
                return moment(this.datepicker.date).format('YYYY-MM-DD');
            }
        },
        mounted() {
            this.datepicker = M.Datepicker.init(this.$el.querySelector('.datepicker'), {
                autoClose: true,
                format: 'dd.mm.yyyy',
                defaultDate: this.dateForPicker,
                setDefaultDate: true,
                onSelect: this.changeDate
            });
        },
        computed: {
            dateForPicker() {
                return moment(this.date, 'YYYY-MM-DD').toDate();
            }
        }
    }
</script>
