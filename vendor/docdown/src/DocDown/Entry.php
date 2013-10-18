<?php

require(dirname(__FILE__) . "/Alias.php");

/**
 * A class to simplify parsing a single JSDoc entry.
 */
class Entry {

  /**
   * The documentation entry.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @type String
=======
   * @type string
>>>>>>> upstream/master
   */
  public $entry = '';

  /**
   * The language highlighter used for code examples.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @type String
=======
   * @type string
>>>>>>> upstream/master
   */
  public $lang = '';

  /**
   * The source code.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @type String
=======
   * @type string
>>>>>>> upstream/master
   */
  public $source = '';

  /*--------------------------------------------------------------------------*/

  /**
   * The Entry constructor.
   *
   * @constructor
<<<<<<< HEAD
   * @param {String} $entry The documentation entry to analyse.
   * @param {String} $source The source code.
   * @param {String} [$lang ='js'] The language highlighter used for code examples.
=======
   * @param {string} $entry The documentation entry to analyse.
   * @param {string} $source The source code.
   * @param {string} [$lang ='js'] The language highlighter used for code examples.
>>>>>>> upstream/master
   */
  public function __construct( $entry, $source, $lang = 'js' ) {
    $this->entry = $entry;
    $this->lang = $lang;
    $this->source = str_replace(PHP_EOL, "\n", $source);
  }

  /*--------------------------------------------------------------------------*/

  /**
   * Extracts the documentation entries from source code.
   *
   * @static
   * @memberOf Entry
<<<<<<< HEAD
   * @param {String} $source The source code.
   * @returns {Array} The array of entries.
   */
  public static function getEntries( $source ) {
    preg_match_all('#/\*\*(?![-!])[\s\S]*?\*/\s*[^\n]+#', $source, $result);
=======
   * @param {string} $source The source code.
   * @returns {Array} The array of entries.
   */
  public static function getEntries( $source ) {
    preg_match_all('#/\*\*(?![-!])[\s\S]*?\*/\s*.+#', $source, $result);
>>>>>>> upstream/master
    return array_pop($result);
  }

  /*--------------------------------------------------------------------------*/

  /**
   * Checks if the entry is a function reference.
   *
   * @private
   * @memberOf Entry
<<<<<<< HEAD
   * @returns {Boolean} Returns `true` if the entry is a function reference, else `false`.
=======
   * @returns {boolean} Returns `true` if the entry is a function reference, else `false`.
>>>>>>> upstream/master
   */
  private function isFunction() {
    if (!isset($this->_isFunction)) {
      $this->_isFunction = !!(
        $this->isCtor() ||
        count($this->getParams()) ||
        count($this->getReturns()) ||
<<<<<<< HEAD
        preg_match('/\* *@function\b/', $this->entry)
=======
        preg_match('/\*[\t ]*@function\b/', $this->entry)
>>>>>>> upstream/master
      );
    }
    return $this->_isFunction;
  }

  /*--------------------------------------------------------------------------*/

  /**
   * Extracts the entry's `alias` objects.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @param {Number} $index The index of the array value to return.
   * @returns {Array|String} The entry's `alias` objects.
   */
  public function getAliases( $index = null ) {
    if (!isset($this->_aliases)) {
      preg_match('#\* *@alias\s+([^\n]+)#', $this->entry, $result);

      if (count($result)) {
        $result = trim(preg_replace('/(?:^|\n)\s*\* ?/', ' ', $result[1]));
=======
   * @param {number} $index The index of the array value to return.
   * @returns {Array|string} The entry's `alias` objects.
   */
  public function getAliases( $index = null ) {
    if (!isset($this->_aliases)) {
      preg_match('#\*[\t ]*@alias\s+(.+)#', $this->entry, $result);

      if (count($result)) {
        $result = trim(preg_replace('/(?:^|\n)[\t ]*\*[\t ]?/', ' ', $result[1]));
>>>>>>> upstream/master
        $result = preg_split('/,\s*/', $result);
        natsort($result);

        foreach ($result as $resultIndex => $value) {
          $result[$resultIndex] = new Alias($value, $this);
        }
      }
      $this->_aliases = $result;
    }
    return $index !== null
      ? @$this->_aliases[$index]
      : $this->_aliases;
  }

  /**
   * Extracts the function call from the entry.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @returns {String} The function call.
=======
   * @returns {string} The function call.
>>>>>>> upstream/master
   */
  public function getCall() {
    if (isset($this->_call)) {
      return $this->_call;
    }

    preg_match('#\*/\s*(?:function ([^(]*)|(.*?)(?=[:=,]|return\b))#', $this->entry, $result);
    if ($result = array_pop($result)) {
      $result = array_pop(explode('var ', trim(trim(array_pop(explode('.', $result))), "'")));
    }
    // resolve name
    // avoid $this->getName() because it calls $this->getCall()
<<<<<<< HEAD
    preg_match('#\* *@name\s+([^\n]+)#', $this->entry, $name);
=======
    preg_match('#\*[\t ]*@name\s+(.+)#', $this->entry, $name);
>>>>>>> upstream/master
    if (count($name)) {
      $name = trim($name[1]);
    } else {
      $name = $result;
    }
    // compile function call syntax
    if ($this->isFunction()) {
      // compose parts
      $result = array($result);
      $params = $this->getParams();
<<<<<<< HEAD
      foreach ($params as $param) {
        $result[] = $param[1];
      }
      // format
      $result = $name .'('. implode(array_slice($result, 1), ', ') .')';
      $result = str_replace(', [', ' [, ', str_replace('], [', ', ', $result));
=======

      foreach ($params as $param) {
        // skip params that are properties of other params (e.g. `options.leading`)
        if (!preg_match('/\w+\.[\w.]+\s*=/', $param[1])) {
          $result[] = $param[1];
        }
      }
      // format
      $result = $name .'('. implode(array_slice($result, 1), ', ') .')';
>>>>>>> upstream/master
    }

    $this->_call = $result ? $result : $name;
    return $this->_call;
  }

  /**
   * Extracts the entry's `category` data.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @returns {String} The entry's `category` data.
=======
   * @returns {string} The entry's `category` data.
>>>>>>> upstream/master
   */
  public function getCategory() {
    if (isset($this->_category)) {
      return $this->_category;
    }

<<<<<<< HEAD
    preg_match('#\* *@category\s+([^\n]+)#', $this->entry, $result);
    if (count($result)) {
      $result = trim(preg_replace('/(?:^|\n)\s*\* ?/', ' ', $result[1]));
=======
    preg_match('#\*[\t ]*@category\s+(.+)#', $this->entry, $result);
    if (count($result)) {
      $result = trim(preg_replace('/(?:^|\n)[\t ]*\*[\t ]?/', ' ', $result[1]));
>>>>>>> upstream/master
    } else {
      $result = $this->getType() == 'Function' ? 'Methods' : 'Properties';
    }
    $this->_category = $result;
    return $result;
  }

  /**
   * Extracts the entry's description.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @returns {String} The entry's description.
=======
   * @returns {string} The entry's description.
>>>>>>> upstream/master
   */
  public function getDesc() {
    if (isset($this->_desc)) {
      return $this->_desc;
    }

    preg_match('#/\*\*(?:\s*\*)?([\s\S]*?)(?=\*\s\@[a-z]|\*/)#', $this->entry, $result);
    if (count($result)) {
      $type = $this->getType();
<<<<<<< HEAD
      $result = trim(preg_replace('/(?:^|\n)\s*\* ?/', ' ', $result[1]));
=======
      $result = preg_replace('/:\n[\t ]*\*[\t ]*/', ":<br>\n", $result[1]);
      $result = preg_replace('/(?:^|\n)[\t ]*\*\n[\t ]*\*[\t ]*/', "\n\n", $result);
      $result = preg_replace('/(?:^|\n)[\t ]*\*[\t ]?/', ' ', $result);
      $result = trim($result);
>>>>>>> upstream/master
      $result = ($type == 'Function' ? '' : '(' . str_replace('|', ', ', trim($type, '{}')) . '): ') . $result;
    }
    $this->_desc = $result;
    return $result;
  }

  /**
   * Extracts the entry's `example` data.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @returns {String} The entry's `example` data.
=======
   * @returns {string} The entry's `example` data.
>>>>>>> upstream/master
   */
  public function getExample() {
    if (isset($this->_example)) {
      return $this->_example;
    }

<<<<<<< HEAD
    preg_match('#\* *@example\s+([\s\S]*?)(?=\*\s\@[a-z]|\*/)#', $this->entry, $result);
    if (count($result)) {
      $result = trim(preg_replace('/(?:^|\n)\s*\* ?/', "\n", $result[1]));
=======
    preg_match('#\*[\t ]*@example\s+([\s\S]*?)(?=\*\s\@[a-z]|\*/)#', $this->entry, $result);
    if (count($result)) {
      $result = trim(preg_replace('/(?:^|\n)[\t ]*\*[\t ]?/', "\n", $result[1]));
>>>>>>> upstream/master
      $result = '```' . $this->lang . "\n" . $result . "\n```";
    }
    $this->_example = $result;
    return $result;
  }

  /**
<<<<<<< HEAD
   * Resolves the entry's line number.
   *
   * @memberOf Entry
   * @returns {Number} The entry's line number.
=======
   * Checks if the entry is an alias.
   *
   * @memberOf Entry
   * @returns {boolean} Returns `false`.
   */
  public function isAlias() {
    return false;
  }

  /**
   * Checks if the entry is a constructor.
   *
   * @memberOf Entry
   * @returns {boolean} Returns `true` if a constructor, else `false`.
   */
  public function isCtor() {
    if (!isset($this->_isCtor)) {
      $this->_isCtor = !!preg_match('/\*[\t ]*@constructor\b/', $this->entry);
    }
    return $this->_isCtor;
  }

  /**
   * Checks if the entry is a license.
   *
   * @memberOf Entry
   * @returns {boolean} Returns `true` if a license, else `false`.
   */
  public function isLicense() {
    if (!isset($this->_isLicense)) {
      $this->_isLicense = !!preg_match('/\*[\t ]*@license\b/', $this->entry);
    }
    return $this->_isLicense;
  }

  /**
   * Checks if the entry *is* assigned to a prototype.
   *
   * @memberOf Entry
   * @returns {boolean} Returns `true` if assigned to a prototype, else `false`.
   */
  public function isPlugin() {
    if (!isset($this->_isPlugin)) {
      $this->_isPlugin = !$this->isCtor() && !$this->isPrivate() && !$this->isStatic();
    }
    return $this->_isPlugin;
  }

  /**
   * Checks if the entry is private.
   *
   * @memberOf Entry
   * @returns {boolean} Returns `true` if private, else `false`.
   */
  public function isPrivate() {
    if (!isset($this->_isPrivate)) {
      $this->_isPrivate = $this->isLicense() || !!preg_match('/\*[\t ]*@private\b/', $this->entry) || !preg_match('/\*[\t ]*@[a-z]+\b/', $this->entry);
    }
    return $this->_isPrivate;
  }

  /**
   * Checks if the entry is *not* assigned to a prototype.
   *
   * @memberOf Entry
   * @returns {boolean} Returns `true` if not assigned to a prototype, else `false`.
   */
  public function isStatic() {
    if (isset($this->_isStatic)) {
      return $this->_isStatic;
    }

    $public = !$this->isPrivate();
    $result = $public && !!preg_match('/\*[\t ]*@static\b/', $this->entry);

    // set in cases where it isn't explicitly stated
    if ($public && !$result) {
      if ($parent = array_pop(preg_split('/[#.]/', $this->getMembers(0)))) {
        foreach (Entry::getEntries($this->source) as $entry) {
          $entry = new Entry($entry, $this->source);
          if ($entry->getName() == $parent) {
            $result = !$entry->isCtor();
            break;
          }
        }
      } else {
        $result = true;
      }
    }
    $this->_isStatic = $result;
    return $result;
  }

  /**
   * Resolves the entry's line number.
   *
   * @memberOf Entry
   * @returns {number} The entry's line number.
>>>>>>> upstream/master
   */
  public function getLineNumber() {
    if (!isset($this->_lineNumber)) {
      preg_match_all('/\n/', substr($this->source, 0, strrpos($this->source, $this->entry) + strlen($this->entry)), $lines);
      $this->_lineNumber = count(array_pop($lines)) + 1;
    }
    return $this->_lineNumber;
  }

  /**
   * Extracts the entry's `member` data.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @param {Number} $index The index of the array value to return.
   * @returns {Array|String} The entry's `member` data.
   */
  public function getMembers( $index = null ) {
    if (!isset($this->_members)) {
      preg_match('#\* *@member(?:Of)?\s+([^\n]+)#', $this->entry, $result);
      if (count($result)) {
        $result = trim(preg_replace('/(?:^|\n)\s*\* ?/', ' ', $result[1]));
=======
   * @param {number} $index The index of the array value to return.
   * @returns {Array|string} The entry's `member` data.
   */
  public function getMembers( $index = null ) {
    if (!isset($this->_members)) {
      preg_match('#\*[\t ]*@member(?:Of)?\s+(.+)#', $this->entry, $result);
      if (count($result)) {
        $result = trim(preg_replace('/(?:^|\n)[\t ]*\*[\t ]?/', ' ', $result[1]));
>>>>>>> upstream/master
        $result = preg_split('/,\s*/', $result);
        natsort($result);
      }
      $this->_members = $result;
    }
    return $index !== null
      ? @$this->_members[$index]
      : $this->_members;
  }

  /**
   * Extracts the entry's `name` data.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @returns {String} The entry's `name` data.
=======
   * @returns {string} The entry's `name` data.
>>>>>>> upstream/master
   */
  public function getName() {
    if (isset($this->_name)) {
      return $this->_name;
    }

<<<<<<< HEAD
    preg_match('#\* *@name\s+([^\n]+)#', $this->entry, $result);
    if (count($result)) {
      $result = trim(preg_replace('/(?:^|\n)\s*\* ?/', ' ', $result[1]));
=======
    preg_match('#\*[\t ]*@name\s+(.+)#', $this->entry, $result);
    if (count($result)) {
      $result = trim(preg_replace('/(?:^|\n)[\t ]*\*[\t ]?/', ' ', $result[1]));
>>>>>>> upstream/master
    } else {
      $result = array_shift(explode('(', $this->getCall()));
    }
    $this->_name = $result;
    return $result;
  }

  /**
   * Extracts the entry's `param` data.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @param {Number} $index The index of the array value to return.
=======
   * @param {number} $index The index of the array value to return.
>>>>>>> upstream/master
   * @returns {Array} The entry's `param` data.
   */
  public function getParams( $index = null ) {
    if (!isset($this->_params)) {
<<<<<<< HEAD
      preg_match_all('#\* *@param\s+\{([^}]+)\}\s+(\[.+\]|[$\w|]+(?:\[.+\])?)\s+([\s\S]*?)(?=\*\s\@[a-z]|\*/)#i', $this->entry, $result);
      if (count($result = array_filter(array_slice($result, 1)))) {
        // repurpose array
        foreach ($result as $param) {
          foreach ($param as $key => $value) {
            if (!is_array($result[0][$key])) {
              $result[0][$key] = array();
            }
            $result[0][$key][] = trim(preg_replace('/(?:^|\n)\s*\* */', ' ', $value));
          }
        }
        $result = $result[0];
=======
      preg_match_all('#\*[\t ]*@param\s+\{\(?([^})]+)\)?\}\s+(\[.+\]|[$\w|]+(?:\[.+\])?)\s+([\s\S]*?)(?=\*\s\@[a-z]|\*/)#i', $this->entry, $matchTuples);
      $matchTuples = array_filter(array_slice($matchTuples, 1));
      $result = array();

      if (count($matchTuples)) {
        foreach ($matchTuples as $tupleKey => $tuple) {
          foreach ($tuple as $key => $value) {
            if (!isset($result[$key])) {
              $result[$key] = array();
            }
            $result[$key][] = $tupleKey
              ? trim(preg_replace('/(?:^|\n)[\t ]*\*[\t ]*/', ' ', $value))
              : trim($value);
          }
        }
>>>>>>> upstream/master
      }
      $this->_params = $result;
    }
    return $index !== null
      ? @$this->_params[$index]
      : $this->_params;
  }

  /**
   * Extracts the entry's `returns` data.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @returns {String} The entry's `returns` data.
=======
   * @returns {string} The entry's `returns` data.
>>>>>>> upstream/master
   */
  public function getReturns() {
    if (isset($this->_returns)) {
      return $this->_returns;
    }

<<<<<<< HEAD
    preg_match('#\* *@returns\s+\{([^}]+)\}\s+([\s\S]*?)(?=\*\s\@[a-z]|\*/)#', $this->entry, $result);
    if (count($result)) {
      $result = array_map('trim', array_slice($result, 1));
      $result[0] = str_replace('|', ', ', $result[0]);
      $result[1] = preg_replace('/(?:^|\n)\s*\* ?/', ' ', $result[1]);
=======
    preg_match('#\*[\t ]*@returns\s+\{([^}]+)\}\s+([\s\S]*?)(?=\*\s\@[a-z]|\*/)#', $this->entry, $result);
    if (count($result)) {
      $result = array_map('trim', array_slice($result, 1));
      $result[0] = str_replace('|', ', ', $result[0]);
      $result[1] = preg_replace('/(?:^|\n)[\t ]*\*[\t ]?/', ' ', $result[1]);
>>>>>>> upstream/master
    }
    $this->_returns = $result;
    return $result;
  }

  /**
   * Extracts the entry's `type` data.
   *
   * @memberOf Entry
<<<<<<< HEAD
   * @returns {String} The entry's `type` data.
=======
   * @returns {string} The entry's `type` data.
>>>>>>> upstream/master
   */
  public function getType() {
    if (isset($this->_type)) {
      return $this->_type;
    }

<<<<<<< HEAD
    preg_match('#\* *@type\s+([^\n]+)#', $this->entry, $result);
    if (count($result)) {
      $result = trim(preg_replace('/(?:^|\n)\s*\* ?/', ' ', $result[1]));
    } else {
      $result = $this->isFunction() ? 'Function' : 'Unknown';
=======
    preg_match('#\*[\t ]*@type\s(?:\{\(?)?([^)}\n]+)#', $this->entry, $result);
    if (count($result)) {
      $result = trim($result[1]);
      if (preg_match('/^(?:array|function|object|regexp)$/', $result)) {
        $result = ucfirst($result);
      }
    } else {
      $result = $this->isFunction() ? 'Function' : 'unknown';
>>>>>>> upstream/master
    }
    $this->_type = $result;
    return $result;
  }
<<<<<<< HEAD

  /**
   * Checks if the entry is an alias.
   *
   * @memberOf Entry
   * @returns {Boolean} Returns `false`.
   */
  public function isAlias() {
    return false;
  }

  /**
   * Checks if the entry is a constructor.
   *
   * @memberOf Entry
   * @returns {Boolean} Returns `true` if a constructor, else `false`.
   */
  public function isCtor() {
    if (!isset($this->_isCtor)) {
      $this->_isCtor = !!preg_match('/\* *@constructor\b/', $this->entry);
    }
    return $this->_isCtor;
  }

  /**
   * Checks if the entry *is* assigned to a prototype.
   *
   * @memberOf Entry
   * @returns {Boolean} Returns `true` if assigned to a prototype, else `false`.
   */
  public function isPlugin() {
    if (!isset($this->_isPlugin)) {
      $this->_isPlugin = !$this->isCtor() && !$this->isPrivate() && !$this->isStatic();
    }
    return $this->_isPlugin;
  }

  /**
   * Checks if the entry is private.
   *
   * @memberOf Entry
   * @returns {Boolean} Returns `true` if private, else `false`.
   */
  public function isPrivate() {
    if (!isset($this->_isPrivate)) {
      $this->_isPrivate = !!preg_match('/\* *@private\b/', $this->entry) || !preg_match('/\* *@[a-z]+\b/', $this->entry);
    }
    return $this->_isPrivate;
  }

  /**
   * Checks if the entry is *not* assigned to a prototype.
   *
   * @memberOf Entry
   * @returns {Boolean} Returns `true` if not assigned to a prototype, else `false`.
   */
  public function isStatic() {
    if (isset($this->_isStatic)) {
      return $this->_isStatic;
    }

    $public = !$this->isPrivate();
    $result = $public && !!preg_match('/\* *@static\b/', $this->entry);

    // set in cases where it isn't explicitly stated
    if ($public && !$result) {
      if ($parent = array_pop(preg_split('/[#.]/', $this->getMembers(0)))) {
        foreach (Entry::getEntries($this->source) as $entry) {
          $entry = new Entry($entry, $this->source);
          if ($entry->getName() == $parent) {
            $result = !$entry->isCtor();
            break;
          }
        }
      } else {
        $result = true;
      }
    }
    $this->_isStatic = $result;
    return $result;
  }
=======
>>>>>>> upstream/master
}
?>