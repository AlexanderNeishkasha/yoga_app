<style scoped>
    .btn-wrap {
        margin: 15px 0;
    }
</style>

<template>
    <div class="col s12 center-align btn-wrap">
        <button type="button"
                class="btn-large waves-effect waves-light col s12"
                :class="btnClass"
                @click="$emit('change')"
        >
            {{ btnText }}
        </button>
    </div>
</template>

<script>
    export default {
        name: "mark_button",
        props: ['time', 'status'],
        computed: {
            btnText() {
                let txt = !this.status ? 'Я не занимался ' : 'Я занимался ';
                txt += this.time == 'morning' ? 'утром' : 'вечером';
                return txt;
            },
            btnClass() {
                return !this.status ? 'red' : '';
            }
        }
    }
</script>
