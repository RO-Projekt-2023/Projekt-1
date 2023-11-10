{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Users" icon="la la-user" :link="backpack_url('user')" />
<x-backpack::menu-item title="Countries" icon="la la-globe" :link="backpack_url('country')" />
<x-backpack::menu-item title="Residences" icon="la la-map-marked" :link="backpack_url('residence')" />
<x-backpack::menu-item title="Locations" icon="la la-search-location" :link="backpack_url('locations')" />
<x-backpack::menu-item title="Events" icon="la la-calendar" :link="backpack_url('events')" />
<x-backpack::menu-item title="Pictures" icon="la la-image" :link="backpack_url('pictures')" />
<x-backpack::menu-item title="Tickets" icon="la la-ticket-alt" :link="backpack_url('tickets')" />