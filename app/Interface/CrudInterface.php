<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface CrudInterface
{
    public function getAll(Request $request);
    public function getById(int $id);
    public function create(Request $request);
    public function update(Request $request, int $id);
    public function delete(int $id);

}
