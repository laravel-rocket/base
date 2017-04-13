<?php
namespace Tests\Models;

use App\Models\File;
use Tests\TestCase;

class FileTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Models\File $file */
        $file = new File();
        $this->assertNotNull($file);
    }

    public function testStoreNew()
    {
        /** @var \App\Models\File $file */
        $fileModel = new File();

        $fileData = factory(File::class)->make();
        foreach ($fileData->toFillableArray() as $key => $value) {
            $fileModel->$key = $value;
        }
        $fileModel->save();

        $this->assertNotNull(File::find($fileModel->id));
    }
}
