@extends('admin.layouts.admin')

@section('styles')
	<style>
		.remove-after::after {
			content: none;
		}
	</style>
@endsection

@section('content')
	<div class="overlay"></div>
	<div class="title-block d-flex justify-content-between align-items-center remove-after">
		<h3 class="title"> Գովազդներ <span class="sparkline bar" data-type="bar"></span></h3>
		<div>
			<button class="btn btn-success-outline" onclick="addNewAds()" type="button">
				<i class="fa fa-plus mr-2"></i>
				Ավելացնել նոր գովազդ
			</button>
			<button class="btn btn-primary" onclick="storeAds()">
				<i class="fa fa-save mr-2"></i>
				Պահպանել
			</button>
		</div>
	</div>

	<section class="section">
		<form action="/cabinet/ads/store" method="POST" id="ads-form">
			@csrf
			<div class="row" id="adsense-area">
				@foreach($ads as $ad)
					<div class="col-12 col-md-6 col-lg-4 ads-card-column">
						<div class="card">
							<div class="card-header p-2 d-block">
								<div class="mb-2 d-block w-100">
									<input type="text" class="name form-control w-100" name="name[]" value="{{ $ad->name }}" placeholder="Անվանումը հայերեն">
								</div>
								<div class="d-block w-100">
									<input type="text" class="slug form-control w-100" name="slug[]" value="{{ $ad->slug }}" placeholder="Իդենտիֆիկատոր անգլերեն">
								</div>
							</div>
							<div class="card-block">
								<textarea class="ads_content form-control" name="content[]" placeholder="Գովազդի կոդը" rows="10">{{ $ad->content }}</textarea>
							</div>
							<div class="card-footer text-center">
								<button class="btn btn-danger" type="button" onclick="deleteAdsCard(this)">
									<i class="fa fa-trash mr-2"></i>
									Ջնջել
								</button>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</form>
	</section>
@endsection

@section('scripts')
	<script>
		function addNewAds() {
			var adsCard = `<div class="col-12 col-md-6 col-lg-4 ads-card-column">
				<div class="card">
					<div class="card-header p-2 d-block">
						<div class="mb-2 d-block w-100">
							<input type="text" class="name form-control w-100" name="name[]" placeholder="Անվանումը հայերեն">
						</div>
						<div class="d-block w-100">
							<input type="text" class="slug form-control w-100" name="slug[]" placeholder="Իդենտիֆիկատոր անգլերեն">
						</div>
					</div>
					<div class="card-block">
						<textarea class="ads_content form-control" name="content[]" placeholder="Գովազդի կոդը" rows="10"></textarea>
					</div>
					<div class="card-footer text-center">
						<button class="btn btn-danger" type="button" onclick="deleteAdsCard(this)">
							<i class="fa fa-trash mr-2"></i>
							Ջնջել
						</button>
					</div>
				</div>
			</div>`;

			$('#adsense-area').append(adsCard);
		}

		function deleteAdsCard(el) {
			$(el).closest('.ads-card-column').remove();
		}

		function storeAds() {
			$('#ads-form').submit();
		}
	</script>
@endsection