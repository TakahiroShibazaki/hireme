<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{-- {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }} --}}
            <p>会員登録ありがとうどざいます!</p>
            <p>ご登録いただきましたメールアドレス宛に認証メールを送信しました。</p>
            <p>メールに記載のリンクをクリック後、ログインをして、メールアドレスを認証してください。</p>
            <p>メールを確認できない場合は、下のボタンよりメールを再送いたします。</p>
            <p>お手数ですが、迷惑メールフォルダのご確認もお願いいたします。</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div>
                    <x-jet-button type="submit">
                        {{-- {{ __('Resend Verification Email') }} --}}
                        メールを再送する
                    </x-jet-button>
                </div>
            </form>
            <a class="btn btn-success" href="{{ route('postCreate') }}" role="button">早速投稿する</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{-- {{ __('Logout') }} --}}
                    ログアウト
                </button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
