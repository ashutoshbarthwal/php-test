<?php

namespace App\Core\Transformers;

use League\Fractal\TransformerAbstract;
use App\Core\Models\Roster;

class StatTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
      'forum_comments',
      'forum_posts'
    ];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
    ];


    /**
     * resolove the profile
     *
     * @param Build $model
     * @return array
     */
    public function transform(Roster $data)
    {
      return $data->toArray();
    }

}
