<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use PaginationLibrary\Pagination;
use Validator;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $totalLocations = Location::count();
        $itemsPerPage = $request->query('items_per_page', 10); // Default 10 item per halaman
        $currentPage = $request->query('page', 1); // Halaman saat ini (default halaman 1)
        // Inisialisasi Pagination library Tsany
        $pagination = new Pagination($totalLocations, $itemsPerPage, $currentPage);

        $locations = Location::offset($pagination->getOffset())->limit($pagination->getLimit())->get();

        $paginationLocations = $pagination->getPaginationInfo();

        return response()->json(['success' => true, 'data' => $locations, 'pagination' => $paginationLocations]);
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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255',
            'description' => 'nullable|string|',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 400);
        }

        // Menyimpan data produk baru
        $location = Location::create([
            'code' => $request->code,
            'description' => $request->description,
            'capacity'=> $request->capacity
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Location berhasil dibuat',
            'data' => $location
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Location tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $location
        ], 200);
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
        //
       // Validasi input
       $validator = Validator::make($request->all(), [
        'code' => 'required|string|max:255',
        'description' => 'nullable|string|',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak valid',
            'errors' => $validator->errors()
        ], 400);
    }

    $location = Location::find($id);

    if (!$location) {
        return response()->json([
            'success' => false,
            'message' => 'Location tidak ditemukan'
        ], 404);
    }

    // Memperbarui data produk
    $location->update([
        'code' => $request->code ?? $location->code,
        'description' => $request->description ?? $location->description,
        'capacity'=> $request->capacity

    ]);

    return response()->json([
        'success' => true,
        'message' => 'Location berhasil diperbarui',
        'data' => $location
    ], 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Location tidak ditemukan'
            ], 404);
        }

        // Menghapus Location
        $location->delete();

        return response()->json([
            'success' => true,
            'message' => 'Location berhasil dihapus'
        ], 200);
    }
}
