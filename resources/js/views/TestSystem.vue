<template>
    <div>
        <h3>Тест WAMP роутера</h3>
        {{ wampLog }}
        <h3>Mongo</h3>
        {{ mongo }}
        <h3>Redis</h3>
        {{ redis }}
    </div>
</template>

<script>
    import autobahn from 'autobahn'
    import axios from 'axios'

    export default {
        data() {
            return {
                wampLog: [],
                mongo: null,
                redis: null,
            }
        },
        mounted() {
            var connection = new autobahn.Connection({url: 'ws://127.0.0.1:8081/', realm: 'realm1'});

            connection.onopen = session => {

                let channelName = 'wshell.test';
                session.subscribe(channelName, args => {
                    console.log("Event:", args);
                }).then(subscription => {
                    this.wampLog.push(['Subscription success!', channelName, subscription.id]);
                    // свои сообщения по умолчанию не получаем
                    session.publish(channelName, ['Hello, world!']);
                }, error => {
                    console.log(error);
                });

                let rpName = 'wshell.test';
                session.register(rpName, args => {
                    return args[0] + args[1];
                }).then(registration => {
                    this.wampLog.push(['Registration success!', rpName, registration.id]);

                    session.call(rpName, [2, 3]).then(res => {
                        console.log("Result:", res);
                    });
                }, error => {
                    console.log(error);
                });
            };

            connection.open();

            axios.get('/api/v1/test/mongo').then(response => {
                this.mongo = response.data.count;
            });
            axios.get('/api/v1/test/redis').then(response => {
                this.redis = response.data.count;
            });
        },
    }
</script>
