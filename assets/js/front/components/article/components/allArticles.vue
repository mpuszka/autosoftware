<template>
  <div>
    <h2>{{ title }}</h2>

    <div class="d-flex justify-content-center" v-if="loader">
      <div class="spinner-border" role="status">
        <span class="sr-only"></span>
      </div>
    </div>

    <ul>
      <li v-for="article in articles" :key="article.id">
        <a :href="'/article/' + article.id">
          {{ article.title }}
        </a>
      </li>
    </ul>

    <div v-if="error">
        No article found
      </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "allArticles",
  data() {
    return {
      articles: [],
      title: this.$parent.title,
      skip: this.$parent.skip,
      error: false,
      loader: true,
    };
  },
  mounted() {
    axios.get('/api/article/').then((response) => {
      if (response) {
        this.articles = response.data;

        if (this.skip) {
          this.articles = this.articles.filter(item => item.id != this.skip);
        }

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