@extends('template')
@section('content')
    <table class="show_users">
        <tbody>
        <tr class="table_row">
            <th>Название статьи:</th>
            <td><?= $article['name']?></td>
        </tr>
        <tr class="table_row">
            <th>Текст статьи:</th>
            <td><?= $article['text']?></td>
        </tr>
        <tr class="table_row">
            <th>Кем создана статья:</th>
            <td><?= $article['created_by']?></td>
        </tr>
        <tr class="table_row">
            <th>Дата создания:</th>
            <td><?= $article['created_at']?></td>
        </tr>
        <tr class="table_row">
            <th>Средний рейтинг:</th>
            <td>{{ $avg }}</td>
        </tr>
        </tbody>
    </table>

    @extends('layouts.app')
    {{--    <div class="container">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-md-12">--}}
    {{--                <div class="panel panel-default">--}}
    {{--                    <div class="panel-body">--}}
    {{--                        <form action="{{ route('articles.rating', $article->id) }}" method="POST">--}}
    {{--                            @csrf--}}
    {{--                            <div class="card">--}}
    {{--                                <div class="container-fliud">--}}
    {{--                                    <div class="wrapper row">--}}
    {{--                                        </div>--}}
    {{--                                        <div class="details col-md-6">--}}
    {{--                                            <h3 class="product-title">Поставьте рейтинг статье:</h3>--}}
    {{--                                            <div class="rating">--}}
    {{--                                                <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1"  data-size="xs">--}}
    {{--                                                <input type="hidden" name="id" required="" value="{{ $article->id }}">--}}
    {{--                                                <br/>--}}
    {{--                                                <button class="btn btn-success">Отправить</button>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                </div>--}}
    {{--                        </form>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <form action="{{ route('articles.rating', $article->id) }}" method="POST">
        @csrf
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">Поставьте рейтинг статье:</h3>
                    <div class="rating">
                        <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5"
                               data-step="1" data-size="xs">
                        <input type="hidden" name="id" required="" value="{{ $article->id }}">
                        <br/>
                        <button class="btn btn-success">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </form>



    <script type="text/javascript">

        $("#input-id").rating();

    </script>

@endsection
