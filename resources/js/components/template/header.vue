<template>
    <div>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Yoga</a>
                <a href="#" data-target="mobile-nav" class="right sidenav-trigger">
                    <i class="material-icons">menu</i>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li v-for="link in navItems">
                        <router-link :to="link.router">{{ link.label }}</router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-nav">
            <li v-for="link in navItems">
                <router-link :to="link.router">{{ link.label }}</router-link>
            </li>
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
                        label: 'Marks'
                    }
                ]
            }
        }
    }
</script>
