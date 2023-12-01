<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Producto::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'titulo' => 'required',
            'tipo' => 'required',
            'metrosCuadrados' => 'required',
            'metrosConstruccion' => 'nullable',
            'precio' => 'required',
            'direccion' => 'required',
            'fotos0' => 'image', // Assuming 2048 is the maximum file size in kilobytes
        ]);
    
        // File upload logic
        if ($request->hasFile('fotos0')) {
                $file = $request->file('fotos0');
                $filename = $file->getClientOriginalName();
                $filename= pathinfo($filename, PATHINFO_FILENAME);
                $name_File = str_replace(' ', '_', $filename);
                $extension = $file->getClientOriginalExtension();
                $picture = date('His').'-'.$name_File.'.'.$extension;
                $file->move(public_path('images/'), $picture);
       
           }else { return response()->json(['error' => 'File upload failed.'], 500);}
    
        $product = Producto::create([
            'titulo' => $request->titulo,
            'tipo' => $request->tipo,
            'metrosCuadrados' => $request->metrosCuadrados,
            'metrosConstruccion' => $request->metrosConstruccion,
            'precio' => $request->precio,
            'direccion' => $request->direccion,
            'fotos' => url('images/' . $picture),
        ]);
    
        return response()->json($product, 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Producto::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Producto::findOrFail($id);
         $product->update($request->all());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Producto::findOrFail($id);
        return response()->json($product->delete());
    }
}
