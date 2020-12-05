@extends('public.layouts.publicApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{--            <div class="col-md-10">--}}
            {{--                <div class="card">--}}
            {{--                    <div class="card-header row mr-0 ml-0">--}}
            {{--                        <div class="col-5">Удаленный суперсклад всего!!!</div>--}}

            {{--                    </div>--}}

            {{--                    <table class="table">--}}

            {{--                        <thead>--}}
            {{--                        <tr>--}}
            {{--                            <th>название комплекта</th>--}}
            {{--                            <th>описание комплекта</th>--}}
            {{--                            <th>артикул</th>--}}
            {{--                        </tr>--}}
            {{--                        </thead>--}}
            {{--                        <tbody>--}}

            {{--                        <tr>--}}
            {{--                            <td>--}}
            {{--                                {{$set->title}}--}}
            {{--                            </td>--}}
            {{--                            <td class="w-25">--}}
            {{--                                {{$set->description}}--}}
            {{--                            </td>--}}
            {{--                            <td class="">--}}
            {{--                                {{$set->code}}--}}
            {{--                            </td>--}}

            {{--                            @if(!empty($set->getFirstMedia('images')))--}}
            {{--                                <td class="ml-4 mr-0 pr-0  d-flex justify-content-end">--}}
            {{--                                    <img class="card-img-right "--}}
            {{--                                         src="{{$set->getFirstMedia('images')->getUrl()}}"--}}
            {{--                                         style="width: 100%">--}}
            {{--                                </td>--}}
            {{--                            @endif--}}
            {{--                        </tr>--}}

            {{--                        </tbody>--}}

            {{--                    </table>--}}
            <div class="col-md-5">

                <div class="card">
                    <div class="card-header">
                        Заказывай давай
                    </div>
                    <div class="card-body d-flex justify-content-center">


                        <img class="card-img-right "
                             src="
                                @if(!empty($set->getFirstMedia('images')))
                                     {{$set->getFirstMedia('images')->getUrl()}}
                                 @endif
                                 "
                             style="width: 100%" alt="Card image cap">


                    </div>

                </div>
            </div>

            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">
                        Заказывай давай
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary justify-content-center">
                            ЗАКАЗАТЬ
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body d-flex justify-content-center">
                        АРТИКУЛ:{{$set->code}}
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <h5 class="card-title">{{$set->title}}</h5>
                        </div>
                        <div class="form-group">
                            {{$set->description}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{--    <div class="container">--}}
    {{--        <div class="row justify-content-center">--}}

    {{--            <div class="pagination">{{ $companies->withQueryString()->links() }}</div>--}}

    {{--        </div>--}}
    {{--    </div>--}}

@endsection