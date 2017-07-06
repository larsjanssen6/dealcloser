<aside class="menu">
    <p class="menu-label">Algemeen</p>

    <ul class="menu-list">
        <li>
            <a href="{{ route('settings.profile') }}" class="{{ setActive('instellingen/profiel') }}">
                Profiel
            </a>
        </li>
    </ul>

    @can('edit-company-settings')
        <p class="menu-label">Bedrijfsinformatie</p>

        <ul class="menu-list">
            <li>
                <a href="{{ route('settings.company.profile') }}"
                   class="{{ setActive('instellingen/bedrijf/profiel') }}">
                    Profiel
                </a>
            </li>

            <li>
                <a href="{{ route('settings.company.location') }}"
                   class="{{ setActive('instellingen/bedrijf/locatie') }}">
                    Locatie
                </a>
            </li>

            <li>
                <a href="{{ route('settings.company.department') }}"
                   class="{{ setActive('instellingen/bedrijf/afdeling') }}">
                    Afdeling
                </a>
            </li>

            <li>
                <a href="{{ route('settings.company.administration') }}"
                   class="{{ setActive('instellingen/bedrijf/administratie') }}">
                    Administratie
                </a>
            </li>
        </ul>
    @endcan

    @can('edit-usage-settings')
        <p class="menu-label">Gebruik</p>

        <ul class="menu-list">
            <li>
                <a href="{{ route('settings.company.usage') }}" class="{{ setActive('instellingen/bedrijf/gebruik') }}">
                    Pakket
                </a>
            </li>
        </ul>
    @endcan

    @if(Auth::user()->can('edit-role-settings') or Auth::user()->can('edit-permission-settings'))
        <p class="menu-label">Rechten</p>
    @endif

    <ul class="menu-list">
        @can('edit-role-settings')
            <li>
                <a href="{{ route('settings.rights.role') }}" class="{{ setActive('instellingen/bedrijf/role') }}">
                    Rollen
                </a>
            </li>
        @endcan

        @can('edit-permission-settings')
            <li>
                <a href="{{ route('settings.rights.permission') }}"
                   class="{{ setActive('instellingen/bedrijf/permissie') }}">
                    Permissies
                </a>
            </li>
        @endcan
    </ul>
</aside>