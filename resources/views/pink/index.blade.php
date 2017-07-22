@extends(env('THEME').'.layouts.site')

@section('navigation')
    {{-- Первый и самый простой способ отображения навигации сайта --}}
    {{-- приведен ниже и представляет собой простое включение файла --}}

{{--    @include(env('THEME').'.navigation')--}}

    {{-- При разработеке сайта будет использоваться другой подход. --}}
    {{-- Вначале, в контроллере будет сформирована навигация, которая --}}
    {{-- в виде переменной $navigation будет передана в шаблон для отображения --}}

   {!! $navigation !!}
@endsection

@section('slider')
    {!! $sliders !!}
@endsection

@section('content')
    {!! $content !!}
@endsection