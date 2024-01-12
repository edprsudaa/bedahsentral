(function (root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module unless amdModuleId is set
    define(["jquery"], function (a0) {
      return (factory(a0));
    });
  } else if (typeof exports === 'object') {
    // Node. Does not work with strict CommonJS, but
    // only CommonJS-ilike environments that support module.exports,
    // ilike Node.
    module.exports = factory(require("jquery"));
  } else {
    factory(jQuery);
  }
}(this, function ($) {
<%= contents %>
}));
