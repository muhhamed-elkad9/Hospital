<div>
    @if ($selected_conversation)
        <div class="main-content-body main-content-body-chat">
            <div class="main-chat-header">

                <div class="main-chat-msg-name">
                    <h6>{{ $receviverUser->name }}</h6><small>Last seen: 2 minutes ago</small>
                </div>
                
            </div><!-- main-chat-header -->
            <div class="main-chat-body" id="ChatBody">
                <div class="content-inner">
                    <label class="main-chat-time"><span>Today</span></label>
                    @foreach ($messages as $message)
                        <div class="media {{ $auth_email == $message->sender_email ? 'flex-row-reverse' : '' }}">
                            <div class="media-body">
                                <div
                                    class="main-msg-wrapper {{ $auth_email == $message->sender_email ? 'right' : 'left' }}">
                                    {{ $message->body }}
                                </div>
                                <div>
                                    <span>{{ $message->created_at->format('H') + 2 - 12 }}:{{ $message->created_at->format('i') }}</span>
                                    <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

</div>
