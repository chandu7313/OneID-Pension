<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Citizens
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('aadhaar_number')->unique();
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('state');
            $table->string('district')->nullable();
            $table->text('address')->nullable();
            $table->string('pension_status')->default('None'); // Active/Pending/None
            $table->timestamps();
        });

        // 2. Pension Schemes
        Schema::create('pension_schemes', function (Blueprint $table) {
            $table->id();
            $table->string('scheme_name');
            $table->string('scheme_code')->unique();
            $table->string('scheme_type')->nullable(); // Social Security, Healthcare, etc.
            $table->string('provider_type')->nullable(); // Government, Private, NGO
            $table->text('eligibility_criteria')->nullable();
            $table->decimal('benefit_amount', 12, 2)->default(0);
            $table->string('status')->default('Active'); // Active/Draft/Inactive
            $table->timestamps();
        });

        // 3. Citizen Pensions (Assignments)
        Schema::create('citizen_pensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')->constrained('citizens')->onDelete('cascade');
            $table->foreignId('pension_scheme_id')->constrained('pension_schemes')->onDelete('cascade');
            $table->string('enrollment_number')->unique();
            $table->date('start_date');
            $table->decimal('benefit_amount', 12, 2)->default(0);
            $table->string('pension_status')->default('Pending'); // Active/Pending/Suspended
            $table->timestamps();
        });

        // 4. Duplicate Logs
        Schema::create('duplicate_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')->constrained('citizens')->onDelete('cascade'); // Potential duplicate 1
            $table->unsignedBigInteger('duplicate_with_id'); // Potential duplicate 2
            $table->string('status')->default('pending'); // pending/resolved
            $table->timestamps();
            
            $table->foreign('duplicate_with_id')->references('id')->on('citizens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duplicate_logs');
        Schema::dropIfExists('citizen_pensions');
        Schema::dropIfExists('pension_schemes');
        Schema::dropIfExists('citizens');
    }
};
