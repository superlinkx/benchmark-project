function counter() {
  let count = 0;
  for (let i = 0; i < 10000; i++) {
    count++;
  }
  return count;
}

module.exports = counter;
