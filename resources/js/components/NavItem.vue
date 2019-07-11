<template>
    <li :class="{ active: isActive }">
        <template v-if="hrefType === 'anchor'">
            <a :href=href>
                <slot></slot>
            </a>
        </template>
        <template v-else-if="hrefType === 'outer'">
            <a :href=href target="_blank">
                <slot></slot>
            </a>
        </template>
        <template v-else-if="hrefType === 'router_path'">
            <a @click="$router.push({ path: href })" tabindex="0" @keyup.enter="$event.target.click()">
                <slot></slot>
            </a>
        </template>
        <template v-else>
            <a @click="$router.push({ name: href })" tabindex="0" @keyup.enter="$event.target.click()">
                <slot></slot>
            </a>
        </template>
    </li>
</template>

<script>
    export default {
        name: 'NavItem',
        mounted() {
            if (this.href.startsWith('#')) {
                this.isActive = (window.location.hash === this.href);
            }
            if (this.href.startsWith('/')) {
                this.isActive = ((window.location.pathname + window.location.hash) === this.href);
            }

            this.$router.beforeEach((to, from, next) => {
                let match = window.location.pathname;
                if (this.href.startsWith('#')) {
                    match = window.location.pathname + this.href;
                }
                this.isActive = ((to.path + to.hash) === match);
                next();
            })
        },
        props: {
            /**
             *  Ссылка навигации. Может быть локальная (начинается с #), внешняя (начинается с http)
             *  или роут: path если начинается с / или name в остальных случаях.
             *  Параметризованные маршруты не поддерживаются за ненадобностью
             */
            href: String,
        },
        data() {
            return {
                isActive: false
            }
        },
        computed: {
            hrefType() {
                if (this.href.startsWith('#')) {
                    return 'anchor';
                }
                if (this.href.startsWith('http')) {
                    return 'outer';
                }
                if (this.href.startsWith('/')) {
                    return 'router_path';
                }
                return 'router_path';
            }
        },
    }
</script>

<style scoped>
    li:first-child {
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
    }

    li {
        display: block;
        margin-bottom: -1px;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, .125);
    }

    li:last-child {
        margin-bottom: 0;
        border-bottom-right-radius: .25rem;
        border-bottom-left-radius: .25rem;
    }

    li:hover {
        background-color: #e2e6ea;
        cursor: pointer;
    }

    a {
        display:block;
        padding: .75rem 1.25rem;
        color: black;
        text-decoration: none;
    }

    li.active {
        background-color: black;
    }

    li.active > a {
        color: white;
    }

    li.active > a:focus {
        outline: none;
    }

</style>