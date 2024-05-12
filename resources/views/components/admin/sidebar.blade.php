<!-- Nav Item - Dashboard -->
<li class="sidebar-header">
    Users
</li>

<li
    class="sidebar-item {{ request()->route()->getName() =='users.index' ??request()->route()->getName() == 'users.show' ||request()->route()->getName() == 'users.edit'? 'active': '' }}">
    <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link collapsed">
        <i class="align-middle me-2 fas fa-fw fa-users"></i> <span class="align-middle">Users</span>
    </a>
    <ul id="users" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
        <li
            class="sidebar-item  {{ request()->route()->getName() == 'users.index' ||request()->route()->getName() == 'users.show' ||request()->route()->getName() == 'users.edit'? 'active': '' }}">
            <a class="sidebar-link" href="{{ route('users.index') }}">
                <i class="align-middle me-2 fas fa-fw fa-users"></i> <span class="align-middle">All</span>
            </a>
        </li>
    </ul>
</li>

<li
    class="sidebar-item {{ request()->route()->getName() =='fleets.index' ??request()->route()->getName() == 'fleets.show' ||request()->route()->getName() == 'fleets.edit'? 'active': '' }}">
    <a data-bs-target="#fleets" data-bs-toggle="collapse" class="sidebar-link collapsed">
        <i class="align-middle me-2 fas fa-fw fa-users"></i> <span class="align-middle">Fleets</span>
    </a>
    <ul id="fleets" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
        <li
            class="sidebar-item  {{ request()->route()->getName() == 'fleets.index' ||request()->route()->getName() == 'fleets.show' ||request()->route()->getName() == 'fleets.edit'? 'active': '' }}">
            <a class="sidebar-link" href="{{ route('fleets.index') }}">
                <i class="align-middle me-2 fas fa-fw fa-users"></i> <span class="align-middle">All</span>
            </a>
        </li>
    </ul>
</li>

<li
    class="sidebar-item {{ request()->route()->getName() =='booking.index' ??request()->route()->getName() == 'booking.show' ||request()->route()->getName() == 'booking.edit'? 'active': '' }}">
    <a data-bs-target="#booking" data-bs-toggle="collapse" class="sidebar-link collapsed">
        <i class="align-middle me-2 fas fa-fw fa-users"></i> <span class="align-middle">Bookings</span>
    </a>
    <ul id="booking" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
        <li
            class="sidebar-item  {{ request()->route()->getName() == 'booking.index' ||request()->route()->getName() == 'booking.show' ||request()->route()->getName() == 'booking.edit'? 'active': '' }}">
            <a class="sidebar-link" href="{{ route('booking.index') }}">
                <i class="align-middle me-2 fas fa-fw fa-users"></i> <span class="align-middle">All</span>
            </a>
        </li>
    </ul>
</li>


