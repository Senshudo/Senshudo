<?php

namespace App\Models;

use Database\Factories\ReviewFactory;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

/**
 * @property int $id
 * @property int $article_id
 * @property string|null $oneliner
 * @property string|null $quote
 * @property float|null $overall
 * @property float|null $graphics
 * @property float|null $story
 * @property float|null $gameplay
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Article $article
 *
 * @method static \Database\Factories\ReviewFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereGameplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereGraphics($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereOneliner($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereOverall($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereStory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereUpdatedAt($value)
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
#[UseFactory(ReviewFactory::class)]
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

    public static function getForm(?Review $model): array
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
