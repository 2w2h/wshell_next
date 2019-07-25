<template>
    <highlight-code lang="javascript" :code="code">
        <slot></slot>
    </highlight-code>
</template>

<script>
    import Vue from 'vue';
    import VueHighlightJS from 'vue-highlight.js';
    import 'vue-highlight.js/lib/allLanguages';
    import 'highlight.js/styles/obsidian.css';
    // import 'highlight.js/styles/agate.css';
    // import 'highlight.js/styles/zenburn.css';
    // import 'highlight.js/styles/darcula.css';
    Vue.use(VueHighlightJS);

    export default {
        name: "Source",
        props: {
            code: String
        }
    }
</script>

<style scoped>
</style>
