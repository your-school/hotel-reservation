@props(['type' => 'info', 'message'])

@if(session($type))
<div class="fixed top-0 left-0 w-full {{ $type === 'error' ? 'bg-red-500' : 'bg-green-500' }} text-center text-sm font-semibold text-white p-4" id="flash-message">
    {{ session($type) }}
</div>

@endif

<script>
    // フラッシュメッセージが存在する場合
    @if(session($type))
        // フラッシュメッセージを5秒後に非表示にする
        $(document).ready(function(){
            setTimeout(function(){
                $('#flash-message').fadeOut('slow');
            }, 5000);
        });
    @endif
</script>