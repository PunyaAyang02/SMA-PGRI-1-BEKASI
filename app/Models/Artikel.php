<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\KategoriArtikel;
use Illuminate\Support\Facades\Storage;
use Image;
class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    // protected $fillable = [
    // 	'judul','slug','deskripsi','thumbnail','slug','user_id','kategori_artikel_id',
    // ];

    protected $guarded = [
        'id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function kategoriArtikel()
    {
    	return $this->belongsTo(KategoriArtikel::class);
    }

    // public function getThumbnail()
    // {
    // 	return 'uploads/img/artikel/'.$this->thumbnail;
    // }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    /**
     * Save image Owner.
     *
     * @param  $request
     * @return string
     */
    public static function saveImage($request)
    {
        $input['file'] = null;

        if ($request->thumbnail) {
            $file = $request->thumbnail;

            $input['file'] = time() . '.' . $file->getClientOriginalExtension();

            $imgFile = Image::make($file->getRealPath());

            $imgFile->stream();

            Storage::disk('local')->put('public/image/artikel' . '/' . $input['file'], $imgFile, 'public');
        }

        return $input['file'];
    }

    /**
     * Get the image owner url.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/image/artikel' . $this->thumbnail);
        }

        return null;
    }

    /**
     * Delete image.
     *
     * @param  $id
     * @return void
     */
    public static function deleteImage($id)
    {
        $artikel = Artikel::firstWhere('id', $id);

        
        if ($artikel->thumbnail != null) {
            $path = 'public/image/artikel/' . $artikel->thumbnail;
            
            if (Storage::exists($path)) {
                Storage::delete('public/image/artikel/' . $artikel->thumbnail);
            }
        }
    }
}
