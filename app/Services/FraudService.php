<?php

namespace App\Services;

use App\Models\Citizen;
use Illuminate\Support\Facades\DB;

class FraudService
{
    /**
     * Check for potential duplicate identity across Central and State records.
     * This logic uses both PostgreSQL for exact matches and MongoDB for similarity.
     */
    public function checkDuplicate(Citizen $citizen)
    {
        $findings = [];

        // 1. Exact Aadhaar Match (PostgreSQL)
        $exactMatch = Citizen::where('aadhaar_number_hash', $citizen->aadhaar_number_hash)
            ->where('citizen_id', '!=', $citizen->citizen_id)
            ->first();

        if ($exactMatch) {
            $findings[] = "Exact Aadhaar match found with OneID: {$exactMatch->oneid_number}";
        }

        // 2. Fuzzy Matching on Name + DOB (Logic would typically use a DB function or MongoDB fuzzy search)
        // This is a placeholder for the algorithm described in the fraud_detection.md
        
        return [
            'is_flagged' => !empty($findings),
            'findings' => $findings,
            'fraud_score' => !empty($findings) ? 90 : 5,
        ];
    }

    /**
     * Log high-volume audit data to MongoDB.
     */
    public function logAudit($userId, $action, $details)
    {
        // Using MongoDB connection if configured
        try {
            DB::connection('mongodb')->collection('system_audit_logs')->insert([
                'user_id' => $userId,
                'action' => $action,
                'details' => $details,
                'timestamp' => now(),
            ]);
        } catch (\Exception $e) {
            // Fallback to local log if MongoDB fails
            \Log::warning("MongoDB Audit Log failed: " . $e->getMessage());
        }
    }
}
