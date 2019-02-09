<template>
    <div>
        <app-header></app-header>
        <router-view></router-view>
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
