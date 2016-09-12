<div class="dropdown profile">
    <a class="logout material-box" id="avatar-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Admin<span class="caret"></span>
    </a>
    <ul class="dropdown-menu material-box" aria-labelledby="avatar-dropdown">
        <li class="scroll">
            <a class="logout" href="{{ route('admin.get.dashboard') }}">
                <i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard
            </a>
        </li>
        <li class="scroll">
            <a class="logout" href="{{ route('admin.get.articles') }}">
                <i class="fa fa-book" aria-hidden="true"></i>&nbsp;Articles
            </a>
        </li>
        <li class="scroll">
            <a class="logout" href="{{ route('admin.get.questions') }}">
                <i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;Questions
            </a>
        </li>
        <li class="scroll">
            <a class="logout" href="{{ route('admin.get.logout') }}">
                <i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;Logout
            </a>
        </li>
    </ul>
</div>