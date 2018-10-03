<?php

namespace Modules\Architect\Jobs\Content;

use Modules\Architect\Http\Requests\Content\DeleteContentRequest;
use Modules\Architect\Entities\Content;

use Illuminate\Support\Facades\Schema;

use Modules\Architect\Tasks\Urls\UpdateUrlsContent;

class DeleteContent
{
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public static function fromRequest(Content $content, DeleteContentRequest $request)
    {
        return new self($content);
    }

    public function handle()
    {
        // Disable FK constraints for this operation
        Schema::disableForeignKeyConstraints();

        // Unindex content (Elasticsearch)
        $this->content->unindex();

        // Update parent ID of childrens
        $contents = Content::where('parent_id', $this->content->id)->get();

        // Update URLS of the contents
        if($contents->isNotEmpty()) {
            foreach($contents as $content) {
                $content->update([
                    'parent_id' => null
                ]);

                (new UpdateUrlsContent($content))->run();
            }
        }

        // Delete content
        $raws = Content::where('id', $this->content->id)->delete();

        // Enable FK constraints
        Schema::enableForeignKeyConstraints();

        return $raws;
    }
}
