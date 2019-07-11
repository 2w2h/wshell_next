<template>
    <div>
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
</template>

<script>
    import Layout from '../components/Layout'

    export default {
        components: {Layout},
        mounted() {
        },
    }
</script>
