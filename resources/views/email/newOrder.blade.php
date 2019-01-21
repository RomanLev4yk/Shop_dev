<!DOCTYPE html>
<html>
<head>
	<title>email</title>
	<meta charset="utf-8">
</head>

<body>

	<p>Номер заказа: #{{ $order->number }}</p>
	<p style="color: {{ $status->color }}">Статус: {{ $status->name }}</p>
	<p>Дата создания: {{ $order->created_at }}</p>

	<p>
		@foreach ($order->currentProducts as $product)
			<p>
				<h3>{{ $product->product_name }}</h3>
				<h4>{{ $product->count }}</h4>
				<h4>{{ $product->product_cost }}</h4>
			</p>
		@endforeach
	</p>

	<h1>{{ $order->cost }}</h1>
</body>
</html>
