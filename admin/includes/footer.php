</div><br><br>
<div class="col-md-12 text-center">&copy; Copyright 2016 伟力集团 All Rights Reserved</div>

<!-- footer End -->
<!-- jQuery, -->
<script src="bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="../fotorama/fotorama.js"></script>
<script src="bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>


<!--/.fluid-container-->
<script src="assets/scripts.js"></script>

<script>
(function($) {
jQuery.fn.cke_resize = function() {
 return this.each(function() {
    var $this = $(this);
    var rows = $this.attr('rows');
    var height = rows * 20;
    $this.next("div.cke").find(".cke_contents").css("height", height);
 });
};
})(jQuery);

CKEDITOR.on( 'instanceReady', function(){
$("textarea.ckeditor").cke_resize();
})
</script>
</body>
</html>
