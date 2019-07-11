<template>
    <ul>
        <slot>
            <NavItem v-for="(item,index) in items" :key=index :href=index>{{ item }}</NavItem>
        </slot>
    </ul>
</template>

<script>
    import NavItem from "./NavItem";
    export default {
        name: 'Nav',
        components: {NavItem},
        mounted() {
        },
        props: {
            items: Object,
        },
    }
</script>

<style scoped>
    ul {
        display: flex;
        flex-direction: column;
        padding-left: 0;
        margin: 0 0 10px 0;
    }
</style>