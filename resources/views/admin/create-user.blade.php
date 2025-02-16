<x-layout class="">
    <x-section-header.back-link
        backLabel="Back to dashboard"
        title="Create user"
        href="{{ route('admin.dashboard') }}"
    />
    <div class="m-auto max-w-xl">
        <div class="flex flex-col gap-12 pt-4 md:pt-8">
            <form
                method="POST"
                action="{{ route('admin.store.user') }}"
                class="flex flex-col gap-8"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="flex flex-col gap-4">
                    <x-input.text
                        name="username"
                        :value="old('username')"
                        autofocus
                        required
                        :error="$errors->first('username')"
                        label="Username"
                        placeholder="Enter the username of the user"
                    />

                    <x-input.text
                        name="email"
                        :value="old('email')"
                        autofocus
                        required
                        :error="$errors->first('email')"
                        label="E-mail"
                        placeholder="Enter the e-mail of the user"
                    />

                    <x-input.password
                        name="password"
                        value="Popco2025!"
                        readonly
                        autofocus
                        required
                        :error="$errors->first('password')"
                        label="Password"
                        placeholder=""
                    />

                    <x-input.checkbox
                        name="is_admin"
                        label="Is admin?"
                        :checked="old('is_admin')"
                    />

                    <x-button type="submit" size="md">Create user</x-button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
