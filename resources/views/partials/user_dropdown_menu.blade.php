<div class="dropdown profile">
    <img class="avatar" src="{{ Auth::user()->getAvatar() }}" />
    <a class="logout material-box" id="avatar-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;{{ Auth::user()->name }}<span class="caret"></span>
    </a>
    <ul class="dropdown-menu material-box" aria-labelledby="avatar-dropdown">
        <li class="scroll">
            <a class="logout" href="{{ route('home') }}">
                <i class="fa fa-home" aria-hidden="true"></i>&nbsp;@lang('home.menu.home')
            </a>
        </li>
        <li class="scroll">
            <a class="logout" href="{{ Auth::user()->getProfile() }}" target="_blank">
                <i class="fa fa-user" aria-hidden="true"></i>&nbsp;@lang('home.menu.profile')
            </a>
        </li>
        <li class="scroll">
            <a class="logout" href="{{ route('questions') }}">
                <i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;@lang('home.menu.my_questions')
            </a>
        </li>
        <li class="scroll">
            <a class="logout" href="{{ route('articles') }}">
                <i class="fa fa-book" aria-hidden="true"></i>&nbsp;@lang('home.menu.my_articles')
            </a>
        </li>
        <li class="scroll">
            <a class="logout" href="{{ route('logout') }}">
                <i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;@lang('home.menu.logout')
            </a>
        </li>
    </ul>
</div>