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
                Бухгалтерия - доход / расход / налоговая декларация, чеки, накладные(полготоска партии), счет-фактура(получение партии), акт выполненых работ
            </p>
            <p>
                распечатки - объявления, визитки, коммерч.предложение
            </p>
            <p>
                контракты(более строгие условия) и договоры
            </p>
            <p>
                Прайс на услуги
            </p>
        </template>
    </Layout>
</template>

<script>
    import DG from '2gis-maps';
    import Layout from "../../components/Layout";
    import Nav from "../../components/Nav";

    export default {
        name: "Docs",
        components: { Layout, Nav },
        mounted() {
        },
        methods: {
        }
    }
</script>

<style scoped>
</style>
