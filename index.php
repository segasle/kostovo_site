<?php
require 'functions/bd.php';
require 'functions/function.php';
require 'functions/info.php';
require 'api/vk.php';
require 'api/instagram.php';
revo();
user_ses();
vk_authorization();
connections();