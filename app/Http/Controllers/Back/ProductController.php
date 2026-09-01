<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Content;
use App\Models\Quantity;

class ProductController extends Controller
{
    public function store(Request $request) {

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'category'       => 'required|numeric',
            'status'         => 'required|in:active,inactive',
            'price'          => 'required|numeric',
            'stock'          => 'required|numeric',
            'description'    => 'required|string',
            'caracteristque' => 'required|string',
            'contents'       => 'required|array|min:1',
            'contents.*'     => 'required|string|max:255',
            'quantities'     => 'required|array|min:1',
            'quantities.*'   => 'required|integer|min:1',
            'couverture'     => 'required|image',
            'image1'         => 'required|image',
            'image2'         => 'required|image',
            'image3'         => 'required|image',
        ]);

        $product = Product::create([
            'name'              => $validated['name'],
            'stock'             => $validated['stock'],
            'status'            => $validated['status'],
            'price'             => $validated['price'],
            'description'       => $validated['description'],
            'features'          => $validated['caracteristque'],
            'image_description' => $validated['couverture'],
            'image_1'           => $validated['image1'],
            'image_2'           => $validated['image2'],
            'image_3'           => $validated['image3'],
            'category_id'       => $validated['category'],
        ]);

        foreach($validated['contents'] as $index => $contentName ) {
            $content = Content::create([
                'name' => $contentName,
            ]);

            $quantity = Quantity::create([
                'value' => $validated['quantities'][$index],
                'content_id' => $content->id,
                'product_id' => $product->id
            ]);
        };
        return redirect()->route('admin.product')->with('success', 'Produit ajoutée avec succès !');
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'category'       => 'required|numeric',
            'status'         => 'required|in:active,inactive',
            'price'          => 'required|numeric',
            'stock'          => 'required|numeric',
            'description'    => 'required|string',
            'caracteristque' => 'required|string',
            'contents'       => 'required|array|min:1',
            'contents.*'     => 'required|string|max:255',
            'quantities'     => 'required|array|min:1',
            'quantities.*'   => 'required|integer|min:1',
            'couverture'     => 'nullable|image|max:2048',
            'image1'         => 'nullable|image|max:2048',
            'image2'         => 'nullable|image|max:2048',
            'image3'         => 'nullable|image|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->name = $validated['name'];
        $product->stock = $validated['stock'];
        $product->status = $validated['status'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];
        $product->features = $validated['caracteristque'];
        $product->category_id = $validated['category'];

        if ($request->hasFile('couverture')) {
            $product->image_description = $request->file('couverture')->store('products', 'public');
        }
        if ($request->hasFile('image1')) {
            $product->image_1 = $request->file('image1')->store('products', 'public');
        }
        if ($request->hasFile('image2')) {
            $product->image_2 = $request->file('image2')->store('products', 'public');
        }
        if ($request->hasFile('image3')) {
            $product->image_3 = $request->file('image3')->store('products', 'public');
        }

        $product->save();

        Quantity::where('product_id', $product->id)->delete();

        foreach($validated['contents'] as $index => $contentName) {
            $content = Content::create([
                'name' => $contentName,
            ]);

            Quantity::create([
                'value' => $validated['quantities'][$index],
                'content_id' => $content->id,
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('admin.product')->with('success', 'Produit modifié avec succès !');
}

    public function destroy($id) {
        $product = Product::findOrFail($id);

        Quantity::where('product_id', $product->id)->delete();

        $product->delete();

        return redirect()->route('admin.product')->with('success', 'Produit supprimé avec succès !');
    }

    public function toggleStatus($id) {
        $product = Product::findOrFail($id);
        $product->status = $product->status === 'active' ? 'inactive' : 'active';
        $product->save();
        return redirect()->route('admin.product')->with('success', 'Statut du produit modifié !');
    }
}

