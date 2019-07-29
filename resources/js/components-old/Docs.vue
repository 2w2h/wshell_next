<template>
    <b-container>
        <b-navbar toggleable="md" type="dark" variant="dark">
            <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

            <b-navbar-brand href="/">wShell</b-navbar-brand>
            <span class="bread-arrow">➔</span>
            <b-navbar-nav class="ml-auto">
                <b-nav-item href="/docs">Документация</b-nav-item>
            </b-navbar-nav>

            <b-collapse is-nav id="nav_collapse">
                <b-navbar-nav class="ml-auto">
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
        <b-row style="margin-top: 1rem;">
            <b-col md="3">
                <b-form-input
                        v-model="search"
                        type="text"
                        placeholder="Поиск книги"
                ></b-form-input>
                <ul id="menu">
                    <li class="item item-h3" v-for="item in searchResult">
                        <a href="#">{{ item }}</a>
                    </li>
                </ul>
            </b-col>
            <b-col md="9">
                <p>
                    Тут собраны статьи, заметки и просто мысли на техническую тематику.
                    Кое-что даже можно с натяжкой назвать документацией.
                    Тексты одной тематики объединены в "Главы" и "Книги".
                </p>
                <p>
                    Например, чтобы почитать про устройство сайта, нужно выбрать книгу "wShell"
                </p>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
//    import Vue from 'vue';
/*
$('pre').addClass('prettyprint');
PR.prettyPrint();

    <link rel="stylesheet" href="{{ asset('css/my/obsidian.css') }}">
*/
    export default {
        data() {
            return {
                search: null,
                data: ['wShell', 'Nginx', 'Kibana']
            };
        },
        computed: {
            searchResult() {
                if (!this.search)  {
                    return [];
                }
                return this.data.filter(item => item.indexOf(this.search) !== -1);
            }
        },
    };
</script>

<style>
    body {
        background: url(/img/bg-texture.jpg) repeat center top fixed;
    }
    #menu {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    #menu li.item:hover {
        background-color:rgba(0, 0, 0, 0.1);
    }
    #menu li.item-h2 {
        border-top: 1px solid rgba(0,0,0, 0.15);
        font-size: 18px;
    }
    #menu li.item-h3 {
        font-size: 16px;
    }
    #menu a {
        color: rgba(0,0,0, 0.6);
        text-decoration: none;
        display: block;
        padding: 5px 10px;
        border: 0 none;
    }
</style>