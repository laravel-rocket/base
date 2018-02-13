<?php
namespace Tests\Repositories;

use App\Models\File;
use Tests\TestCase;

class FileRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Repositories\FileRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FileRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models  = factory(File::class, 3)->create();
        $fileIds = $models->pluck('id')->toArray();

        /** @var \App\Repositories\FileRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FileRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(File::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($fileIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models  = factory(File::class, 3)->create();
        $fileIds = $models->pluck('id')->toArray();

        /** @var \App\Repositories\FileRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FileRepositoryInterface::class);
        $this->assertNotNull($repository);

        $fileCheck = $repository->find($fileIds[0]);
        $this->assertEquals($fileIds[0], $fileCheck->id);
    }

    public function testCreate()
    {
        $fileData = factory(File::class)->make();

        /** @var \App\Repositories\FileRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FileRepositoryInterface::class);
        $this->assertNotNull($repository);

        $fileCheck = $repository->create($fileData->toFillableArray());
        $this->assertNotNull($fileCheck);
    }

    public function testUpdate()
    {
        $fileData = factory(File::class)->create();

        /** @var \App\Repositories\FileRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FileRepositoryInterface::class);
        $this->assertNotNull($repository);

        $fileData = factory(File::class)->make();

        $fileCheck = $repository->update($fileData, $fileData->toFillableArray());
        $this->assertNotNull($fileCheck);
    }

    public function testDelete()
    {
        $fileData = factory(File::class)->create();

        /** @var \App\Repositories\FileRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FileRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($fileData);

        $fileCheck = $repository->find($fileData->id);
        $this->assertNull($fileCheck);
    }
}
