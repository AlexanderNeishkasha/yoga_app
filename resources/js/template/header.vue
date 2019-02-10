<style scoped>
    nav {
        position: relative;
        z-index: 10;
    }
</style>

<template>
    <div>
        <nav>
            <div class="nav-wrapper container">
                <a href="#" class="brand-logo">Yoga</a>
                <a href="#" data-target="mobile-nav" class="right sidenav-trigger">
                    <i class="material-icons">menu</i>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <router-link v-for="link in navItems"
                                 :to="link.router"
                                 :key="link.router.name"
                                 tag="li"
                                 active-class="active"
                    >
                        <a class="waves-effect">{{ link.label }}</a>
                    </router-link>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-nav">
            <router-link v-for="link in navItems"
                         :to="link.router"
                         :key="link.router.name"
                         tag="li"
                         active-class="active"
                         @click.native="closeSidebar"
            >
                <a class="waves-effect">{{ link.label }}</a>
            </router-link>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'AppHeader',
        data() {
            return {
                navItems: [
                    {
                        router: {
                            name: 'marks'
                        },
                        label: 'Отметки'
                    },
                    {
                        router: {
                            name: 'statistic'
                        },
                        label: 'Статистика'
                    }
                ],
                sidebar: null
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
