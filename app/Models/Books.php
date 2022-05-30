<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'author'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function findByAuthor($name){
        return DB::select('SELECT * FROM books WHERE author = "'.urldecode($name).'" ');
    }

    public function findAll($page, $numberPerPage){
        // build query
        $offset = ($page - 1) * $numberPerPage;
        
        return DB::select("SELECT * FROM books LIMIT " . $offset . "," . $numberPerPage);
    }
}