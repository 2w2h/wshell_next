<template>
    <Layout without_aside>
        <template #header>
            <h3>Управление образами</h3>
            <hr>
        </template>
        <template #main>
            <Set>
                <SetItem v-for="image in images">
                    <Card>
                        <h3>{{ image.name }}</h3>
                        <p>{{ image.description }}</p>
                        <Spoiler v-if="image.depfile" summary="composer.json">
                            {{ image.depfile }}
                        </Spoiler>
                        <div v-if="image.caps">
                            <span>Лимиты: </span>
                            <Badge>{{ image.caps.memory }}</Badge>
                            <Badge>{{ image.caps.cpu }}</Badge>
                        </div>
                    </Card>
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
    import Badge from "../../components/Badge";
    import Card from "../../components/Card";

    export default {
        components: {Card, Badge, Spoiler, Nav, Layout, Set, SetItem},
        data() {
            return {
                images: [
                    {name: 'php', description: 'Минимальный образ с php'},
                    {name: 'php_pdf', depfile: 'содержимое файла'},
                    {name: 'bin', description: 'Минимальный образ для бинарников', caps: {memory: '10mb', cpu: '50%'}},
                ],
            }
        },
        created() {

        }
    }
</script>
