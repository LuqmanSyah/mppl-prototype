<?php

use App\Models\PayrollRecord;

it('calculates net salary from payroll components', function (): void {
    $payroll = new PayrollRecord([
        'base_salary' => 6500000,
        'allowance' => 1250000,
        'attendance_deduction' => 150000,
    ]);

    expect($payroll->net_salary)->toBe(7600000.0);
});
