<?php
/*!
 * Docdown v1.0.0-pre
<<<<<<< HEAD
 * Copyright 2011-2012 John-David Dalton <http://allyoucanleet.com/>
 * Available under MIT license <http://mths.be/mit>
 */
require(dirname(__FILE__) . '/src/DocDown/Generator.php');
=======
 * Copyright 2011-2013 John-David Dalton <http://allyoucanleet.com/>
 * Available under MIT license <http://mths.be/mit>
 */
require(dirname(__FILE__) . '/src/DocDown/MarkdownGenerator.php');
>>>>>>> upstream/master

/**
 * Generates Markdown from JSDoc entries in a given file.
 *
 * @param {Array} [$options=array()] The options array.
<<<<<<< HEAD
 * @returns {String} The generated Markdown.
=======
 * @returns {string} The generated Markdown.
>>>>>>> upstream/master
 * @example
 *
 * // specify a file path
 * $markdown = docdown(array(
 *   // path to js file
 *   'path' => $filepath,
 *   // url used to reference line numbers in code
 *   'url' => 'https://github.com/username/project/blob/master/my.js'
 * ));
 *
 * // or pass raw js
 * $markdown = docdown(array(
 *   // raw JavaScript source
 *   'source' => $rawJS,
 *   // documentation title
 *   'title' => 'My API Documentation',
 *   // url used to reference line numbers in code
 *   'url' => 'https://github.com/username/project/blob/master/my.js'
 * ));
 */
function docdown( $options = array() ) {
<<<<<<< HEAD
  $gen = new Generator($options);
=======
  $gen = new MarkdownGenerator($options);
>>>>>>> upstream/master
  return $gen->generate();
}
?>