function mapfill() {
  let map = new Map();
  for (let i = 0; i < 1000; i++) {
    map.set("word" + i, "Word\n");
  }
  return map;
}

module.exports = mapfill;
