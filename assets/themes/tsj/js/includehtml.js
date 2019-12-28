// JavaScript Document




/*$.ajax({
  url: "slink.html",
  cache: false
}).done(function( html ) {
  $("#slink-list").append(html);
});*/



$(document).ready(function(){ 
$.get("header.html",function(data){ //初始將a.html include div#iframe
$("#header-wrapper").html(data);
});
$.get("footer.html",function(data){ //初始將a.html include div#iframe
$("#footer-wrapper").html(data);
});
$.get("slink.html",function(data){ //初始將a.html include div#iframe
$("#slink-list").html(data);
});
});