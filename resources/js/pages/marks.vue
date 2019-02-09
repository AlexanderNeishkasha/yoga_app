<style scoped>

</style>

<template>
    <div id="marks">
        <form action="/api/mark">
            <div class="row">
                <app-datepicker></app-datepicker>
                <app-mark-button v-for="button in buttons" :button="button" :key="button.time"></app-mark-button>
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
        },
        data() {
            return {
                buttons: [
                    {
                        time: 'morning',
                        status: false
                    },
                    {
                        time: 'evening',
                        status: true
                    }
                ]
            }
        }
    }
</script>
