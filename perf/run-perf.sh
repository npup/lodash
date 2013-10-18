cd "$(dirname "$0")"
<<<<<<< HEAD
for cmd in node narwhal ringo rhino; do
	echo ""
	echo "Running performance suite in $cmd..."
	$cmd perf.js
done
echo ""
echo "Running performance suite in a browser..."
open index.html
=======

echo "Running performance suite in node..."
node perf.js ../dist/lodash.js && node perf.js ../dist/lodash.min.js

for cmd in rhino "rhino -require" narwhal ringo phantomjs; do
  echo ""
  echo "Running performance suite in $cmd..."
  $cmd perf.js ../dist/lodash.compat.js && $cmd perf.js ../dist/lodash.compat.min.js
done

echo ""
echo "Running performance suite in a browser..."
open index.html
>>>>>>> upstream/master
