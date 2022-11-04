<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Author::all();
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
            "name.required" => "Masukkan nama",
            "email.required" => "Masukkan email",
            "no_hp.required" => "Masukkan Nomor HP",
            'gender.required' => "Masukkan gender",
            'tempat_lahir.required' => "Masukkan Tempat Lahir",
            'tanggal_lahir.required' => "Masukkan Tanggal Lahir"
        ];
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required'
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
            $store = Author::create($validate->validate());
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
        $update = Author::where('id', $id)->update($request->all());
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
        $delete = Author::destroy($id);
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
