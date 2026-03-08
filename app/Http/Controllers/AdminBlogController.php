<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;

class AdminBlogController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin || !in_array($admin->staff_role, ['IT','customer_service','marketing'])) {
            abort(403, 'Unauthorized');
        }

        // Fetch latest 10 blogs
        $blogs = Blog::latest()->limit(10)->get();

        return view('admin.functions.blog.index', [
            'blogs' => $blogs,
            'admin' => $admin
        ]);
    }

    public function toggle($id)
{
$blog = Blog::findOrFail($id);

$blog->status = $blog->status == 'published' ? 'draft' : 'published';

$blog->published_at = $blog->status == 'published' ? now() : null;

$blog->save();

return response()->json(['success'=>true]);
}

public function feature(Blog $blog)
{

Blog::where('featured',true)->update(['featured'=>false]);

$blog->update(['featured'=>true]);

return back();

}
}