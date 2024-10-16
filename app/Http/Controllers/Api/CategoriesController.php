<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all character
        $category = Categories::latest()->paginate(5);

        //response
        $response = [
           'message' => 'List All Category',
           'data' => $category,
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi data
        $validator = Validator::make($request->all(),[
            'category' => 'required|unique:categories|min:2',
        ]);


        //jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors()
            ],422);
        }

        //insert character to database
        $category = Categories::create([
            'category' => $request->category,
            'is_active' => $request->input('is_active', 1),
        ]);


        //response
        $response = [
            'success'   => 'Add category success',
            'data'      => $category,
        ];


        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //find character by ID
        $category = Categories::find($id);


        //response
        $response = [
            'success'   => 'Detail category',
            'data'      => $category,
        ];


        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validasi data
       $validator = Validator::make($request->all(),[
        'category' => 'required|unique:categories|min:2',
        'is_active' => $request->input('is_active', 1),
    ]);


    //jika validasi gagal
    if ($validator->fails()) {
        return response()->json([
            'message' => 'Invalid field',
            'errors' => $validator->errors()
        ],422);
    }


    //find character by ID
    $category = Categories::find($id);


    //update post without image
    $category->update([
        'category' => $request->category,
        ]);
    }


    //response
    $response = [
        'success'   => 'Update category success',
        'data'      => $category,
    ];


    return response()->json($response, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
