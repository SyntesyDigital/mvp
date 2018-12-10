<?php

namespace Modules\RRHH\Jobs\Tags;

use Modules\RRHH\Entities\Tag;
use App\Models\User;

class UpdateCandidateTags
{
    public function __construct(User $user, $tags)
    {
        $this->tags = $tags;
        $this->user = $user;
    }

    public function handle()
    {
        $tags_array = [];
        $this->user->candidate->tags()->detach();
        foreach ($this->tags as $tag) {
            $tag_exists = Tag::where('name', $tag)->first();
            if (null === $tag_exists) {
                $tag_exists = Tag::create(['name' => $tag]);
            }
            $tags_array[] = $tag_exists->id;
        }

        return $this->user->candidate->tags()->attach($tags_array);
    }
}
