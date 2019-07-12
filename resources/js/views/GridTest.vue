<template>
    <Layout without_aside>
        <template #header>
            <h3>grid test</h3>
            <hr>
        </template>
        <template #main>
            <grid-layout
                    class="blockPanel"
                    :layout.sync="blocks"
                    :col-num="20"
                    :row-height="30"
                    :is-draggable="true"
                    :is-resizable="true"
                    :is-mirrored="false"
                    :vertical-compact="false"
                    :margin="[10, 10]"
                    :use-css-transforms="true"
                    @layout-updated="unfreeze"
            >

                <grid-item v-for="block in blocks"
                           :key="block.i"
                           :class="['block', block.static === true ? 'blockStatic' : '']"
                           :x="block.x"
                           :y="block.y"
                           :w="block.w"
                           :h="block.h"
                           :i="block.i"
                           :static="block.static"
                           @move="freeze(block)"
                >
                    #{{ block.i }}
                    #{{ block.static }}
                </grid-item>
            </grid-layout>
        </template>
    </Layout>
</template>

<script>
    import Layout from '../components/Layout'
    import VueGridLayout from 'vue-grid-layout'

    export default {
        components: {
            Layout,
            GridLayout: VueGridLayout.GridLayout,
            GridItem: VueGridLayout.GridItem
        },
        mounted() {
            this.blocks[0].h = 6;
        },
        methods: {
            freeze(block) {
                if (this.frized) return;
                this.blocks = this.blocks.map(x => {
                    if (x.i !== block.i) {
                        x.static = true;
                    }
                    return x;
                });
                this.frized = true;
            },
            unfreeze(block) {
                this.blocks = this.blocks
                    .map(x => {
                        x.static = false;
                        return x;
                    });
                this.frized = false;
            },

        },
        data() {
            return {
                frized: false,
                blocks: [
                    {"x":0,"y":0,"w":2,"h":2,"i":"0"},
                    {"x":2,"y":0,"w":2,"h":2,"i":"1"},
                    {"x":4,"y":0,"w":2,"h":2,"i":"2"},
                    {"x":6,"y":0,"w":2,"h":2,"i":"3"},
                    {"x":8,"y":0,"w":2,"h":2,"i":"4"},
                    {"x":10,"y":0,"w":2,"h":2,"i":"5"},
                    {"x":0,"y":5,"w":2,"h":2,"i":"6"},
                    {"x":2,"y":5,"w":2,"h":2,"i":"7"},
                    {"x":4,"y":5,"w":2,"h":2,"i":"8"},
                    {"x":6,"y":3,"w":2,"h":2,"i":"9"},
                    {"x":8,"y":4,"w":2,"h":2,"i":"10"},
                    {"x":10,"y":4,"w":2,"h":2,"i":"11"},
                    {"x":0,"y":10,"w":2,"h":2,"i":"12"},
                    {"x":2,"y":10,"w":2,"h":2,"i":"13"},
                    {"x":4,"y":8,"w":2,"h":2,"i":"14"},
                    {"x":6,"y":8,"w":2,"h":2,"i":"15"},
                    {"x":8,"y":10,"w":2,"h":2,"i":"16"},
                    {"x":10,"y":4,"w":2,"h":2,"i":"17"},
                    {"x":0,"y":9,"w":2,"h":2,"i":"18"},
                    {"x":2,"y":6,"w":2,"h":2,"i":"19"}
                ],
            }
        },
    }
</script>

<style scoped>
    .block {
        border: 1px solid;
        background-color: darkseagreen;
    }
    .blockStatic {
        border: 1px solid;
        background-color: lightskyblue;
    }
    .blockPanel {
        background-color: lightgrey;
    }
</style>