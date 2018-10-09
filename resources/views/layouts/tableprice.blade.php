<section class="section text-center visible-xs">
    <div class="shell rates-mobile">
        @foreach($rates as $rate)
        {{ $rate['title'].':'. $rate['description'] }}&nbsp;
        @endforeach
    </div>
</section>

<section class="table-price section text-center">
    <div class="shell">
        <h2>
            Расширение границ и возможностей Вашего бизнеса в 3 клика
        </h2>
        <h3>
            Zelenka.Trade - единый портал поставщиков зерновых культур
        </h3>

        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <a href="/register" class="button button-block button-effect-ujarak button-tableprice-view">
                    Регистрация
                </a>
            </div>
        </div>
    </div>

</section>

<section class="section text-center hidden-xs table-price-add-order">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <form action="{{ route('order.create') }}">
                <button type="submit" class="button button-effect-ujarak button-block button-primary">
                    Добавить заявку
                </button>
            </form>
        </div>
    </div>
</section>
