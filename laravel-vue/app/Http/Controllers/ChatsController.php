<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Inertia\Inertia;

class ChatsController extends Controller
{
    
    public function index(){

        return Inertia::render('Chat');
    }
}
