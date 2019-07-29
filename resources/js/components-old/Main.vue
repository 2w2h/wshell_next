<template>
  <b-container>
    <b-navbar toggleable="md" type="dark" variant="dark">
      <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

      <b-navbar-brand href="/">wShell</b-navbar-brand>

      <b-collapse is-nav id="nav_collapse">
        <b-navbar-nav class="ml-auto">
          <b-nav-item href="/profile">Профиль</b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <b-row style="margin-top: 1rem;">
      <b-col md="3">
        <b-list-group>
          <router-link class="list-group-item" :to="{ name: 'news' }">Новости</router-link>
          <router-link class="list-group-item" :to="{ name: 'nabla' }">Терминал</router-link>
          <router-link class="list-group-item" :to="{ name: 'chapters' }">Механизмы</router-link>
        </b-list-group>
      </b-col>
      <b-col md="9">
        <router-view></router-view>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
    };
  },
  methods: {
  }
};
</script>