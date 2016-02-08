(function($){

Craft.ControllerActionInput = Garnish.Base.extend(
{
  $field: null,
  $actionBtn: null,
  $spinner: null,

  init: function(settings)
  {
    this.setSettings(settings);

    this.$field = $('#'+this.settings.id+'-field');
    this.$actionBtn = this.$field.find('.controlleraction');
    this.$spinner = this.$field.find('.spinner');

    this.addListener(this.$actionBtn, 'activate', 'doAction');
  },

  doAction: function()
  {
    this.$spinner.removeClass('hidden');

    Craft.postActionRequest(this.settings.actionPath, this.settings.postData, $.proxy(function(response, textStatus)
    {
      this.$spinner.addClass('hidden');

      if (textStatus == 'success') {
        if (response.error) {
          Craft.cp.displayError(this.settings.errorMessage);
        } else {
          Craft.cp.displayNotice(this.settings.successMessage);
        }
      }
    }, this));
  },
});

})(jQuery);
