<?php
require_once '../core/init.php';
// include('cek-login.php');

$query = mysql_query("SELECT * FROM pageabout");

?>

<!DOCTYPE html>
<html>
<head>
        <title>Manage Halaman Tentang Kami</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="bootstrap-wysihtml5/src/bootstrap-wysihtml5.css"></link>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="container-fluid">
            <div class="row-fluid">

                <!--/span-->

                <div class="span10">
                	<div class="row-fluid">

		                <div class="span12" id="content">
		                    <div class="row-fluid">
		                        <!-- block -->
		                        <div class="block">

		                            <div class="block-content collapse in">
		                               	<form action="Submit-kami.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                      <?php  $data = mysql_fetch_array($query); ?>

                                        <textarea id="ckeditor_full" name="desc"><?php echo $data['deskripsi']; ?></textarea>

		                            	<br>
                                        <button class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
		                        </div>
		                        <!-- /block -->
		                    </div>
		                </div>

                	</div>
                </div>

            </div>
            <hr>
            <footer>
                <p>&copy; Shop 2013</p>
            </footer>
        </div>

        <!--/.fluid-container-->
    <script src="bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>

    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/adapters/jquery.js"></script>

    <script src="assets/scripts.js"></script>
        <script>
        $(function() {
            // Bootstrap
            $('#bootstrap-editor').wysihtml5();

			// Ckeditor standard
            $( 'textarea#ckeditor_standard' ).ckeditor({width:'98%', height: '150px', toolbar: [
				{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
				[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
				{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
			]});
            $( 'textarea#ckeditor_full' ).ckeditor({width:'98%', height: '150px'});
        });


        </script>
    </body>

</html>
