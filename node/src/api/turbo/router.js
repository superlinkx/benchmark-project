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
    let headers = { "Content-Type": "application/json" };
    if (handler) {
      res.writeHead(200, headers);
      res.end(JSON.stringify(handler()));
    } else {
      res.writeHead(404, headers);
      res.end(JSON.stringify(this.#routes.get("404")()));
    }
  }
}

module.exports = Router;
