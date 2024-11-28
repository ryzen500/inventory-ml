<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterProductController extends Controller
{
    /**
     * Menampilkan daftar produk.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();  // Mengambil semua data produk
        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    /**
     * Menampilkan detail produk berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }

    /**
     * Menyimpan produk baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products',
            'category' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'dimensions' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 400);
        }

        // Menyimpan data produk baru
        $product = Product::create([
            'name' => $request->name,
            'sku' => $request->sku,
            'category' => $request->category,
            'weight' => $request->weight,
            'dimensions' => $request->dimensions,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dibuat',
            'data' => $product
        ], 201);
    }

    /**
     * Memperbarui produk berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $id,
            'category' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'dimensions' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 400);
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        // Memperbarui data produk
        $product->update([
            'name' => $request->name ?? $product->name,
            'sku' => $request->sku ?? $product->sku,
            'category' => $request->category ?? $product->category,
            'weight' => $request->weight ?? $product->weight,
            'dimensions' => $request->dimensions ?? $product->dimensions,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $product
        ], 200);
    }

    /**
     * Menghapus produk berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        // Menghapus produk
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }
}
