$(document).ready(function() {
 
// initialise the visibility check
var is_visible = false;
 
// hide all of the elements with a class of 'toggle'
$('.droptable').hide();
 
// capture clicks on the toggle links
$('a.toggleLink').click(function() {
 
// switch visibility
is_visible = !is_visible;
 

 
// hide each elements
//$('.leftmenu').each(function(){
//    $('.droptable').hide('400');
//});
// show pressed element of menu
$(this).parent().next('.droptable').toggle('100');

return false;
 
});
});
