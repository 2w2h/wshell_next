<template>
    <Layout without_aside>
        <template #header>
            <h3>VK Streaming</h3>
            <hr>
        </template>
        <template #main>
            <Set>
                <SetItem>
                    <h3>Лог</h3>
                    <div v-for="event in logs">
                        <b> тип события: {{ event.event_type }} </b>
                        <p>tags: {{ event.tags }}</p>
                        <i> id: {{ event.event_id }} </i>
                        <a :href="event.event_url" target="_blank"> {{ event.event_url }} </a>
                        <p> {{ event.text }} </p>
                        <p>attachments: {{ event.attachments }} </p>
                        <p>author: {{ event.author }}</p>

<!--                        <p>action: {{ event.action }} </p>-->
<!--                        <p>action_time: {{ event.action_time }} </p>-->
<!--                        <p>creation_time: {{ event.creation_time }} </p>-->
<!--                        <p>geo: {{ event.geo }} </p>-->
<!--                        <p>shared: {{ event.shared_post_text }} - {{ event.shared_post_creation_time }}</p>-->
<!--                        <p>signer_id: {{ event.signer_id }}</p>-->
                        <hr>
                    </div>
                </SetItem>
                <SetItem>
                    <h3>Комментарии</h3>
                </SetItem>
                <SetItem>
                    <h3>Посты</h3>
                </SetItem>
                <SetItem>
                    <h3>Репосты</h3>
                </SetItem>
            </Set>
        </template>
    </Layout>
</template>

<script>
    import Layout from '../../components/Layout'
    import Nav from "../../components/Nav";
    import Set from "../../components/Set";
    import SetItem from "../../components/SetItem";

    export default {
        components: {Nav, Layout, Set, SetItem},
        data() {
            return {
                logs: [],
                count: {
                    comment: 0,
                    post: 0,
                    share: 0,
                }
            }
        },
        created() {
            let ws = new WebSocket("ws://127.0.0.1:8888/stream");
            ws.onopen = (evt) => {
                console.log("OPEN");
            };
            ws.onclose = (evt) => {
                console.log("CLOSE");
                ws = null;
            };
            ws.onerror = (evt) => {
                console.log("ERROR: " + evt.data);
            };

            ws.onmessage = (evt) => {
                let data = JSON.parse(evt.data);

                // raw data
                this.logs.push(data.event);
                return;

                // TODO: spam filter
                if (data.event.text.length > 1000) {
                    console.log("Spam?");
                    console.log(data.event.tags);
                    console.log(data.event);
                    return;
                }

                var message = "";
                for (var i = 0; i < data.event.tags.length; i++) {
                    message += '<span class="label label-default">' + data.event.tags[i] + '</span>';
                }
                // message += '<i>'+getTime(data.event.creation_time)+'</i>';
                message += "<b><a target='_blank' href='" + data.event.event_url + "'>" + data.event.text + "</a></b></br>"
                // attaches
                if (data.event.attachments) {
                    for (var i = 0; i < data.event.attachments.length; i++) {
                        var attach = data.event.attachments[i];
                        if (attach.type == "photo") {

                            message += '<img src="' + attach.photo.photo_130 + '"></img>';

                        } else if (attach.type == "audio") {

                            message += '<br><i>AUDIO: ' + attach.audio.artist + ':' + attach.audio.title + '</i><br>';

                        } else if (attach.type == "video") {

                            message += '<i>VIDEO: ' + attach.video.title + '</i>';
                            message += '<img src="' + attach.video.photo_130 + '"></img>';

                        } else if (attach.type == "album") {

                            message += '<i>ALBUM: ' + attach.album.title + ' (' + attach.album.size + ')</i>';
                            message += '<img src="' + attach.album.thumb.photo_130 + '"></img>';

                        } else if (attach.type == "poll") {

                            message += '<br><b>' + attach.poll.question + '</b><ul>';
                            for (var i = 0; i < attach.poll.answers.length; i++) {
                                message += '<li>' + attach.poll.answers[i].text + '</li>';
                            }
                            message += '</ul>';

                        } else if (attach.type == "link") {

                            message += '<a src="' + attach.link.url + '">' + attach.link.title + '</a>';

                        } else if (attach.type == "doc") {

                            // docs
                            if (attach.doc.ext == "gif") {
                                message += '<img src="' + attach.doc.url + '"></img>';
                            } else {
                                console.log("OTHER DOC!");
                                console.log(data.event);
                            }

                        } else {
                            console.log("OTHER ATTACH!");
                            console.log(data.event);
                        }
                    }
                }
                message += "<br>";
                print(message, data.event.event_type);
            };
        },
        methods: {
            getTime(ts) {
                let date = new Date(ts * 1000);
                let hours = date.getHours();
                let minutes = "0" + date.getMinutes();
                let seconds = "0" + date.getSeconds();
                return hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
            }
        }
    }
</script>
