<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {

        $response = Http::get('https://dummyjson.com/products');
        $products = $response->json()['products'];


        $perPage = 10;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;


        $paginatedProducts = array_slice($products, $offset, $perPage);

        return response()->json([
            'data' => $paginatedProducts,
            'current_page' => $page,
            'last_page' => ceil(count($products) / $perPage),
            'total' => count($products),
        ]);
    }
}
