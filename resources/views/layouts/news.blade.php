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
                                <a href="tel:#87084445606">
                                    +7 (708) 444-56-06
                                </a>
                            </dd>
                            </br>
                            <dt style="color: transparent">
                                Телефон:
                            </dt>
                            <dd>
                                <a href="tel:#87162445606">
                                    +7 (7162) 44-56-06
                                </a>
                            </dd>
                        </dl>
                        
                        <dl class="social-networking">
                            <dt>
                                <a href="https://www.facebook.com/zelenka.trade"><span class="fa fa-facebook fa-3x"></span></a>
                            </dt>
                            <dt>
                                <a href="https://www.instagram.com/zelenka.trade"><span class="fa fa-instagram fa-3x"></span></a>
                            </dt>
                            <dt>
                                <a href="javascript:void(0);"><span class="fa fa-google-plus fa-3x"></span></a>
                            </dt>
                            
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
                    
                   
                    @if( $profile_type === 'trader')
						@if( $profile_action === 'create' )
							<a href="{{ route('trader.create') }}"><h6>МОЙ  ПРОФИЛЬ</h6></a>
						@else
							<a href="{{ route('trader.edit', $profile_id) }}"><h6>МОЙ  ПРОФИЛЬ</h6></a>
						@endif
					@else
						@if( $profile_action === 'create' )
							<a href="{{ route('farmer.create') }}"><h6>МОЙ  ПРОФИЛЬ</h6></a>
						@else
							<a href="{{ route('farmer.edit', $profile_id) }}"><h6>МОЙ  ПРОФИЛЬ</h6></a>
						@endif
					@endif
                    
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