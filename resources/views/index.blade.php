<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Log Sent Messages
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" media="screen" title="no title" charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&subset=latin-ext" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js" charset="utf-8"></script>
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
            color: #323544;
            background-color: #FFFFFF;
            font-family: 'Roboto', sans-serif;
            font-size: 100%;
            line-height: 1.5;
        }
        a:visited {
            color: currentColor;
        }
        .wrapper {
            height: 100%;
            width: 100%;
        }
        .Email {
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: stretch;
        }
        .List {
            flex: 2;
            flex-basis: 100px;
            padding-top: 120px;
            position: relative;
            /*min-height: calc(100% - 120px);*/
            height: 100%;
            border-right: 1px solid #DEDEDE;
        }
        .List__reset {
            position: absolute;
            align-items: center;
            top: 5px;
            right: 0;
            z-index: 10;
            display: block;
            padding: 12px 24px;
            cursor: pointer;
            text-decoration: none;
        }
        .List__search {
            position: absolute;
            top: 0;
            left: 0;
            height: 60px;
            width: calc(100% - 31px);
            border-bottom: 1px solid #EDEDED;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 30px;
        }

        .List__search form {
            height: 100%;
            width: 100%;
            display: block;
        }
        .List__search input {
            border: 0;
            outline: 0;
            height: 100%;
            width: 100%;
            color: #6D788E;
        }
        .List__search input:focus {
            border: 0;
            outline: 0;
        }
        .List__pagination {
            height: 60px;
            position: absolute;
            background-color: #F6F7FA;
            top: 60px;
            left: 0;
            width: calc(100% - 1px);
            border-bottom: 1px solid #EDEDED;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .List__item {
            height: auto;
            padding: 15px 30px;
            border-bottom: 1px solid #EDEDED;
            transition: all .2s ease;
            background-color: #F6F7FA;
            cursor: pointer;
            display: block;
            text-decoration: none;
            color: inherit;
        }
        .List__item:hover {
            background-color: #FFFFFF;
            border-right-color: #FFFFFF;
            text-decoration: none;
            color: inherit;
        }
        .List__item--active {
            background-color: #FFFFFF;
            border-right-color: #FFFFFF;
            text-decoration: none;
            color: inherit;
        }
        .List__from {
            font-weight: 400;
            font-size: 12px;
            margin: 5px 0;
        }
        .List__date {
            font-weight: 400;
            color: #6D788E;
            font-size: 12px;
        }
        .List--hidden {
            display: none;
        }
        .List__subject {
            font-weight: 700;
            color: #323544;
            font-size: 14px;
        }
        .Feedback {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.25em;
            color: #6D788E;
        }

        .Feedback form {
            display: flex;
            align-items: stretch;
            justify-content: center;
            margin-top: 20px;
        }
        .Feedback form input {
            transition: all 0.25s ease;
        }

        .Feedback form input:hover,
        .Feedback form input:active,
        .Feedback form input:focus {
            border-color: #6D788E;
        }
        .Feedback__button {
            padding: 6px 12px;
            border: 1px solid #EDEDED;
            font-size: 1em;
            color: #6D788E;
            text-decoration: none;
            margin-right: 12px;
            transition: all 0.25s ease;
        }
        .Feedback__button:hover {
            border-color: #6D788E;
        }
        .Search__input--feedback {
            border: 1px solid #EDEDED;
            outline: 0;
            padding: 6px;
            color: #6D788E;
            text-align: center;
        }
        .View {
            flex: 5;
            padding: 40px 70px;
            border-left: 1px solid #EDEDED;
            min-height: calc(100% - 80px);
        }
        .View__date {
            font-size: 14px;
            font-weight: 400;
            color: #6D788E;
            margin-bottom: 35px;
        }
        .View__subject {
            font-size: 32px;
            font-weight: 700;
            color: #323544;
            margin-bottom: 30px;
        }
        .View__from-to {
            font-size: 14px;
            font-weight: 400;
            color: #6D788E;
            line-height: 25px;
            margin-bottom: 10px;
        }
        .View__from-to span {
            color: #323544;
            font-weight: 700;
            margin-right: 5px;
        }
        .View__message {
            border-top: 1px solid #EDEDED;
            padding-top: 30px;
            margin-top: 30px;
            font-size: 16px;
            color: #6D788E;
            font-weight: 400;
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 22px 0;
            border-radius: 2px;
        }
        .pagination > .disabled > span {
            cursor: not-allowed;
        }
        .pagination > .active > span {
            background-color: #6D788E;
            color: #FFFFFF;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            line-height: 1.5;
            text-decoration: none;
            color: #6D788E;
            background-color: #FFFFFF;
            border: 1px solid #EDEDED;
            margin-left: -1px;
        }
        .pagination > li > a {
            position: relative;
            float: left;
            padding: 6px 12px;
            line-height: 1.5;
            text-decoration: none;
            color: #6D788E;
            background-color: #FFFFFF;
            border: 1px solid #EDEDED;
            margin-left: -1px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="Email">
            <div class="List
                @if(count($emails) == 0)
                    List--hidden
                @endif">
                @if(Session::has('xdroidteam-logsentmessages-filter'))
                    <a href="{{{ '/' . config('xdroidteam-logsentmessages.route.prefix') . '/reset-search' }}}" class="List__reset" title="Reset search">
                        x
                    </a>
                @endif
                <div class="List__search">
                    <form action="/{{{ config('xdroidteam-logsentmessages.route.prefix') }}}/search" method="post">
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
                        <input class="Search__input"
                            type="text"
                            name="search"
                            value="{{{ Session::get('xdroidteam-logsentmessages-filter', '') }}}"
                            data-original-value="{{{ Session::get('xdroidteam-logsentmessages-filter', '') }}}"
                            placeholder="Search..."
                        />
                    </form>
                </div>
                <div class="List__pagination">
                    {!! $emails->render() !!}
                </div>
                <div class="List__wrapper">
                    @foreach ($emails as $email)
                        <a class="List__item {{ $email->id == $selectedEmail->id ? 'List__item--active' : '' }}" href="/sent-emails/{{ $email->id }}">
                            <div class="List__subject">
                                {{ $email->subject }}
                            </div>
                            <div class="List__from">
                                @foreach (explode(';', $email->to) as $oneRecipient)
                                    {{ $oneRecipient }}
                                    <br>
                                @endforeach
                            </div>
                            <div class="List__date">
                                {{ $email->created_at }} ({{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $email->created_at)->diffForHumans() }})
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="View">
                @if(count($emails) == 0 && Session::has('xdroidteam-logsentmessages-filter'))
                    <div class="Feedback">
                        <div>
                            No results for your search! Try again?
                        </div>
                        <form action="/{{{ config('xdroidteam-logsentmessages.route.prefix') }}}/search" method="post">
                            {{{ csrf_field() }}}
                            <a href="{{{ '/' . config('xdroidteam-logsentmessages.route.prefix') . '/reset-search' }}}" class="Feedback__button">
                                Back
                            </a>
                            <input class="Search__input Search__input--feedback"
                                type="text"
                                name="search"
                                value="{{{ Session::get('xdroidteam-logsentmessages-filter', '') }}}"
                                data-original-value="{{{ Session::get('xdroidteam-logsentmessages-filter', '') }}}"
                                placeholder="Search..."
                            />
                        </form>
                    </div>
                @elseif (count($emails) == 0 && !Session::has('xdroidteam-logsentmessages-filter'))
                    <div class="Feedback">
                        We have not found any log messages yet.
                    </div>
                @endif
                @if($selectedEmail)
                    <div class="View__date">
                        {{ $selectedEmail->created_at }} ({{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $selectedEmail->created_at)->diffForHumans() }})
                    </div>
                    <div class="View__subject">
                        {{ $selectedEmail->subject }}
                    </div>
                    <div class="View__from-to">
                        <span>
                            From:
                        </span>
                        {{ $selectedEmail->from }}
                        <br>
                        <span>
                            To:
                        </span>
                        {{ $selectedEmail->to }}
                    </div>
                    @if ($selectedEmail->cc || $selectedEmail->bcc)
                        <div class="View__from-to">
                            @if ($selectedEmail->cc)
                                <span>
                                    Cc:
                                </span>
                                {{ $selectedEmail->cc }}
                            @endif
                            <br>
                            @if ($selectedEmail->bcc)
                                <span>
                                    Bcc:
                                </span>
                                {{ $selectedEmail->bcc }}
                            @endif
                        </div>
                    @endif
                    <div class="View__message">
                        {!! $selectedEmail->body !!}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.List__wrapper').slimScroll({
                height: '100%',
                distance: '0px',
                color: '#47525E',
                borderRadius: '0'
            });

            $(document).on('keyup', '.Search__input', function(event) {
                if (event.keyCode == 13) {
                    $(this).parent('form').submit();
                }
                if (event.keyCode == 27) {
                    $(this).val($(this).data('original-value'));
                    $(this).blur();
                }
            });

            $("img").each(function(){
                var image = $(this);
                if(image.prop('naturalHeight') == 0){
                    $(image).hide();
                }
            });
        });
    </script>
</body>
</html>
                                                     
