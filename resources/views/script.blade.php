@php($settings = app(\JeffersonGoncalves\Crisp\Settings\CrispSettings::class))

@if($settings->shouldRender())
    @php($user = $settings->identify_users ? auth()->user() : null)
    <script @if(\Illuminate\Support\Facades\Vite::cspNonce()) nonce="{{ \Illuminate\Support\Facades\Vite::cspNonce() }}" @endif type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = @js($settings->website_id);
        @if(filled(data_get($user, 'email')))
        window.$crisp.push(["set", "user:email", [@js((string) data_get($user, 'email'))]]);
        @endif
        @if(filled(data_get($user, 'name')))
        window.$crisp.push(["set", "user:nickname", [@js((string) data_get($user, 'name'))]]);
        @endif
        (function () {
            var d = document, s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>
@endif
