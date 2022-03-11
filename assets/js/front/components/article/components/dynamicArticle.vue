<template>
    <div>
      <div class="d-flex justify-content-center" v-if="loader">
        <div class="spinner-border" role="status">
          <span class="sr-only"></span>
        </div>
      </div>

      <div v-if="!error">
        <h1>{{ title }}</h1>
        <p>{{ body }}</p>
      </div>

      <div v-if="error">
        No article found
      </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
  name: "dynamicArticle",
  data() {
    return {
      title: '',
      body: '',
      error: false,
      id: this.$parent.id,
      loader: true,
    };
  },
  mounted() {
    axios.get('/api/article/' + this.id).then((response) => {
      if (response) {
        this.title = response.data.title;
        this.body = response.data.body;
        this.loader = false;
      }
    })
    .catch((e) => {
      this.error = true;
      this.loader = false;
      console.log(e);
    });
  },
};
</script>