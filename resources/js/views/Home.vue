<template>
     <div>
         <h1>Меню</h1>

         <h2> Фронт </h2>
         <ul>
             <li v-for="(route, index) in frontRoutes">
                 <a @click.prevent="$router.push({path:route.path})" href>
                     {{ route.path }}
                 </a>
             </li>
         </ul>
         <h2> Бэк (только GET) </h2>
         <ul>
             <template v-for="(routes, typeName) in backRoutes">
                 <h3> {{ typeName }} </h3>
                 <li v-for="(route, index) in routes">
                     <a :href="route">
                         {{ route }}
                     </a>
                 </li>
             </template>
         </ul>
     </div>
</template>

<script>
    import axios from 'axios'

    export default {
        mounted() {
            this.frontRoutes = this.$router.options.routes;

            axios.get('/api/v1/routes').then(result => {
                this.backRoutes = result.data;
            });
        },
        data() {
            return {
                frontRoutes: [],
                backRoutes: [],
            }
        }
    }
</script>
