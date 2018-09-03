<?php

namespace Modules\Architect\Jobs\Translation;

use Modules\Architect\Http\Requests\Translation\DeleteTranslationRequest;
use Modules\Architect\Entities\Translation;

class DeleteTranslation
{
    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }

    public static function fromRequest(Translation $translation, DeleteTranslationRequest $request)
    {
        return new self($translation);
    }

    public function handle()
    {
        return $this->translation->delete();
    }
}
