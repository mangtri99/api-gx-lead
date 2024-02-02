<?php

namespace App\Repository\Media;

use App\Interface\CrudInterface;

use App\Models\Media;

use Illuminate\Http\Request;

class MediaRepository implements CrudInterface
{
    public function getAll(Request $request)
    {
        return Media::all();
    }

    public function getById(int $id)
    {
        return Media::findOrfail($id);
    }

    public function create(Request $request)
    {
        $media = Media::create([
            'name' => $request->name,
            'channel_id' => $request->channel_id,
            'description' => $request->description,
        ]);
        return $media;
    }

    public function update(Request $request, int $id)
    {
        $media = Media::findOrfail($id);
        $media->name = $request->name;
        $media->channel_id = $request->channel_id;
        $media->description = $request->description;
        $media->save();

        return $media;
    }

    public function delete(int $id)
    {
        $media = Media::findOrfail($id);
        $media->delete();
        return $media;
    }
}
