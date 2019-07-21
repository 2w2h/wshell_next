<template>
    <div :style="{flex: cols}">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: 'SetItem',
        props: {
            cols: {
                type: Number,
                default: 1,
            }
        }

    }
</script>
