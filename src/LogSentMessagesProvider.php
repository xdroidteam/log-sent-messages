<?php namespace XdroidTeam\LogSentMessages;

use DB, Auth;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class LogSentMessagesProvider extends ServiceProvider
{
    public function register()
    {
        \Event::listen('Illuminate\Mail\Events\MessageSending', function($message)
        {
            $messageObject = $message->message;

            SentEmail::create([
                                'user_id' => Auth::check() ? Auth::id() : 'No user defined',
                                'from' => $this->arrayToEmail($messageObject->getFrom()),
                                'to' => $this->arrayToEmail($messageObject->getTo()),
                                'cc' => $this->arrayToEmail($messageObject->getCc()),
                                'bcc' => $this->arrayToEmail($messageObject->getBcc()),
                                'subject' => $messageObject->getSubject(),
                                'body' => $messageObject->getBody(),
                                'plain' => $messageObject
                                ]);
        });
        
    }

    private function arrayToEmail($emails){
        if (!is_array($emails))
            return;

        return collect($emails)->map(function ($recipientName, $address) {
                    return $recipientName . ' <' . $address . '>';
                })
                ->implode(';');
    }

    public function boot(Router $router)
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'log_sent_messages');

        $this->publishes([
                    __DIR__.'/../database/migrations' => base_path('database/migrations'),
                    __DIR__.'/../config/xdroidteam-logsentmessages.php' => config_path('xdroidteam-logsentmessages.php'),
            ], 'xdroidteam-logsentmessages');

        $config = array_merge(['namespace' => 'XdroidTeam\LogSentMessages'], config('xdroidteam-logsentmessages.route', []));

        $router->group($config, function($router)
        {
            $router->post('/search', 'LogSentMessagesController@setFilter');
            $router->get('/reset-search', 'LogSentMessagesController@resetFilter');
            $router->get('/{id?}', 'LogSentMessagesController@index');
        });
    }
}
