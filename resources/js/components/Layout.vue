<template>
    <div class="w_layout">
        <div :class="['w_layout_center', without_aside ? 'w_layout_center_without_aside' : '' ]">
            <header class="w_layout_header">
                <slot name="header"></slot>
            </header>
<!--            TODO: может сжиматься до фиксированных 40 px-->
            <aside class="w_layout_aside" v-if="!without_aside">
                <slot name="aside"></slot>
            </aside>
            <main class="w_layout_main">
                <slot name="main"></slot>
            </main>
            <footer class="w_layout_footer">
                <slot name="footer"></slot>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Layout',
        props: {
            without_aside: Boolean,
            default: false
        },
        mounted() {}
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap');

    html, body, .w_layout {
        height: 100%;
        width: 100%;
        box-sizing: border-box;

        font-family: 'Source Sans Pro', sans-serif;
    }
    img,video {
        max-width:100%;
    }
    .w_layout_center {
        height: 100%;
        max-width: 1100px;
        margin: auto;

        background-color: white;

        display: grid;
        grid-template:
                "header header header header"
                "aside main main main" 1fr
                "footer footer footer footer" 1fr
                / 210px 1fr;
    }
    .w_layout_center_without_aside {
        grid-template:
            "header header header header"
            "main  main main main" 1fr
            "footer footer footer footer"
                / 210px 1fr;
    }
    header {
        grid-area: header;
        padding: 20px;
    }
    aside {
        grid-area: aside;
        padding: 20px;
    }
    main {
        grid-area: main;
        padding: 20px;
    }
    footer {
        grid-area: footer;
        padding: 20px;
    }
</style>
