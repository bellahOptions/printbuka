<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function aboutPage()
    {
        return view('about');
    }
    public function servicesPage()
    {
        return view('services');
    }
    public function blogPage()
    {
        return view('blog.index');
    }
    public function dtf()
    {
        return view('services.dtf.index');
    }
    public function uvdtf()
    {
        return view('services.uv.index');
    }
    public function directImage()
    {
        return view('services.direct-image.index');
    }
    public function shopPage()
    {
        return view('shop.index');
    }
    public function engravePage(){
        return view('services.engraving.index');
    }
}
