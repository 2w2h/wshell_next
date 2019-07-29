<template>
    <div class="row">
        <div class="col-lg-4" :key=chapter.link v-for="chapter in chapters">
            <a :href=chapter.link>
                <img :src=chapter.img width="200">
                <h3>{{ chapter.title }}</h3>
                <p>{{ chapter.anno }}</p>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                chapters: [{
                    'title': 'Юниты',
                    'anno': 'Настраиваемый набор инструментов для широкого круга вычислительных задач',
                    'link': '/units',
                    'img': 'img/chapters/unit.png'
                },{
                    'title': 'Карта',
                    'anno': 'Динамическая карта',
                    'link': '/map',
                    'img': 'img/chapters/map.png'
                },{
                    'title': 'Документация',
                    'anno': 'Различная справочная информация',
                    'link': '/docs',
                    'img': 'img/chapters/doc.png'
                }]
            };
        },
        methods: {}
    };
</script>

<style>
    h3 {
        text-decoration: none;
    }
</style>