<style scoped>

</style>

<template>
    <div id="marks">
        <form action="/api/mark">
            <div class="row">
                <app-datepicker></app-datepicker>
                <app-mark-button :time="'утром'"></app-mark-button>
                <app-mark-button :time="'вечером'"></app-mark-button>
            </div>
        </form>
    </div>
</template>

<script>
    import AppDatepicker from '../components/datepicker';
    import AppMarkButton from '../components/mark_button';
    export default {
        name: "marks",
        components: {
            AppDatepicker,
            AppMarkButton
        }
    }
</script>
