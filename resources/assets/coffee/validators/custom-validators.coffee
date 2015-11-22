###*
# JavaScript function to match (and return) the video Id
# of any valid Youtube Url, given as input string.
###
$.ItwayIO.cValidator =
  ytVidId: (url) ->
    p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/
    if url.match(p) then RegExp.$1 else false

  githubLNK: (url, opts) ->
    _this = this
    try
      m = _this.githubLNKre(opts).exec(url.replace(/\.git(#.*)?$/, ''))
      host = m[1]
      path = m[2]
      return 'https://' + host + '/' + path
    catch err
      false
    return

  # generate the git:// parsing regex
  # with options, e.g., the ability
  # to specify multiple GHE domains.

  githubLNKre: (opts) ->
    opts = opts or {}
    # whitelist of URLs that should be treated as GitHub repos.
    baseUrls = [
      'gist.github.com'
      'github.com'
    ].concat(opts.extraBaseUrls or [])
    # build regex from whitelist.
    new RegExp(/^(?:https?:\/\/|git:\/\/|git\+ssh:\/\/|git\+https:\/\/)?(?:[^@]+@)?/.source + '(' + baseUrls.join('|') + ')' + /[:\/]([^\/]+\/[^\/]+?|[0-9]+)$/.source)
