<div class="landingContainer">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}" />
    <script src=" {{ asset('js/landing/divsMoveEffect.js') }}" defer></script>
    <script src="{{ asset('js/landing/divsCommunityEffect.js') }}" defer></script>
    <div id="visionHubdiv">
        <h1 id="visionHubT">VisionHub</h1>
    </div>
    <div id="sloganVH">
        <h2 id="subTitleVH">{{ __('Generate the art on your mind!') }}</h2>
        <p id="subSloganVH">
            {{ __('Select the tool that best suits the idea you want to realize') }}
        </p>
    </div>
    <div id="mainBodyTemplate">
        <div id="wrapperCommunity" class="genericWrapper">
            <div id="communityGrid">
                <div id="comunnityDiv1" class="subVisionHubdiv comunnityDiv displayNone">
                    <div class="flipCardDetails">
                        <div class="flip-card-inner" id="flip-card-inner-community">
                            <div class="flip-card-front" id="flip-card-front-community">
                                <h2>{{ __('Great Community!') }}</h2>
                            </div>
                            <div class="flip-card-back" id="flip-card-back-community">
                                <h1>{{ __('Details') }}</h1>
                                <p>{{ __('Source of inspiration') }}</p>
                                <p>{{ __("View other users' creations") }}</p>
                                <p>{{ __('Request for new generation resources') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="comunnityDiv2" class="subVisionHubdiv comunnityDiv displayNone">
                    <div class="flipCardDetails">
                        <div class="flip-card-inner" id="flip-card-inner-upgrades">
                            <div class="flip-card-front" id="flip-card-front-upgrades">
                                <h2>{{ __('On future upgrades') }}</h2>
                            </div>
                            <div class="flip-card-back" id="flip-card-back-upgrades">
                                <h1>{{ __('Details') }}</h1>
                                <p>{{ __('New generation resources') }}</p>
                                <p>{{ __('Generation of poses') }}</p>
                                <p>{{ __('Resource export') }}</p>
                                <p>{{ __('Community improvements') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper2D" class="genericWrapper">
            <div id="generatordiv2d" class="subVisionHubdiv hidden">
                <div id="content1">
                    <h2 class="subVisionHubT" id="2dGeneratorT">{{ __('2D generator') }}</h2>
                    <a href="/create">
                        <div id="generatorB2d" class="buttonApp">{{ __("Let's Generate!") }}</div>
                    </a>
                </div>
                <div class="flipCardDetails">
                    <div id="flip-card-inner2d" class="flip-card-inner">
                        <div class="flip-card-front" id="flip-card-front-2d">
                            <h3>{{ __('Get more info!') }}</h3>
                        </div>
                        <div class="flip-card-back" id="flip-card-back-2d">
                            <h1>{{ __('Details') }}</h1>
                            <p>Use of embeddings</p>
                            <p>Multi Loras and Checkpoint on generation</p>
                            <p>Saves your favorites styles to generate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper3D" class="genericWrapper">
            <div id="generatordiv3d" class="subVisionHubdiv hidden">
                <div id="content1">
                    <h2 class="subVisionHubT" id="3dGeneratorT">{{ __('3D generator') }}</h2>
                    <a href={{ config('services.angular') . '/generate' }}>
                        <div id="generatorB3ds" class="buttonApp">{{ __("Let's Generate!") }}</div>
                    </a>
                </div>
                <div class="flipCardDetails">
                    <div id="flip-card-inner3d" class="flip-card-inner">
                        <div class="flip-card-front" id="flip-card-front-3d">
                            <h3>{{ __('Get more info!') }}</h3>
                        </div>
                        <div class="flip-card-back" id="flip-card-back-3d">
                            <h1>{{ __('Details') }}</h1>
                            <p>{{ __('Generation of 3D models from a prompt') }}</p>
                            <p>{{ __('Get different choices from a generation') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footerVH">
        <div id="footerWrapper">
            <div id="gridFooter">
                <div class="gridFooterElement" id="logoFooter">
                    <img src="logo.svg" alt="VisionHub Logo" />
                </div>
                <div class="gridFooterElement" id="contacts">
                    <p>
                        <em>{{ __('This is a Open Source Project') }} <br />
                            {{ __('Feel free you propagate your ideas!') }}
                        </em>
                    </p>
                </div>
                <div class="gridFooterElement" id="socialMedias">
                    <a href="https://github.com/r0zh/VisionHub">
                        <div id="gitHubLink">
                            <img src="{{ asset('assets/landing/icons8-github.svg') }}" alt="" />
                            VisionHub
                        </div>
                    </a>
                    <a href="mailto:inbox.visionhub@gmail.com?subject=New Suggestion to VisionHub">
                        <div id="gitHubLink">
                            <img src="{{ asset('assets/landing/icons8-correo-96.png') }}" alt="" />
                            {{ __('Suggestions') }}
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
