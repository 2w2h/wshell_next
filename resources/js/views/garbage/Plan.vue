<template>
    <Layout>
        <template #header>
            <h3>Сбор и переработка мусора в Новосибирске</h3>
            <hr>
        </template>
        <template #aside>
            <Nav :items="{
                '/garbage/map': 'Карта',
                '/garbage/bd': 'База данных',
                '/garbage/docs': 'Документы',
                '/garbage/plan': 'План',
                '/garbage/theory': 'Теория',
            }">
            </Nav>
        </template>
        <template #main>
            <p>
                идеи
                Общий бизнес план - объёмы сбора, территория покрытия, план выручки
                направления для развития

                график сбора
            </p>
        </template>
    </Layout>
</template>

<script>
    import DG from '2gis-maps';
    import Layout from "../../components/Layout";
    import Nav from "../../components/Nav";

    export default {
        name: "Plan",
        components: { Layout, Nav },
        mounted() {
        },
        methods: {
        }
    }
</script>

<style scoped>
</style>
