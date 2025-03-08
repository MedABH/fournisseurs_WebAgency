<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Import your model

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all(); // Fetch all orders
        return view('myApp.admin.links.journaux', compact('orders'));
    }
}

