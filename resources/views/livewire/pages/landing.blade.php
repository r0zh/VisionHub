<div class="landingContainer">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}" />
    <script src=" {{ asset('js/landing/divsMoveEffect.js') }}" defer></script>
    <script src="{{ asset('js/landing/divsCommunityEffect.js') }}" defer></script>
    <div id="visionHubdiv">
        <h1 id="visionHubT">VisionHub</h1>
    </div>
    <div id="sloganVH">
        <h2 id="subTitleVH">Generate the art on your mind!</h2>
        <p id="subSloganVH">
            Select the tool that best suits the idea you want to realize
        </p>
    </div>
    <div id="mainBodyTemplate">
        <div id="wrapperCommunity" class="genericWrapper">
            <div id="communityGrid">
                <div id="comunnityDiv1" class="subVisionHubdiv comunnityDiv displayNone">
                    <div class="flipCardDetails">
                        <div class="flip-card-inner" id="flip-card-inner-community">
                            <div class="flip-card-front" id="flip-card-front-community">
                                <h2>Great Community!</h2>
                            </div>
                            <div class="flip-card-back" id="flip-card-back-community">
                                <h1>Details</h1>
                                <p>Source of inspiration</p>
                                <p>View other users' creations</p>
                                <p>Request for new generation resources</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="comunnityDiv2" class="subVisionHubdiv comunnityDiv displayNone">
                    <div class="flipCardDetails">
                        <div class="flip-card-inner" id="flip-card-inner-upgrades">
                            <div class="flip-card-front" id="flip-card-front-upgrades">
                                <h2>On future upgrades</h2>
                            </div>
                            <div class="flip-card-back" id="flip-card-back-upgrades">
                                <h1>Details</h1>
                                <p>New generation resources</p>
                                <p>Generation of poses</p>
                                <p>Resource export</p>
                                <p>Community improvements</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper2D" class="genericWrapper">
            <div id="generatordiv2d" class="subVisionHubdiv hidden">
                <div id="content1">
                    <h2 class="subVisionHubT" id="2dGeneratorT">2D generator</h2>
                    <a href="">
                        <div id="generatorB2d" class="buttonApp">Let's Generate!</div>
                    </a>
                </div>
                <div class="flipCardDetails">
                    <div id="flip-card-inner2d" class="flip-card-inner">
                        <div class="flip-card-front" id="flip-card-front-2d">
                            <h3>Get more info!</h3>
                        </div>
                        <div class="flip-card-back" id="flip-card-back-2d">
                            <h1>Details</h1>
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
                    <h2 class="subVisionHubT" id="3dGeneratorT">3D generator</h2>
                    <a href="">
                        <div id="generatorB3ds" class="buttonApp">Let's Generate!</div>
                    </a>
                </div>
                <div class="flipCardDetails">
                    <div id="flip-card-inner3d" class="flip-card-inner">
                        <div class="flip-card-front" id="flip-card-front-3d">
                            <h3>Get more info!</h3>
                        </div>
                        <div class="flip-card-back" id="flip-card-back-3d">
                            <h1>Details</h1>
                            <p>Generation of 3D models from a promp</p>
                            <p>Get different choices from a generation</p>
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
                        <em>This is a Open Source Project <br />
                            Feel free you propagate your ideas!
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
                            Suggestions
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
