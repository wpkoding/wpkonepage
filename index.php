<?php
/*
Really one page :p
redirect all request to home.
*/
header('Location: '.esc_url( home_url( '/' ) ));
?>