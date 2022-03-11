import Vue from "vue";
import allArticles from "./components/allArticles";

((el) => {
  new Vue({
      el,
      render: h => h(allArticles),
      data: () => Object.assign({}, el.dataset) ,
  });
})(document.getElementById('articles'));
