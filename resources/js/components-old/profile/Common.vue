<template>
  <div>
    <!-- основные поля -->
    <b-row>
      <b-col md="12">
        <b-form inline>
        <b-input class="mb-2 mr-sm-2 mb-sm-0" v-model=nickname placeholder="Никнейм" />
        <b-input-group left="@" class="mb-2 mr-sm-2 mb-sm-0">
          <b-input type="password" v-model=password placeholder="Новый пароль" />
        </b-input-group>
        <b-button variant="orange">Сохранить</b-button>
        </b-form>
      </b-col>
    </b-row>
    <!-- userpic -->
    <b-row style="margin-top: 1rem;">
      <b-col md="6">
        <b-form>
            <b-form-file v-model="userpic" :state="Boolean(userpic)" placeholder="Выбери фото..." @change="previewUserpic"></b-form-file>
            <b-card
                :img-src=userpicSrc
                img-top>
            </b-card>
        </b-form>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
       nickname: null,
       password: null,
       userpic: null,
       userpicSrc: null,
    };
  },
  methods: {
    previewUserpic(event) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
            this.userpicSrc = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  },
};
</script>