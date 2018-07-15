@extends('layouts.template')

@section('content')

<h1 class="page-header">Заявки</h1>

<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading"> {{-- заголовок окна --}}
            Редактирование заявки
            <a href="{{ route('order.index') }}" class="close" data-dismiss="alert" aria-hidden="true">&times;</a> {{-- х закрыть --}}
        </div>

        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('order.update', $viewdata->id) }}">                            {{ csrf_field() }}

                <input type="hidden" name="id" value="{{ $viewdata->id }}">
                <input type="hidden" name="_method" value="put"/>

                @include('order.form')

                <div class="form-group">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            Редактировать
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
						<div class="col-xs-12">
							<a href="{{ route('order.index') }}" class="btn btn-warning btn-block" data-dismiss="alert" aria-hidden="true">Отмена</a>
						</div>
				</div>

            </form>
        </div>
    </div>
</div>

@endsection