<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

/**
 * @mixin IdeHelperReview
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'oneliner',
        'quote',
        'overall',
        'graphics',
        'story',
        'gameplay',
    ];

    protected function casts(): array
    {
        return [
            'overall' => 'float',
            'graphics' => 'float',
            'story' => 'float',
            'gameplay' => 'float',
        ];
    }

    /** @return BelongsTo<Article, $this> */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public static function getForm(?Review $model)
    {
        return [
            TextInput::make('oneliner')
                ->maxLength(255)
                ->default(fn () => $model?->oneliner),

            TinyEditor::make('quote')
                ->columnSpanFull(),

            TextInput::make('overall')
                ->numeric()
                ->step('.1')
                ->hint('Minimum: 0, Maximum: 10')
                ->rules(['min:0', 'max:10']),

            TextInput::make('graphics')
                ->numeric()
                ->step('.1')
                ->hint('Minimum: 0, Maximum: 10')
                ->rules(['min:0', 'max:10']),

            TextInput::make('story')
                ->numeric()
                ->step('.1')
                ->hint('Minimum: 0, Maximum: 10')
                ->rules(['min:0', 'max:10']),

            TextInput::make('gameplay')
                ->numeric()
                ->step('.1')
                ->hint('Minimum: 0, Maximum: 10')
                ->rules(['min:0', 'max:10']),
        ];
    }
}
