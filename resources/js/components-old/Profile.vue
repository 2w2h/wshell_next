<template>
  <b-container>
    <b-navbar toggleable="md" type="dark" variant="dark">
      <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

      <b-navbar-brand href="/">wShell </b-navbar-brand>
      <span class="bread-arrow">➔</span>
      <b-navbar-nav class="ml-auto">
        <b-nav-item href="/profile">Профиль</b-nav-item>
      </b-navbar-nav>

      <b-collapse is-nav id="nav_collapse">
        <b-navbar-nav class="ml-auto">
          <b-nav-form>
            <b-form-input size="sm" class="mr-sm-2" type="text"/>
            <b-button size="sm" class="my-2 my-sm-0" type="submit">Поиск</b-button>
          </b-nav-form>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <b-row style="margin-top: 1rem;">
      <b-col md="3">
        <b-list-group>
          <router-link class="list-group-item" :to="{ name: 'common' }">Общие настройки</router-link>
          <router-link class="list-group-item" :to="{ name: 'files' }">Файлы</router-link>
          <router-link class="list-group-item" :to="{ name: 'keys' }">Ключи</router-link>
          <router-link class="list-group-item" :to="{ name: 'groups' }">Группы</router-link>
          <router-link class="list-group-item" :to="{ name: 'chains' }">Цепочки</router-link>
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