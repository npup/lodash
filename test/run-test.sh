cd "$(dirname "$0")"
<<<<<<< HEAD
for cmd in rhino ringo narwhal node; do
  echo ""
  echo "Testing in $cmd..."
  $cmd test.js
done

echo ""
echo "Testing build..."
node test-build.js
=======

for cmd in rhino "rhino -require" narwhal ringo phantomjs; do
  echo "Testing in $cmd..."
  $cmd test.js ../dist/lodash.compat.js && $cmd test.js ../dist/lodash.compat.min.js
  echo ""
done

echo "Testing in node..."
node test.js ../dist/lodash.js && node test.js ../dist/lodash.min.js
>>>>>>> upstream/master

echo ""
echo "Testing in a browser..."
open index.html
