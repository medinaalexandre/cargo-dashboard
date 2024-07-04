<?php

namespace App\Models;

use Database\Factories\ContainerFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $label
 * @property string $company
 * @property string $inspection_status
 * @property string $packing_list
 * @property int $items_count
 * @property string $arrival_at
 * @property string $departure_at
 * @property float $weight
 * @property string $origin
 * @property string $destination
 * @property float $capacity
 * @property int $contents_price_cents
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static ContainerFactory factory($count = null, $state = [])
 * @method static Builder|Container newModelQuery()
 * @method static Builder|Container newQuery()
 * @method static Builder|Container query()
 * @method static Builder|Container whereArrivedAt($value)
 * @method static Builder|Container whereCapacity($value)
 * @method static Builder|Container whereCompany($value)
 * @method static Builder|Container whereContentsPriceCents($value)
 * @method static Builder|Container whereCreatedAt($value)
 * @method static Builder|Container whereDepartedAt($value)
 * @method static Builder|Container whereDestination($value)
 * @method static Builder|Container whereId($value)
 * @method static Builder|Container whereInspectionStatus($value)
 * @method static Builder|Container whereItemsCount($value)
 * @method static Builder|Container whereLabel($value)
 * @method static Builder|Container whereOrigin($value)
 * @method static Builder|Container wherePackingList($value)
 * @method static Builder|Container whereUpdatedAt($value)
 * @method static Builder|Container whereWeight($value)
 *
 * @mixin \Eloquent
 */
class Container extends Model
{
    use HasFactory;
}
