<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator; //this is not auto imported we have to write this while creating validator inside store method
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //This mathod will display products page
    public function index()
    {
            $products = Product::orderBy('created_at','DESC')->get();



             // folder.file name
            return view('products.list',['products' => $products]); 
    }


    //This method will display form for creating a product
    public function create()
    {
        return view("products.create");
    }


    //This method will store a product in db
    public function store(Request $request){

        $rules = [
            'name' => 'required|min:5', //name minimum of 5 characters
            'sku' =>  'required|min:5',
            'price'=> 'required|numeric',
        ];

        if($request->image != ""){
            $rules["image"] = 'image';

            // image should be a valid image
        }



        $validator = Validator::make($request->all(),$rules); //saved inside variable

        if($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);// if error occured then redirect to create page
        }

        //Here we wil store product in db
        $Product = new Product();
        $Product->name = $request->name;
        $Product->sku = $request->sku;
        $Product->price = $request->price;  
        $Product->description = $request->description;
        $Product->save();

        if($request->image != "")
        {
            //here we will store image
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext; //unique image name

        //save image to public/uploads/product directory
        $image->move(public_path('uploads/products'),$imageName);

        //save image name in database
        $Product->image = $imageName;
        $Product->save();
        }

        return redirect()->route('products.index')->with('success','Product added successfully.');

    }
    //This method will update product
    public function edit($id)
    {
        $Product = Product::findOrFail($id);
        return view('products.edit',['product' => $Product]);
    }

    //This method will open form with data to update
    public function update(Request $request, $id)
    {
        $Product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|min:5', //name minimum of 5 characters
            'sku' =>  'required|min:5',
            'price'=> 'required|numeric',
        ];

        if($request->image != ""){
            $rules["image"] = 'image';

            // image should be a valid image
        }

        $validator = Validator::make($request->all(),$rules); //saved inside variable

        if($validator->fails()){
            return redirect()->route('products.edit',$Product->id)->withInput()->withErrors($validator);// if error occured then redirect to create page
        }

        //Here we wil store product in db
        $Product->name = $request->name;
        $Product->sku = $request->sku;
        $Product->price = $request->price;  
        $Product->description = $request->description;
        $Product->save();

        if($request->image != "")
        {
            //if user has selected a new image then we have to delete the old image first
            File ::delete(public_path('upload/products/.'.$Product->image));

            //here we will store image
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext; //unique image name

        //save image to public/uploads/product directory
        $image->move(public_path('uploads/products'),$imageName);

        //save image name in database
        $Product->image = $imageName;
        $Product->save(); // now when this method is called insetead of saving data it will update the data
        }

        return redirect()->route('products.index')->with('success','Product updated successfully.');

    }


    //This method will delete the product
    public function destroy($id)
    {
        $Product = Product::findOrFail($id);

        //delete image
        File ::delete(public_path('upload/products/.'.$Product->image));

        //delete product from database
        $Product->delete();

        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}
