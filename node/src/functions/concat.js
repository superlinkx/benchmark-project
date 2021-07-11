function concat() {
  let str = "";
  for (let i = 0; i < 1000; i++) {
    str += "Words\n";
  }
  return str;
}

module.exports = concat;
