<style scoped>
    #content {
        margin-top: 30px;
    }
</style>
<template>
    <div>
        <app-header></app-header>
        <div class="container" id="content">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import AppHeader from './header';

    export default {
        name: 'AppTemplate',
        components: {
            AppHeader
        }
    }
</script>
