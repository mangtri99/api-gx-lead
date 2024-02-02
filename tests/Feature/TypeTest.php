
<?php

use App\Repository\Type\TypeRepository;
use App\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->typeRepository = new TypeRepository();
});

test('it can get all types', function () {
    Type::factory()->count(3)->create();
    $types = $this->typeRepository->getAll(new Request());
    expect($types)->toHaveCount(3);
});

test('it can get a type by id', function () {
    $type = Type::factory()->count(1)->create()->first();
    $foundType = $this->typeRepository->getById($type->id);
    expect($foundType->id)->toBe($type->id);
});

test('it can create a type', function () {
    $request = new Request();
    $request->replace(['name' => 'Test Type', 'description' => 'Test Description']);
    $type = $this->typeRepository->create($request);
    expect($type->name)->toBe('Test Type');
    expect($type->description)->toBe('Test Description');
});

test('it can update a type', function () {
    $type = Type::factory()->count(1)->create()->first();
    $request = new Request();
    $request->replace(['name' => 'Updated Type', 'description' => 'Updated Description']);
    $updatedType = $this->typeRepository->update($request, $type->id);
    expect($updatedType->name)->toBe('Updated Type');
    expect($updatedType->description)->toBe('Updated Description');
});

test('it can delete a type', function () {
    $type = Type::factory()->count(1)->create()->first();
    $deletedType = $this->typeRepository->delete($type->id);
    expect($deletedType->id)->toBe($type->id);
    expect(Type::find($type->id))->toBeNull();
});
?>
