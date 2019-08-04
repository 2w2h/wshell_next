<template>
    <Layout without_aside>
        <template #header>
            <h3>VK Streaming</h3>
            <hr>
        </template>
        <template #main>

            <Spoiler summary="Правила">
                <p>
                    Правило — это набор ключевых слов, наличие которых в тексте объекта означает, что объект попадёт в
                    поток.
                    Если слова указаны без двойных кавычек, поиск ведётся с упрощением (все словоформы, без учёта
                    регистра).
                    Для поиска по точному вхождению (с учётом регистра, словоформы и т.п.) каждое слово должно быть
                    указано в двойных кавычках.
                    Минус (-) перед ключевым словом исключит из выборки тексты, содержащие это слово. Правило не может
                    состоять только из ключевых слов с минусом.
                    Внутри правила в кавычках Вы можете использовать для поиска произвольные символы (#, $, % и так
                    далее), кроме пробела и перевода каретки. В правилах без кавычек подобные символы игнорируются.
                </p>

                <p>
                    Например, правилу кот будут соответствовать объекты с текстом "кот", "кОт", "Котик".
                    Правилу "кот" из вышеперечисленных будет соответствовать только объект с текстом "кот".
                    Правилу -"кот" будут соответствовать объекты, которые не содержат точную словоформу «кот».
                    Правилу -собака будут соответствовать объекты, которые не содержат слово «собака» в любой форме.
                    Чтобы искать записи с хэштегом, используйте правило вида "#хэштег".
                </p>

                <p>
                    У каждого правила есть значение (value) — собственно содержание правила, и метка (tag). Вместе с
                    каждым объектом Вы будете получать список его меток, чтобы понимать, какому правилу этот объект
                    соответствует.
                </p>

                <b>Ограничения</b>
                <ul>
                    <li>максимальное количество правил — 300;</li>
                    <li>максимальное количество ключевых слов в правиле — 100;</li>
                    <li>максимальное размер правила в байтах — 4096;</li>
                    <li>максимальное размер метки правила (tag) в байтах — 256;</li>
                </ul>
            </Spoiler>
            <br>

            <template v-for="rule in rules">
                <Badge>{{ rule.tag }}</Badge>
                <input type="text" v-model="rule.value">
                <button @click="saveRule(rule)">Сохранить</button>
                <button @click="deleteRule(rule)">Удалить</button>
                <br>
            </template>
            <input type="text" v-model="newRule.tag" placeholder="tag">
            <input type="text" v-model="newRule.value" placeholder="value">
            <button @click="addRule()">Добавить</button>
            <hr>

            <Set>
                <!--                        <p>action: {{ event.action }} </p>-->
                <!--                        <p>action_time: {{ event.action_time }} </p>-->
                <!--                        <p>creation_time: {{ event.creation_time }} </p>-->
                <!--                        <p>geo: {{ event.geo }} </p>-->
                <!--                        <p>shared: {{ event.shared_post_text }} - {{ event.shared_post_creation_time }}</p>-->
                <!--                        <p>signer_id: {{ event.signer_id }}</p>-->
                <SetItem>
                    <h3>Посты ({{ posts.length }})</h3>
                    <div v-for="event in posts">
                        <template v-for="tag in event.tags">
                            <Badge>{{ tag }}</Badge>
                        </template>
                        <a :href="event.event_url" target="_blank"> {{ event.event_url }} </a>
                        <p> {{ shortText(event.text) }} </p>
                        <template v-if="event.attachments">
                            <div v-for="att in event.attachments">
                                <a v-if="att.link" :href="att.link.url" target="_blank">
                                    {{ att.link.title }}
                                </a>
                                <img v-else-if="att.photo" :src="att.photo.photo_130"/>
                                <template v-else-if="att.video">
                                    <i>{{ att.video.title }}</i>
                                    {{ att.video }}
                                    <video controls width="400" height="300">
                                        <source src="video.mp4" type="video/mp4">
                                    </video>
                                </template>
                                <template v-else-if="att.audio">
                                    <i>AUDIO: {{att.audio.artist}} - {{att.audio.title}}</i>
                                </template>
                                <template v-else-if="att.doc">
                                    <img v-if="attach.doc.ext === 'gif'" :src="att.doc.url">
                                    <template v-else>
                                        {{ attach.doc }}
                                    </template>
                                </template>
                                <div v-else>
                                    {{ att }}
                                </div>
                            </div>
                        </template>

                        <template v-if="event.author.platform">
                            <b>{{ event.author.platform }}</b>
                            <a :href="event.author.author_url" target="_blank">Юзер</a>
                        </template>
                        <template v-else>
                            <a :href="event.author.author_url" target="_blank">Группа</a>
                        </template>
                        <hr>
                    </div>
                </SetItem>
                <SetItem>
                    <h3>Комментарии ({{ comments.length }})</h3>
                    <div v-for="event in comments">
                        <template v-for="tag in event.tags">
                            <Badge>{{ tag }}</Badge>
                        </template>
                        <a :href="event.event_url" target="_blank"> {{ event.event_url }} </a>
                        <p> {{ shortText(event.text) }} </p>
                        <p>attachments: {{ event.attachments }} </p>

                        <template v-if="event.author.platform">
                            <b>{{ event.author.platform }}</b>
                            <a :href="event.author.author_url" target="_blank">Юзер</a>
                        </template>
                        <template v-else>
                            <a :href="event.author.author_url" target="_blank">Группа</a>
                        </template>
                        <hr>
                    </div>
                </SetItem>
                <SetItem>
                    <h3>Репосты ({{ shares.length }})</h3>
                    <div v-for="event in shares">
                        <template v-for="tag in event.tags">
                            <Badge>{{ tag }}</Badge>
                        </template>
                        <a :href="event.event_url" target="_blank"> {{ event.event_url }} </a>
                        <p> {{ shortText(event.text) }} </p>
                        <p>attachments: {{ event.attachments }} </p>

                        <template v-if="event.author.platform">
                            <b>{{ event.author.platform }}</b>
                            <a :href="event.author.author_url" target="_blank">Юзер</a>
                        </template>
                        <template v-else>
                            <a :href="event.author.author_url" target="_blank">Группа</a>
                        </template>
                        <hr>
                    </div>
                </SetItem>
                <SetItem>
                    <h3>Остальное ({{ others.length }})</h3>
                    <div v-for="event in others">
                        <b> тип события: {{ event.event_type }} </b>
                        <template v-for="tag in event.tags">
                            <Badge>{{ tag }}</Badge>
                        </template>
                        <a :href="event.event_url" target="_blank"> {{ event.event_url }} </a>
                        <p> {{ shortText(event.text) }} </p>
                        <p>attachments: {{ event.attachments }} </p>

                        <template v-if="event.author.platform">
                            <b>{{ event.author.platform }}</b>
                            <a :href="event.author.author_url" target="_blank">Юзер</a>
                        </template>
                        <template v-else>
                            <a :href="event.author.author_url" target="_blank">Группа</a>
                        </template>
                        <hr>
                    </div>
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
    import Spoiler from "../../components/Spoiler";
    import axios from "axios";
    import Badge from "../../components/Badge";

    export default {
        components: {Badge, Nav, Layout, Set, SetItem, Spoiler},
        data() {
            return {
                logs: [],
                comments: [],
                posts: [],
                shares: [],
                others: [],

                rules: [],

                newRule: {tag:'', value:''}
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

                if (data.event.event_type === 'post') {
                    this.posts.push(data.event);
                } else if (data.event.event_type === 'comment') {
                    this.comments.push(data.event);
                } else if (data.event.event_type === 'share') {
                    this.shares.push(data.event);
                } else {
                    this.others.push(data.event);
                }
            };

            this.getRules();
        },
        methods: {
            getRules() {
                axios.get('http://127.0.0.1:8889/rule')
                    .then((response) => {
                        this.rules = JSON.parse(response.data.result).rules;
                    })
            },
            deleteRule(rule) {
                axios.post('http://127.0.0.1:8889/rule?tag=' + rule.tag)
                    .then((response) => {
                        console.log(response.data.result);
                    });
            },

            addRule() {
                axios.post('http://127.0.0.1:8889/rule?tag=' + this.newRule.tag + '&value=' + this.newRule.value)
                    .then((response) => {
                        console.log(response.data.result);
                    });
            },
            saveRule(rule) {
                axios.post('http://127.0.0.1:8889/rule?tag=' + rule.tag + '&value=' + rule.value)
                    .then((response) => {
                        console.log(response.data.result);
                    });
            },

            shortText(text) {
                let limit = 300;
                if (text.length > limit) {
                    return text.substring(0, limit) + '...';
                }
                return text;
            },
            getTime(ts) {
                let date = new Date(ts * 1000);
                let hours = date.getHours();
                let minutes = "0" + date.getMinutes();
                let seconds = "0" + date.getSeconds();
                return hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
            },
        }
    }
</script>
