<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($ability == 'impersonate' || $ability == 'stopImpersonate') {
            // do not check if is admin.
        } elseif ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can list models.
     *
     * @param  User $user
     * @return mixed
     */
    public function viewList(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->isAdmin() && $user->id != $model->id;
    }

    /**
     * Determine whether the user can impersonate the model.
     *
     * @param \App\User $user
     * @param \App\User $model
     * @return bool
     */
    public function impersonate(User $user, User $model)
    {
        // Should be an admin.
        // Cannot impersonate again if already impersonating a user.
        // Cannot impersonate yourself.
        return $user->isAdmin() && ! $user->isImpersonating() && $user->id !== $model->id;
    }

    /**
     * Determine whether the user can stop impersonation.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function stopImpersonate(User $user)
    {
        // Already impersonating a user?
        return $user->isImpersonating();
    }
}
