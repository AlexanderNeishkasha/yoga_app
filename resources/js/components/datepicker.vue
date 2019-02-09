<template>
    <div class="input-field col s12">
        <input type="text" name="date" id="date" class="datepicker">
        <label for="date">Выбери дату</label>
    </div>
</template>

<script>
    export default {
        name: "datepicker",
        mounted() {
            this.datepicker = M.Datepicker.init(this.$el.querySelector('.datepicker'), {
                autoClose: true,
                format: 'dd.mm.yyyy',
                defaultDate: new Date(),
                setDefaultDate: true
            });
        }
    }
</script>
