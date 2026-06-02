<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'period',
        'base_salary',
        'allowance',
        'attendance_deduction',
        'status',
        'paid_at',
    ];

    protected $appends = [
        'net_salary',
    ];

    protected function casts(): array
    {
        return [
            'base_salary' => 'decimal:2',
            'allowance' => 'decimal:2',
            'attendance_deduction' => 'decimal:2',
            'paid_at' => 'date',
        ];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getNetSalaryAttribute(): float
    {
        return (float) $this->base_salary + (float) $this->allowance - (float) $this->attendance_deduction;
    }
}
