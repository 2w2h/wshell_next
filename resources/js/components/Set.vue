<template>
    <div class="set">
        <div class="col" v-for="i in cols">
            <slot :name="'col'+i">
            </slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Set',
        mounted() {
            let slots = Object.keys(this.$slots);
            let cols = [];
            for (let i in slots) {
                if (slots[i].includes('-')) {
                    cols.push([
                        +slots[i].split('-')[0],
                        +slots[i].split('-')[1],
                    ]);
                } else {
                    cols.push([+slots[i], 0]);
                }
            }
            console.log(cols);
        },
        data() {
            return {
                cols: null,
                maxCols: 12
            }
        },
    }
</script>

<style scoped>
    .set {
        display: grid;
        grid-gap: 10px;
        grid-auto-flow: column;
    }
    .col {
        grid-column-start: 1;
        grid-column-end: 4;
    }
</style>