<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Transformers\DepartmentTransformer;

class ApiController extends Controller
{
    public function fetchAllDepartments()
    {
        $departments = Department::all();
        return response()->json(fractal($departments, new DepartmentTransformer())->toArray()['data']);
    }
}
