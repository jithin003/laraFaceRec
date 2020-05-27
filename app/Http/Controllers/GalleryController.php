<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FaceGallery;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;
class GalleryController extends Controller
{
    //
    public function index()
    {
    	$images = FaceGallery::get();
    	return view('gallery',compact('images'));
    }

    public function upload(Request $request)
    {

    	$this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $palette = Palette::fromFilename($request->image);
        // an extractor is built from a palette
        $extractor = new ColorExtractor($palette);

        // it defines an extract method which return the most “representative” colors
        $colors = $extractor->extract(5);
        print_r($colors);
        $images = FaceGallery::get();
        foreach($images as $image) {
             echo public_path('images/').$image->image;
            $palette_db = Palette::fromFilename(public_path('images/').$image->image);
            // an extractor is built from a palette
            $extractor_db = new ColorExtractor($palette_db);

            // it defines an extract method which return the most “representative” colors
            $colors_db = $extractor_db->extract(5);
            if($colors === $colors_db)
            {
                 return back()->with('error','image Exists.');
            }
        }
        // $palette is an iterator on colors sorted by pixel count
        // foreach($palette as $color => $count) {
        //     // colors are represented by integers
        //     echo Color::fromIntToHex($color), ': ', $count, "\n";
        // }

        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $input['image']);
        FaceGallery::create($input);


    	return back()
    		->with('success','Image Uploaded successfully.');
    }



    public function destroy($id)
    {
    	FaceGallery::find($id)->delete();
    	return back()
    		->with('success','Image removed successfully.');
    }
}
