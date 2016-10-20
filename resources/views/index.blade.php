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
        .wrapper {
            height: 100%;
            width: 100%;
        }
        .Email {
            height: 100%;
            width: 100%;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: row;
            -ms-flex-direction: row;
            flex-direction: row;
            -webkit-justify-content: flex-start;
            -ms-flex-pack: start;
            justify-content: flex-start;
            -webkit-align-items: flex-start;
            -ms-flex-align: start;
            align-items: flex-start;
        }
        .List {
            -webkit-flex: 2;
            -ms-flex: 2;
            flex: 2;
            -webkit-flex-basis: 100px;
            -ms-flex-preferred-size: 100px;
            flex-basis: 100px;
            padding-top: 120px;
            position: relative;
            height: calc(100% - 120px);
        }
        .List__search {
            position: absolute;
            top: 0;
            left: 0;
            height: 60px;
            width: calc(100% - 31px);
            border-bottom: 1px solid #EDEDED;
            border-right: 1px solid #EDEDED;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-justify-content: flex-start;
            -ms-flex-pack: start;
            justify-content: flex-start;
            padding-left: 30px;
        }
        .List__search input {
            border: 0;
            outline: 0;
            height: calc(100% - 20px);
            width: 100%;
            color: #6D788E;
        }
        .List__search input:focus {
            border: 0;
            outline: 0;
        }
        .List__pagination {
            border-right: 1px solid #EDEDED;
            height: 60px;
            position: absolute;
            background-color: #F6F7FA;
            top: 60px;
            left: 0;
            width: calc(100% - 1px);
            border-bottom: 1px solid #EDEDED;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
        }
        .List__item {
            height: auto;
            padding: 15px 30px;
            border-bottom: 1px solid #EDEDED;
            border-right: 1px solid #EDEDED;
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
        .List__subject {
            font-weight: 700;
            color: #323544;
            font-size: 14px;
        }
        .View {
            -webkit-flex: 5;
            -ms-flex: 5;
            flex: 5;
            padding: 40px 70px;
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
            <div class="List">
                <div class="List__search">
                    <form action="/{{{ config('xdroidteam-logsentmessages.route.prefix') }}}/search" method="post">
                        {{{ csrf_field() }}}
                        <input id="search-input"
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
                                {{ $email->created_at }}
                            </div>
                        </a>
                    @endforeach
                    @if(count($emails) == 0)
                        <div class="List__item">
                            <div class="List__subject">
                                No results for your search!
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="View">
                @if($selectedEmail)
                    <div class="View__date">
                        {{ $selectedEmail->created_at }}
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

            $(document).on('keyup', '#search-input', function(event) {
                if (event.keyCode == 13) {
                    $(this).parent('form').submit();
                }
                if (event.keyCode == 27) {
                    $(this).val($(this).data('original-value'));
                    $(this).blur();
                }
            });
        });
    </script>
</body>
</html>
