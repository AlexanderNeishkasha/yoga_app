<template>
    <div id="auth">
        <app-telegram-login
                mode="callback"
                telegram-login="yoga_appliction_test_bot"
                size="large"
                :userpic="false"
                radius="0"
                @callback="auth">
        </app-telegram-login>
    </div>
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
    #auth {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }
</style>
