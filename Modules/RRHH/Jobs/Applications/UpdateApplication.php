<?php

namespace Modules\RRHH\Jobs\Applications;

use Modules\RRHH\Entities\Offers\Application;

class UpdateApplication
{
    private $application;
    private $attributes;

    public function __construct(Application $application, array $attributes = [])
    {
        $this->application = $application;
        $this->attributes = array_only($attributes, (new Application())->getFillable());
    }

    public static function fromRequest(Application $application, Request $request): self
    {
        return new self($application, $request->all());
    }

    public function handle()
    {
        return $this->application->update($this->attributes);
    }
}
