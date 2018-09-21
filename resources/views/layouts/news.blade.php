<section class="section section-sm bg-gray-bright context-dark moderno-footer">
    <div class="shell">
        <div class="range range-40">
            <div class="cell-md-3 cell-sm-5">
                <div class="preffix-xl-85 footer-item-custom footer-item-custom-1" style="max-width: 274px">
                    <h6 class="text-spacing-200 text-uppercase font-base">
                        НОВОСТИ
                    </h6>
                    <div class="divider-default">
                    </div>
                    <div class="post-minimal-wrap">
                       @foreach($posts as $post) 
                        <a class="post-minimal" href="#">
                            <div class="unit unit-horizontal unit-middle">
								
                                <div class="unit-body">
                                    <p>
                                        <span>
                                            {{ $post->changed_at }}
                                        </span>
                                        {{ $post->title }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <div class="cell-md-3 cell-sm-5">
                <div class="preffix-xl-45 footer-item-custom footer-item-custom-2" style="max-width: 327px">
                    <h6 class="text-spacing-200 text-uppercase font-base">
                        НАШИ КОНТАКТЫ
                    </h6>
                    <div class="divider-default">
                    </div>
                    <div class="contact-data">
                        <dl>
                            <dt>
                                Phone:
                            </dt>
                            <dd>
                                <a class="link-call" href="tel:#">
                                    1-800-700-6200
                                </a>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                E-mail:
                            </dt>
                            <dd>
                                <a href="mailto:#">
                                    info@demolink.org
                                </a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="cell-md-4">
                <div class="preffix-xl-70 footer-item-custom footer-item-custom-3" style="max-width: 433px">
                    <h6 class="text-spacing-200 text-uppercase font-base">
                        ПОДАВАЙТЕ ЗАЯВКУ ПРЯМО СЕЙЧАС
                    </h6>
                    <div class="divider-default">
                    </div>
                    <a class="button button-lg button-primary button-effect-ujarak" href="{{ route('order.create') }}">
                        ДОБАВИТЬ ЗАЯВКУ
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>