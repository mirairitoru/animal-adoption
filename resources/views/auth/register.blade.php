<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf

        <div class="flex flex-col items-center justify-center">
            <h2 class="mt-4 mb-4 font-bold">新規登録画面</h2>
            <!-- select -->
            <div class="flex mb-6">
                <button id="btn-user" type="button" onclick="setRole('user')"
                    class="border p-1 w-48 text-white bg-green-700">一般ユーザー</button>
                <button id="btn-org" type="button" onclick="setRole('organization')"
                    class="border p-1 w-48 bg-gray-200">保護団体</button>
                <input type="hidden" name="role" id="role" value="{{ old('role') ?? 'user' }}">
            </div>
            <!-- ユーザー用 -->
            <div id="user-fields" class="w-96">
                <!-- 名前 -->
                <div class="w-96">
                    <x-input-label for="user_name" :value="__('名前')" />
                    <x-text-input id="user_name" class="block mt-1 w-full {{ old('role') === 'user' && $errors->has('user_name') ? 'border-red-500' : '' }}" type="text" name="user_name"
                        :value="old('user_name')" autofocus autocomplete="user_name" placeholder="山田 太郎" />
                    <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
                </div>
                <!-- ニックネーム -->
                <div class="mt-4 w-96">
                    <x-input-label for="nickname" :value="__('ニックネーム')" />
                    <x-text-input id="nickname" class="block mt-1 w-full {{ old('role') === 'user' && $errors->has('nickname') ? 'border-red-500' : '' }}" type="text" name="nickname"
                        :value="old('nickname')" autocomplete="name" placeholder="ニックネーム" />
                    <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
                </div>
            </div>
            <!-- 保護団体 -->
            <div id="org-fields" class="w-96 hidden">
                <!-- 団体名 -->
                <div>
                    <x-input-label for="org_name" :value="__('団体名')" />
                    <x-text-input id="org_name" class="block mt-1 w-full {{ old('role') === 'organization' && $errors->has('org_name') ? 'border-red-500' : '' }}" type="text" name="org_name"
                        :value="old('org_name')" placeholder="しらゆり動物保護" />
                    <x-input-error :messages="$errors->get('org_name')" class="mt-2" />
                </div>
                <!-- 担当者名 -->
                <div class="mt-4">
                    <x-input-label for="contact_name" :value="__('担当者名')" />
                    <x-text-input id="contact_name" class="block mt-1 w-full {{ old('role') === 'organization' && $errors->has('contact_name') ? 'border-red-500' : '' }}" type="text" name="contact_name"
                        :value="old('contact_name')" placeholder="佐藤 一郎" />
                    <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
                </div>
            </div>
            <!-- メールアドレス -->
            <div class="mt-4 w-96">
                <x-input-label for="email" :value="__('メールアドレス')" />
                <x-text-input id="email" class="block mt-1 w-full {{ $errors->has('email') ? 'border-red-500' : '' }}" type="email" name="email" :value="old('email')"
                    autocomplete="username" placeholder="メールアドレス" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- パスワード -->
            <div class="mt-4 w-96">
                <x-input-label for="password" :value="__('パスワード')" />

                <x-text-input id="password" class="block mt-1 w-full {{ $errors->has('password') ? 'border-red-500' : '' }}" type="password" name="password"
                    placeholder="パスワード" autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- パスワード(確認) -->
            <div class="mt-4 w-96">
                <x-input-label for="password_confirmation" :value="__('パスワード(確認)')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}" type="password"
                    placeholder="確認用パスワード" name="password_confirmation" autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <x-primary-button class="mt-6 w-96 justify-center !bg-green-700">
                {{ __('登録する') }}
            </x-primary-button>

            <div class="w-96 mt-6">
                <hr>
            </div>

            <p class="mt-6">
                すでにアカウントをお持ちの方はこちら
                <a class="hover:underline hover:text-blue-600 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('home') }}">
                    {{ __('ログインへ') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
