<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DateTimeInterface;

/**
 * App\Models\JobCategory
 *
 * @property int $id
 * @property string $name 名称
 * @property string $content 内容
 * @property string $image 画像パス
 * @property int $sort_no 並び順
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Job[] $job
 * @property-read int|null $job_count
 * @method static \Database\Factories\JobCategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|JobCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|JobCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|JobCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobCategory whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobCategory whereSortNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|JobCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|JobCategory withoutTrashed()
 * @mixin \Eloquent
 */
class JobCategory extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id', 'updated_at', 'created_at', 'deleted_at']; // ブラックリスト

    // リレーション
    public function job()
    {
        return $this->hasMany('App\Models\Job');
    }

    /**
    * 日時を日本時間に変換する
    * laravel7からtoArray, toJson内の日時がUTC固定になったので
    *
    * @param  \DateTimeInterface  $date
    * @return string
    */
   protected function serializeDate(DateTimeInterface $date)
   {
       return $date->format('Y-m-d H:i:s');
   }
}
