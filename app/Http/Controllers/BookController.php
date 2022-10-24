<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Psr\Http\Message\ResponseInterface;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        $response = [
            "status" => 200,
            "data" => $books
        ];
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messges = [
            "title.required" => "Masukkan Title",
            "description.required" => "Masukkan Deskripsi",
            "author.required" => "Masukkan Author",
            'publisher.required' => "Masukkan Publisher",
            'date_of_issue.required' => "Masukkan Tanggal Buku Dibuat"
        ];
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'date_of_issue' => 'required'
        ], $messges);

        if ($validate->fails()) {
            $response = [
                'status' => 400,
                'message' => $validate->errors()
            ];
            return response()->json(
                $response,
                400
            );
        } else {
            $store = Book::create($validate->validate());
            if ($store) {
                $response = [
                    'status' => 201,
                    'message' => "Data Berhasil Ditambahkan"
                ];
                return response()->json(
                    $response,
                    201
                );
            } else {
                $response = [
                    'status' => 400,
                    'message' => "Data Gagal Ditambahkan"
                ];
                return response()->json(
                    $response,
                    400
                );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Book::where('id', $id)->update($request->all());
        if ($update) {
            $response = [
                'status' => 201,
                'message' => "Data Berhasil Diupdate"
            ];
            return response()->json(
                $response,
                201
            );
        }
        $response = [
            'status' => 400,
            'message' => "Data Gagal Diupdate"
        ];
        return response()->json(
            $response,
            400
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Book::destroy($id);
        if ($delete) {
            $response = [
                'status' => 201,
                'message' => "Data Berhasil Dihapus"
            ];
            return response()->json(
                $response,
                201
            );
        }
        $response = [
            'status' => 400,
            'message' => "Data Gagal Dihapus"
        ];
        return response()->json(
            $response,
            400
        );
    }
}
