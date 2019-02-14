<template>
    <div>
        <transition enter-active-class="animated fadeIn"
                    leave-active-class="animated fadeOut"
                    appear
        >
            <div id="auth" v-if="!loading">
                <app-telegram-login mode="callback"
                                    :telegram-login="telegramLogin"
                                    size="large"
                                    :userpic="false"
                                    radius="2"
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
                this.loading = true;
                axios.post('api/auth', {
                    ...user
                }).then(response => {
                    return response.data;
                }).then(response => {
                    if (response.success) {
                        this.$store.dispatch('setToken', response.data.token);
                        this.$store.dispatch('setUser', response.data.user);
                        this.$router.push({name: 'marks'});
                    } else {
                        throw new Error(response.message);
                    }
                }).catch(exception => {
                    M.toast({html: exception.message});
                }).finally(() => {
                    this.loading = false;
                });
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
        position: fixed;
        width: 100%;
        bottom: 0;
        margin-bottom: 30px;
        left: 0;
    }
</style>
