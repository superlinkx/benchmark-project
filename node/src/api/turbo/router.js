class Router {
  #routes = new Map();
  constructor() {
    this.#routes.set("404", () => {
      return { error: "Resource Not Found" };
    });
  }
  add404Handler(handler) {
    this.#routes.set("404", handler);
    return this;
  }
  addRoute(name, handler) {
    this.#routes.set(name, handler);
    return this;
  }
  handle(req, res) {
    let handler = this.#routes.get(req.url);
    if (handler) {
      res.statusCode = 200;
      res.setHeader("Content-Type", "application/json");
      res.write(JSON.stringify(handler()));
    } else {
      res.statusCode = 404;
      res.setHeader("Content-Type", "application/json");
      res.write(JSON.stringify(this.#routes.get("404")()));
    }
  }
}

module.exports = Router;
