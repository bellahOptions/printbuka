@extends('layouts.staff')

@section('title','Blog Manager')

@section('content')

<div class="pb-layout-3col">
<div class="pb-col-left">

<div class="pb-card">

<div class="pb-card-header">

<div>
<div class="pb-card-title">Blog Manager</div>
<div class="pb-card-subtitle">Content publishing system</div>
</div>

<a href="{{ route('admin.blog.create') }}"
class="pb-btn bg-pink-600 text-white">
Create Blog
</a>

</div>

<div class="pb-table-wrap">

<table class="pb-table">

<thead>
<tr>
<th>Thumbnail</th>
<th>Title</th>
<th>SEO</th>
<th>Read</th>
<th>Status</th>
<th>Featured</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@foreach($blogs as $blog)

<tr>

<td>

<img src="{{ $blog->featured_image ? asset('storage/'.$blog->featured_image) : asset('images/default.png') }}"
width="60">

</td>

<td class="pb-cell-strong">
{{ $blog->title }}
</td>

<td>

@if($blog->seo_score >= 80)
<span class="text-cyan-600">{{ $blog->seo_score }}</span>
@else
<span class="text-yellow-600">{{ $blog->seo_score }}</span>
@endif

</td>

<td>
{{ $blog->reading_time }} min
</td>

<td>

<button
data-id="{{ $blog->id }}"
class="togglePublish pb-btn pb-btn-sm {{ $blog->status=='published' ? 'bg-cyan-600 text-white':'bg-yellow-600 text-white' }}">

{{ $blog->status }}

</button>

</td>

<td>

<form method="POST" action="{{ route('admin.blog.feature',$blog) }}">
@csrf

<button class="pb-btn pb-btn-sm {{ $blog->featured ? 'bg-pink-600 text-white':'bg-gray-900 text-white' }}">

{{ $blog->featured ? 'Featured':'Set Featured' }}

</button>

</form>

</td>

<td>

<div class="pb-cell-actions">

<a href="{{ route('admin.blog.edit',$blog) }}"
class="pb-btn pb-btn-sm bg-cyan-600 text-white">
Edit
</a>

<form method="POST" action="{{ route('admin.blog.delete',$blog) }}">
@csrf
@method('DELETE')

<button class="pb-btn pb-btn-danger pb-btn-sm">
Delete
</button>

</form>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>
</div>

<script>

document.querySelectorAll('.togglePublish').forEach(btn=>{

btn.addEventListener('click',async function(){

let id = this.dataset.id;

await fetch(`/admin/blog/toggle/${id}`,{
method:"POST",
headers:{
'X-CSRF-TOKEN':'{{ csrf_token() }}'
}
})

location.reload();

})

})

</script>

@endsection