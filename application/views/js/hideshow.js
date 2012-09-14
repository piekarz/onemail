$(document).ready(function() {
 
// initialise the visibility check
var is_visible = false;
 
// hide all of the elements with a class of 'toggle'
$('.leftmenu').hide();
 
// capture clicks on the toggle links
$('a.toggleLink').click(function() {
 
// switch visibility
is_visible = !is_visible;
 

 
// hide each elements
$('.leftmenu').each(function(){
    $('.leftmenu').hide('slow');
});
// show pressed element of menu
$(this).parent().next('.leftmenu').toggle('slow');

return false;
 
});
});
