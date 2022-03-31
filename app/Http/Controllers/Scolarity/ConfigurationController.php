<?php
namespace App\Http\Controllers\Inscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ConfigurationController extends Controller
{
    public function index()
    {
		
        return view('inscription/configuration/index');
		
    }
}