<?php namespace MicheleAngioni\MessageBoard\Models;

class Like extends \Illuminate\Database\Eloquent\Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tb_messboard_likes';

    protected $guarded = array('id');



    public function likable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('\TopGames\Models\Tough\User');
    }

}