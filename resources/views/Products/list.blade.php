<h1>All Products</h1>
@foreach ($Products as $Product )
<h1>{{ $Product->name }}</h1>
<li>{{ $Product->description }}</li>
<li>{{ number_format($Product->price,2) }}</li>
<img src="{{ asset('storage/'.$Product->image) }}" alt="" srcset="" width="200px">
@endforeach