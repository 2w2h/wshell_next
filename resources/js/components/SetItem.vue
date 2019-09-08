<template>
    <div :style="{flex: cols+' 0', width:(100/total)+'%', overflow: 'hidden', padding:'5px'}">
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
            },
            total: {
                type: Number,
                default: 12,
            }
        }

    }
</script>
