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
                Пока выбираем только пункты платного приёма -
                сделать интерфес модерации, где можно подгружать данные из источников
                и выбирать - игнорировать, использовать, отложить (будет в бд как пока неактивное)

                https://2gis.ru/novosibirsk/rubrics
                https://asktel.ru/novosibirsk
                https://sfo.spr.ru/novosibirsk-i-novosibirskiy-rayon
                http://orgpage.ru/areas/novosibirsk

                https://2gis.ru/novosibirsk/search/%D0%A3%D1%82%D0%B8%D0%BB%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D1%8F%20%D0%BE%D1%82%D1%85%D0%BE%D0%B4%D0%BE%D0%B2%20%2F%20%D0%92%D1%82%D0%BE%D1%80%D1%81%D1%8B%D1%80%D1%8C%D1%91/rubricId/476?queryState=center%2F82.93725%2C55.05453%2Fzoom%2F13
                http://nsk-makulatura.ru/price/

                https://catalog.api.2gis.ru/3.0/items?viewpoint1=82.72705032617188%2C55.156120243049266&viewpoint2=83.22418167382813%2C54.820074362077435&type=street%2Cadm_div.city%2Ccrossroad%2Cadm_div.settlement%2Cstation%2Cbuilding%2Cadm_div.district%2Croad%2Cadm_div.division%2Cadm_div.region%2Cadm_div.living_area%2Cattraction%2Cadm_div.place%2Cadm_div.district_area%2Cbranch%2Cparking%2Cgate%2Croute&page=1&page_size=12&sort=rating&q=%D0%BF%D1%83%D0%BD%D0%BA%D1%82%D1%8B%20%D0%BF%D1%80%D0%B8%D0%B5%D0%BC%D0%B0&locale=ru_RU&fields=request_type%2Citems.adm_div%2Citems.context%2Citems.attribute_groups%2Citems.contact_groups%2Citems.flags%2Citems.address%2Citems.rubrics%2Citems.name_ex%2Citems.point%2Citems.geometry.centroid%2Citems.region_id%2Citems.segment_id%2Citems.external_content%2Citems.org%2Citems.group%2Citems.schedule%2Citems.timezone_offset%2Citems.ads.options%2Citems.stat%2Citems.reviews%2Citems.purpose%2Csearch_type%2Ccontext_rubrics%2Csearch_attributes%2Cwidgets%2Cfilters&stat%5Bsid%5D=94a1e528-5981-4421-b048-71261cef54eb&stat%5Buser%5D=5ef3aacd-d4f8-454a-a98f-ceededf1f103&key=rutnpt3272&r=529789110
                http://novosibirsk.spravkarf.ru/search/%D0%BF%D1%83%D0%BD%D0%BA%D1%82%D1%8B%20%D0%BF%D1%80%D0%B8%D0%B5%D0%BC%D0%B0?center=54.92418256615949,82.88257598876955&zoom=11
                http://www.orgpage.ru/novosibirsk/жкх_и_благоустройство/ +++
                http://nsk.bpages.ru/cat/48/54/ +++
                https://novosibirsk.yp.ru/list/ekologicheskie_sluzhby_i_organizatsii/
                http://nsib.su/companies/smallsection292.html
            </p>

            <p>
                Различная собранная информация -
                + всё что на карте, но таблицей:
                покрытие (на карте + таблично)
            </p>

            <p>
                Компании: приём / пункты приёма!!!! / произодство / переработка / ЖКО и УК (вывоз мусора), клининговые
                фильтры по типам сырья
            </p>

            <p>
                тарифы и цены на приём + объёмы сдачи
            </p>

            <p>
                списки опроса людей
            </p>

            <p>
                магазины - фильтры: все магазины, супер/гипер-маркеты, ТЦ, киоски, бары-рестораны(стекло)
            </p>

        </template>
    </Layout>
</template>

<script>
    import Layout from "../../components/Layout";
    import Nav from "../../components/Nav";

    export default {
        name: "Database",
        components: { Layout, Nav },
        mounted() {
        },
        methods: {
        }
    }
</script>

<style scoped>
</style>
