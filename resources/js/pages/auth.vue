<template>
    <app-telegram-login
            mode="callback"
            telegram-login="yoga_application_bot"
            size="large"
            @callback="auth">
    </app-telegram-login>
</template>

<script>
    import AppTelegramLogin from '../components/telegram_login';

    export default {
        name: "auth",
        components: {
            AppTelegramLogin
        },
        methods: {
            auth(user) {
                console.log(user);
            }
        }
    }
</script>

<style scoped>

</style>
