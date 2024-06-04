<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class ImageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('imageUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);
        $imageName = $request->userid;
        $request->image->move(public_path('photo/pas'), $imageName);
        /* 
            Write Code Here for
            Store $imageName name in DATABASE from HERE 
        */

        return back()
            ->with('success', 'You have successfully upload image.')
            ->with('image', $imageName);
    }

    public function storeKTP(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);
        $imageName = $request->userid;
        $request->image->move(public_path('photo/ktp'), $imageName);
        /* 
            Write Code Here for
            Store $imageName name in DATABASE from HERE 
        */

        return back()
            ->with('success', 'You have successfully upload image.')
            ->with('image2', $imageName);
    }
}
