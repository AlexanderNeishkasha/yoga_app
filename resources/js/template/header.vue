<style scoped>
    nav {
        position: relative;
        z-index: 10;
    }

    .brand-logo {
        display: inline-flex;
        align-items: center;
    }
</style>

<template>
    <div>
        <nav>
            <div class="nav-wrapper container">
                <router-link :to="{name: 'marks'}" class="brand-logo">
                    <img src="img/header_logo.png" alt="Logo">
                    Yoga
                </router-link>
                <a href="#" data-target="mobile-nav" class="right sidenav-trigger">
                    <i class="material-icons">menu</i>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <router-link v-for="link in navigation"
                                 :to="link.router"
                                 :key="link.router.name"
                                 tag="li"
                                 exact
                                 exact-active-class="active"
                    >
                        <a class="waves-effect">
                            {{ link.label }}
                        </a>
                    </router-link>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-nav">
            <router-link v-for="link in navigation"
                         :to="link.router"
                         :key="link.router.name"
                         tag="li"
                         exact
                         exact-active-class="active"
                         @click.native="closeSidebar"
            >
                <a class="waves-effect">
                    <i class="material-icons">{{ link.icon }}</i>
                    {{ link.label }}
                </a>
            </router-link>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'AppHeader',
        data() {
            return {
                navItems: {
                    auth: [
                        {
                            router: {
                                name: 'marks'
                            },
                            label: 'Отметки',
                            icon: 'check_box'
                        },
                        {
                            router: {
                                name: 'statistic'
                            },
                            label: 'Статистика',
                            icon: 'insert_chart'
                        },
                        {
                            router: {
                                name: 'logout'
                            },
                            label: 'Выход',
                            icon: 'exit_to_app'
                        }
                    ],
                    guest: [
                        {
                            router: {
                                name: 'auth'
                            },
                            label: 'Вход',
                            icon: 'account_box'
                        }
                    ]
                },
                sidebar: null
            }
        },
        computed: {
            navigation() {
                return this.$store.getters.checkLogin ? this.navItems.auth : this.navItems.guest;
            }
        },
        methods: {
            closeSidebar: function () {
                this.sidebar.close();
            }
        },
        mounted() {
            this.sidebar = M.Sidenav.init(document.querySelector('.sidenav'), {
                edge: 'right',
            });
        }
    }
</script>
