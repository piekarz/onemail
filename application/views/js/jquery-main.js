$(document).ready(function() {
  
//$("select.emaillist").click(function() {
//    
//    $("option.emaillist:selected").first(function () {
//        
//        $.post(
//                "./ajaxactions/post_ajax", 
//                { email: 'pppiekarz@wp.pl' },
//                "json");
//
//                    
//    });
//        
//});


var is_visible = false;
 
// hide all of the elements with a class of 'toggle'
$('.droptable').hide();
$('.droptableshow').show();
 
// capture clicks on the toggle links
$('a.toggleLink').click(function() {
 
// switch visibility
is_visible = !is_visible;
 

 
// hide each elements
$('.leftmenu').each(function(){
    $('.droptable').hide('400');
    $('.droptableshow').hide('400');
});
// show pressed element of menu
$(this).parent().next('.droptable').toggle('100');
$(this).parent().next('.droptableshow').toggle('100');

return false;
 
});
$("textarea.writebody").TextAreaExpander();
});
