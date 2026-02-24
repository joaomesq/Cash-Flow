<section class="space-y-6">
    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
    @csrf

        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
            <x-secondary-button>
                    {{ __('Log Out') }}
            </x-secondary-button>
        </x-responsive-nav-link>
    </form>
</section>