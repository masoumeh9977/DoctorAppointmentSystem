<div class="">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"
        style="width: 280px; height:100vh; top: 0; position: absolute;">
        <p>Online Users: {{ $numOfOnlineUsers }}</p>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="/dashboard" class="nav-link text-white" aria-current="page">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="/appointment" class="nav-link text-white">
                    Appointments
                </a>
            </li>
            <li>
                <a href="/profile" class="nav-link text-white">
                    Profile
                </a>
            </li>
            @if (Auth::user()->is_doctor)
                <li>
                    <a href="{{ route('user.index') }}" class="nav-link text-white">
                        Patient List
                    </a>
                </li>
            @endif
        </ul>
        <hr>
    </div>

</div>
