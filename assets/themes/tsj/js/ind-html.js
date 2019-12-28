// JavaScript Document
$.ajax({
  url: "header.html",
  cache: false
}).done(function( html ) {
  $("#text").append(html);
});

$.ajax({
  url: "dw-menu.html",
  cache: false
}).done(function( html ) {
  $("section").append(html);
});

$.ajax({
  url: "footer.html",
  cache: false
}).done(function( html ) {
  $("footer").append(html);
});

$.ajax({
  url: "nav1.html",
  cache: false
}).done(function( html ) {
  $("nav").append(html);
});
