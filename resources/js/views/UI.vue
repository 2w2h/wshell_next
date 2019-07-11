<template>
    <Layout>
        <template #header>
            <h3>Библиотека wShell UI</h3>
            <hr>
        </template>
        <template #aside>
            <h4>Компоновка</h4>
            <Nav :items="{'#Layout': 'Layout', '#Set': 'Set'}">
            </Nav>
            <h4>Ввод</h4>
            <Nav :items="{
                '#Text': 'Text',
                '#Enum': 'Enum',
                '#Bool': 'Bool',
                '#Range': 'Range',
                '#Email': 'Email',
                '#Color': 'Color',
                '#Time': 'Time',
                '#File': 'File'
                }">
            </Nav>
            <h4>Остальное</h4>
            <Nav :items="{'#Nav': 'Nav', '#Source': 'Source'}">
            </Nav>
        </template>
        <template #main>
            <h3>Layout</h3>
            <p>Основной компонент, отвечающий за расположение блоков страницы и общие стили</p>
            <highlight-code lang="javascript" :code="`
                let b = 123;
                <div>asd</div>
                const = 345;
            `">
            </highlight-code>

            <h3>Nav</h3>
            <p>
                Меню навигации, cоздает список внутренних ссылок (router-link). <br>
                Поведение по умолчанию можно переопределить помощью NavItem
            </p>
            <h3>Set</h3>
            <p>Отвечает за горизонтальное размещение дочерних компонентов</p>
        </template>
    </Layout>
</template>

<script>
    import Layout from '../components/Layout'
    import Nav from "../components/Nav";
    import NavItem from "../components/NavItem";

    import Vue from 'vue';
    import VueHighlightJS from 'vue-highlight.js';
    import 'vue-highlight.js/lib/allLanguages';
    import 'highlight.js/styles/obsidian.css';
    // import 'highlight.js/styles/agate.css';
    // import 'highlight.js/styles/zenburn.css';
    // import 'highlight.js/styles/darcula.css';
    Vue.use(VueHighlightJS);

    export default {
        components: {NavItem, Nav, Layout},
        mounted() {},
    }
</script>

<style scoped>

</style>