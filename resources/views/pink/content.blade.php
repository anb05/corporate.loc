@if($portfolios && count($portfolios) > 0)

    <div id="content-home" class="content group">
        <div class="hentry group">
            <div class="section portfolio">

                {{-- Lesson 10--}}
                {{-- Для вывода русского языка можно использовать фасад Lang::get() --}}
                {{-- или функцию - хелпер trans --}}
                <h3 class="title">{{ trans('ru.latest_projects') }}</h3>

                @foreach($portfolios as $key => $item)
                    @if ($key === 0)

                        <div class="hentry work group portfolio-sticky portfolio-full-description">
                            <div class="work-thumbnail">
                                <a class="thumb"><img src="{{ asset(env('THEME')) }}/images/projects/{{ $item->img->max  }}" alt="0081" title="0081" /></a>
                                <div class="work-overlay">

                                    {{-- Формируем маршруты по ссылкам. При этом учитываем, что в роутере испльзуем--}}
                                    {{-- REST маршруты и соответствующие контроллеры. В документации на Laravel  --}}
                                    {{-- указано, что имя роутера формируется автоматически с использованием  --}}
                                    {{-- точечной нотации. Первая часть это имя маршрута (первый параметр в круглых --}}
                                    {{-- скобках) и через точку имя метода который должен обработать запрос --}}
                                    {{-- берется из документации по REST controller т.к. в нашем случае необходимо --}}
                                    {{-- только отобазить информацию, то используется метод get, соответственно --}}
                                    {{-- метод show(). В этом случае имя пути выглядит так: 'portfolio.sho' --}}

                                    <h3><a href="{{ route('portfolios.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a></h3>
                                    <p class="work-overlay-categories"><img src="{{ asset(env('THEME')) }}/images/categories.png" alt="Categories" /> in: <a href="#">{{ $item->filter->title }}</a></p>
                                </div>
                            </div>
                            <div class="work-description">
                                <h2><a href="{{ route('portfolios.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a></h2>
                                <p class="work-categories">in: <a href="#">{{ $item->filter->title }}</a></p>
                                <p>{{ str_limit($item->text, 200) }}</p>
                                    <a href="{{ route('portfolios.show', ['alias' => $item->alias]) }}" class="read-more">|| Read more</a>
                            </div>
                        </div>

                        <div class="clear"></div>

                        @continue
                    @endif

                @if($key == 1)
                <div class="portfolio-projects">
                @endif

                    <div class="related_project {{ ($key === 4) ? ' related_project_last' : '' }}">
                        <div class="overlay_a related_img">
                            <div class="overlay_wrapper">
                                <img src="{{ asset(env('THEME')) }}/images/projects/{{ $item->img->mini }}" alt="0061" title="0061" />
                                <div class="overlay">
                                    <a class="overlay_img" href="{{ asset(env('THEME')) }}/images/projects/{{ $item->img->path }}" rel="lightbox" title=""></a>
                                    <a class="overlay_project" href="{{ route('portfolios.show', ['alias' => $item->alias]) }}"></a>
                                    <span class="overlay_title">{{ $item->title }}</span>
                                </div>
                            </div>
                        </div>
                        <h4><a href="{{ route('portfolios.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a></h4>
                        <p>{{ str_limit($item->text, 200) }}</p>
                    </div>

                    @endforeach
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <!-- START COMMENTS -->
        <div id="comments">
        </div>
        <!-- END COMMENTS -->
    </div>

@else
    <p>Not</p>
@endif
