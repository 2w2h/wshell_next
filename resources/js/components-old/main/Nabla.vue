<template>
    <div>
        <div id="terminal">
            <img src='/img/qw.png' id="qw">
        </div>
    </div>
</template>

<script>
    import $ from 'jquery';
    import terminal from 'jquery.terminal';

    export default {
        data() {
            return {};
        },
        mounted() {
            var CSRF_HEADER = "X-CSRF-TOKEN";
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#terminal').terminal("/term", {
                format: function (arg) {
                    this.echo('[[guib;green;white] some text ]')
                },
                request: function(jxhr, request) {
                    if (csrfToken) {
                        jxhr.setRequestHeader(CSRF_HEADER, csrfToken);
                    }
                },
                greetings: "Добро пожаловать!\nКраткая справка доступна по команде 'help'",
                height: 470,
                prompt: '> ',
                name: 'nabla',
                linksNoReferer: false,
                exit: true, // for exit on Ctrl + D
                clear: true, // Ctrl + L
                login: false,
                completion: true,
                onRPCError: function () {
                    this.error('Shit happens, RPC error')
                },
                exceptionHandler: function (error) {
                    term.exception(error, 'exception!')
                }
            });
        },
        methods: {},
    };
</script>

<style>
    @import "~jquery.terminal/css/jquery.terminal.css";

    #qw {
        position:absolute; right: 25px; top:10px; z-index: 10;
    }

    #terminal {
        border-radius: .25rem;
    }

    .terminal, .cmd {
        --background:#343a40;
        --color:#d39e00;
    }

    @keyframes terminal-blink {
        0%, 100% {
            background-color: #343a40;
            color: #d39e00;
        }
        50% {
            background-color: #d39e00;
            color: #343a40;
        }
    }

    /* скролл терминала */
    .terminal::-webkit-scrollbar{
        width:12px;
        background-color: #ddd;
        webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    .terminal::-webkit-scrollbar-thumb{
        border-width:1px 1px 1px 2px;
        border-color: #777;
        background-color: #aaa;
        webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;

    }
    .terminal::-webkit-scrollbar-thumb:hover{
        border-color: #555;
        background-color: #777;
    }
</style>