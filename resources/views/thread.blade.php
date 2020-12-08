<!DOCTPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="{{ $metaDescription }}">
        <meta name="keywords" content="{{ $metaKeywords }}" >
        <title>{{$title}}</title>

        <style>
            a {
                text-decoration: none;
            }
            .header {
                vertical-align: middle;
                margin-bottom: 30px;
                padding-bottom: 10px;
                border-bottom: 1px #f1f1f1 solid;
                display:block;
            }
            .header img {
                width: 40px;
                height: 40px;
                margin-right: 10px;
                vertical-align: middle;
            }
            .main {
                padding:40px;
            }
            .thread-section {
                display: flex;
                margin-bottom: 40px;
                background: #f1f1f1;
                padding: 20px;
            }
            .thread-section .thread-content {
                margin-left: 20px;
                flex-grow: 1;
            }
            .thread-section .avatar {
                width:50px;
                height:50px;
            }
            .username {
                margin: 0;
            }
            .embedded-image {
                width:185px;
            }
        </style>
    </head>
<body>
    <div class="main">
        <a class="header" href="/">
            <img src="{{ $logo }}"> {{ $sitename }}
        </a>
        <div class="thread-section">
            <img class="avatar" src="{{ $thread['user']['attributes']['avatarUrl'] }}" alt="{{ $thread['user']['attributes']['username'] }}"/>
            <div class="thread-content">
                <p class="username">{{ $thread['user']['attributes']['username'] }}</p>
                @if (!empty($thread['attributes']['title']))
                <p clsas="title"><a href="/thread/{{ $thread['id']}}">{{ $thread['attributes']['title'] }}</a></p>
                @endif
                <p class="content">{!! $thread['detail']['attributes']['contentHtml'] !!}</p>

                @if (!empty($thread['detail']['images']))
                @foreach ($thread['detail']['images'] as $image)
                    <img class="embedded-image" src="{{ $image['attributes']['url'] }}" />
                @endforeach
                @endif

                @if (!empty($thread['detail']['video']))
                <video width="620" controls
                    poster="{{$thread['detail']['video']['attributes']['cover_url']}}">
                    <source src="{{$thread['detail']['video']['attributes']['media_url']}}" type="video/mp4">
                </video>
                @endif
                <p class="publish-date">{{ $thread['attributes']['createdAt'] }}</p>

                @if (!empty($thread['category']))
                <a href="/category/{{ $thread['category']['id'] }}">{{ $thread['category']['attributes']['name'] }}</a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
