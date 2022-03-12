class Author {
  setAuthor(author) {
    this.id = author.id;
    this.name = author.name;
    this.email = author.email;

    return this;
  }

  getId() {
    return this.id;
  }

  getName() {
    return this.name;
  }

  getEmail() {
    return this.email;
  }
}

export default Author;