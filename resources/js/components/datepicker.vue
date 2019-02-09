<template>
    <div class="input-field col s12">
        <input type="text" name="date" id="date" class="datepicker">
        <label for="date">Выбери дату</label>
    </div>
</template>

<script>
    export default {
        name: "datepicker",
        props: ['date'],
        methods: {
            changeDate() {
                this.$emit('change', this.datepicker.date);
            }
        },
        mounted() {
            console.log(this.date);
            this.datepicker = M.Datepicker.init(this.$el.querySelector('.datepicker'), {
                autoClose: true,
                format: 'dd.mm.yyyy',
                defaultDate: this.date,
                setDefaultDate: true,
                onSelect: this.changeDate
            });
        },
        watch: {
            date() {
                this.datepicker.setDate(this.date);
                return this.date;
            }
        }
    }
</script>
