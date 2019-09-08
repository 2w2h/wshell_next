<template>
    <div class="card">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "Card",
    }
</script>

<style scoped>
    .card {
        border: 1px solid;
        border-radius: 3px;
        padding: 5px;
    }
</style>
