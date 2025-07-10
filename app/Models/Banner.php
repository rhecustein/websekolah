<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Banner extends Model
    {
        use HasFactory;

        protected $fillable = [
            'title',
            'subtitle',
            'image_path',
            'link_url',
            'link_text',
            'is_active',
            'order',
        ];
    }
    