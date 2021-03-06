/*!
<<<<<<< HEAD
 * QUnit CLI Boilerplate v1.0.0
=======
 * QUnit CLI Boilerplate v1.3.0
>>>>>>> upstream/master
 * Copyright 2011-2012 John-David Dalton <http://allyoucanleet.com/>
 * Based on a gist by Jörn Zaefferer <https://gist.github.com/722381>
 * Available under MIT license <http://mths.be/mit>
 */
<<<<<<< HEAD
;(function(global) {
  'use strict';

  /** Add `console.log()` support for Narwhal, Rhino, and RingoJS */
  global.console || (global.console = { 'log': global.print });

  /** Reduce global.QUnit.QUnit -> global.QUnit */
  global.QUnit && (QUnit = QUnit.QUnit || QUnit);

  /*--------------------------------------------------------------------------*/

  /** Used as a horizontal rule in console output */
  var hr = '----------------------------------------';

  /** Shortcut used to convert array-like objects to arrays */
  var slice = [].slice;

  /** Used to resolve a value's internal [[Class]] */
  var toString = {}.toString;

  /** Used by timer methods */
  var doneCalled,
      timer,
      counter = 0,
      ids = {};
=======
;(function(root) {
  'use strict';

  /** Detect free variable `exports` */
  var freeExports = typeof exports == 'object' && exports;

  /** Detect free variable `global`, from Node.js or Browserified code, and use it as `root` */
  var freeGlobal = typeof global == 'object' && global;
  if (freeGlobal.global === freeGlobal || freeGlobal.window === freeGlobal) {
    root = freeGlobal;
  }
>>>>>>> upstream/master

  /*--------------------------------------------------------------------------*/

  /**
<<<<<<< HEAD
   * An iteration utility for arrays.
   *
   * @private
   * @param {Array} array The array to iterate over.
   * @param {Function} callback The function called per iteration.
   */
  function each(array, callback) {
    var index = -1,
        length = array.length;

    while (++index < length) {
      callback(array[index], index, array);
    }
  }

  /**
   * Checks if the specified `value` is a function.
   *
   * @private
   * @param {Mixed} value The value to check.
   * @returns {Boolean} Returns `true` if `value` is a function, else `false`.
   */
  function isFunction(value) {
    return toString.call(value) == '[object Function]';
  }

  /*--------------------------------------------------------------------------*/

  /**
   * Timeout fallbacks based on the work of Andrea Giammarchi and Weston C.
   * https://github.com/WebReflection/wru/blob/master/src/rhinoTimers.js
   * http://stackoverflow.com/questions/2261705/how-to-run-a-javascript-function-asynchronously-without-using-settimeout
   */

  /**
   * Clears the delay set by `setInterval` or `setTimeout`.
   *
   * @memberOf global
   * @param {Number} id The ID of the timeout to be cleared.
   */
  function clearTimer(id) {
    if (ids[id]) {
      ids[id].cancel();
      timer.purge();
      delete ids[id];
    }
  }

  /**
   * Schedules timer-based callbacks.
   *
   * @private
   * @param {Function} fn The function to call.
   * @oaram {Number} delay The number of milliseconds to delay the `fn` call.
   * @param [arg1, arg2, ...] Arguments to invoke `fn` with.
   * @param {Boolean} repeated A flag to specify whether `fn` is called repeatedly.
   * @returns {Number} The the ID of the timeout.
   */
  function schedule(fn, delay, args, repeated) {
    // Rhino 1.7RC4 will error assigning `task` below
    // https://bugzilla.mozilla.org/show_bug.cgi?id=775566
    var task = ids[++counter] = new JavaAdapter(java.util.TimerTask, {
      'run': function() {
        fn.apply(global, args);
      }
    });
    // support non-functions
    if (!isFunction(fn)) {
      fn = (function(code) {
        code = String(code);
        return function() { eval(code); };
      }(fn));
    }
    // used by setInterval
    if (repeated) {
      timer.schedule(task, delay, delay);
    }
    // used by setTimeout
    else {
      timer.schedule(task, delay);
    }
    return counter;
  }

  /**
   * Executes a code snippet or function repeatedly, with a delay between each call.
   *
   * @memberOf global
   * @param {Function|String} fn The function to call or string to evaluate.
   * @oaram {Number} delay The number of milliseconds to delay each `fn` call.
   * @param [arg1, arg2, ...] Arguments to invoke `fn` with.
   * @returns {Number} The the ID of the timeout.
   */
  function setInterval(fn, delay) {
    return schedule(fn, delay, slice.call(arguments, 2), true);
  }

  /**
   * Executes a code snippet or a function after specified delay.
   *
   * @memberOf global
   * @param {Function|String} fn The function to call or string to evaluate.
   * @oaram {Number} delay The number of milliseconds to delay the `fn` call.
   * @param [arg1, arg2, ...] Arguments to invoke `fn` with.
   * @returns {Number} The the ID of the timeout.
   */
  function setTimeout(fn, delay) {
    return schedule(fn, delay, slice.call(arguments, 2));
  }

  /*--------------------------------------------------------------------------*/

  /**
   * A logging callback triggered when all testing is completed.
   *
   * @memberOf QUnit
   * @param {Object} details An object with properties `failed`, `passed`,
   *  `runtime`, and `total`.
   */
  function done(details) {
    // stop `asyncTest()` from erroneously calling `done()` twice in
    // environments w/o timeouts
    if (doneCalled) {
      return;
    }
    doneCalled = true;
    console.log(hr);
    console.log('    PASS: ' + details.passed + '  FAIL: ' + details.failed + '  TOTAL: ' + details.total);
    console.log('    Finished in ' + details.runtime + ' milliseconds.');
    console.log(hr);

    // exit out of Rhino
    try {
      quit();
    } catch(e) { }

    // exit out of Node.js
    try {
      if (details.failed) {
        console.error('Error: ' + details.failed + ' of ' + details.total + ' tests failed.');
        process.exit(1);
      } else {
        process.exit(0);
      }
    } catch(e) { }
  }

  /**
   * A logging callback triggered after every assertion.
   *
   * @memberOf QUnit
   * @param {Object} details An object with properties `actual`, `expected`,
   *  `message`, and `result`.
   */
  function log(details) {
    var expected = details.expected,
        result = details.result,
        type = typeof expected != 'undefined' ? 'EQ' : 'OK';

    var assertion = [
      result ? 'PASS' : 'FAIL',
      type,
      details.message || 'ok'
    ];

    if (!result && type == 'EQ') {
      assertion.push('Expected: ' + expected + ', Actual: ' + details.actual);
    }
    QUnit.config.testStats.assertions.push(assertion.join(' | '));
  }

  /**
   * A logging callback triggered at the start of every test module.
   *
   * @memberOf QUnit
   * @param {Object} details An object with property `name`.
   */
  function moduleStart(details) {
    console.log(hr);
    console.log(details.name);
    console.log(hr);
  }

  /**
   * Converts an object into a string representation.
   *
   * @memberOf QUnit
   * @type Function
   * @param {Object} object The object to stringify.
   * @returns {String} The result string.
   */
  var parseObject = (function() {
    var func = QUnit.jsDump.parsers.object;
    return function(object) {
      // fork to support Rhino's error objects
      if (typeof object.rhinoException == 'object') {
        return object.name +
          ' { message: "' + object.message +
          '", fileName: "' + object.fileName +
          '", lineNumber: ' + object.lineNumber + ' }';
      }
      return func(object);
    };
  }());

  /**
   * A logging callback triggered after a test is completed.
   *
   * @memberOf QUnit
   * @param {Object} details An object with properties `failed`, `name`,
   *  `passed`, and `total`.
   */
  function testDone(details) {
    var assertions = QUnit.config.testStats.assertions,
        testName = details.name;

    if (details.failed > 0) {
      console.log(' FAIL - '+ testName);
      each(assertions, function(value) {
        console.log('    ' + value);
      });
    }
    else {
      console.log(' PASS - ' + testName);
    }
    assertions.length = 0;
  }

  /*--------------------------------------------------------------------------*/

  /**
   * An object used to hold information about the current running test.
   *
   * @memberOf QUnit.config
   * @type Object
   */
  QUnit.config.testStats = {

    /**
     * An array of test summaries (pipe separated).
     *
     * @memberOf QUnit.config.testStats
     * @type Array
     */
    'assertions': []
  };

  // add shortcuts to the global
  // exclude `module` because some environments have it as a built-in object
  each(['asyncTest', 'deepEqual', 'equal', 'equals', 'expect', 'notDeepEqual',
        'notEqual', 'notStrictEqual', 'ok', 'raises', 'same', 'start', 'stop',
        'strictEqual', 'test', 'throws'], function(funcName) {
    var func = QUnit[funcName];
    if (func) {
      global[funcName] = func;
    }
  });

  // expose timer methods to global
  try {
    timer = new java.util.Timer;
    if (!isFunction(global.clearInterval)) {
      global.clearInterval = clearTimer;
    }
    if (!isFunction(global.clearTimeout)) {
      global.clearTimeout = clearTimer;
    }
    if (!isFunction(global.setInterval)) {
      global.setInterval = setInterval;
    }
    if (!isFunction(global.setTimeout)) {
      global.setTimeout = setTimeout;
    }
  } catch(e) { }

  // add callbacks
  QUnit.done(done);
  QUnit.log(log);
  QUnit.moduleStart(moduleStart);
  QUnit.testDone(testDone);

  // add wrapped function
  QUnit.jsDump.parsers.object = parseObject;

  // must call `QUnit.start()` in the test file if using QUnit < 1.3.0 with
  // Node.js or any version of QUnit with Narwhal, Rhino, or RingoJS
  QUnit.init();

}(typeof global == 'object' && global || this));
=======
   * Installs the CLI boilerplate additions on the given `context` object.
   *
   * @memberOf exports
   * @param {Object} context The context object.
   */
  function runInContext(context) {
    // exit early if no `context` is provided or if `QUnit` does not exist
    if (!context || !context.QUnit) {
      return;
    }

    /**
     * Schedules timer-based callbacks.
     *
     * @private
     * @param {Function|string} fn The function to call.
     * @param {number} delay The number of milliseconds to delay the `fn` call.
     * @param [arg1, arg2, ...] Arguments to invoke `fn` with.
     * @param {boolean} repeated A flag to specify whether `fn` is called repeatedly.
     * @returns {number} The the ID of the timeout.
     */
    function schedule(fn, delay, args, repeated) {
      // Rhino 1.7RC4 will error assigning `task` below
      // https://bugzilla.mozilla.org/show_bug.cgi?id=775566
      var task = ids[++counter] = new JavaAdapter(java.util.TimerTask, {
        'run': function() {
          fn.apply(context, args);
        }
      });
      // support non-functions
      if (typeof fn != 'function') {
        fn = (function(code) {
          code = String(code);
          return function() { eval(code); };
        }(fn));
      }
      // used by setInterval
      if (repeated) {
        timer.schedule(task, delay, delay);
      }
      // used by setTimeout
      else {
        timer.schedule(task, delay);
      }
      return counter;
    }

    /**
     * Clears the delay set by `setInterval` or `setTimeout`.
     *
     * @memberOf context
     * @param {number} id The ID of the timeout to be cleared.
     */
    function clearTimer(id) {
      if (ids[id]) {
        ids[id].cancel();
        timer.purge();
        delete ids[id];
      }
    }

    /**
     * Executes a code snippet or function repeatedly, with a delay between each call.
     *
     * @memberOf context
     * @param {Function|string} fn The function to call or string to evaluate.
     * @param {number} delay The number of milliseconds to delay each `fn` call.
     * @param [arg1, arg2, ...] Arguments to invoke `fn` with.
     * @returns {number} The the ID of the timeout.
     */
    function setInterval(fn, delay) {
      return schedule(fn, delay, slice.call(arguments, 2), true);
    }

    /**
     * Executes a code snippet or a function after specified delay.
     *
     * @memberOf context
     * @param {Function|string} fn The function to call or string to evaluate.
     * @param {number} delay The number of milliseconds to delay the `fn` call.
     * @param [arg1, arg2, ...] Arguments to invoke `fn` with.
     * @returns {number} The the ID of the timeout.
     */
    function setTimeout(fn, delay) {
      return schedule(fn, delay, slice.call(arguments, 2));
    }

    /*------------------------------------------------------------------------*/

    /** Used to report the test module for failing tests */
    var moduleName,
        modulePrinted;

    /** Add `console.log()` support for Narwhal, Rhino, and RingoJS */
    var console = context.console || (context.console = { 'log': context.print });

    /** Used as a horizontal rule in console output */
    var hr = '----------------------------------------';

    /** Used by `logInline` to clear previously logged messages */
    var prevLine = '';

    /** Shorten `context.QUnit.QUnit` to `context.QUnit` */
    var QUnit = context.QUnit = context.QUnit.QUnit || context.QUnit;

    /**
     * Logs an inline message to standard output.
     *
     * @private
     * @param {string} text The text to log.
     */
    var logInline = (function() {
      // exit early if not Node.js
      if (!(typeof process == 'object' && process &&
          process.on && process.stdout && process.platform != 'win32')) {
        return function() {};
      }
      // cleanup any inline logs when exited via `ctrl+c`
      process.on('SIGINT', function() {
        logInline('');
        process.exit();
      });
      return function(text) {
        var blankLine = Array(prevLine.length + 1).join(' ');
        if (text.length > hr.length) {
          text = text.slice(0, hr.length - 3) + '...';
        }
        prevLine = text;
        process.stdout.write(text + blankLine.slice(text.length) + '\r');
      }
    }());

    /**
     * A logging callback triggered when all testing is completed.
     *
     * @memberOf QUnit
     * @param {Object} details An object with properties `failed`, `passed`, `runtime`, and `total`.
     */
    QUnit.done(function() {
      var ran;
      return function(details) {
        // stop `asyncTest()` from erroneously calling `done()` twice in
        // environments w/o timeouts
        if (ran) {
          return;
        }
        ran = true;

        logInline('');
        console.log(hr);
        console.log('    PASS: ' + details.passed + '  FAIL: ' + details.failed + '  TOTAL: ' + details.total);
        console.log('    Finished in ' + details.runtime + ' milliseconds.');
        console.log(hr);

        var fails = details.failed,
            error = fails + ' of ' + details.total + ' tests failed.';

        // exit out of Node.js or PhantomJS
        try {
          var process = context.process || context.phantom;
          if (fails) {
            console.error('Error: ' + error);
            process.exit(1);
          } else {
            process.exit(0);
          }
        } catch(e) {
          if (fails) {
            throw new Error(error);
          }
        }
        // exit out of Narhwal, Rhino, or RingoJS
        try {
          quit();
        } catch(e) { }
      };
    }());

    /**
     * A logging callback triggered after every assertion.
     *
     * @memberOf QUnit
     * @param {Object} details An object with properties `actual`, `expected`, `message`, and `result`.
     */
    QUnit.log(function(details) {
      var expected = details.expected,
          result = details.result,
          type = typeof expected != 'undefined' ? 'EQ' : 'OK';

      var assertion = [
        result ? 'PASS' : 'FAIL',
        type,
        details.message || 'ok'
      ];

      if (!result && type == 'EQ') {
        assertion.push('Expected: ' + expected + ', Actual: ' + details.actual);
      }
      QUnit.config.testStats.assertions.push(assertion.join(' | '));
    });

    /**
     * A logging callback triggered at the start of every test module.
     *
     * @memberOf QUnit
     * @param {Object} details An object with property `name`.
     */
    QUnit.moduleStart(function(details) {
      var newModuleName = details.name;
      if (moduleName != newModuleName) {
        moduleName = newModuleName;
        modulePrinted = false;
      }
    });

    /**
     * Converts an object into a string representation.
     *
     * @memberOf QUnit
     * @type Function
     * @param {Object} object The object to stringify.
     * @returns {string} The result string.
     */
    QUnit.jsDump.parsers.object = (function() {
      var func = QUnit.jsDump.parsers.object;
      return function(object) {
        // fork to support Rhino's error objects
        if (typeof object.rhinoException == 'object') {
          return object.name +
            ' { message: "' + object.message +
            '", fileName: "' + object.fileName +
            '", lineNumber: ' + object.lineNumber + ' }';
        }
        return func(object);
      };
    }());

    /**
     * A logging callback triggered after a test is completed.
     *
     * @memberOf QUnit
     * @param {Object} details An object with properties `failed`, `name`, `passed`, and `total`.
     */
    QUnit.testDone(function(details) {
      var assertions = QUnit.config.testStats.assertions,
          testName = details.name;

      if (details.failed > 0) {
        logInline('');
        if (!modulePrinted) {
          modulePrinted = true;
          console.log(hr);
          console.log(moduleName);
          console.log(hr);
        }
        console.log(' FAIL - '+ testName);
        assertions.forEach(function(value) {
          console.log('    ' + value);
        });
      } else {
        logInline('Testing ' + moduleName + '...');
      }
      assertions.length = 0;
    });

    /**
     * An object used to hold information about the current running test.
     *
     * @memberOf QUnit.config
     * @type Object
     */
    QUnit.config.testStats = {

      /**
       * An array of test summaries.
       *
       * @memberOf QUnit.config.testStats
       * @type Array
       */
      'assertions': []
    };

    /*------------------------------------------------------------------------*/

    // Timeout fallbacks based on the work of Andrea Giammarchi and Weston C.
    // https://github.com/WebReflection/wru/blob/master/src/rhinoTimers.js
    // http://stackoverflow.com/questions/2261705/how-to-run-a-javascript-function-asynchronously-without-using-settimeout
    try {
      var counter = 0,
          ids = {},
          slice = Array.prototype.slice,
          timer = new java.util.Timer;

      context.clearInterval =
      context.clearTimeout = clearTimer;
      context.setInterval = setInterval;
      context.setTimeout = setTimeout;
    } catch(e) { }

    // expose shortcuts
    // exclude `module` because some environments have it as a built-in object
    ('asyncTest deepEqual equal equals expect notDeepEqual notEqual notStrictEqual ' +
     'ok raises same start stop strictEqual test throws').replace(/\S+/g, function(methodName) {
      context[methodName] = QUnit[methodName];
    });

    // must call `QUnit.start()` in the test file if not loaded in a browser
    if (!context.document || context.phantom) {
      QUnit.config.autostart = false;
      QUnit.init();
    }
  }

  /*--------------------------------------------------------------------------*/

  // expose QUnit CLIB
  if (freeExports && !freeExports.nodeType) {
    freeExports.runInContext = runInContext;
  } else {
    runInContext(root);
  }
}(this));
>>>>>>> upstream/master
