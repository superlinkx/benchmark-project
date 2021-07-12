const fs = require("fs");

function fileread(path) {
  let content = fs.readFileSync(path);
  return content;
}

module.exports = fileread;
