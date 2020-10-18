<?php

namespace App\Core\Transformers;

use League\Fractal\TransformerAbstract;

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
    public function transform(User $model)
    {
      return [
        'id' => $model->id,
        'email' => $model->email,
        'name' => $model->name,
        'slug' => $model->slug,
        'avatar' => $model->avatar_image,
        'status'  => $model->status,
        'about' => $model->about,
      ];
    }

}
