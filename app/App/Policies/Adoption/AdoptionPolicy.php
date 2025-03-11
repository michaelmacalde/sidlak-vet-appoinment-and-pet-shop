<?php

namespace App\Policies\Adoption;

use App\Models\User;
use App\Models\Adoption\Adoption;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdoptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_adoption::adoption');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Adoption $adoption): bool
    {
        return $user->can('view_adoption::adoption');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_adoption::adoption');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Adoption $adoption): bool
    {
        return $user->can('update_adoption::adoption');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Adoption $adoption): bool
    {
        return $user->can('delete_adoption::adoption');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_adoption::adoption');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Adoption $adoption): bool
    {
        return $user->can('force_delete_adoption::adoption');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_adoption::adoption');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Adoption $adoption): bool
    {
        return $user->can('restore_adoption::adoption');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_adoption::adoption');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Adoption $adoption): bool
    {
        return $user->can('replicate_adoption::adoption');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_adoption::adoption');
    }
}
