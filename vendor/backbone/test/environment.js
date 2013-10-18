(function() {

<<<<<<< HEAD
  var Environment = this.Environment = function(){};

  _.extend(Environment.prototype, {

    ajax: Backbone.ajax,

    sync: Backbone.sync,

    emulateHTTP: Backbone.emulateHTTP,

    emulateJSON: Backbone.emulateJSON,

    setup: function() {
      var env = this;

      // Capture ajax settings for comparison.
      Backbone.ajax = function(settings) {
        env.ajaxSettings = settings;
      };

      // Capture the arguments to Backbone.sync for comparison.
      Backbone.sync = function(method, model, options) {
        env.syncArgs = {
          method: method,
          model: model,
          options: options
        };
        env.sync.apply(this, arguments);
      };
    },

    teardown: function() {
      this.syncArgs = null;
      this.ajaxSettings = null;
      Backbone.sync = this.sync;
      Backbone.ajax = this.ajax;
      Backbone.emulateHTTP = this.emulateHTTP;
      Backbone.emulateJSON = this.emulateJSON;
    }

=======
  var sync = Backbone.sync;
  var ajax = Backbone.ajax;
  var emulateHTTP = Backbone.emulateHTTP;
  var emulateJSON = Backbone.emulateJSON;

  QUnit.testStart(function() {
    var env = this.config.current.testEnvironment;

    // Capture ajax settings for comparison.
    Backbone.ajax = function(settings) {
      env.ajaxSettings = settings;
    };

    // Capture the arguments to Backbone.sync for comparison.
    Backbone.sync = function(method, model, options) {
      env.syncArgs = {
        method: method,
        model: model,
        options: options
      };
      sync.apply(this, arguments);
    };

  });

  QUnit.testDone(function() {
    Backbone.sync = sync;
    Backbone.ajax = ajax;
    Backbone.emulateHTTP = emulateHTTP;
    Backbone.emulateJSON = emulateJSON;
>>>>>>> upstream/master
  });

})();
