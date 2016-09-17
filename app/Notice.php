<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model{
    protected $fillable = [
        'provider_id',
        'infringing_title',
        'infringing_link',
        'original_link',
        'additional_description',
        'template',
        'content_removed'
    ];
    
    public function recipient(){
        return $this->belongsTo('App\Provider', 'provider_id');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function  getRecepientEmail(){
        return $this->recipient->copyright_email;
    }
    
    public function getOwnerEmail(){
        //return $this->user->email;
        return 'sandbox@sparkpostbox.com';
    }
    
//    // open a new notice
//    //named constructor
//    public static function open(array $attributes){
//        return new static($attributes);
//    }
//    
//    //set the email template for notice
//    public function useTemplate($template){
//        $this->template = $template;
//        return $this;
//    }
    
}
