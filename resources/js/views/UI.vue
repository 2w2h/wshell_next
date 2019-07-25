<template>
    <Layout>
        <template #header>
            <h3>Библиотека wShell UI</h3>
            Vue Styleguidist
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
            <Nav :items="{'#Nav': 'Nav', '#Source': 'Source', '#Spoiler': 'Spoiler'}">
            </Nav>
        </template>
        <template #main>
            <h3>Layout</h3>
            <p>Основной компонент, отвечающий за расположение блоков страницы и общие стили</p>
            <Spoiler summary="Пример">
                <Layout>
                    <template #header>#header</template>
                    <template #aside>#aside</template>
                    <template #main>#main</template>
                    <template #footer>#footer</template>
                </Layout>
            </Spoiler>

            <h3>Set</h3>
            <p>Отвечает за горизонтальное размещение дочерних компонентов</p>
            <Spoiler summary="Пример">
                <Set>
                    <SetItem :cols="1">col1-3 <br>
                        много букв много букв много букв много букв много букв много букв
                        много букв много букв много букв много букв много букв много букв
                    </SetItem>
                    <SetItem></SetItem>
                    <SetItem>col5 <br>
                        много букв много букв много букв много букв много букв много букв
                        много букв много букв много букв много букв много букв много букв
                    </SetItem>
                    <SetItem>col6 <br>
                        много букв много букв много букв много букв много букв много букв
                        много букв много букв много букв много букв много букв много букв
                    </SetItem>
                </Set>
            </Spoiler>

            <h3>Nav</h3>
            <p>
                Меню навигации, cоздает список внутренних ссылок (router-link). <br>
                Поведение по умолчанию можно переопределить помощью NavItem
            </p>

            <h3>Source</h3>
            <p>Отображение исходного кода</p>
            <Spoiler summary="Пример">
                <Source :code="`
                    let b = 123;
                    <div>asd</div>
                    const = 345;
                `">
                </Source>
            </Spoiler>

            <h3>Spoiler</h3>
            <p>Сворачивание контента</p>



            <h3>Preview</h3>
            <p>
                Блок предварительного просмотра результата выполнения кода
            </p>

            <Preview :code="`
                <h1>header</h1>
            `"></Preview>
        </template>
    </Layout>
</template>

<script>
    import Layout from '../components/Layout'
    import Nav from "../components/Nav";
    import NavItem from "../components/NavItem";
    import Source from "../components/Source";
    import Set from "../components/Set";
    import SetItem from "../components/SetItem";
    import Preview from "../components/doc/Preview";
    import Spoiler from "../components/Spoiler";

    export default {
        components: {Spoiler, Preview, Nav, NavItem, Layout, Source, Set, SetItem},
    }
</script>
