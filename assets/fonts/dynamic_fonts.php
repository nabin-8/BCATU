<?php
header("Content-type: text/css; charset: UTF-8");

$font_name = 'Roboto';
$font_file = 'Montserrat-Regular.ttf';
?>

@font-face {
font-family: '<?php echo $font_name; ?>';
src: url('<?php echo $font_file; ?>');
}

body {
font-family: '<?php echo $font_name; ?>';
}
