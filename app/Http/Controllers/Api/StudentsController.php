<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');
        return !$search?
            [] :
            Student::whereHas('user', function($query) use($search) {
                $query->where('users.name', 'LIKE', "%{$search}%");
            })->take(10)->get();
    }
}
