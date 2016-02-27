<?php namespace MicheleAngioni\MessageBoard;

trait Notifable
{
    /**
     * Notifications Relation.
     *
     * @return mixed
     */
    public function notifications()
    {
        return $this->hasMany('\MicheleAngioni\MessageBoard\Models\Notification', 'to_id');
    }

    /**
     * Read all Notifications.
     *
     * @return mixed
     */
    public function readAllNotifications()
    {
        return $this->notifications()->where('read', false)->update(['read' => true]);
    }

    /**
     * Read input Notification.
     * Return true on success.
     *
     * @param  int  $idNotification
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return bool
     */
    public function readNotification($idNotification)
    {
        $notification = $this->notifications()->where('id', $idNotification)->firstOrFail();
        $notification->setAsRead();

        return true;
    }

    /**
     * Read Limiting Notifications.
     *
     * @param  int    $numbers
     * @param  string  $order
     *
     * @return mixed
     */
    public function readLimitNotifications($numbers = 10, $order = 'desc')
    {
        return $this->notifications()
            ->where('read', false)
            ->orderBy('created_at', $order)
            ->take($numbers)
            ->update('read', true);
    }

    /**
     * Delete Limiting Notifications.
     *
     * @param  int    $numbers
     * @param  string  $order
     *
     * @return mixed
     */
    public function deleteLimitNotifications($numbers = 10, $order = 'desc')
    {
        return $this->notifications()
            ->orderBy('created_at', $order)
            ->take($numbers)
            ->delete();
    }

    /**
     * Delete all Notifications.
     *
     * @return mixed
     */
    public function deleteAllNotifications()
    {
        return $this->notifications()->delete();
    }

    /**
     * Get Not Read Notifications.
     *
     * @param  int|null  $limit
     * @param  int  $page
     * @param  string   $order
     *
     * @return \Illuminate\Support\Collection
     */
    public function getNotificationsNotRead($limit = null, $page = 1, $order = 'desc')
    {
        $query = $this->notifications()
            ->where('read', false)
            ->orderBy('created_at', $order);

        if($limit) {
            $query = $query
                ->skip($page * $limit - $limit)
                ->take($limit);
        }

        return $query->get();
    }

    /**
     * Get all Notifications.
     *
     * @param  null|null  $limit
     * @param  int  $page
     * @param  string   $order
     *
     * @return \Illuminate\Support\Collection
     */
    public function getNotifications($limit = null, $page = 1, $order = 'desc')
    {
        $query = $this->notifications()
            ->orderBy('created_at', $order);

        if($limit) {
            $query = $query
                ->skip($page * $limit - $limit)
                ->take($limit);
        }

        return $query->get();
    }

    /**
     * Get last Notification.
     *
     * @param  string|null  $type
     *
     * @return \MicheleAngioni\MessageBoard\Models\Notification|null
     */
    public function getLastNotification($type = null)
    {
        $query = $this->notifications()
            ->orderBy('created_at', 'desc');

        if($type) {
            $query = $query->where('type', $type);
        }

        return $query->first();
    }

    /**
     * Count unread Notifications;
     *
     * @param  string|null  $type
     *
     * @return int
     */
    public function countNotificationsNotRead($type = null)
    {
        $query = $this->notifications()
            ->where('read', false);

        if($type) {
            $query = $query->where('type', $type);
        }

        return $query->count();
    }

}
