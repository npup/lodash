<<<<<<< HEAD
# Lo-Dash <sup>v0.9.2</sup>
[![build status](https://secure.travis-ci.org/bestiejs/lodash.png)](http://travis-ci.org/bestiejs/lodash)

A drop-in replacement<sup>[*](https://github.com/bestiejs/lodash/wiki/Drop-in-Disclaimer)</sup> for Underscore.js, from the devs behind [jsPerf.com](http://jsperf.com), delivering [performance](http://lodash.com/benchmarks), [bug fixes](https://github.com/bestiejs/lodash#resolved-underscorejs-issues), and [additional features](http://lodash.com/#features).

Lo-Dash’s performance is gained by avoiding slower native methods, instead opting for simplified non-ES5 compliant methods optimized for common usage, and by leveraging function compilation to reduce the number of overall function calls.

## Download

 * [Development build](https://raw.github.com/bestiejs/lodash/v0.9.2/lodash.js)
 * [Production build](https://raw.github.com/bestiejs/lodash/v0.9.2/lodash.min.js)
 * [Underscore build](https://raw.github.com/bestiejs/lodash/v0.9.2/lodash.underscore.min.js) tailored for projects already using Underscore
 * CDN copies of ≤ v0.9.2’s [Production](http://cdnjs.cloudflare.com/ajax/libs/lodash.js/0.9.2/lodash.min.js), [Underscore](http://cdnjs.cloudflare.com/ajax/libs/lodash.js/0.9.2/lodash.underscore.min.js), and [Development](http://cdnjs.cloudflare.com/ajax/libs/lodash.js/0.9.2/lodash.js) builds are available on [cdnjs](http://cdnjs.com/) thanks to [CloudFlare](http://www.cloudflare.com/)
 * For optimal file size, [create a custom build](https://github.com/bestiejs/lodash#custom-builds) with only the features you need

## Dive in

We’ve got [API docs](http://lodash.com/docs), [benchmarks](http://lodash.com/benchmarks), and [unit tests](http://lodash.com/tests).

Create your own benchmarks at [jsPerf](http://jsperf.com), or [search](http://jsperf.com/search?q=lodash) for existing ones.

For a list of upcoming features, check out our [roadmap](https://github.com/bestiejs/lodash/wiki/Roadmap).

## Screencasts

For more information check out these screencasts over Lo-Dash:

 * [Introducing Lo-Dash](https://vimeo.com/44154599)
 * [Lo-Dash optimizations and custom builds](https://vimeo.com/44154601)
 * [Lo-Dash’s origin and why it’s a better utility belt](https://vimeo.com/44154600)
 * [Unit testing in Lo-Dash](https://vimeo.com/45865290)
 * [Lo-Dash’s approach to native method use](https://vimeo.com/48576012)

## Features

 * AMD loader support ([RequireJS](http://requirejs.org/), [curl.js](https://github.com/cujojs/curl), etc.)
 * [_.clone](http://lodash.com/docs#clone) supports *“deep”* cloning
 * [_.contains](http://lodash.com/docs#contains) accepts a `fromIndex` argument
 * [_.forEach](http://lodash.com/docs#forEach) is chainable and supports exiting iteration early
 * [_.forIn](http://lodash.com/docs#forIn) for iterating over an object’s own and inherited properties
 * [_.forOwn](http://lodash.com/docs#forOwn) for iterating over an object’s own properties
 * [_.isPlainObject](http://lodash.com/docs#isPlainObject) checks if values are created by the `Object` constructor
 * [_.lateBind](http://lodash.com/docs#lateBind) for late binding
 * [_.merge](http://lodash.com/docs#merge) for a *“deep”* [_.extend](http://lodash.com/docs#extend)
 * [_.partial](http://lodash.com/docs#partial) for partial application without `this` binding
 * [_.pick](http://lodash.com/docs#pick) and [_.omit](http://lodash.com/docs#omit) accepts `callback` and `thisArg` arguments
 * [_.template](http://lodash.com/docs#template) supports [ES6 delimiters](http://people.mozilla.org/~jorendorff/es6-draft.html#sec-7.8.6) and utilizes [sourceURLs](http://www.html5rocks.com/en/tutorials/developertools/sourcemaps/#toc-sourceurl) for easier debugging
 * [_.contains](http://lodash.com/docs#contains), [_.size](http://lodash.com/docs#size), [_.toArray](http://lodash.com/docs#toArray),
   [and more…](http://lodash.com/docs "_.countBy, _.every, _.filter, _.find, _.forEach, _.groupBy, _.invoke, _.map, _.max, _.min, _.pluck, _.reduce, _.reduceRight, _.reject, _.shuffle, _.some, _.sortBy, _.where") accept strings

## Support

Lo-Dash has been tested in at least Chrome 5~23, Firefox 1~16, IE 6-10, Opera 9.25-12, Safari 3-6, Node.js 0.4.8-0.8.14, Narwhal 0.3.2, RingoJS 0.8, and Rhino 1.7RC5.

## Custom builds

Custom builds make it easy to create lightweight versions of Lo-Dash containing only the methods you need.
To top it off, we handle all method dependency and alias mapping for you.

 * Backbone builds, with only methods required by Backbone, may be created using the `backbone` modifier argument.
```bash
lodash backbone
```

 * CSP builds, supporting default Content Security Policy restrictions, may be created using the `csp` modifier argument.
```bash
lodash csp
```

 * Legacy builds, tailored for older browsers without [ES5 support](http://es5.github.com/), may be created using the `legacy` modifier argument.
```bash
lodash legacy
```

 * Mobile builds, with IE < 9 bug fixes and method compilation removed, may be created using the `mobile` modifier argument.
```bash
lodash mobile
```

 * Strict builds, with `_.bindAll`, `_.defaults`, and `_.extend` in [strict mode](http://es5.github.com/#C), may be created using the `strict` modifier argument.
```bash
lodash strict
```

 * Underscore builds, tailored for projects already using Underscore, may be created using the `underscore` modifier argument.
```bash
lodash underscore
```

Custom builds may be created using the following commands:

 * Use the `category` argument to pass comma separated categories of methods to include in the build.<br>
   Valid categories (case-insensitive) are *“arrays”*, *“chaining”*, *“collections”*, *“functions”*, *“objects”*, and *“utilities”*.
```bash
lodash category=collections,functions
lodash category="collections, functions"
```

 * Use the `exports` argument to pass comma separated names of ways to export the `LoDash` function.<br>
   Valid exports are *“amd”*, *“commonjs”*, *“global”*, *“node”*, and *“none”*.
```bash
lodash exports=amd,commonjs,node
lodash exports="amd, commonjs, node"
```

 * Use the `iife` argument to specify code to replace the immediately-invoked function expression that wraps Lo-Dash.
```bash
lodash iife="!function(window,undefined){%output%}(this)"
```

 * Use the `include` argument to pass comma separated method/category names to include in the build.
```bash
lodash include=each,filter,map
lodash include="each, filter, map"
```

 * Use the `minus` argument to pass comma separated method/category names to remove from those included in the build.
```bash
lodash underscore minus=result,shuffle
lodash underscore minus="result, shuffle"
```

 * Use the `plus` argument to pass comma separated method/category names to add to those included in the build.
```bash
lodash backbone plus=random,template
lodash backbone plus="random, template"
```

 * Use the `template` argument to pass the file path pattern used to match template files to precompile.
```bash
lodash template="./*.jst"
```

 * Use the `settings` argument to pass the template settings used when precompiling templates.
```bash
lodash settings="{interpolate:/\\{\\{([\\s\\S]+?)\\}\\}/g}"
```

 * Use the `moduleId` argument to specify the AMD module ID of Lo-Dash, which defaults to “lodash”, used by precompiled templates.
```bash
lodash moduleId="underscore"
```

All arguments, except `legacy` with `csp` or `mobile`, may be combined.<br>
Unless specified by `-o` or `--output`, all files created are saved to the current working directory.

The following options are also supported:

 * `-c`, `--stdout`&nbsp;&nbsp;&nbsp;&nbsp; Write output to standard output
 * `-d`, `--debug`&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Write only the debug output
 * `-h`, `--help`&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Display help information
 * `-m`, `--minify`&nbsp;&nbsp;&nbsp;&nbsp; Write only the minified output
 * `-o`, `--output`&nbsp;&nbsp;&nbsp;&nbsp; Write output to a given path/filename
 * `-s`, `--silent`&nbsp;&nbsp;&nbsp;&nbsp; Skip status updates normally logged to the console
 * `-V`, `--version`&nbsp;&nbsp; Output current version of Lo-Dash

The `lodash` command-line utility is available when Lo-Dash is installed as a global package (i.e. `npm install -g lodash`).

## Installation and usage
=======
# Lo-Dash v2.2.1
A utility library delivering consistency, [customization](http://lodash.com/custom-builds), [performance](http://lodash.com/benchmarks), & [extras](http://lodash.com/#features).

## Download

* Modern builds perfect for newer browsers/environments:<br>
[Development](https://raw.github.com/lodash/lodash/2.2.1/dist/lodash.js) &
[Production](https://raw.github.com/lodash/lodash/2.2.1/dist/lodash.min.js)

* Compatibility builds for older environment support too:<br>
[Development](https://raw.github.com/lodash/lodash/2.2.1/dist/lodash.compat.js) &
[Production](https://raw.github.com/lodash/lodash/2.2.1/dist/lodash.compat.min.js)

* Underscore builds to use as a drop-in replacement:<br>
[Development](https://raw.github.com/lodash/lodash/2.2.1/dist/lodash.underscore.js) &
[Production](https://raw.github.com/lodash/lodash/2.2.1/dist/lodash.underscore.min.js)

CDN copies are available on [cdnjs](http://cdnjs.com/libraries/lodash.js/) & [jsDelivr](http://www.jsdelivr.com/#!lodash).<br>
For smaller file sizes, create [custom builds](http://lodash.com/custom-builds) with only the features needed.<br>
Love modules? We’ve got you covered with [lodash-amd](https://npmjs.org/package/lodash-amd), [lodash-node](https://npmjs.org/package/lodash-node), & [npm packages](https://npmjs.org/browse/keyword/lodash-modularized) per method.

## Dive in

There’s plenty of [documentation](http://lodash.com/docs), [unit tests](http://lodash.com/tests), & [benchmarks](http://lodash.com/benchmarks).<br>
For a list of upcoming features, check out our [roadmap](https://github.com/lodash/lodash/wiki/Roadmap).<br>
The full changelog for this release is available on our [wiki](https://github.com/lodash/lodash/wiki/Changelog).

## Features *not* in Underscore

 * AMD loader support ([curl](https://github.com/cujojs/curl), [dojo](http://dojotoolkit.org/), [requirejs](http://requirejs.org/), etc.)
 * [_(…)](http://lodash.com/docs#_) supports intuitive chaining
 * [_.at](http://lodash.com/docs#at) for cherry-picking collection values
 * [_.bindKey](http://lodash.com/docs#bindKey) for binding [*“lazy”*](http://michaux.ca/articles/lazy-function-definition-pattern) defined methods
 * [_.clone](http://lodash.com/docs#clone) supports shallow cloning of `Date` & `RegExp` objects
 * [_.cloneDeep](http://lodash.com/docs#cloneDeep) for deep cloning arrays & objects
 * [_.contains](http://lodash.com/docs#contains) accepts a `fromIndex`
 * [_.createCallback](http://lodash.com/docs#createCallback) for extending callbacks in methods & mixins
 * [_.curry](http://lodash.com/docs#curry) for creating [curried](http://hughfdjackson.com/javascript/2013/07/06/why-curry-helps/) functions
 * [_.debounce](http://lodash.com/docs#debounce) & [_.throttle](http://lodash.com/docs#throttle) accept additional `options` for more control
 * [_.findIndex](http://lodash.com/docs#findIndex) & [_.findKey](http://lodash.com/docs#findKey) for finding indexes & keys
 * [_.forEach](http://lodash.com/docs#forEach) is chainable & supports exiting early
 * [_.forIn](http://lodash.com/docs#forIn) for iterating own & inherited properties
 * [_.forOwn](http://lodash.com/docs#forOwn) for iterating own properties
 * [_.isPlainObject](http://lodash.com/docs#isPlainObject) for checking if values are created by `Object`
 * [_.memoize](http://lodash.com/docs#memoize) exposes the `cache` of memoized functions
 * [_.merge](http://lodash.com/docs#merge) for a deep [_.extend](http://lodash.com/docs#extend)
 * [_.parseInt](http://lodash.com/docs#parseInt) for consistent behavior
 * [_.partialRight](http://lodash.com/docs#partialRight) for [partial application](http://lodash.com/docs#partial) from the right
 * [_.pull](http://lodash.com/docs#pull) & [_.remove](http://lodash.com/docs#remove) for mutating arrays
 * [_.random](http://lodash.com/docs#random) supports returning floating-point numbers
 * [_.runInContext](http://lodash.com/docs#runInContext) for easier mocking
 * [_.support](http://lodash.com/docs#support) for flagging environment features
 * [_.template](http://lodash.com/docs#template) supports [*“imports”*](http://lodash.com/docs#templateSettings_imports) options & [ES6 template delimiters](http://people.mozilla.org/~jorendorff/es6-draft.html#sec-7.8.6)
 * [_.transform](http://lodash.com/docs#transform) as a powerful alternative to [_.reduce](http://lodash.com/docs#reduce) for transforming objects
 * [_.where](http://lodash.com/docs#where) supports deep object comparisons
 * [_.zip](http://lodash.com/docs#zip) is capable of unzipping values
 * [_.omit](http://lodash.com/docs#omit), [_.pick](http://lodash.com/docs#pick), &
   [more](http://lodash.com/docs "_.assign, _.clone, _.cloneDeep, _.first, _.initial, _.isEqual, _.last, _.merge, _.rest") accept callbacks
 * [_.contains](http://lodash.com/docs#contains), [_.toArray](http://lodash.com/docs#toArray), &
   [more](http://lodash.com/docs "_.at, _.countBy, _.every, _.filter, _.find, _.forEach, _.forEachRight, _.groupBy, _.invoke, _.map, _.max, _.min, _.pluck, _.reduce, _.reduceRight, _.reject, _.shuffle, _.size, _.some, _.sortBy, _.where") accept strings
 * [_.filter](http://lodash.com/docs#filter), [_.map](http://lodash.com/docs#map), &
   [more](http://lodash.com/docs "_.countBy, _.every, _.find, _.findKey, _.findLast, _.findLastIndex, _.findLastKey, _.first, _.groupBy, _.initial, _.last, _.max, _.min, _.reject, _.rest, _.some, _.sortBy, _.sortedIndex, _.uniq") support *“_.pluck”* & *“_.where”* shorthands
 * [_.findLast](http://lodash.com/docs#findLast), [_.findLastIndex](http://lodash.com/docs#findLastIndex), &
   [more](http://lodash.com/docs "_.findLastKey, _.forEachRight, _.forInRight, _.forOwnRight") right-associative methods

## Resources

 * Podcasts
  - [JavaScript Jabber](http://javascriptjabber.com/079-jsj-lo-dash-with-john-david-dalton/)

 * Posts
  - [Say “Hello” to Lo-Dash](http://kitcambridge.be/blog/say-hello-to-lo-dash/)
  - [Custom builds in Lo-Dash 2.0](http://kitcambridge.be/blog/custom-builds-in-lo-dash-2-dot-0/)

 * Videos
  - [Introduction](https://vimeo.com/44154599)
  - [Origins](https://vimeo.com/44154600)
  - [Optimizations & builds](https://vimeo.com/44154601)
  - [Native method use](https://vimeo.com/48576012)
  - [Testing](https://vimeo.com/45865290)
  - [CascadiaJS ’12](http://www.youtube.com/watch?v=dpPy4f_SeEk)

 For a list of other community created podcasts, posts, and videos please check out our [wiki](https://github.com/lodash/lodash/wiki/Resources).

## Support

Tested in Chrome 5~30, Firefox 2~24, IE 6-10, Opera 9.25~16, Safari 3-6, Node.js 0.6.8-0.10.20, Narwhal 0.3.2, PhantomJS 1.9.2, RingoJS 0.9, & Rhino 1.7RC5.

## Installation & usage
>>>>>>> upstream/master

In browsers:

```html
<script src="lodash.js"></script>
```

<<<<<<< HEAD
Using [npm](http://npmjs.org/):

```bash
npm install lodash

npm install -g lodash
npm link lodash
```
=======
Using [`npm`](http://npmjs.org/):

```bash
npm i --save lodash
>>>>>>> upstream/master

{sudo} npm i -g lodash
npm ln lodash
```

<<<<<<< HEAD
```js
var _ = require('lodash');
```

**Note:** If Lo-Dash is installed globally, [run `npm link lodash`](http://blog.nodejs.org/2011/03/23/npm-1-0-global-vs-local-installation/) in your project’s root directory before requiring it.

In [RingoJS v0.7.0-](http://ringojs.org/):

```js
var _ = require('lodash')._;
```
=======
In [Node.js](http://nodejs.org/) & [Ringo](http://ringojs.org/):

```js
var _ = require('lodash');
// or as Underscore
var _ = require('lodash/dist/lodash.underscore');
```

**Notes:**
 * Don’t assign values to [special variable](http://nodejs.org/api/repl.html#repl_repl_features) `_` when in the REPL
 * If Lo-Dash is installed globally, run [`npm ln lodash`](http://blog.nodejs.org/2011/03/23/npm-1-0-global-vs-local-installation/) in your project’s root directory *before* requiring it
 * Node.js 0.10.8-0.10.11 [have](https://github.com/joyent/node/issues/5622) [bugs](https://github.com/joyent/node/issues/5688) preventing minified builds
>>>>>>> upstream/master

In [Rhino](http://www.mozilla.org/rhino/):

```js
load('lodash.js');
```

In an AMD loader:

```js
require({
<<<<<<< HEAD
  'paths': {
    'underscore': 'path/to/lodash'
  }
=======
  'packages': [
    { 'name': 'lodash', 'location': 'path/to/lodash', 'main': 'lodash' }
  ]
>>>>>>> upstream/master
},
['underscore'], function(_) {
  console.log(_.VERSION);
});
```
<<<<<<< HEAD

## Resolved Underscore.js issues

 * Allow iteration of objects with a `length` property [[#799](https://github.com/documentcloud/underscore/pull/799), [test](https://github.com/bestiejs/lodash/blob/v0.9.2/test/test.js#L545-551)]
 * Fix cross-browser object iteration bugs [[#60](https://github.com/documentcloud/underscore/issues/60), [#376](https://github.com/documentcloud/underscore/issues/376), [test](https://github.com/bestiejs/lodash/blob/v0.9.2/test/test.js#L558-582)]
 * Methods should work on pages with incorrectly shimmed native methods [[#7](https://github.com/documentcloud/underscore/issues/7), [#742](https://github.com/documentcloud/underscore/issues/742), [test](https://github.com/bestiejs/lodash/blob/v0.9.2/test/test.js#L140-146)]
 * `_.isEmpty` should support jQuery/MooTools DOM query collections [[#690](https://github.com/documentcloud/underscore/pull/690), [test](https://github.com/bestiejs/lodash/blob/v0.9.2/test/test.js#L747-752)]
 * `_.isObject` should avoid V8 bug [#2291](http://code.google.com/p/v8/issues/detail?id=2291) [[#605](https://github.com/documentcloud/underscore/issues/605), [test](https://github.com/bestiejs/lodash/blob/v0.9.2/test/test.js#L828-840)]
 * `_.keys` should work with `arguments` objects cross-browser [[#396](https://github.com/documentcloud/underscore/issues/396), [test](https://github.com/bestiejs/lodash/blob/v0.9.2/test/test.js#L921-923)]
 * `_.range` should coerce arguments to numbers [[#634](https://github.com/documentcloud/underscore/issues/634), [#683](https://github.com/documentcloud/underscore/issues/683), [test](https://github.com/bestiejs/lodash/blob/v0.9.2/test/test.js#L1337-1340)]

## Release Notes

### <sup>v0.9.2</sup>

 * Added `fromIndex` argument to `_.contains`
 * Added `moduleId` build option
 * Added Closure Compiler *“simple”* optimizations to the build process
 * Added support for strings in `_.max` and `_.min`
 * Added support for ES6 template delimiters to `_.template`
 * Ensured re-minification of Lo-Dash by third parties avoids Closure Compiler bugs
 * Optimized `_.every`, `_.find`, `_.some`, and `_.uniq`

The full changelog is available [here](https://github.com/bestiejs/lodash/wiki/Changelog).

## BestieJS

Lo-Dash is part of the BestieJS *“Best in Class”* module collection. This means we promote solid browser/environment support, ES5 precedents, unit testing, and plenty of documentation.
=======

## Author

| [![twitter/jdalton](http://gravatar.com/avatar/299a3d891ff1920b69c364d061007043?s=70)](http://twitter.com/jdalton "Follow @jdalton on Twitter") |
|---|
| [John-David Dalton](http://allyoucanleet.com/) |
>>>>>>> upstream/master

## Contributors

<<<<<<< HEAD
* [John-David Dalton](http://allyoucanleet.com/)
  [![twitter/jdalton](http://gravatar.com/avatar/299a3d891ff1920b69c364d061007043?s=70)](https://twitter.com/jdalton "Follow @jdalton on Twitter")

## Contributors

* [Kit Cambridge](http://kitcambridge.github.com/)
  [![twitter/kitcambridge](http://gravatar.com/avatar/6662a1d02f351b5ef2f8b4d815804661?s=70)](https://twitter.com/kitcambridge "Follow @kitcambridge on Twitter")
* [Mathias Bynens](http://mathiasbynens.be/)
  [![twitter/mathias](http://gravatar.com/avatar/24e08a9ea84deb17ae121074d0f17125?s=70)](https://twitter.com/mathias "Follow @mathias on Twitter")
=======
| [![twitter/blainebublitz](http://gravatar.com/avatar/ac1c67fd906c9fecd823ce302283b4c1?s=70)](http://twitter.com/blainebublitz "Follow @BlaineBublitz on Twitter") | [![twitter/kitcambridge](http://gravatar.com/avatar/6662a1d02f351b5ef2f8b4d815804661?s=70)](https://twitter.com/kitcambridge "Follow @kitcambridge on Twitter") | [![twitter/mathias](http://gravatar.com/avatar/24e08a9ea84deb17ae121074d0f17125?s=70)](http://twitter.com/mathias "Follow @mathias on Twitter") |
|---|---|---|
| [Blaine Bublitz](http://iceddev.com/) | [Kit Cambridge](http://kitcambridge.github.io/) | [Mathias Bynens](http://mathiasbynens.be/) |
>>>>>>> upstream/master
