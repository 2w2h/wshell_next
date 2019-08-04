<template>
    <div class="details" :class="{'is-expand': isExpand}">
        <button class="details-summary" @click="toggle">
            <span class="arrow"></span>
            {{ summary }}
        </button>
        <div class="details-content" ref="content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Spoiler",
        props: {
            summary: {
                type: String,
                'default': 'summary'
            }
        },
        data() {
            return {
                isExpand: false
            }
        },
        computed: {
            delay() {
                const dur = parseFloat(getComputedStyle(this.$refs.content).transitionDuration);
                return dur * 1000;
            }
        },
        mounted() {
            window.addEventListener('resize', this.resizeExpand);
        },
        beforeDestroy() {
            window.removeEventListener('resize', this.resizeExpand);
        },
        methods: {
            toggle(e) {
                e.preventDefault();
                const content = this.$refs.content;

                clearTimeout(this.timer)

                if (!this.isExpand) {
                    content.style.display = 'block';

                    setTimeout(() => {
                        this.isExpand = true;
                        content.style.maxHeight = `${content.scrollHeight}px`;
                    }, 0)
                } else {
                    this.isExpand = false;
                    content.style.maxHeight = ``;

                    this.timer = setTimeout(() => {
                        content.style.display = '';
                    }, this.delay)
                }
            },
            resizeExpand() {
                if (!this.isExpand) return;
                const content = this.$refs.content;
                content.style.maxHeight = `${content.scrollHeight}px`;
            }
        }
    }
</script>

<style scoped>
    .details-summary {
        display: block;
        width: 100%;
        text-align: left;
        line-height: 30px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.03em;
        border: 0;
        cursor: pointer;
        background-color: lightgray;
    }

    .details-summary .arrow {
        position: relative;
        display: inline-block;
        margin-right: 5px;
        width: 12px;
        height: 6px;
    }
    .details-summary .arrow::before, .details-summary .arrow::after {
        content: "";
        background: currentColor;
        position: absolute;
        top: calc(50% - 2px);
        height: 1px;
        width: calc(50% + 1px);
        margin: auto;
        transition: transform .25s ease;
    }
    .details-summary .arrow::before {
        left: 0;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .details-summary .arrow::after {
        right: 0;
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    .details-content {
        display: none;
        max-height: 0;
        margin-top: 0;
        margin-bottom: 0;
        overflow: hidden;
        transition-property: max-height, margin-top, margin-bottom;
        transition-duration: .25s;
        transition-timing-function: ease;
    }

    .details.is-expand .details-content {
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .details.is-expand .details-summary .arrow::before {
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }
    .details.is-expand .details-summary .arrow::after {
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
