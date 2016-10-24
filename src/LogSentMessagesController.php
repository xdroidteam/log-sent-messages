<?php namespace XdroidTeam\LogSentMessages;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Session;

class LogSentMessagesController extends BaseController
{
    public function index($id = false){
        $emails = SentEmail::orderBy('created_at', 'DESC');

        if (Session::has('xdroidteam-logsentmessages-filter')){
            $emails->where('to', 'LIKE', '%' . Session::get('xdroidteam-logsentmessages-filter') . '%')
                    ->orWhere('cc', 'LIKE', '%' . Session::get('xdroidteam-logsentmessages-filter') . '%')
                    ->orWhere('bcc', 'LIKE', '%' . Session::get('xdroidteam-logsentmessages-filter') . '%')
                    ->orWhere('subject', 'LIKE', '%' . Session::get('xdroidteam-logsentmessages-filter') . '%');
        }

        $emails = $emails->paginate(10);

        if ($id)
            $selectedEmail = SentEmail::findOrFail($id);
        else
            $selectedEmail = $emails[0];

        return view('log_sent_messages::index', compact('emails', 'selectedEmail'));
    }

    public function setFilter(Request $request){
        if ($request->get('search', false)){
            Session::put('xdroidteam-logsentmessages-filter', $request->get('search'));
        }
        else{
            Session::forget('xdroidteam-logsentmessages-filter');
        }

        return redirect()->to('/' . config('xdroidteam-logsentmessages.route.prefix'));
    }

    public function resetFilter(){
        Session::forget('xdroidteam-logsentmessages-filter');
        
        return redirect()->to('/' . config('xdroidteam-logsentmessages.route.prefix'));
    }
}
