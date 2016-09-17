<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NoticeCreateRequest;
use App\Provider;
use App\Notice;
use Auth;

class NoticesController extends Controller
{
    protected $user;

    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
        parent::__construct();
    }

    public function index(){
//        $notices = $this->user->notices()->where('content_removed',0)->get();

        $notices = $this->user->notices;
        return view('notices.index', compact('notices'));
    }

    public function create(){
        $provider = Provider::pluck('name','id');
        return view('notices.create', compact('provider'));
    }

    public function confirm(NoticeCreateRequest $request){
        $template = $this->compileDmcaTemplate($data = $request->all());
        session()->flash('dmca', $data);
        return view('notices.confirm', compact('template'));
    }

    public function store(Request $request){
        $notice = $this->createNotice($request);

        //for sending simple text message use text instead of html
        \Mail::queue(['html'=>'emails.dmca'], compact('notice'), function($message) use ($notice){
            $message->from($notice->getOwnerEmail())
                    ->to($notice->getRecepientEmail())
                    ->subject('DMCA Notice');
        });

        flash('Your DMCA notice has been delivered');

        return redirect('notices');
    }

    public function update($noticeid, Request $request){
        $isRemoved = $request->has('content_removed');
        $notice = Notice::findOrFail($noticeid)
                ->update(['content_removed' => $isRemoved]);

        return redirect()->back();
    }


    public function compileDmcaTemplate($data){
        $data = $data + [
            'name' => $this->user->name,
            'email' => $this->user->email,
        ];

        return view()->file(app_path('Http/Templates/dmca.blade.php'), $data);
    }

    public function createNotice(Request $request){
//        $data = session()->get('dmca');
//        $notice = Notice::open($data)->useTemplate($request->input('template'));
//        //auth()->user()->notices()->save($notice);
//        Auth::user()->notices()->save($notice);

        $notice = session()->get('dmca') + ['template' => $request->input('template')];
        $notice = $this->user->notices()->create($notice);

        return $notice;
    }
}
