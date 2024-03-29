<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */

namespace App\Models\Expenses{
    /**
     * App\Models\Expenses\Category
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Category query()
     * @mixin \Eloquent
     * @property-read Team|null $workspace
     * @property int $id
     * @property string $name
     * @property string|null $description
     * @property string $color
     * @property int $team_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereColor($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereTeamId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
     */
    class Category extends \Eloquent
    {
    }
}

namespace App\Models\Expenses{
    /**
     * App\Models\Expenses\Expense
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
     * @mixin \Eloquent
     * @property-read \App\Models\Expenses\Category|null $category
     */
    class Expense extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Income
     *
     * @method static \Database\Factories\IncomeFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Income newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Income newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Income query()
     * @mixin \Eloquent
     * @property int $id
     * @property string $name
     * @property string $description
     * @property int $amount
     * @property string $date
     * @property int $is_recurring
     * @property int $recurring_interval
     * @property int $team_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Illuminate\Database\Eloquent\Builder|Income whereAmount($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Income whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Income whereDate($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Income whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Income whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Income whereIsRecurring($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Income whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Income whereRecurringInterval($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Income whereTeamId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Income whereUpdatedAt($value)
     */
    class Income extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Membership
     *
     * @property int $id
     * @property int $team_id
     * @property int $user_id
     * @property string|null $role
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereRole($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereTeamId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUserId($value)
     * @mixin \Eloquent
     */
    class Membership extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Team
     *
     * @property int $id
     * @property int $user_id
     * @property string $name
     * @property bool $personal_team
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\User|null $owner
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TeamInvitation[] $teamInvitations
     * @property-read int|null $team_invitations_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
     * @property-read int|null $users_count
     * @method static \Database\Factories\TeamFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Team query()
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team wherePersonalTeam($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserId($value)
     * @mixin \Eloquent
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Income[] $incomes
     * @property-read int|null $incomes_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Expenses\Category[] $categories
     * @property-read int|null $categories_count
     * @property-read \Illuminate\Database\Eloquent\Collection|Expense[] $expenses
     * @property-read int|null $expenses_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Expenses\Category[] $expenseCategories
     * @property-read int|null $expense_categories_count
     */
    class Team extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\TeamInvitation
     *
     * @property int $id
     * @property int $team_id
     * @property string $email
     * @property string|null $role
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Team $team
     * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation query()
     * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereRole($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereTeamId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereUpdatedAt($value)
     * @mixin \Eloquent
     */
    class TeamInvitation extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\User
     *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property \Illuminate\Support\Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $two_factor_secret
     * @property string|null $two_factor_recovery_codes
     * @property string|null $two_factor_confirmed_at
     * @property string|null $remember_token
     * @property int|null $current_team_id
     * @property string|null $profile_photo_path
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Team|null $currentTeam
     * @property-read string $profile_photo_url
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $ownedTeams
     * @property-read int|null $owned_teams_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
     * @property-read int|null $teams_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
     * @property-read int|null $tokens_count
     * @method static \Database\Factories\UserFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User query()
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
     * @mixin \Eloquent
     */
    class User extends \Eloquent
    {
    }
}
