(function ($, drupalSettings) {
  Drupal.behaviors.sliderPro = {
    galleries: [],
    attach: function (context, settings) {
      var that = this;
      // Init all galleries.
      for (id in settings.sliderPro.instances) {
        // Store galleries so that developers can change options.
        that.galleries[id] = settings.sliderPro.instances[id];
        _slider_pro_init(id, that.galleries[id], context);
      }
    }
  };

  function _slider_pro_init(id, optionset, context) {
    $('#' + id, context).sliderPro(optionset);
  }
})(jQuery, drupalSettings);