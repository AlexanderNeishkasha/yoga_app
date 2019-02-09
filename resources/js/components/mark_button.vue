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
        >
            {{ btnText }}
        </button>
    </div>
</template>

<script>
    export default {
        name: "mark_button",
        props: ['button'],
        computed: {
            btnText() {
                let txt = this.button.status ? 'Я не занимался ' : 'Я занимался ';
                txt += this.button.time == 'morning' ? 'утром' : 'вечером';
                return txt;
            },
            btnClass() {
                return this.button.status ? 'red' : '';
            }
        }
    }
</script>

<style scoped>

</style>
