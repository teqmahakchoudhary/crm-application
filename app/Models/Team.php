<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property string $name
 * @property string $description
 * @property array|null $team_members
 */
class Team extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = ['name', 'description', 'team_members'];

    protected static $logAttributes = ['name', 'team_members', 'description'];
    protected static $recordEvents = ['created', 'updated'];
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    /**
     * Description for activity log event.
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return $eventName;
    }

    /**
     * Generate HTML link to show team details.
     *
     * @param int $id
     * @param string $className
     * @param string $style
     * @return string
     */
    public static function getDetailLink(int $id, string $className = "", string $style = ""): string
    {
        $team = self::withTrashed()->find($id);

        if (!$team || $team->deleted_at !== null) {
            return 'Not Provided';
        }

        $class = $className ?: 'btn-icon text-secondary';
        $name = ucfirst($team->name ?? 'Not Provided');
        $encryptedId = Helpers::encrypt($id);

        return sprintf(
            '<a target="%s" href="javascript:void(0)" data-id="%s" class="show-team-details %s" style="%s">%s</a>',
            config('global-variable.BLANK_TARGET'),
            $encryptedId,
            $class,
            $style,
            $name
        );
    }
}
