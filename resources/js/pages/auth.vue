<template>
    <div>
        <transition enter-active-class="animated fadeIn"
                    leave-active-class="animated fadeOut"
                    mode="out-in"
                    appear
        >
            <div id="auth" v-if="!loading">
                <app-telegram-login mode="callback"
                                    :telegram-login="telegramLogin"
                                    size="large"
                                    :userpic="false"
                                    radius="0"
                                    @callback="auth">
                </app-telegram-login>
            </div>
            <app-loader v-else></app-loader>
        </transition>
    </div>
</template>

<script>
    import axios from 'axios';
    import AppTelegramLogin from '../components/telegram_login';
    import AppLoader from '../components/loader';

    export default {
        name: "auth",
        components: {
            AppTelegramLogin,
            AppLoader
        },
        data() {
            return {
                telegramLogin: false,
                loading: true
            }
        },
        methods: {
            auth(user) {
                console.log(user);
            }
        },
        beforeMount() {
            axios.get('api/tg/login').then(response => {
                return response.data;
            }).then(response => {
                if (response.success) {
                    this.telegramLogin = response.data;
                }
                this.loading = false;
            });
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
