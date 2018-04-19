<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class getqueryController extends Controller
{
    public function index(){
         $students = DB::table('students')->get();
         return view('students', ['students' => $students]);
    }
}