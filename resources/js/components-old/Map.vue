<template>
    <b-container>
        <b-navbar toggleable="md" type="dark" variant="dark">
            <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

            <b-navbar-brand href="/chapters">wShell</b-navbar-brand>
            <span class="bread-arrow">➔</span>
            <b-navbar-nav class="ml-auto">
                <b-nav-item href="/map">Карта</b-nav-item>
            </b-navbar-nav>

            <b-collapse is-nav id="nav_collapse">
                <b-navbar-nav class="ml-auto">
                    <b-nav-item href="/profile">Профиль</b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
        <b-row style="margin-top: 1rem;">
            <b-col md="12">
                <select v-model=mode>
                    <option value="twoGis">2gis</option>
                    <option value="mapBox">mapBox</option>
                </select>
                <div id="map"></div>
                <pre id='info'></pre>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import mapboxgl from 'mapbox-gl';
    import $ from 'jquery';

    import DG from '2gis-maps';

    export default {
        data() {
            return {
                mode: 'mapBox',
                map: null
            };
        },
        watch: {
            mode(val) {
                this.changeMap(val);
            },
        },
        mounted() {
            this.changeMap(this.mode);
        },
        methods: {
            changeMap(name){
                if (name === 'mapBox') {
                    if (this.map) {
                        this.map.off();
                        this.map.remove();
                    }
                    this.mapBoxInit();
                }
                if (name === 'twoGis') {
                    $('#info').empty();
                    if (this.map) {
                        this.map.off();
                        this.map.remove();
                    }
                    this.twoGisInit();
                }
            },
            twoGisInit() {
                this.map = DG.map('map', {
                    'center': [55.02, 82.92],
                    'zoom': 12
                });
            },
            mapBoxInit() {
                mapboxgl.accessToken = 'pk.eyJ1IjoicGlsb3QxMTQiLCJhIjoiY2llb2lsNjhyMDBhenRpbTBvZ3didnJzcyJ9.91lZn7DeDvW-lKE5OSk_-A';
                this.map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/pilot114/cjpqjm8uo2jom2rp9fa21nafv',
                    center: [82.92, 55.02],
                    zoom: 12,
                });

                this.map.on('mousemove', function (e) {
                    e.lngLat.lng = e.lngLat.lng.toFixed(6);
                    e.lngLat.lat = e.lngLat.lat.toFixed(6);

                    document.getElementById('info').innerHTML =
                        JSON.stringify(e.point) + '<br />' +
                        JSON.stringify(e.lngLat);
                });

                $('.mapboxgl-ctrl-attrib').hide();
            },
        }
    };
</script>

<style>
    @import "~mapbox-gl/dist/mapbox-gl.css";

    body { margin:0; padding:0; }
    #map {
        width: auto;
        height: 45em;
    }

    #info {
        display: block;
        position: relative;
        margin: 0px auto;
        width: 50%;
        padding: 10px;
        border: none;
        border-radius: 3px;
        font-size: 12px;
        text-align: center;
        color: #222;
        background: #fff;
    }
</style>