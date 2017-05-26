<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Repositories\ImageRepository;
use App\Product;
use App\Image;

class ProductController extends Controller
{
	protected $images;

	public function __construct(Image $image)
	{
		$this->images = $image;
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
	{
		return view('products.index', [
			'products' => Product::all()
		]);
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:128',
			'price' => 'required|numeric',
			'description' => 'required|max:255'
		]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);
		
		if($request->hasFile('image')){
		    $file = $request->file('image');
            $name = 'image_' . time() . '.' . $file->extension();

            $file->move('uploads', $name);

            Image::create([
                'product_id' => $product->id,
                'path' =>  $name,
            ]);
		}

        Session::flash('message', 'Successfully added product!');
		return redirect('/products');
	}

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function show($id)
	{
		return view('product.show', [
			'product' => Product::findOrFail((int) $id)
		]);
	}

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function edit($id)
	{
        return view('products.edit', [
            'product' => Product::findOrFail((int) $id)
        ]);
	}

	public function update(Request $request, $id)
	{
        $this->validate($request, [
            'name' => 'required|max:128',
            'price' => 'required|numeric',
            'description' => 'required|max:255'
        ]);

        $product = Product::findOrFail((int) $id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        Session::flash('message', 'Successfully updated product!');
        return redirect('/products');
	}

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function destroy($id)
	{
		$product = Product::findOrFail((int) $id);
		$product->delete();

		return redirect('/products');
	}
}
