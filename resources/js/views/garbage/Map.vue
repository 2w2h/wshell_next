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
            <div id="map"></div>
        </template>
    </Layout>
</template>

<script>
    import DG from '2gis-maps';
    import Layout from "../../components/Layout";
    import Nav from "../../components/Nav";

    export default {
        name: "Map",
        components: { Layout, Nav },
        mounted() {
            this.twoGisInit();
        },
        methods: {
            twoGisInit() {
                this.map = DG.map('map', {
                    'center': [55.02, 82.92],
                    'zoom': 12,
                });

                DG.marker([55.02, 82.92]).addTo(this.map).bindPopup('Вы кликнули по мне!');


                // координатный прямоугольник
                var southWest = DG.latLng(55.01, 82.91),
                    northEast = DG.latLng(55.03, 82.93),
                    cBounds = DG.latLngBounds(southWest, northEast);
                // собрать автоматом по точкам, чтобы сделать по ним map.fitBounds([latLngBounds]);
                // DG.latLngBounds( <LatLng[]> latlngs)

                // this.map.fitBounds(cBounds);

                // пиксельный прямоугольник
                // var p1 = DG.point(10, 10),
                //     p2 = DG.point(40, 60),
                //     pBounds = DG.bounds(p1, p2);

                // слой
                // var layer = DG.Marker(latlng).addTo(map);
                // layer.addTo(map);
                // layer.remove();
            },
        }
    }
</script>

<style scoped>
    #map {
        width: auto;
        height: 45em;
    }
</style>
