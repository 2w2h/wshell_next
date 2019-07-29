<template>
    <Layout without_aside>
        <template #header>
            <h3>Юниты</h3>
            <hr>
        </template>
        <template #main>
            123
        </template>
    </Layout>
</template>

<script>
    import Layout from '../../components/Layout'
    import Nav from "../../components/Nav";
    import Set from "../../components/Set";
    import SetItem from "../../components/SetItem";

    export default {
        components: {Nav, Layout, Set, SetItem},
    }
</script>
