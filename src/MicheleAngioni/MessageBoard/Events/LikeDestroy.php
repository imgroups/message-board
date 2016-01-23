<?php namespace MicheleAngioni\MessageBoard\Events;

use MicheleAngioni\MessageBoard\Models\Like;
use Illuminate\Queue\SerializesModels;

class LikeDestroy {

	use SerializesModels;

    /**
     * @var Like
     */
    public $like;

    /**
     * Create a new event instance.
     */
    public function __construct(Like $like)
    {
        $this->like = $like;
    }

}