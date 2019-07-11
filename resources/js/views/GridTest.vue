<template>
    <Layout without_aside>
        <template #header>
            <h3>grid test</h3>
            <hr>
        </template>
        <template #main>
            <grid-layout
                    class="taskPanel"
                    :layout.sync="preparedTasks"
                    :col-num="20"
                    :row-height="30"
                    :is-draggable="true"
                    :is-resizable="true"
                    :is-mirrored="false"
                    :vertical-compact="false"
                    :margin="[10, 10]"
                    :use-css-transforms="true"
            >

                <grid-item v-for="(task, index) in preparedTasks"
                           :key="index"
                           :class="['task', task.static ? 'task_static' : '']"
                           :x="task.x"
                           :y="task.y"
                           :w="task.w"
                           :h="task.h"
                           :i="task.i"
                           :static="task.static"
                >
                    #{{ task.i }}
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
        },
        data() {
            return {
                tasks: [
                    {"x":0,"y":0,"w":2,"h":2,"id":"0", "static": true},
                    {"x":2,"y":0,"w":2,"h":2,"id":"1"},
                    {"x":4,"y":0,"w":2,"h":2,"id":"2"},
                    {"x":6,"y":0,"w":2,"h":2,"id":"3"},
                    {"x":8,"y":0,"w":2,"h":2,"id":"4"},
                    {"x":10,"y":0,"w":2,"h":2,"id":"5"},
                    {"x":0,"y":5,"w":2,"h":2,"id":"6"},
                    {"x":2,"y":5,"w":2,"h":2,"id":"7"},
                    {"x":4,"y":5,"w":2,"h":2,"id":"8"},
                    {"x":6,"y":3,"w":2,"h":2,"id":"9"},
                    {"x":8,"y":4,"w":2,"h":2,"id":"10"},
                    {"x":10,"y":4,"w":2,"h":2,"id":"11"},
                    {"x":0,"y":10,"w":2,"h":2,"id":"12"},
                    {"x":2,"y":10,"w":2,"h":2,"id":"13"},
                    {"x":4,"y":8,"w":2,"h":2,"id":"14"},
                    {"x":6,"y":8,"w":2,"h":2,"id":"15"},
                    {"x":8,"y":10,"w":2,"h":2,"id":"16"},
                    {"x":10,"y":4,"w":2,"h":2,"id":"17"},
                    {"x":0,"y":9,"w":2,"h":2,"id":"18"},
                    {"x":2,"y":6,"w":2,"h":2,"id":"19"}
                ],
            }
        },
        computed: {
            preparedTasks() {
                let tasks = this.tasks.map(x => {
                    // подвисает, если у элемента сетки нет i
                    x.i = x.id;
                    return x;
                });
                tasks[0].h = 6;
                return tasks;
            }
        }
    }
</script>

<style scoped>
    .task {
        border: 1px solid;
        background-color: darkseagreen;
    }
    .task_static {
        border: 1px solid;
        background-color: lightskyblue;
    }
    .taskPanel {
        background-color: lightgrey;
    }
</style>