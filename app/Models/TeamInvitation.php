<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\WorkspaceInvitation as JetstreamWorkspaceInvitation;

/**
 * App\Models\WorkspaceInvitation
 *
 * @property int $id
 * @property int $workspace_id
 * @property string $email
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Workspace $workspace
 * @method static \Illuminate\Database\Eloquent\Builder|WorkspaceInvitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkspaceInvitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkspaceInvitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkspaceInvitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkspaceInvitation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkspaceInvitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkspaceInvitation whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkspaceInvitation whereWorkspaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkspaceInvitation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WorkspaceInvitation extends JetstreamWorkspaceInvitation
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string<int, string>
     */
    protected $fillable = [
        'email',
        'role',
    ];

    /**
     * Get the workspace that the invitation belongs to.
     */
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Jetstream::workspaceModel());
    }
}
