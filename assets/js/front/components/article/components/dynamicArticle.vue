<template>
    <div>
      <div class="d-flex justify-content-center" v-if="loader">
        <div class="spinner-border" role="status">
          <span class="sr-only"></span>
        </div>
      </div>

      <div v-if="!error">
        <h1>{{ article.getTitle() }}</h1>
        <p>{{ article.getBody() }}</p>
        <div class="float-end">Author: {{ author.getName() }}</div>
      </div>

      <div v-if="error">
        No article found
      </div>
    </div>
</template>

<script>
import axios from "axios";
import Article from "../../../models/Article";
import Author from "../../../models/Author";

export default {
  name: "dynamicArticle",
  data() {
    return {
      article: new Article,
      author: new Author,
      error: false,
      id: this.$parent.id,
      loader: true,
    };
  },
  mounted() {
    axios.get('/api/article/' + this.id).then((response) => {
      if (response) {
        this.article = this.article.setArticle(response.data);
        this.author = this.author.setAuthor(this.article.getAuthor());
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