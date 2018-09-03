<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('layouts::default');

echo "\nERROR: ",
	$heading,
	"\n\n",
	$message,
	"\n\n";