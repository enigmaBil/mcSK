@extends('layouts.app')

@section('content')
	<div class="col-sm-offset-4 col-sm-4">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Erreur avec la base de données !</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
					</button>
				</div>
			</div>
			<div class="box-body">
				<p>Nous sommes désolés mais une erreur est survenue lors de l'exécution de votre requête.</p>
			</div>

			<div class="box-footer">
				<a href="{{ back()->getTargetUrl() }}" style="font-weight: bold; float:left">
					Retour
				</a>
				<a  href="{{ route('home') }}" style="font-weight: bold; float:right">
					Accueil
				</a>
			</div>
		</div>
	</div>
@endsection