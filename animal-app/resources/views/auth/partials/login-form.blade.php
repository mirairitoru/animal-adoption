<div class="w-96">
    <!-- タブ -->
    <div class="border-b mb-4 flex justify-center space-x-16">
        <button type="button" id="login-btn-user" onclick="switchTab('user')" class="px-4 py-2 hover:text-blue-500 hover:underline">
            一般ユーザー
        </button>

        <button type="button" id="login-btn-org" onclick="switchTab('org')" class="px-4 py-2 hover:text-blue-500 hover:underline">
            保護団体
        </button>
    </div>

    <!-- ユーザーフォーム -->
    <form id="userForm" method="POST" action="{{ route('login') }}">
        @csrf

        <input type="hidden" name="role" value="user">
        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input class="block mt-1 w-full" type="email" name="email" placeholder="メールアドレス"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input class="block mt-1 w-full" type="password" name="password" placeholder="パスワード"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button type="submit" class="w-96 justify-center mt-3">
            {{ __('ログイン') }}
        </x-primary-button>
    </form>

    <!-- 保護団体 --->
    <form id="orgForm" class="hidden" method="POST" action="{{ route('org.login') }}">
        @csrf

        <input type="hidden" name="role" value="org">
        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input class="block mt-1 w-full" type="email" name="email" placeholder="メールアドレス"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input class="block mt-1 w-full" type="password" name="password" placeholder="パスワード"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button type="submit" class="w-96 justify-center mt-3">
            {{ __('ログイン') }}
        </x-primary-button>
    </form>
</div>