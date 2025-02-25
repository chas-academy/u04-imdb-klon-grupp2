@php
    use Carbon\Carbon;

    $listsTitle = $isCurrentUserProfile ? 'My lists' : "$user->username's lists";
    $reviewsTitle = $isCurrentUserProfile
        ? 'My reviews'
        : "$user->username's reviews";
@endphp

<x-layout class="flex flex-col gap-16 pt-6">
    <x-profile :user="$user" :statistics="$statistics">
        @if (auth()->check() && auth()->user()->role === 'admin')
            <x-slot:buttons>
                @if ($isCurrentUserProfile)
                    <x-button
                        variant="secondary"
                        size="sm"
                        href="{{ route('admin.dashboard') }}"
                    >
                        Go to admin dashboard
                    </x-button>
                @elseif ($user->isBanned())
                    <span class="text-sm text-slate-400">
                        User is banned until
                        {{ Carbon::parse($user->banned_until)->format('F jS') }}
                    </span>
                @endif
            </x-slot>
        @endif
    </x-profile>

    @if ($lists->isEmpty() && $reviews->isEmpty())
        @if ($isCurrentUserProfile)
            <div class="flex flex-1 flex-col items-center justify-center gap-4">
                <p class="text-slate-200">You don't have any content yet!</p>
                <x-button
                    x-data
                    @click="$dispatch('open-modal', 'create-list')"
                >
                    Create list
                </x-button>
            </div>
        @else
            <div class="grid flex-1 place-items-center">
                <p class="text-slate-200">
                    {{ $user->username }} doesn't have any content yet!
                </p>
            </div>
        @endif
    @else
        <div class="flex flex-col gap-12">
            <div class="flex flex-col items-start gap-4">
                <x-section-header.link
                    :title="$listsTitle"
                    href="{{ route('lists', ['username' => $user->username]) }}"
                />
                @if ($lists->isNotEmpty())
                    <x-section :columns="[2, 'md' => 4]">
                        @foreach ($lists as $list)
                            <x-list
                                :title="$list['title']"
                                :posters="$list['posters']->toArray()"
                                link="{{ route('list', ['id' => $list['id']]) }}"
                            />
                        @endforeach
                    </x-section>
                @else
                    <div class="flex flex-col items-start gap-2">
                        <x-empty-state
                            content="Looks like your list section is empty. Time to
                            create your first list!"
                        />
                        <x-button
                            x-data
                            @click="$dispatch('open-modal', 'create-list')"
                            size="sm"
                        >
                            Create list
                        </x-button>
                    </div>
                @endif
            </div>

            @if ($reviews->isNotEmpty())
                <div class="flex flex-col items-start gap-4">
                    <x-section-header.link
                        :title="$reviewsTitle"
                        href="{{ route('reviews.user', ['username' => $user->username]) }}"
                    />
                    <x-section :columns="[1, 'md' => 2]">
                        @foreach ($reviews as $review)
                            <x-review
                                :id="$review->movie->id"
                                :title="$review->movie->title "
                                :content="$review->content"
                                :created_at="$review->created_at"
                                :rating="$review->rating"
                                :image="$review->movie->poster"
                                link="{{ route('review', ['id' => $review->id]) }}"
                            />
                        @endforeach
                    </x-section>
                </div>
            @endif
        </div>
    @endif

    <x-modal.base name="profile-menu" :show="$errors->makeAdmin->isNotEmpty()">
        <x-modal.menu :error="$errors->makeAdmin->first()">
            <x-slot:title>
                {{ $user->username }}
            </x-slot>

            @if ($isCurrentUserProfile)
                {{-- TODO: add edit profile modal --}}
                <x-menu-item>Edit profile</x-menu-item>
                <x-modal.divider />

                {{-- TODO: add change password functionality --}}
                <x-menu-item>Change password</x-menu-item>
                <x-modal.divider />

                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <x-menu-item>Log out</x-menu-item>
                </form>
                <x-modal.divider />

                {{-- TODO: open delete account confirm with password modal --}}
                <x-menu-item variant="destructive">Delete account</x-menu-item>
                <x-modal.divider />
            @else
                <x-menu-item
                    x-data
                    @click="
                        $dispatch('close-modal', 'profile-menu')
                        $dispatch('open-modal', 'report-user')
                    "
                >
                    Report user
                </x-menu-item>
                <x-modal.divider />

                @if (auth()->check() && auth()->user()->role === 'admin' && $user->role !== 'admin' && ! $user->isBanned())
                    <x-menu-item
                        x-data
                        @click="
                            $dispatch('close-modal', 'profile-menu')
                            $dispatch('open-modal', 'ban-user')
                        "
                    >
                        Ban user
                    </x-menu-item>
                    <x-modal.divider />

                    <form
                        method="post"
                        action="{{ route('admin.profile.make-admin', ['id' => $user->id]) }}"
                    >
                        @csrf
                        @method('put')
                        <x-menu-item>Make admin</x-menu-item>
                    </form>
                    <x-modal.divider />
                @endif
            @endif

            <x-menu-item
                x-data
                @click="$dispatch('close-modal', 'profile-menu')"
                variant="highlights"
            >
                Cancel
            </x-menu-item>
        </x-modal.menu>
    </x-modal.base>

    <x-modal.base
        name="report-user"
        :show="$errors->createReport->isNotEmpty() || $errors->createReportValidation->isNotEmpty()"
    >
        <x-modal.input>
            <x-slot:title>
                {{ $user->username }}
            </x-slot>

            <form
                method="post"
                action="{{ route('report.store.profile', ['id' => $user->id]) }}"
                class="flex flex-col gap-6"
            >
                @csrf

                <div class="flex flex-col gap-4">
                    <x-input.textarea
                        name="reason"
                        :value="old('reason')"
                        required
                        :error="$errors->createReportValidation->first('reason')"
                        label="Why do you want to report this user?"
                        placeholder="Describe how this user breaks our rules"
                        color="light"
                    />
                </div>

                <x-input.error :message="$errors->createReport->first()" />

                <div class="flex gap-2">
                    <x-button
                        x-data
                        @click="$dispatch('close-modal', 'report-user')"
                        type="button"
                        variant="secondary"
                    >
                        Cancel
                    </x-button>
                    <x-button class="flex-1">Send</x-button>
                </div>
            </form>
        </x-modal.input>
    </x-modal.base>

    <x-ban-user-modal :errors="$errors" :user="$user" />
    <x-create-list-modal />
</x-layout>
