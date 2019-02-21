<?php

namespace Modules\Extranet\Jobs\Applications;

use Modules\Extranet\Http\Requests\Admin\Applications\DeleteApplicationRequest;
use Modules\Extranet\Entities\Offers\Application;

class DeleteApplication
{
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public static function fromRequest(Application $application, DeleteApplicationRequest $request)
    {
        return new self($application, $request->all());
    }

    public function handle()
    {
        return $this->application->delete() > 0 ? true : false;
    }
}
