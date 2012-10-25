$(document).ready(function() {
  
//$("select.emaillist").change(function() {
//    
//    $("option.emaillist:selected").each(function () {
//        
//        $.post(
//                "/mgr/ajaxactions/post_ajax", 
//                { email: $(this).text() },
//                function(data){
//                    alert("Hello"); 
//                }, 
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
