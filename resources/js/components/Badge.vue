<template>
    <span class="badge" :style="{backgroundColor: color}">
        <slot></slot>
    </span>
</template>

<script>
    export default {
        name: "Badge",
        props: {
            color: {
                type: String,
                default: '#6c757d'
            }
        },
        methods: {
            // нужны 2 инструмента - инвертирование цвета и выбор белого или черного текста в контраст фону
            invertColor(hex) {
                if (hex.indexOf('#') === 0) {
                    hex = hex.slice(1);
                }
                if (hex.length === 3) {
                    hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                }
                if (hex.length !== 6) {
                    throw new Error('Invalid HEX color.');
                }
                var r = (255 - parseInt(hex.slice(0, 2), 16)).toString(16),
                    g = (255 - parseInt(hex.slice(2, 4), 16)).toString(16),
                    b = (255 - parseInt(hex.slice(4, 6), 16)).toString(16);
                return '#' + this.padZero(r) + this.padZero(g) + this.padZero(b);
            }
        },
        padZero(str, len) {
            len = len || 2;
            let zeros = new Array(len).join('0');
            return (zeros + str).slice(-len);
        }
    }
</script>

<style scoped>
    .badge {
        color: #fff;
        background-color: #6c757d;

        display: inline-block;
        padding: .35em .4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
</style>
