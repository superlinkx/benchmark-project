const fs = require("fs");
const path = require("path");

function fileread() {
  let demoFilePath = path.resolve(__dirname, "../data/demo.txt");
  let content = fs.readFileSync(demoFilePath);
  return content;
}

module.exports = fileread;
