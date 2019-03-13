<?php
require_once 'restful.php';

$data = Resquest::dealRequest();

Respone::sendResponse($data);