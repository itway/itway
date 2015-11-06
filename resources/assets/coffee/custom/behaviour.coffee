# JavaScript source code
$(document).ready ->
  $('.tooltip-bottom').tooltipster
    animation: 'fade'
    delay: 200
    theme: 'tooltipster-light'
    touchDevices: true
    trigger: 'hover'
    position: 'bottom'
  $('.tooltip-left').tooltipster
    animation: 'fade'
    delay: 200
    theme: 'tooltipster-light'
    touchDevices: true
    trigger: 'hover'
    position: 'left'
  $('.tooltip-right').tooltipster
    animation: 'fade'
    delay: 200
    theme: 'tooltipster-light'
    touchDevices: true
    trigger: 'hover'
    position: 'right'
  $('.tooltip').tooltipster
    animation: 'fade'
    delay: 200
    theme: 'tooltipster-light'
    touchDevices: true
    trigger: 'hover'
  return
do ->
  nav = document.getElementById('nav')
  anchor = nav.getElementsByTagName('a')
  path = window.location
  current = window.location.pathname
  i = 0
  while i < anchor.length
    definedLinks = anchor[i].pathname
    if definedLinks == current
      anchor[i].className = 'item selected'
    i++
  return
do ->
  $(document).ready ->
    $.ajaxSetup headers: 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    return
  return

# ---
