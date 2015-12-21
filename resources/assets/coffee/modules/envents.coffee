###
  events functionality
###
$.ItwayIO.envents =
  o:
    dialog: $("[data-remodal-id='create-event']")
    button: $("[data-remodal-id='create-event'] .remodal-confirm")
    organizer_link: $("[name='organizer_link']")
    addonBtn: $("a.github-link")
    timer: undefined
    warningTempl: "<div class=\"text-danger\">The url is not real.</div>"
    dialogTempl:
      "<div class=\"organizer_link-input-success input-success \">
      <i class=\"icon-plus_one\"></i>
      </div>"

  initialize: ->
    _this = this

  resolve: ->
    _this = this
  stop: ->
    _this = this
  resolveAddon: ->
    _this = this

$.ItwayIO.envents.initialize()
