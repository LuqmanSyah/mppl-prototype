<?php

namespace App\Policies;

use App\Models\PayrollRecord;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayrollRecordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_payroll::record');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PayrollRecord $payrollRecord): bool
    {
        return $user->can('view_payroll::record');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_payroll::record');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PayrollRecord $payrollRecord): bool
    {
        return $user->can('update_payroll::record');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PayrollRecord $payrollRecord): bool
    {
        return $user->can('delete_payroll::record');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_payroll::record');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, PayrollRecord $payrollRecord): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, PayrollRecord $payrollRecord): bool
    {
        return false;
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, PayrollRecord $payrollRecord): bool
    {
        return false;
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return false;
    }
}
