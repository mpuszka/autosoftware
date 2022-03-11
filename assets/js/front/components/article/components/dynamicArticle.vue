<template>
    <div>
      <div class="d-flex justify-content-center" v-if="loader">
        <div class="spinner-border" role="status">
          <span class="sr-only"></span>
        </div>
      </div>

      <div v-if="!error">
        <h1>{{ article.title }}</h1>
        <p>{{ article.body }}</p>
        <div class="float-end">Author: {{ author.name }}</div>
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
      article: '',
      author: '',
      error: false,
      id: this.$parent.id,
      loader: true,
    };
  },
  mounted() {
    axios.get('/api/article/' + this.id).then((response) => {
      if (response) {
        this.article = response.data;
        this.author = this.article.author;
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