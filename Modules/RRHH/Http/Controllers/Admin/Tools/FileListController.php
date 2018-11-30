<?php

namespace Modules\RRHH\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Admin\Tools\FileList\CreateFileRequest;
use Modules\RRHH\Http\Requests\Admin\Tools\SiteList\UpdateSiteListRequest;
use Modules\RRHH\Jobs\Tools\FileList\CreateFile;
use Modules\RRHH\Jobs\Tools\FileList\DeleteFile;
use Modules\RRHH\Jobs\Tools\FileList\GetFileList;
use Modules\RRHH\Jobs\Tools\FileList\UpdateFileList;
use Illuminate\Http\Request;
use Session;

class FileListController extends Controller
{
    public function index(Request $request)
    {
        return view('rrhh::admin.tools.filelist.form', [
            'filelist' => $this->dispatchNow(new GetFileList()),
        ]);
    }

    public function update(UpdateSiteListRequest $request)
    {
        $filelist = $this->dispatchNow(new GetFileList());
        try {
            $this->dispatchNow(UpdateFileList::fromRequest($filelist, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.tools.filelist.index');
    }

    public function store(CreateFileRequest $request)
    {
        return $this->dispatchNow(CreateFile::fromRequest($request));
    }

    public function delete(Request $request)
    {
        $filename = $request->get('filename');
        if ($this->dispatchNow(new DeleteFile($filename))) {
            return 'deleted';
        } else {
            return 'error';
        }
    }

    public function sort(Request $request)
    {
        $value = $request->get('value');
        $filelist = $this->dispatchNow(new GetFileList());
        if ($this->dispatchNow(UpdateFileList::fromSort($filelist, $value))) {
            return 'saved';
        } else {
            return 'error';
        }
    }
}
