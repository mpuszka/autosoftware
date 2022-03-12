class Article {
  setArticle(article) {
    this.id = article.id;
    this.title = article.title;
    this.body = article.body;
    this.author = article.author;

    return this;
  }

  getId() {
    return this.id;
  }

  getTitle() {
    return this.title;
  }

  getBody() {
    return this.body;
  }

  getAuthor() {
    return this.author;
  }
}

export default Article;