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
            <h3>
                Общие сведения
            </h3>
            <p>
                Переработка/утилизация отходов — обработка отходов с целью их безопасного уничтожения
                или обеспечения повторного использования в народном хозяйстве полученных сырья, энергии, изделий и материалов.
            </p>
            <p>
                Вторичное сырьё - всё, что пригодно для переработки с целью повторного использования.
                <br>
                Виды вторичного сырья (для каждого вида отходов есть соответствующая технология переработки):
            </p>
            <ul>
                <li>Макулатура: бумага, картон, газеты, текстиль</li>
                <li>Стекло: стеклотара, стеклобой</li>
                <li>Металлолом: чёрный, цветной</li>
                <li>
                    Пластмассы: полиэтилентерефталат (ПЭТ), поливинилхлорид (ПВХ), полиэтилен высокого давления (ПВД) и низкого (ПНД), АБС-пластик, полистирол (ПС)
                    <a href="https://habr.com/ru/post/450342/" target="_blank">Про маркировки и определение типов пластмасс</a>
                </li>
                <li>Электроника: платы, аккумуляторы, провода</li>
                <li>Резина</li>
            </ul>

            <h3>
                В России
            </h3>

            <a target="_blank" href="https://ru.wikipedia.org/wiki/%D0%A0%D0%B5%D1%84%D0%BE%D1%80%D0%BC%D0%B0_%D0%BE%D0%B1%D1%80%D0%B0%D1%89%D0%B5%D0%BD%D0%B8%D1%8F_%D1%81_%D0%BE%D1%82%D1%85%D0%BE%D0%B4%D0%B0%D0%BC%D0%B8_%D0%BF%D1%80%D0%BE%D0%B8%D0%B7%D0%B2%D0%BE%D0%B4%D1%81%D1%82%D0%B2%D0%B0_%D0%B8_%D0%BF%D0%BE%D1%82%D1%80%D0%B5%D0%B1%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F_%D0%B2_%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D0%B9%D1%81%D0%BA%D0%BE%D0%B9_%D0%A4%D0%B5%D0%B4%D0%B5%D1%80%D0%B0%D1%86%D0%B8%D0%B8">
                Реформа обращения с отходами производства и потребления в Российской Федерации
            </a>
            <br>
            <a target="_blank" href="https://reo.ru/">Российский экологический оператор</a>
            <br>
            <a target="_blank" href="https://ecologynsk.ru">Новосибирский региональный оператор ТКО</a>
            <br>
            <a target="_blank" href="https://vk.com/ecologynsk?w=wall-152652112_1826">
                Кто за что отвечает?
            </a>

            <p>
                РЭО занимается созданием комплексной системы обращения с твердыми коммунальными отходами (ТКО) по России.
                На местах (т.е. в регионах) работают местные операторы ТКО. Договоры заключаются на период не более 10 лет,
                на конкурсной основе.
                Оператор, в свою очередь, обязан заключить договор со всеми предприятиями, которые являются источниками образования отходов.
            </p>

            <h3>Экологические организации НСК</h3>
            <a href="https://vk.com/izdrevaya_nsk">https://vk.com/izdrevaya_nsk</a><br>
            <a href="https://vk.com/arctica_city">https://vk.com/arctica_city</a><br>
            <a href="https://vk.com/krishki_enota_nsk">https://vk.com/krishki_enota_nsk</a><br>

            <h3>Разное</h3>
            <a href="http://tkorus.ru/razdelnyy-sbor-othodov/karta-konteynerov-rso.html">КАРТА КОНТЕЙНЕРОВ раздельного сбор мусора</a>
        </template>
    </Layout>
</template>

<script>
    import DG from '2gis-maps';
    import Layout from "../../components/Layout";
    import Nav from "../../components/Nav";

    export default {
        name: "Theory",
        components: { Layout, Nav },
        mounted() {
        },
        methods: {
        }
    }
</script>

<style scoped>
</style>
