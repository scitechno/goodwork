<?php

namespace App\Repositories;

use App\Models\Team;

class TeamRepository
{
    use RepositoryHelperTrait;
    /**
     * @var mixed
     */
    protected $model;

    /**
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        $this->model = $team;
    }

    /**
     * @return mixed
     */
    public function getLatestThreeTeam()
    {
        return $this->model->orderBy('created_at', 'desc')->take(3)->get();
    }

    public function getLatestTeams($total)
    {
        return $this->model->orderBy('created_at', 'desc')->take($total)->get();
    }

    public function createNewTeam($data)
    {
        return $this->model->create(array_add($data, 'slug', str_slug($data['name'])));
    }
}
