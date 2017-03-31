//Menu function

$(function(){
$(".dropdown").hover(
        function() {
            $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
            $(this).toggleClass('open');
            $('b', this).toggleClass("caret caret-up");
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
            $(this).toggleClass('open');
            $('b', this).toggleClass("caret caret-up");
        });
});

// JS of Gallery
$(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});


$(document).ready(function()
                  {
                  $("#add_fields_placeholder").change(function()
        {
            if($(this).val() == "No")
        {
            $("#basicfield").show();
            $("#basic").attr("required", "required");


        }
        else
        {
            $("#basicfield").hide();
            $("#basic").removeAttr("required", "required");

        }
            });
            $("#basicfield").hide();
            $("#basic").removeAttr("required", "required");

});

$(document).ready(function()
                  {
                  $("#add_jobs_placeholder").change(function()
        {
            if($(this).val() == "No")
        {
            $("#jobfield1").show();
            $("#jobfield2").show();
            $("#jobfield3").show();
            $("#job1").attr("required", "required");
            $("#job2").attr("required", "required");
            $("#job3").attr("required", "required");

        }
        else
        {
            $("#jobfield1").hide();
            $("#jobfield2").hide();
            $("#jobfield3").hide();
            $("#job1").removeAttr("required", "required");
            $("#job2").removeAttr("required", "required");
            $("#job3").removeAttr("required", "required");

        }
            });

            $("#jobfield1").hide();
            $("#jobfield2").hide();
            $("#jobfield3").hide();
            $("#job1").removeAttr("required", "required");
            $("#job2").removeAttr("required", "required");
            $("#job3").removeAttr("required", "required");

});

jQuery(document).ready(function() {

  var navOffset = jQuery("nav").offset().top;
  jQuery("nav").wrap('<div class="nav-placeholder"></div>');
  jQuery(".nav-placeholder").height(jQuery("nav").outerHeight());
  jQuery(window).scroll(function(){
    var scrollPos = jQuery(window).scrollTop();
    // jQuery(".status").html(scrollPos);
    if(scrollPos >= navOffset){
      jQuery("nav").addClass("fixed");
    }else{
      jQuery("nav").removeClass("fixed");
    }
  });

});
