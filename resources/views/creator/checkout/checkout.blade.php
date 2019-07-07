@extends('creator.master.master')
@section('title','thanh Toán')
@section('content')
		<!-- main -->

		<div class="colorlib-shop">
			<div class="container">
				<div class="row row-pb-md">
					<form method="post">
						@csrf
					<div class="col-md-10 col-md-offset-1">
						<div class="process-wrap">
							<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Giỏ hàng</h3>
							</div>
							<div class="process text-center active">
								<p><span>02</span></p>
								<h3>Thanh toán</h3>
							</div>
							<div class="process text-center">
								<p><span>03</span></p>
								<h3>Hoàn tất thanh toán</h3>
							</div>
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-md-7">
						<form method="post" class="colorlib-form">
							@csrf
							<h2>Chi tiết thanh toán</h2>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label >Họ & Tên</label>
										<input type="text"  name="full" class="form-control" placeholder="Full Name" >
										{!! ShowError($errors,"full") !!}
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="fname">Địa chỉ</label>
										<input type="text" id="address" class="form-control"
											placeholder="Nhập địa chỉ của bạn" name="address">
											{{ ShowError($errors,"address") }}
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6">
										<label for="email">Địa chỉ email</label>
										<input type="email" id="email" class="form-control"
											name ="email" placeholder="Ex: youremail@domain.com">
											{{ ShowError($errors,"email") }}
									</div>
									<div class="col-md-6">
										<label for="Phone">Số điện thoại</label>
										<input type="text" id="zippostalcode" class="form-control"
											placeholder="Ex: 0123456789" name="phone">
											{{ ShowError($errors,"phone") }}
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">

									</div>
								</div>
							</div>
						
					</div>
					<div class="col-md-5">
						<div class="cart-detail">
							<h2>Tổng Giỏ hàng</h2>
							<ul>
								<li>

									<ul>
										@foreach ($cart as $row)
										<li><span>{{$row->qty}} x {{$row->name}}</span> <span>{{number_format($row->qty*$row->price,0,"",".")}}đ</span></li>
										@endforeach
									
									
									</ul>
								</li>

								<li><span>Tổng tiền đơn hàng</span> <span>{{$total}}đ</span></li>
							</ul>
						</div>

						<div class="row">
							<div class="col-md-12">
									<button type="submit" class="btn btn-primary">Thanh toán</button>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>

		<!-- end main -->

	@endsection
