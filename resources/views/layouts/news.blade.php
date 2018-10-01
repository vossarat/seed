<footer class="section section-sm bg-gray-bright context-dark moderno-footer">
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
                        <a class="post-minimal" href="{{ route('onepost', $post->id) }}">
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
            
            <div class="cell-md-3 cell-sm-5 hidden-xs">
                <div class="preffix-xl-45 footer-item-custom footer-item-custom-2" style="max-width: 327px">
                    <h6 class="text-spacing-200 text-uppercase font-base">
                        НАШИ КОНТАКТЫ
                    </h6>
                    <div class="divider-default">
                    </div>
                    <div class="contact-data">
                        
                        <dl>
                            <dt>
                                E-mail:
                            </dt>
                            <dd>
                                <a href="mailto:info@zelenka.trade">
                                    info@zelenka.trade
                                </a>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                Адрес:
                            </dt>
                            <dd>
                               г. Кокшетау, ул. Валиханова ⅓
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                Телефон:
                            </dt>
                            <dd>
                                <a class="link-call" href="tel:#">
                                    
                                </a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            
                        
            <div class="cell-md-4">
                <div class="preffix-xl-70 footer-item-custom footer-item-custom-3" style="max-width: 433px">
                    <h6 class="text-spacing-200 text-uppercase font-base">
                        ПОДАЙТЕ ЗАЯВКУ ПРЯМО СЕЙЧАС
                    </h6>
                    <div class="divider-default">
                    </div>
                    <a class="button button-lg button-primary button-effect-ujarak" href="{{ route('order.create') }}">
                        ДОБАВИТЬ ЗАЯВКУ
                    </a>
                </div>
            </div>
            
            <div class="cell-md-3 cell-sm-5 text-center visible-xs">
                <div class="preffix-xl-45 footer-item-custom footer-item-custom-2" style="max-width: 327px">
                    <a href="{{ route('order.index') }}">
	                    <h6>
	                        НА ГЛАВНУЮ
	                    </h6>
                    </a>
                    <div class="divider divider-nav"></div>
                    
                    <a href="{{ route('order.create') }}">
	                    <h6>
	                        ДОБАВИТЬ ЗАЯВКУ
	                    </h6>
                    </a>
                    <div class="divider divider-nav"></div>
                    
                    <a href="">
	                    <h6>
	                        МОЙ  ПРОФИЛЬ
	                    </h6>
                    </a>
                    <div class="divider divider-nav"></div>
                    <a href="{{ route('feedback') }}">
	                    <h6>
	                        О НАС
	                    </h6>
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</footer>