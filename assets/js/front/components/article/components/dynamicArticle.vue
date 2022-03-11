<template>
    <div>
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
    };
  },
  mounted() {
    axios.get('/api/article/' + this.id).then((response) => {
      if (response) {
        this.title = response.data.title;
        this.body = response.data.body;
      }
    })
    .catch((e) => {
      this.error = true;
      console.log(e);
    });
  },
};
</script>