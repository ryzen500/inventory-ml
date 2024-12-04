<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use PaginationLibrary\Pagination;
use Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $totalSupplier = Supplier::count();
        $itemsPerPage = $request->query('items_per_page', 10); // Default 10 item per halaman
        $currentPage = $request->query('page', 1); // Halaman saat ini (default halaman 1)
        // Inisialisasi Pagination library Tsany
        $pagination = new Pagination($totalSupplier, $itemsPerPage, $currentPage);

        $Supplier = Supplier::offset($pagination->getOffset())->limit($pagination->getLimit())->get();

        $paginationLocations = $pagination->getPaginationInfo();

        return response()->json(['success' => true, 'data' => $Supplier, 'pagination' => $paginationLocations]);
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
            'name' => 'required|string|max:255',
            'telp' => 'nullable|string|',
            'address' => 'nullable|string|',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 400);
        }

        // Menyimpan data Supplier baru
        $location = Supplier::create([
            'name' => $request->name,
            'telp' => $request->telp,
            'address'=> $request->address
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Supplier berhasil dibuat',
            'data' => $location
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $Supplier = Supplier::find($id);

        if (!$Supplier) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $Supplier
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
            'name' => 'required|string|max:255',
            'telp' => 'nullable|string|',
            'address' => 'nullable|string|',
        ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak valid',
            'errors' => $validator->errors()
        ], 400);
    }

    $Supplier = Supplier::find($id);

    if (!$Supplier) {
        return response()->json([
            'success' => false,
            'message' => 'Supplier tidak ditemukan'
        ], 404);
    }

    // Memperbarui data produk
    $Supplier->update([
        'name' => $request->name ?? $Supplier->name,
        'telp' => $request->telp ?? $Supplier->telp,
        'address'=> $request->capacity ?? $Supplier->address
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Location berhasil diperbarui',
        'data' => $Supplier
    ], 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $Supplier = Supplier::find($id);

        if (!$Supplier) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier tidak ditemukan'
            ], 404);
        }

        // Menghapus Supplier
        $Supplier->delete();

        return response()->json([
            'success' => true,
            'message' => 'Supplier berhasil dihapus'
        ], 200);
    }
}
