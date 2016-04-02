<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Match extends Model
{
    protected $table = 'matches';

    protected $guarded = ['id'];

    const TYPE_NONE = 'none';
    const TYPE_HOME = 'home';
    const TYPE_AWAY = 'away';

    const STATUS_WAITING = 'waiting';
    const STATUS_IN_PLAY = 'success';
    const STATUS_FINISHED = 'fail';

    const MY_GAMES_YES = 1;
    const MY_GAMES_NO = 0;

    static $VALID_TYPES = [
        self::TYPE_NONE,
        self::TYPE_HOME,
        self::TYPE_AWAY
    ];

    static $VALID_STATUSES = [
        self::STATUS_WAITING,
        self::STATUS_IN_PLAY,
        self::STATUS_FINISHED
    ];

    static $VALID_MY_GAMES = [
        self::MY_GAMES_YES,
        self::MY_GAMES_NO
    ];

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getOdds()
    {
        return $this->odds;
    }

    /**
     * @param string $odds
     */
    public function setOdds($odds)
    {
        $this->odds = $odds;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param string $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return float
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * @param float $parameter
     */
    public function setParameter($parameter)
    {
        $this->parameter = $parameter;
    }

    /**
     * @return float
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param float $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @return float
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param float $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getMyGames()
    {
        return $this->my_games;
    }

    /**
     * @param $my_games
     */
    public function setMyGames($my_games)
    {
        $this->my_games = $my_games;
    }

    /**
     * @return integer
     */
    public function getLeagueId()
    {
        return $this->league_id;
    }

    /**
     * @param integer $league_id
     */
    public function setLeagueId($league_id)
    {
        $this->league_id = $league_id;
    }

    public function toggleMyGames()
    {
        if ($this->my_games == self::MY_GAMES_NO) {
            return $this->my_games = self::MY_GAMES_YES;
        } else {
            return $this->my_games = self::MY_GAMES_NO;
        }
    }

    /**
     * @return BelongsTo
     */
    public function league()
    {
        return $this->belongsTo('App\Models\League');
    }

    /**
     * @param string $odds
     * @param string $result
     * @param float  $x
     * @param float  $y
     * @param string $type
     * @param string $status
     * @param League $league
     *
     * @return static
     * @internal param float $parameter
     */
    public static function make($odds = '', $result = '', $x = 0.0, $y = 0.0, $type = 'none', $status = 'waiting', $league)
    {
        if (!in_array($type, self::$VALID_TYPES)) {
            throw new \InvalidArgumentException("Invalid $type value. Possible options are: ".implode(', ', self::$VALID_TYPES));
        }

        if (!in_array($status, self::$VALID_STATUSES)) {
            throw new \InvalidArgumentException("Invalid $status value. Possible options are: ".implode(', ', self::$VALID_STATUSES));
        }

        return new static([
            'odds'      => $odds,
            'result'    => $result,
            'x'         => $x,
            'y'         => $y,
            'parameter' => (float)$x - (float)$y,
            'type'      => $type,
            'status'    => $status,
            'league_id' => $league->id
        ]);
    }
}
