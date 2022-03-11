import Vue from "vue";
import dynamicArticle from "./components/dynamicArticle";

((el) => {
  new Vue({
    el,
    render: h => h(dynamicArticle),
    data: () => Object.assign({}, el.dataset),
  });
})(document.getElementById('article'));
