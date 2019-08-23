<?php
namespace Modules\Extranet\Jobs\Elements;

use Modules\Extranet\Http\Requests\Elements\PostServiceRequest;

use Modules\Extranet\Repositories\BobyRepository;

use Config;
use Carbon\Carbon;

class ProcessService
{
  //  use FormFields;

    public function __construct($attributes)
    {
      $this->attributes = array_only($attributes, [
          'method',
          'url',
          'data'
      ]);
    }

    public static function fromRequest(PostServiceRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {

      $bobyRepository = new BobyRepository();

      $response = $bobyRepository->processService(
        $this->attributes['method'],
        $this->attributes['url'],
        $this->attributes['data']
      );

      dd($response);

      return true;
    }
}
