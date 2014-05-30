<?php
// (c)Perez Karjee(www.aas9.in)
// Project Site www.aas9.in/zerocms
// Created March 2014
function redirect($url){
	if(!headers_sent()){
		header('Location: ' . $url);
	} else {
		die('Fuck!, unable to redirect, output was already sent to the browser.');
	}
}
?>
