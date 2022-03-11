<template>
  <div>
    <h2>{{ title }}</h2>

    <ul>
      <li v-for="article in articles" :key="article.id">
        <a :href="'/article/' + article.id">
          {{ article.title }}
        </a>
      </li>
    </ul>

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
    };
  },
  mounted() {
    axios.get('/api/article/').then((response) => {
      if (response) {
        this.articles = response.data;

        if (this.skip) {
          this.articles = this.articles.filter(item => item.id != this.skip);
        }
      }
    })
    .catch((e) => {
      console.log(e);
    });
  },
};
</script>