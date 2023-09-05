<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Comite;
use Validator;
use Illuminate\Support\Str;
use Mail;

$password = bcrypt('test');

error_log(print_r($password, true));