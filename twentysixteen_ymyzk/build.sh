#!/bin/bash
set -ex
languages=(
  # Common
  'bash'
  'cs' # C#
  'css'
  'diff'
  'http'
  'ini'
  'json'
  'java'
  'javascript'
  'makefile'
  'markdown'
  'nginx'
  'objective-c'
  'php'
  'perl'
  'python'
  'ruby'
  'sql'
  'vim'
  'xml' # including HTML
  # Others
  'django'
  'dockerfile'
  'ocaml'
  'swift'
  'tex'
  'yaml'
)

cd $(dirname $0)

cd highlight.js/
yarn

node ./tools/build.js -n ${languages[*]}
cp ./build/highlight.pack.js ../js/highlight.js

node ./tools/build.js ${languages[*]}
cp ./build/highlight.pack.js ../js/highlight.min.js

node ./tools/build.js -t cdn
cp ./build/styles/monokai.min.css ../css/

cd ..
